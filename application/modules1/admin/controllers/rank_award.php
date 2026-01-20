<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/rank_award
*/
class Rank_Award extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
	} 
	public function index()
	{
		$data=array();
		$data['all_rank']=$this->db->select(array('r.*','u.username'))
		->from('rank_award as r')
		->join('user_registration as u','r.user_id=u.user_id')
		->order_by('r.create_date','desc')
		->get()
		->result();
		//pr($data['all_rank']);
		_adminLayout("rank-award-mgmt/rank-award",$data);
	}
}//end class
