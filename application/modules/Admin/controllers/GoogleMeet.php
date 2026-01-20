<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "../vendor/autoload.php";
$client->setClientId(getenv('GOOGLE_CLIENT_ID'));
$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
class GoogleMeet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        session_start();
    }

    private function getClient() {

        $client = new Google_Client();

		$client->setClientId(getenv('GOOGLE_CLIENT_ID'));
		$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));

        // ⚠️ EXACT redirect URI (Google console me bhi same hona chahiye)
        $client->setRedirectUri('http://localhost/bizkits/Admin/googlemeet/callback');

        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        return $client;
    }

    // STEP 1: Google login
    public function index() {
        $client = $this->getClient();
        redirect($client->createAuthUrl());
    }

    // STEP 2: Callback
	public function callback() {

		if (!isset($_GET['code'])) {
			redirect('admin/');
		}
	
		$client = $this->getClient();  // Initialize client FIRST
	
		
		$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
		
		
	
		// 🔴 token error check (VERY IMPORTANT)
		if (isset($token['error'])) {
			echo '<pre>';
			print_r($token);
			exit;
		}
	
		$_SESSION['access_token'] = $token;
		
		redirect('admin/googlemeet/createMeeting');
	}
	

    // STEP 3: Create Meet
    public function createMeeting() {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
	
			// Form values
			$date = $this->input->post('meet_date');
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
	
			if (!$date || !$start_time || !$end_time) {
				$this->session->set_flashdata('error', 'All fields are required');
				redirect('admin/googlemeet/form');
			}
	
			if (empty($_SESSION['access_token'])) {
				redirect('admin/googlemeet');
			}
	
			$client = $this->getClient();
			$client->setAccessToken($_SESSION['access_token']);
	
			if ($client->isAccessTokenExpired()) {
				unset($_SESSION['access_token']);
				redirect('admin/googlemeet');
			}
	
			$service = new Google_Service_Calendar($client);
	
			$startDateTime = date('c', strtotime("$date $start_time"));
			$endDateTime = date('c', strtotime("$date $end_time"));
	
			$event = new Google_Service_Calendar_Event([
				'summary' => 'Bizkits Google Meet',
				'description' => 'Meeting from CodeIgniter',
				'start' => [
					'dateTime' => $startDateTime,
					'timeZone' => 'Asia/Kolkata',
				],
				'end' => [
					'dateTime' => $endDateTime,
					'timeZone' => 'Asia/Kolkata',
				],
				'attendees' => [
					['email' => 'npcoder2002@gmail.com'] // Sirf host
				],
				'conferenceData' => [
					'createRequest' => [
						'requestId' => uniqid(),
						'conferenceSolutionKey' => [
							'type' => 'hangoutsMeet'
						],
					],
				],
			]);
	
			$event = $service->events->insert(
				'primary',
				$event,
				['conferenceDataVersion' => 1]
			);
	
			$data['event'] = $event;
			_adminLayout("google_meet",$data);
	
		} else {
			// Agar GET request hai, form dikhaye
			_adminLayout("google_meet_form", []);
		}
	}
	}
