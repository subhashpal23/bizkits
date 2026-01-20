<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/admin
*/
class Admin extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		//echo 'oooo';
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("dashboard_model");
	} 
	/*
	@Desc:It's used to view dashboard
	*/
	public function index()
	{
		$data=array();
		////////////////////////////////////
		/*$data['member_registered_today']=$this->dashboard_model->getRegisteredMemberByDate(date('d-m-Y'));
		$data['this_week_registered_member']=$this->dashboard_model->getCurrentWeekRegisteredMember();
		$data['this_month_registered_member']=$this->dashboard_model->getCurrentMonthRegisteredMember();
		$data['total_registered_member']=$this->dashboard_model->getTotalRegisteredMember();
		////////////////////////////////////
		$data['total_payout_request']=$this->dashboard_model->getTotalNumberOfPayoutRequest();
		$data['total_payout_request_completion_rate']=$this->dashboard_model->getTotalPayoutRequestCompletionRate();
		$data['total_payout_request_amount']=$this->dashboard_model->getTotalPayoutRequestAmount();
		////////////////////////////////////
		$data['total_completed_payout_request']=$this->dashboard_model->getTotalNumberOfCompletedPayoutRequest();
		$data['total_completed_payout_request_amount']=$this->dashboard_model->getTotalCompletedPayoutRequestAmount();
		////////////////////////////////////
		$data['total_pending_payout_request']=$this->dashboard_model->getTotalNumberOfPendingPayoutRequest();
		$data['total_payout_request_pending_rate']=$this->dashboard_model->getTotalPayoutRequestPendingRate();
		$data['total_pending_payout_request_amount']=$this->dashboard_model->getTotalPendingPayoutRequestAmount();
		////////////////////////////////////
		$data['total_open_ticket']=$this->dashboard_model->getTotalOpenTicket();
		$data['total_closed_ticket']=$this->dashboard_model->getTotalClosedTicket();
		/////////////////////
		////////////////////
		
		$total_invest_amount=$this->dashboard_model->getTotalInvestAmount();		
		$data['total_invest_amount']=number_format($total_invest_amount,2);
		
		$total_company_daily_income=$this->dashboard_model->getUserDailyIncome(COMP_USER_ID);
		$data['total_company_daily_income']=number_format($total_company_daily_income,2);

		
		$total_company_level_commission=$this->dashboard_model->getUserTotalLevelCommission(COMP_USER_ID);
		$data['total_company_level_commission']=number_format($total_company_level_commission,2);
		
		
		$total_company_binary_commission=$this->dashboard_model->getUserTotalBinaryCommission(COMP_USER_ID);
		$data['total_company_binary_commission']=number_format($total_company_binary_commission,2);
		

		$company_gross_commission=$total_company_daily_income+$total_company_level_commission+$total_company_binary_commission;
		
		$data['company_gross_commission']=number_format($company_gross_commission,2);
	
	
		$total_all_member_daily_income=$this->dashboard_model->getAllUserDailyIncome();
		$data['total_all_member_daily_income']=number_format($total_all_member_daily_income,2);
		
		$total_all_member_level_commission=$this->dashboard_model->getAllUserTotalLevelCommission();
		$data['total_all_member_level_commission']=number_format($total_all_member_level_commission,2);
		
		$total_all_member_binary_commission=$this->dashboard_model->getAllUserTotalBinaryCommission();
		$data['total_all_member_binary_commission']=number_format($total_all_member_binary_commission,2);		
		
		$all_user_gross_commission=$total_all_member_daily_income+$total_all_member_level_commission+$total_all_member_binary_commission+
		$total_all_member_signup_bonus;
		
		$data['all_user_gross_commission']=number_format($all_user_gross_commission,2);
		/////////////////////////////////////////////////

		$total_company_profit=($total_invest_amount+$company_gross_commission)-$all_user_gross_commission;	
		
		$data['total_company_profit']=number_format($total_company_profit,2);*/
		$affiliate=$this->db->select('*')->from('user_registration')->get()->num_rows();
		$school=$this->db->select('*')->from('user_registration')->where('member_type','2')->get()->num_rows();
		$student=$this->db->select_sum('pkg_amount')->from('package_sold_amount')->get()->row();
		$data['total_users']=$affiliate;
		$data['stockist']=$school;
		$data['package_sold']=$student->pkg_amount;
		$student=$this->db->select_sum('amount')->from('final_e_wallet')->get()->row();
		$data['total_commission']=$student->amount;
		$student=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->where(array('status'=>'0'))->get()->row();
		$data['payout_pending']=$student->amount;
		$student=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->where(array('status'=>'1'))->get()->row();
		$data['payout_approved']=$student->amount;
			$student=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array('cd.reason'=>'13','cd.ttype'=>'Rank Bonus'))->get()->row();
		$data['rank_bonus']=$student->credit_amt;
		_adminLayout("dashboard",$data);
	}
	public function allDocuments()
	{
	    $doccount=$this->db->select('*')->from('user_school_docs')->get()->num_rows();
        $data['doccount']=$doccount;
        if($doccount>0)
        {
	        $user_info=$this->db->select('*')->from('user_school_docs')->get()->result();
	        $data['user_info']=$user_info;
        }
	    _userLayout("document",$data);
	}
	public function changeDocStatus($type,$id)
	{
	    if($type=='verify')
	    {
	        $this->db->update('user_school_docs',array('verify_status'=>1,'verify_date'=>date('Y-m-d H:i:S')),array('id'=>$id));
	    }
	    else if($type=='cancel')
	    {
	        $this->db->update('user_school_docs',array('verify_status'=>2,'verify_date'=>date('Y-m-d H:i:S')),array('id'=>$id));
	    }
	    $this->session->set_flashdata('success','Document '.$type.' Successfully');
	    redirect(base_url()."Admin/allDocuments"); exit;
	}
}//end class
