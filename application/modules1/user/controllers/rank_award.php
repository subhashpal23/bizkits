<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/rank_award
*/
class Rank_Award extends Common_Controller 
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
		$data['all_rank']=$this->db->select('*')->from('rank_award')->where('user_id', $this->user_id)->order_by('create_date','desc')->get()->result();
		_userLayout("rank-award-mgmt/rank-award",$data);
	}
}//end class
