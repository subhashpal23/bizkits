<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends Common_Model {

    public function get($id) {
        return $this->db->get_where('user_registration',['id'=>$id])->row();
    }

    public function update_tokens($agentId, $refreshToken, $accessToken = null, $expiresAt = null) {
        $data = [
          'google_refresh_token' => $refreshToken,
          'google_access_token' => $accessToken,
          'google_token_expires_at' => $expiresAt ? date('Y-m-d H:i:s',$expiresAt) : null
        ];
        $this->db->where('id',$agentId)->update('user_registration',$data);
    }

}
