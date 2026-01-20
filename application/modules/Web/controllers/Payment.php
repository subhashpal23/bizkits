<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Common_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Agent_model', 'Booking_model']);
        $this->load->config('google');
        require_once APPPATH . '../vendor/autoload.php';
    }

    public function success($booking_id) {
        // example: fetch booking info
        $booking = $this->Booking_model->get_by_id($booking_id);
        $agent_id = $booking->agent_id;
        $duration = $booking->duration; // minutes (e.g. 60)

        $token = $this->Agent_model->get_google_token($agent_id);
        if (!$token) {
            show_error('Agent not connected to Google Calendar.');
        }

        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setAccessToken($token);

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                show_error('Agent token expired, please reconnect Google.');
            }
        }

        $service = new Google_Service_Calendar($client);

        $start = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $end   = clone $start;
        $end->modify("+{$duration} minutes");

        $event = new Google_Service_Calendar_Event([
            'summary' => 'Customer Meeting',
            'start' => ['dateTime' => $start->format(DateTime::RFC3339)],
            'end'   => ['dateTime' => $end->format(DateTime::RFC3339)],
            'conferenceData' => [
                'createRequest' => ['requestId' => uniqid()]
            ],
        ]);

        $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);
        $meetLink = $createdEvent->hangoutLink;

        $this->Booking_model->update_meet_link($booking_id, [
            'meet_link'  => $meetLink,
            'meet_start' => $start->format('Y-m-d H:i:s'),
            'meet_end'   => $end->format('Y-m-d H:i:s')
        ]);

        // You can send this link via email or show on frontend
        echo "Meeting link: <a href='{$meetLink}' target='_blank'>{$meetLink}</a>";
    }
}
