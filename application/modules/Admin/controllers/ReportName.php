<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportName extends Common_Controller
{
    public function __construct()
    {
        parent::__construct();
        admin_auth();
        $this->load->helper('layout_helper');
    }

    public function index()
    {
        $data = [];
        $data['title'] = 'Report';

        // Customers (member_type=2)
        $data['customers'] = $this->db
            ->select('ur.user_id, ur.username, ur.first_name, ur.last_name, ur.email, ur.contact_no, ur.active_status')
            ->from('user_registration ur')
            ->where('ur.member_type', 2)
            ->order_by('ur.user_id', 'DESC')
            ->get()
            ->result();

        // Calls info from user_calls (if not exists => 0)
        $calls = $this->db->select('user_id,total_calls,used_calls,remaining_calls')->from('user_calls')->get()->result();
        $callsMap = [];
        foreach ($calls as $c) {
            $callsMap[$c->user_id] = $c;
        }
        $data['callsMap'] = $callsMap;

        // meeting connect count per customer (approved or all?) -> keep all rows count
        $meetCounts = $this->db
            ->select('customer_id, COUNT(*) as cnt')
            ->from('customer_meeting_requests')
            ->group_by('customer_id')
            ->get()
            ->result();
        $meetCountMap = [];
        foreach ($meetCounts as $m) {
            $meetCountMap[$m->customer_id] = (int)$m->cnt;
        }
        $data['meetCountMap'] = $meetCountMap;

        _adminLayout('report-mgmt/report-name', $data);
    }

    public function customer_detail($user_id = null)
    {
        $user_id = (int)$user_id;
        if (!$user_id) {
            echo json_encode(['status' => false, 'message' => 'Invalid user']);
            return;
        }

        $customer = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('user_id', $user_id)
            ->get()
            ->row();

        $calls = $this->db
            ->select('*')
            ->from('user_calls')
            ->where('user_id', $user_id)
            ->get()
            ->row();

        $requests = $this->db
            ->select('cmr.*, eu.username as expert_username, eu.first_name as expert_first_name, eu.last_name as expert_last_name')
            ->from('customer_meeting_requests cmr')
            ->join('user_registration eu', 'eu.user_id = cmr.expert_id', 'left')
            ->where('cmr.customer_id', $user_id)
            ->order_by('cmr.id', 'DESC')
            ->get()
            ->result();

        echo json_encode([
            'status' => true,
            'customer' => $customer,
            'calls' => $calls,
            'requests' => $requests,
        ]);
    }
}
