<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_ConferenceData;
use Google_Service_Calendar_CreateConferenceRequest;

class Customer extends Common_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->load->model('Agent_model');
        $this->load->model('Meeting_model');
        $this->config->load('google');
        // load composer autoload
        require_once FCPATH . 'vendor/autoload.php';
    }
    public function index() {
        echo "Customer controller loaded successfully!";
    }

    // 1) Agent clicks link to connect Google

    public function connect_agent($agentId)
    {
        // Start clean output buffer
        
    
        $this->load->config('google');
        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
    
        $state = base64_encode(json_encode(['agent_id' => $agentId]));
        $authUrl = $client->createAuthUrl() . '&state=' . urlencode($state);
    
        // Clear buffer before redirect
        if (ob_get_length()) {
            ob_end_clean();
        }
    
        header("Location: $authUrl", true, 302);
        exit;
    }


    // 2) OAuth callback
    public function oauth_callback() {
        
        $this->load->config('google');
        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));

        if ($this->input->get('code')) {
            $code = $this->input->get('code');
            $state = $this->input->get('state');
            $stateData = json_decode(base64_decode($state), true);
            $agentId = $stateData['agent_id'] ?? null;
            //echo $code;die;

            $token = $client->fetchAccessTokenWithAuthCode($code);
            if (isset($token['error'])) {
                // handle error
                show_error('Google OAuth error: ' . $token['error_description']);
                return;
            }
            // token contains access_token, expires_in, refresh_token (only on first grant)
            $refreshToken = $token['refresh_token'] ?? null;
            $accessToken = $token['access_token'] ?? null;
            $expiresAt = isset($token['expires_in']) ? time() + $token['expires_in'] : null;

            if (!$agentId) {
                show_error('Missing agent id in state.');
                return;
            }
            // save refresh token and access info to DB
            $this->Agent_model->update_tokens($agentId, $refreshToken, json_encode($token), $expiresAt);
            echo "Google account connected. You can close this window.";die;
        } else {
            show_error('No code parameter.');
        }
    }

    // Helper: build Google client for an agent using stored refresh token
    private function buildClientForAgent($agent) {
        $this->load->config('google');
        $client = new Google_Client();
        $client->setApplicationName($this->config->item('google_application_name'));
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setAccessType('offline');

        // If we stored full token JSON, use it
        if (!empty($agent->google_access_token)) {
            $token = json_decode($agent->google_access_token, true);
            if ($token) $client->setAccessToken($token);
        }

        // If token expired and we have refresh_token, refresh it
        if ($client->isAccessTokenExpired()) {
            $refreshToken = $agent->google_refresh_token;
            if ($refreshToken) {
                $client->fetchAccessTokenWithRefreshToken($refreshToken);
                $newToken = $client->getAccessToken();
                // update stored access token JSON and expiry
                $expiresAt = isset($newToken['expires_in']) ? time() + $newToken['expires_in'] : null;
                $this->Agent_model->update_tokens($agent->id, $refreshToken, json_encode($newToken), $expiresAt);
            } else {
                throw new Exception("Agent missing refresh token. Agent must reconnect Google account.");
            }
        }
        return $client;
    }

    // 3) Called when payment is confirmed — create the meeting
    //    $agentId: which agent will host
    //    $customerId: id of customer (for record)
    //    $startTimeStr: start time e.g. '2025-10-12 16:00:00' (server tz)
    //    $durationMinutes: integer minutes for meeting length
    public function create_meet_on_payment($agentId, $customerId, $startTimeStr, $durationMinutes) {
        $agent = $this->Agent_model->get($agentId);
        if (!$agent) throw new Exception("Agent not found.");

        // prepare client
        $client = $this->buildClientForAgent($agent);
        $service = new Google_Service_Calendar($client);

        // times must be RFC3339 with timezone. Adjust as needed.
        $start = new DateTime($startTimeStr);
        $end = clone $start;
        $end->modify("+{$durationMinutes} minutes");

        $event = new Google_Service_Calendar_Event([
            'summary' => "Paid Meeting with customer #{$customerId}",
            'description' => "Meeting between agent {$agent->id} and customer {$customerId}.",
            'start' => [
                'dateTime' => $start->format(DateTime::RFC3339),
                'timeZone' => date_default_timezone_get()
            ],
            'end' => [
                'dateTime' => $end->format(DateTime::RFC3339),
                'timeZone' => date_default_timezone_get()
            ],
            // Request conference data (Meet link)
            'conferenceData' => new Google_Service_Calendar_ConferenceData([
                'createRequest' => new Google_Service_Calendar_CreateConferenceRequest([
                    'requestId' => 'meet-request-' . uniqid()
                ])
            ]),
            // Optionally set guests (invite customer email if known)
            // 'attendees' => [
            //   ['email' => 'customer@example.com']
            // ]
        ]);

        // When inserting, set conferenceDataVersion=1 and sendUpdates to "none" or "all"
        $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1, 'sendUpdates' => 'all']);

        // extract meet link
        $meetLink = null;
        if (isset($createdEvent->conferenceData) && isset($createdEvent->conferenceData->entryPoints)) {
            foreach ($createdEvent->conferenceData->entryPoints as $entry) {
                if ($entry->entryPointType === 'video') {
                    $meetLink = $entry->uri;
                    break;
                }
            }
        }
        // fallback: sometimes hangoutLink present
        if (!$meetLink && isset($createdEvent->hangoutLink)) {
            $meetLink = $createdEvent->hangoutLink;
        }

        // store meeting in DB
        $meetingData = [
            'agent_id' => $agentId,
            'customer_id' => $customerId,
            'calendar_event_id' => $createdEvent->getId(),
            'meet_link' => $meetLink,
            'start_time' => $start->format('Y-m-d H:i:s'),
            'end_time' => $end->format('Y-m-d H:i:s'),
            'status' => 'scheduled'
        ];
        $meetingId = $this->Meeting_model->create($meetingData);

        // return meeting details
        return [
            'meeting_id' => $meetingId,
            'meet_link' => $meetLink,
            'calendar_event_id' => $createdEvent->getId(),
            'start' => $start->format('Y-m-d H:i:s'),
            'end' => $end->format('Y-m-d H:i:s')
        ];
    }

    // Example endpoint that receives payment webhook (e.g. Stripe). Adjust per gateway.
    public function stripe_webhook() {
        // Example: decode JSON from Stripe and on successful payment create meeting
        $payload = @file_get_contents('php://input');
        $event_json = json_decode($payload, true);

        // Validate signature in production. For this example assume valid.
        // Determine agentId, customerId, startTime and duration from your order data.
        // I’ll assume you map the Stripe metadata to these values:
        $metadata = $event_json['data']['object']['metadata'] ?? [];

        if ($event_json['type'] === 'payment_intent.succeeded') {
            $agentId = $metadata['agent_id'] ?? null;
            $customerId = $metadata['customer_id'] ?? null;
            $start = $metadata['start_time'] ?? null; // '2025-10-12 16:00:00'
            $duration = intval($metadata['duration_minutes'] ?? 60);

            if ($agentId && $customerId && $start) {
                try {
                    $result = $this->create_meet_on_payment($agentId, $customerId, $start, $duration);

                    // send mail/sms to customer with $result['meet_link'] OR return success
                    http_response_code(200);
                    echo json_encode(['ok'=>true, 'meeting'=>$result]);
                    return;
                } catch (Exception $e) {
                    http_response_code(500);
                    echo json_encode(['error' => $e->getMessage()]);
                    return;
                }
            }
        }
        http_response_code(400);
        echo json_encode(['status'=>'ignored']);
    }    
}
