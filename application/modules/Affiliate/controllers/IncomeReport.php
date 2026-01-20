<?php
ob_start();
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
		affiliate_auth();
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
	public function selfComissionList()
	{
	    $data['title']="Repurchase Commission List";
	    $data['breadcrumb']='<li class="active">Repurchase Commission List</li>';
	    $data['direct_referral_income']=$this->income_report->getSelfCommission($this->userId);
	    //$data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    //$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/self-comission-list",$data);
	}
	public function unilvelComissionList()
	{
	    $data['title']="Unilvel Commission List";
	    $data['breadcrumb']='<li class="active">Unilvel Commission List</li>';
	    $data['direct_referral_income']=$this->income_report->getUnilvelCommission($this->userId);
	    //$data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    //$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/self-comission-list",$data);
	}
	public function rankComissionList()
	{
	    $data['title']="Rank Bonus List";
	    $data['breadcrumb']='<li class="active">Rank Bonus List</li>';
	    $data['direct_referral_income']=$this->income_report->getRankCommission($this->userId);
	    //echo $this->db->last_query();
	    //pr($data['direct_referral_income']);
	    //$data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    //$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/self-comission-list",$data);
	}
	public function directMatchingCommissionList()
	{
	    $data['title']="Direct Matching Commission List";
	    $data['breadcrumb']='<li class="active">Direct Matching Commission List</li>';
	    $data['direct_referral_income']=$this->income_report->getDirectMatchingCommission($this->userId);
	    //$data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    //$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/direct-matching-comission-list",$data);
	}
	public function fastStartCommissionList()
	{
	    $data['title']="Fast Start Commission List";
	    $data['breadcrumb']='<li class="active">Fast Start Commission List</li>';
	    $data['direct_referral_income']=$this->income_report->getFastStartCommission($this->userId);
	    //$data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    //$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/fast-start-commission-list",$data);
	}
	
	public function stockistComissionList()
	{
	    $data['title']="Stockist Commission List";
	    $data['breadcrumb']='<li class="active">Stockist Commission List</li>';
	    $data['direct_referral_income']=$this->income_report->getStockistCommission($this->userId);
	    //$data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    //$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/fast-start-commission-list",$data);
	}
	
	public function pvList($status=null)
	{
	    $data['title']=ucfirst($status)." PV List";
	    $data['breadcrumb']='<li class="active">'.$data['title'].'</li>';
	    if($status=='unused'){$status=0;}
	    if($status=='used'){$status=1;}
	    $data['direct_referral_income']=$this->income_report->getAllPVList($this->userId,$status);
	    
		_userLayout("income-report-mgmt/pv-list",$data);
	}
	public function fspvList()
	{
	    $data['title']="PV List";
	    $data['breadcrumb']='<li class="active">PV List</li>';
	    $data['direct_referral_income']=$this->income_report->getFSPVList($this->userId);
	    
		_userLayout("income-report-mgmt/fspv-list",$data);
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
