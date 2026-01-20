<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/rank_kw_report
*/
class Rank_Kw_Report extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->user_id=$this->session->userdata('user_id');
		$this->load->model('rank_kw_report_model','kw');
	} 
	public function selfKwList()
	{
		$data=array();
		$data['kw_point']=$this->kw->getSelfKw($this->user_id);
		_userLayout("rank-kw-report-mgmt/self-kw-list",$data);
	}//end method
	public function leftKwList()
	{
		$data=array();
		$data['kw_point']=$this->kw->getLeftKw($this->user_id);
		_userLayout("rank-kw-report-mgmt/left-kw-list",$data);
	}//end method
	public function rightKwList()
	{
		$data=array();
		$data['kw_point']=$this->kw->getRightKw($this->user_id);
		_userLayout("rank-kw-report-mgmt/right-kw-list",$data);
	}//end method

	
}//end class
