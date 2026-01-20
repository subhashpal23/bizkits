<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/set_leg_position
*/
class Set_Leg_Position extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
	} 
	public function index()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$set_leg_position=$this->input->post('set_leg_position');
			$this->db->update('user_registration',array('set_leg_position'=>$set_leg_position),array('user_id'=>$this->user_id));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Leg Position is set Successfully');
			redirect(ci_site_url() . "user/set_leg_position/");
            exit;
		}
		$user_details=get_user_details($this->user_id);
		$data['leg_position']=$user_details->set_leg_position;
		_userLayout('set-leg-position-mgmt/set-leg-position',$data);
	}//end method
	
}//end class
