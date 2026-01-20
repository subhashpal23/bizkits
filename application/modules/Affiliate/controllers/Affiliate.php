<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/user
*/
class Affiliate extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		affiliate_auth();
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
		//pr($user_details);
		$data['activate']=$user_details->active_status;
		$data['user_package']=$user_details->pkg_id;
        $data['referral_affiliate_link']=base_url().'Web/register/'.$user_details->username;
        //$data['referral_school_link']=base_url().'Web/listaschool/'.$user_details->username;
        //$enabled_commission=$this->dashboard_model->getEnabledCommission($user_details->pkg_id);

		//$data['total_commission']=(!empty($this->income_report->getTotalCommission($this->user_id)))?$this->income_report->getTotalCommission($this->user_id):0;

		//$data['total_direct_commission']=(!empty($this->income_report->getTotalDirectCommission($this->user_id)))?$this->income_report->getTotalDirectCommission($this->user_id):0;

		/*$data['total_binary_commission']=(!empty($this->income_report->getTotalBinaryCommission($this->user_id)))?$this->income_report->getTotalBinaryCommission($this->user_id):0;

		//$data['total_matching_commission']=(!empty($this->income_report->getTotalMatchingCommission($this->user_id)))?$this->income_report->getTotalMatchingCommission($this->user_id):0;
	
		$data['total_unilevel_commission']=(!empty($this->income_report->getTotalUnilevelCommission($this->user_id)))?$this->income_report->getTotalUnilevelCommission($this->user_id):0;

		$data['enabled_commission']=$enabled_commission;
		
		$data['total_team_member']=(!empty($this->team_report->getTotalTeamMember($this->user_id)))?$this->team_report->getTotalTeamMember($this->user_id):0;*/

		$data['total_affiliate_member']=(!empty($this->team_report->getTotalMember($this->user_id,'1')))?$this->team_report->getTotalMember($this->user_id,'1'):0;
		$data['total_school_member']=(!empty($this->team_report->getTotalMember($this->user_id,'2')))?$this->team_report->getTotalMember($this->user_id,'2'):0;
		$data['total_student_member']=(!empty($this->team_report->getTotalMember($this->user_id,'3')))?$this->team_report->getTotalMember($this->user_id,'3'):0;
		$data['total_team_member']=(!empty($this->team_report->getTotalTeamMember($this->user_id)))?$this->team_report->getTotalTeamMember($this->user_id):0;
		$data['left_team_member']=(!empty($this->team_report->getTeamMember($this->user_id,'left')))?$this->team_report->getTeamMember($this->user_id,'left'):0;
		$data['right_team_member']=(!empty($this->team_report->getTeamMember($this->user_id,'right')))?$this->team_report->getTeamMember($this->user_id,'right'):0;
		$data['total_pv']=(!empty($this->team_report->getTotalPv($this->user_id,0)))?$this->team_report->getTotalPv($this->user_id,0):0;
		$data['left_total_pv']=(!empty($this->team_report->getTotalPosPv($this->user_id,'left',0)))?$this->team_report->getTotalPosPv($this->user_id,'left',0):0;
		$data['right_total_pv']=(!empty($this->team_report->getTotalPosPv($this->user_id,'right',0)))?$this->team_report->getTotalPosPv($this->user_id,'right',0):0;
		
		$data['left_rank_pv']=(!empty($this->team_report->getTotalRankPv($this->user_id,'left')))?$this->team_report->getTotalRankPv($this->user_id,'left'):0;
		$data['right_rank_pv']=(!empty($this->team_report->getTotalRankPv($this->user_id,'right')))?$this->team_report->getTotalRankPv($this->user_id,'right'):0;
		
		$data['total_pv_used']=(!empty($this->team_report->getTotalPv($this->user_id,1)))?$this->team_report->getTotalPv($this->user_id,1):0;
		$data['left_total_pv_used']=(!empty($this->team_report->getTotalPosPv($this->user_id,'left',1)))?$this->team_report->getTotalPosPv($this->user_id,'left',1):0;
		$data['right_total_pv_used']=(!empty($this->team_report->getTotalPosPv($this->user_id,'right',1)))?$this->team_report->getTotalPosPv($this->user_id,'right',1):0;

		/*$data['rank_name']=(!empty($this->dashboard_model->getRank($this->user_id)))?$this->dashboard_model->getRank($this->user_id):Null;*/

		$data['payout_in_process']=(!empty($this->dashboard_model->getPayOutInProcess($this->user_id)))?$this->dashboard_model->getPayOutInProcess($this->user_id):0;

		$data['payout_success']=(!empty($this->dashboard_model->getPayOutSuccess($this->user_id)))?$this->dashboard_model->getPayOutSuccess($this->user_id):0;

		$data['user_details']=$user_details;

		$data['sponsor_details']=$this->dashboard_model->getSponsorDetails($this->user_id);
		

		$data['ewallet_balance']=$this->ewallet_model->getEwalletBalance($this->user_id);
		$data['twallet_balance']=$this->ewallet_model->getTwalletBalance($this->user_id);
		////////////////////////@for Dashboard
		
		$direct_commission =$this->dashboard_model->getUserTotalDirectCommission($this->user_id);
		//echo date('Y-m-d',strtotime("last Monday"));
		$direct_commission_weekly =$this->dashboard_model->getUserTotalDirectCommissionWeekly($this->user_id);
		//echo $direct_commission;
		$data['direct_commission']=$direct_commission_weekly;
		
		$level_commission =$this->dashboard_model->getUserTotalLevelCommission($this->user_id,'1');
		$level_commission_weekly =$this->dashboard_model->getUserTotalLevelCommissionWeekly($this->user_id,'1');
		$data['level_commission']=$level_commission_weekly;
		
		$fast_start =$this->dashboard_model->getUserTotalFastStartCommission($this->user_id,'1');
		$fast_start_weekly =$this->dashboard_model->getUserTotalFastStartCommissionWeekly($this->user_id,'1');
		$data['fast_start']=$fast_start_weekly;
		
		$matching_bonus =$this->dashboard_model->getUserTotalBinaryCommission($this->user_id,'1');
		$matching_bonus_weekly =$this->dashboard_model->getUserTotalBinaryCommissionWeekly($this->user_id,'1');
		$data['matching_bonus']=$matching_bonus_weekly;
		
		$repurchase_bonus =$this->dashboard_model->getSelfCommission($this->user_id);
		$data['repurchase_bonus']=$repurchase_bonus;
		$unilevel_bonus =$this->dashboard_model->getUnilvelCommission($this->user_id);
		$data['unilevel_bonus']=$unilevel_bonus;
		
		$rank_bonus =$this->dashboard_model->getRankCommission($this->user_id);
		$data['rank_bonus']=$rank_bonus;
		
		$stockist_bonus =$this->dashboard_model->getStockistCommission($this->user_id);
		$data['stockist_bonus']=$stockist_bonus;
		
		$data['gross_commission']=$direct_commission+$level_commission+$fast_start+$matching_bonus+$unilevel_bonus+$repurchase_bonus+$rank_bonus+$stockist_bonus;
		
		$checkrankbonus =$this->db->select('*')->from('rank_bonus')->where(array('user_id'=>$this->user_id,'status'=>'0'))->get()->num_rows();
		$data['checkrankbonus']=$checkrankbonus;
		if($checkrankbonus)
		{
		    $rankbonusinfo =$this->db->select('*')->from('rank_bonus')->where(array('user_id'=>$this->user_id,'status'=>'0'))->get()->row();
		    //$rankbonusinfo->bonus_date;
		    $data['bonus']=$rankbonusinfo->bonus;
		    $data['bonus_date']=date('M d, Y H:i:s',strtotime($rankbonusinfo->bonus_date));
		    $data['expire_date']=date('M d, Y H:i:s',strtotime('+30 days',strtotime($rankbonusinfo->bonus_date)));
		}
        $data['callfunc']=$this;
        $user_id=$this->user_id;
		$matchingcondleft=$this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='left') and ref_id='".$user_id."'")->num_rows();
        $matchingcondright=$this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='right') and ref_id='".$user_id."'")->num_rows();
        if($matchingcondleft>=1 && $matchingcondright>=1)
        {
            $data['bq']=1;
        }		
        $date=date('Y-m-d');
        
        $info=$this->db->select('matched_pv')->from('matching_bonus')->where(array('user_id'=>$user_id))->order_by('bonus_date','desc')->limit(1)->get()->row();
        //echo $this->db->last_query();
			$totaldailybonus=$info->matched_pv;
			$data['today_pv']=$totaldailybonus;
			$info=$this->db->select_sum('matched_pv')->from('matching_bonus')->where(array('user_id'=>$user_id))->get()->row();
			$totaldailybonus=$info->matched_pv;
			$data['total_pv']=$totaldailybonus;
        $data['notice'] =$this->db->select('*')->from('confidential')->where(array('confidential_key'=>'notice'))->get()->row();
        $data['notice1'] =$this->db->select('*')->from('confidential')->where(array('confidential_key'=>'notice1'))->get()->row();
		_userLayout("dashboard",$data);
	}
	
	public function getROIStatus($deposit_id,$request_date)
	{
	    //echo "select id from credit_debit_investment where reason='3' and deposit_id='".$deposit_id."' and receive_date='".$request_date."'";
	    $incomeinfo=$this->db->query("select id from credit_debit_investment where reason='3' and deposit_id='".$deposit_id."' and receive_date='".$request_date."'")->num_rows();
	    return $incomeinfo;
	}
}//end class
