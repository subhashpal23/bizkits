<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/user
*/
class User extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->model('dashboard_model');
		$this->load->model('ewallet_model');
		
		$this->load->model('TeamReport_model','team_report');
		$this->load->model('IncomeReport_Model','income_report');

	} 
	/*
	@Desc:It's used to render the userbackoffice dashboard page
	*/
	public function index()
	{
		/*************************/
		$user_details=$this->dashboard_model->getUserDetails($this->user_id);
        $data['referral_link']=base_url().'join-us/'.$this->user_id;
        //$enabled_commission=$this->dashboard_model->getEnabledCommission($user_details->pkg_id);

		//$data['total_commission']=(!empty($this->income_report->getTotalCommission($this->user_id)))?$this->income_report->getTotalCommission($this->user_id):0;

		//$data['total_direct_commission']=(!empty($this->income_report->getTotalDirectCommission($this->user_id)))?$this->income_report->getTotalDirectCommission($this->user_id):0;

		$data['total_binary_commission']=(!empty($this->income_report->getTotalBinaryCommission($this->user_id)))?$this->income_report->getTotalBinaryCommission($this->user_id):0;

		//$data['total_matching_commission']=(!empty($this->income_report->getTotalMatchingCommission($this->user_id)))?$this->income_report->getTotalMatchingCommission($this->user_id):0;
	
		$data['total_unilevel_commission']=(!empty($this->income_report->getTotalUnilevelCommission($this->user_id)))?$this->income_report->getTotalUnilevelCommission($this->user_id):0;

		$data['enabled_commission']=$enabled_commission;
		/**************************/
		$data['total_team_member']=(!empty($this->team_report->getTotalTeamMember($this->user_id)))?$this->team_report->getTotalTeamMember($this->user_id):0;

		$data['total_direct_member']=(!empty($this->team_report->getTotalDirectMember($this->user_id)))?$this->team_report->getTotalDirectMember($this->user_id):0;

		$data['rank_name']=(!empty($this->dashboard_model->getRank($this->user_id)))?$this->dashboard_model->getRank($this->user_id):Null;

		$data['payout_in_process']=(!empty($this->dashboard_model->getPayOutInProcess($this->user_id)))?$this->dashboard_model->getPayOutInProcess($this->user_id):0;

		$data['payout_success']=(!empty($this->dashboard_model->getPayOutSuccess($this->user_id)))?$this->dashboard_model->getPayOutSuccess($this->user_id):0;

		$data['user_details']=$user_details;

		$data['sponsor_details']=$this->dashboard_model->getSponsorDetails($this->user_id);
		

		$data['ewallet_balance']=$this->ewallet_model->getEwalletBalance($this->user_id);
		
		////////////////////////@for Dashboard
		
		/*$direct_commission =$this->dashboard_model->getUserTotalDirectCommission($this->user_id,'1');
		$data['direct_commission']=number_format($direct_commission,2);*/
		
		$level_commission =$this->dashboard_model->getUserTotalLevelCommission($this->user_id,'1');
		$data['level_commission']=number_format($level_commission,2);
		
		
		
		
		
		$binary_commission =$this->dashboard_model->getUserTotalBinaryCommission($this->user_id,'1');
		$data['binary_commission']=number_format($binary_commission,2);
		
		$data['gross_commission']=number_format($direct_commission+$level_commission+$signup_bonus+$binary_commission,2);
		//////////////////////////////
		$data['rank_name']=$user_details->rank_name;
		
		//////////////////////
		/************ get current daily income name *************/
		$incomeinfo=$this->db->query("select * from deposit_investment_amount_request where user_id='".$this->user_id."' and status='0'")->row();
		//pr($incomeinfo);
		$data['daily_income_name']=$incomeinfo->title;
		$data['daily_income_per']=$incomeinfo->roi_per;
		$data['daily_income_upto']=$incomeinfo->roi_upto;
		$data['daily_income_amount']=$incomeinfo->amount;
		$data['request_date']=$incomeinfo->request_date;
		$data['deposit_id']=$incomeinfo->deposit_id;
        $data['callfunc']=$this;
		_userLayout("dashboard",$data);
	}
	
	public function getROIStatus($deposit_id,$request_date)
	{
	    //echo "select id from credit_debit_investment where reason='3' and deposit_id='".$deposit_id."' and receive_date='".$request_date."'";
	    $incomeinfo=$this->db->query("select id from credit_debit_investment where reason='3' and deposit_id='".$deposit_id."' and receive_date='".$request_date."'")->num_rows();
	    return $incomeinfo;
	}
}//end class
