<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting_model extends Common_Model {

    public function create($data) {
        $this->db->insert('meetings', $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id) {
        return $this->db->get_where('meetings',['id'=>$id])->row();
    }

    public function get_expired_scheduled($now) {
        $this->db->where('status','scheduled');
        $this->db->where('end_time <=',$now);
        return $this->db->get('meetings')->result();
    }

    public function mark_finished($id) {
        $this->db->where('id',$id)->update('meetings',['status'=>'finished','updated_at'=>date('Y-m-d H:i:s')]);
    }

    public function cancel($id) {
        $this->db->where('id',$id)->update('meetings',['status'=>'cancelled','updated_at'=>date('Y-m-d H:i:s')]);
    }

    
}
