<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_ConferenceData;
use Google_Service_Calendar_CreateConferenceRequest;
class Google extends Common_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Agent_model');
        $this->load->model('Meeting_model');
        $this->config->load('google');
        // load composer autoload
        require_once FCPATH . 'vendor/autoload.php';
    }

    private function getClient() {
        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        return $client;
    }

    // Step 1: Redirect agent to Google login
    public function auth() {
        $client = $this->getClient();
        redirect($client->createAuthUrl());
    }

    // Step 2: Callback from Google
    public function callback() {
        $client = $this->getClient();
        if ($this->input->get('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));
            $userInfoService = new Google_Service_Oauth2($client);
            $userInfo = $userInfoService->userinfo->get();

            // assuming logged-in agent ID is stored in session
            $agent_id = $this->session->userdata('agent_id');
            if ($agent_id) {
                $this->Agent_model->save_google_token($agent_id, json_encode($token));
            }

            $this->session->set_flashdata('success', 'Google account connected successfully!');
            redirect('agent/dashboard');
        }
    }
    public function callback() {
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
            echo "Google account connected. You can close this window.";
        } else {
            show_error('No code parameter.');
        }
    }
}
