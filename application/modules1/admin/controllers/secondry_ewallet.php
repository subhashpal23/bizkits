<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/secondry_ewallet
*/
class Secondry_Ewallet extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		if(!is_active_secondry_ewallet())
		{
			redirect(ci_site_url()."admin/AdminWallet/viewEwalletBalance");
			exit;
		}
		$this->load->helper("layout_helper");
		$this->load->model('secondry_ewallet_model');
		$this->load->model('member_model');
		$this->userId=$this->session->userdata('user_id');
		
	} 
	/*
	@Desc: It's used to view the ewallet balance
	*/
	public function viewEwalletBalance()
	{
		$data['title']='Ewallet Balance';
		$data['ewallet_balance']=$this->secondry_ewallet_model->getEwalletBalance($this->userId);
		_userLayout("secondry-ewallet-mgmt/view-ewallet-balance",$data);
	}

	public function viewEwalletStatement()
	{
		$data=array();
        $all_statements=$this->secondry_ewallet_model->getEwalletStatements($this->userId);
		$data['all_statements']=$all_statements;
		_userLayout("secondry-ewallet-mgmt/view-ewallet-statement",$data);
	}//end method
}//end class
