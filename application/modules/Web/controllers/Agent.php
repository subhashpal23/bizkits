<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends Common_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Agent_model');
        $this->load->config('google');
        require_once APPPATH . '../vendor/autoload.php';
    }

    public function dashboard() {
        // Assuming agent_id stored in session after login
        $agent_id = $this->session->userdata('agent_id');
        if (!$agent_id) redirect('login');

        $agent = $this->Agent_model->get_by_id($agent_id);

        $isConnected = false;
        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));

        if (!empty($agent->google_token)) {
            $token = json_decode($agent->google_token, true);
            $client->setAccessToken($token);
            if (!$client->isAccessTokenExpired()) {
                $isConnected = true;
            }
        }

        $data = [
            'agent' => $agent,
            'isConnected' => $isConnected
        ];
        $this->load->model('Booking_model');
        $data['bookings'] = $this->Booking_model->get_by_agent($agent_id);


        $this->load->view('agent/dashboard', $data);
    }
}
