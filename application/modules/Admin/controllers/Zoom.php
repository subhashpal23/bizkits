<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zoom extends CI_Controller {

    private $api_key = '4rmQvy0lQ_W6f1w_XRfXRA';
    private $api_secret = 'fVD5MJn2rWPcO6A5iw1DooX0XYlNNCk1';

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    // JWT Token generate function
    private function generateJWT() {
        $header = json_encode(['alg'=>'HS256','typ'=>'JWT']);
        $payload = json_encode([
            'iss' => $this->api_key,
            'exp' => time() + 3600
        ]);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->api_secret, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    // Create Zoom Meeting
    public function create_meeting() {
		echo "<h3>Zoom Meeting Creation</h3>";exit;
        $jwt = $this->generateJWT();

        $data = [
            "topic" => "Test Meeting",
            "type" => 2, // Scheduled meeting
            "start_time" => date("Y-m-d\TH:i:s", strtotime("+5 minutes")),
            "duration" => 30,
            "timezone" => "Asia/Kolkata",
            "agenda" => "Testing Zoom API",
            "settings" => [
                "host_video" => true,
                "participant_video" => true,
                "join_before_host" => false,
                "mute_upon_entry" => true,
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zoom.us/v2/users/me/meetings");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $jwt",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $result = json_decode($response, true);
        echo "<pre>";
        print_r($result); // Zoom meeting info
        echo "</pre>";
    }
}
