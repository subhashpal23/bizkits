<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/IncomeReport
*/
class IncomeReport extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('IncomeReport_Model','income_report');
		$this->load->model('TeamReport_model','team_report');
		$this->load->model('dashboard_model','dashboard');
	} 
	/*
	@Desc: It's used to view the direct referral commission list
	*/
	public function directReferralCommissionList()
	{
	    $data['title']="Direct Referral Commission List";
	    $data['breadcrumb']='<li class="active">Direct Referral Commission List</li>';
	    $data['direct_referral_income']=$this->income_report->getDirectReferralCommission($this->userId);
	    $data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    $data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/direct-referral-comission-list",$data);
	}
	/*
	@Desc: It's used to view the level commission list
	*/
	public function levelCommissionList()
	{
	    $data['title']="Level Commission List";
	    $data['breadcrumb']='<li class="active">Level Commission List</li>';
	    $data['level_income']=$this->income_report->getLevelCommission($this->userId);
	    $data['total_team_member']=$this->team_report->getTotalTeamMember($this->userId);
		_userLayout("income-report-mgmt/level-comission-list",$data);
	}
	public function dailyIncomeList()
	{
	    $data['title']="Daily Income List";
	    $data['breadcrumb']='<li class="active">Daily Income List</li>';
	    $data['level_income']=$this->income_report->getDailyIncome($this->userId);
	    //$data['total_team_member']=$this->team_report->getTotalTeamMember($this->userId);
		_userLayout("income-report-mgmt/level-comission-list",$data);
	}
	/*
	@Desc: It's used to view the binary commission list
	*/
	public function binaryCommissionList()
	{
	    $data['title']="Level Commission List";
	    $data['breadcrumb']='<li class="active">Level Commission List</li>';
	    $data['binary_income']=$this->income_report->getBinaryCommission($this->userId);
	    $data['total_binary_income']=$this->income_report->getBinaryCommission($this->userId);
		_userLayout("income-report-mgmt/binary-comission-list",$data);
	}
	/*
	@Desc: It's used to view the matching commission list
	*/
	public function matchingCommissionList()
	{
	    $data['title']="Level Commission List";
	    $data['breadcrumb']='<li class="active">Level Commission List</li>';
	    $data['matching_income']=$this->income_report->getMatchingCommission($this->userId);
		_userLayout("income-report-mgmt/matching-comission-list",$data);
	}
	/*
	@Desc: It's used to view the rank bonus
	*/
	public function rankBonusList()
	{
	    $data['title']="Level Commission List";
	    $data['breadcrumb']='<li class="active">Level Commission List</li>';
	    $data['rank_bonus_income']=$this->income_report->getRankUpdateBonus($this->userId);
	    $data['rank_name']=$this->dashboard->getRank($this->userId);
		_userLayout("income-report-mgmt/rank-bonus-list",$data);
	}

}//end class
