<?php
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
		$data['member_registered_today']=$this->dashboard_model->getRegisteredMemberByDate(date('d-m-Y'));
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
		/*
		@for company
		*/
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
	
		/*
		 @ for member
		*/
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
		
		$data['total_company_profit']=number_format($total_company_profit,2);
		_adminLayout("dashboard",$data);
	}
}//end class
