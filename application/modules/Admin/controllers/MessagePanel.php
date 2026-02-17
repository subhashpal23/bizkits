<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/MessagePanel
*/
class MessagePanel extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper('layout');
		$this->load->model('member_model');
		$this->load->model('message_panel_model');
	} 
	public function inbox()
	{
		$data=array();
		$data['all_inbox_msg']=$this->message_panel_model->getAllInboxMessage(COMP_USER_ID);
		_adminLayout("message-panel/inbox",$data);
	}
	function deleteInboxMessage($id)
	{
		$id=ID_decode($id);
		$this->db->delete("message",array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is deleted successfully.');
		redirect(ci_site_url() . "admin/MessagePanel/inbox");
		exit;
	}
    function generateMessageId()
    {
        $random_number="M".mt_rand(100000, 999999);
        if($this->db->select('message_id')->from('message')->where('message_id',$random_number)->get()->num_rows()>0)
        {
          $this->generateMessageId();
        }
        return $random_number;
	}//end function

	/**
	 * Return current admin username/name safely even if COMP_USERNAME constant is not defined.
	 */
	private function getCompUsernameSafe()
	{
		if (defined('COMP_USERNAME') && !empty(COMP_USERNAME)) {
			return COMP_USERNAME;
		}

		// try session (common in CI apps)
		$sessionUsername = $this->session->userdata('username');
		if (!empty($sessionUsername)) {
			return $sessionUsername;
		}

		// fallback: fetch from DB if possible
		try {
			$row = $this->db->select('username')->from('users')->where('user_id', COMP_USER_ID)->get()->row();
			if (!empty($row) && !empty($row->username)) {
				return $row->username;
			}
		} catch (Throwable $e) {
			// ignore and fallback
		}

		return (defined('COMP_USER_ID') ? (string)COMP_USER_ID : '');
	}

	public function composeMessage()
	{
		if(!empty($this->input->post("btn")))
		{
			$all_users=$this->input->post('users');
			//pr($all_users);
			$subject=$this->input->post('subject');
			$message=$this->input->post('message');
			$message_id=$this->generateMessageId();
			$attachment='';
			if(!empty($_FILES['attachment']))
			{
				$image_upload_path='/images/';
			    $attachment=adImageUpload($_FILES['attachment'],1, $image_upload_path);
			}
			////////////////////////////////
			$sender_name = $this->getCompUsernameSafe();
			foreach($all_users as $user_id)
			{
				$compose_to[]=array(
					'message_id'=>$message_id,
					'user_id'=>$user_id,
					'subject'=>$subject,
					'message'=>$message,
					'reciever_id'=>$user_id,
					'sender_id'=>COMP_USER_ID,
					'reciever_name'=>get_user_name($user_id),
					'sender_name'=>$sender_name,
					'attachment'=>$attachment
					);
			}
			$this->db->insert_batch("message",$compose_to);
			$this->db->insert("message",array(
					'message_id'=>$message_id,
					'user_id'=>COMP_USER_ID,
					'subject'=>$subject,
					'message'=>$message,
					'sender_id'=>COMP_USER_ID,
					'sender_name'=>$sender_name,
					'attachment'=>$attachment
					));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is sent successfully');
			redirect(ci_site_url() . "admin/MessagePanel/sentMessage");
			exit;
		}
		$data=array();
		$data['all_active_members']=$this->member_model->getAllActiveMembers();
				// print_r($data['all_active_members']); exit;

		_adminLayout("message-panel/compose-message",$data);
	}//end method
	public function sentMessage()
	{
		$data=array();
		$data['all_sent_msg']=$this->message_panel_model->getAllSentMessage(COMP_USER_ID);
		_adminLayout("message-panel/sent-message",$data);
	}
	function deleteSentMessage($id)
	{
		$id=ID_decode($id);
		$this->db->delete("message",array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is deleted successfully.');
		redirect(ci_site_url() . "admin/MessagePanel/sentMessage");
		exit;
	}
	public function readMessage($message_id=null)
	{
		$message_id=(!empty($message_id))?$message_id:$this->input->post('msg_id');
		$id=ID_decode($message_id);
		sleep(1);
		$msg=$this->db->select('m.*')->from('message as m')->where('id',$id)->get()->row();
		$this->output->set_content_type('application/json')->set_output(json_encode($msg));
	}
}//end class
