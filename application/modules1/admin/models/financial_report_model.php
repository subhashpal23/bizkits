<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/financial_report_model
*/
class Financial_Report_Model extends Common_Model
{
	public function __construct()
	{
		//@call to parent CI_Model constructor
		parent::__construct();
	}
	public function financial_reports($date)    
    {   
	  ///package sold details
	   $package_sold_info=$this->db->select_sum('pkg_amount')->from('package_sold_amount')->where(array('date(create_date)'=>$date))->get()->row();
	   $package_sold_amount=(!empty($package_sold_info->pkg_amount))?$package_sold_info->pkg_amount:0;
    
	  //5=>direct commission, 9=>level commission, 6=>binary commission, 7=>matching commission, 24=>signup bonus
	  ///paid commission details
	  $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID, 'date(create_date)'=>$date))->where_in('reason',array('5','9','6','7','24'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  
	  $credit_amount_info1=$this->db->select_sum('credit_amt')->from('secondry_wallet_credit_debit')->where(array('user_id !='=>COMP_USER_ID,'date(create_date)'=>$date))->where_in('reason',array('5','9','6','7','24'))->get()->row();
	  $credit_amount1=(!empty($credit_amount_info1->credit_amt))?$credit_amount_info1->credit_amt:0;
	  $total_paid_commission=$credit_amount+$credit_amount1;
	  
	  
	  ///payout details
	  $payout_info=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->where(array(
	  'status'=>'1',
	  'date(response_date)'=>$date
	  ))->get()->row();
	  $payout_amount=(!empty($payout_info->amount))?$payout_info->amount:0;
	  //////////////////////////////////////////////////////////////////////
	  $total_registered_user=$this->db->select('id')->from('user_registration')->where('date(auto_registration_date)',$date)->get()->num_rows();
	  /////////////////////////
	  $financial_report_data=array(
	  'create_date'=>date('m/d/Y',strtotime($date)),
	  'total_registered_user'=>$total_registered_user,
	  'package_sold_amount'=>$package_sold_amount,
	  'total_paid_commission'=>$total_paid_commission,
	  'payout_amount'=>$payout_amount,
	  'profit'=>$package_sold_amount-$total_paid_commission
	  );
	  return $financial_report_data;
	}
	
}//end class
?>