<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/dashboard_model
*/
class Dashboard_Model extends Common_Model
{
    public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    /*
    @Desc:It's used to get registered member by date wise, so that total number of registered member can be identified of any day
    */
    public function getRegisteredMemberByDate($date=null)
    {
      $query="SELECT `id`,`registration_date` FROM (`user_registration`)
      WHERE `active_status` = '1'
      AND STR_TO_DATE(`registration_date`, '%d-%m-%Y') = STR_TO_DATE('".$date."','%d-%m-%Y')";
      
      $result=$this->db->query($query);
      $result=$result->result();
      return count($result);
    }
    /*
    @Desc:
    */
    public function getCurrentWeekRegisteredMember()
    {
      $current_date=date('d-m-Y');//current date
      $start_date=date('d-m-Y', strtotime('-7 days', strtotime($current_date)));
      
      $query="SELECT `id`,`registration_date` FROM (`user_registration`)
      WHERE `active_status` = '1'
      AND STR_TO_DATE(`registration_date`, '%d-%m-%Y') >= STR_TO_DATE('".$start_date."','%d-%m-%Y')
      AND STR_TO_DATE(`registration_date`, '%d-%m-%Y') <= STR_TO_DATE('".$current_date."','%d-%m-%Y')";
      
      $result=$this->db->query($query);
      $result=$result->result();
      return count($result);
    }
    /*
    @Desc:
    */
    public function getCurrentMonthRegisteredMember()
    {
      $query="SELECT `id`,`registration_date`
        FROM user_registration
        WHERE MONTH(STR_TO_DATE(`registration_date`, '%d-%m-%Y')) = MONTH(CURRENT_DATE())
        AND YEAR(STR_TO_DATE(`registration_date`, '%d-%m-%Y')) = YEAR(CURRENT_DATE())";
      
      $result=$this->db->query($query);
      $result=$result->result();
      return count($result);
    }
	public function getTotalRegisteredMember()
	{
		return $this->db->select('id')->from('user_registration')->where(array('user_id !='=>COMP_USER_ID))->get()->num_rows();
	}
    /*
    @Desc:
    */
    public function getTotalNumberOfPayoutRequest()
    {
      $result=$this->db->select('id')->from('withdrawl_wallet_amount_request')->get()->result();
      return count($result);
    }
    /*
    @Desc:
    */
    public function getTotalPayoutRequestCompletionRate()
    {
      $total_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->get()->result();
      $completed_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','1')->get()->result();
      $total_completed_request=count($completed_request);
      if($total_request==0)
      {
        $result=100;
      }
      else 
      {
          if(count($total_request)>0)
          {
            $result=number_format(($total_completed_request*100)/count($total_request),2);
          }
      }
      return $result;
    }
    /*
    @Desc:
    */
    public function getTotalPayoutRequestPendingRate()
    {
      $total_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->get()->result();
      $pending_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','0')->get()->result();
      $total_pending_request=count($pending_request);
      if($total_request==0)
      {
        $result=0;
      }
      else 
      {
        $result=number_format(($total_pending_request*100)/count($total_request),2);
      }
      return $result;
    }

    /*
    @Desc:
    */
    public function getTotalPayoutRequestAmount()
    {

      $request=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->get()->row();
      return number_format($request->amount,2);
    }
    /*
    @Desc:
    */
    public function getTotalCompletedPayoutRequestAmount()
    {

      $request=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->where('status','1')->get()->row();
      return number_format($request->amount,2);
    }
    /*
    @Desc:
    */
    public function getTotalNumberOfCompletedPayoutRequest()
    {
      $completed_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','1')->get()->result();
      $total_completed_request=count($completed_request);
      return $total_completed_request; 
    }
    /*
    @Desc:
    */
    public function getTotalPendingPayoutRequestAmount()
    {
      $request=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->where('status','0')->get()->row();
      return number_format($request->amount,2);
    }
    /*
    @Desc:
    */
    public function getTotalNumberOfPendingPayoutRequest()
    {
      $pending_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','0')->get()->result();
      $total_pending_request=count($pending_request);
      return $total_pending_request; 
    }
    /*
    @Desc:
    */
    public function getTotalCompanyProfit()
    {
      $package_sold_info=$this->db->select_sum('amount')->from('user_package_log')->get()->row();
      $package_sold_amount=$package_sold_info->amount;
      $commission_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where('user_id',COMP_USER_ID)->where_in('reason',array('5','6','7','9'))->get()->row();
      $commission_amount=$commission_info->credit_amt;
      $total_company_profit=number_format($package_sold_amount+$commission_amount,2);
      return $total_company_profit;
    }
    /*
    @Desc:
    */
    public function getTotalPaidCommission()
    {
      /*
      '6'=>credit for binary commission, 
      '5'=>credit for direct commission,
      '7'=>credit for matching commission,
      '9'=>credit for unilevel commission,
      */
      $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where_in('reason',array('5','6','7','9'))->get()->row();
      $total_paid_commission=$credit_amount_info->credit_amt;
      return $total_paid_commission;
    }
    /*
    @Desc:
    */
    public function getTotalOpenTicket()
    {
      $open_ticket_info=$this->db->select('id')->from('support')->where('status','0')->get()->result();
      $total_open_ticket=count($open_ticket_info);
      return $total_open_ticket;
    }
    /*
    @Desc:
    */
    public function getTotalClosedTicket()
    {
      $closed_ticket_info=$this->db->select('id')->from('support')->where('status','1')->get()->result();
      $total_closed_ticket=count($closed_ticket_info);
      //die;
      return $total_closed_ticket;
    }
	/*
  @Desc:
  */
  ///////@for company/////
  public function getTotalPackageSoldAmount()    
  {   
   $package_sold_info=$this->db->select_sum('pkg_amount')->from('package_sold_amount')->get()->row();
   $package_sold_amount=(!empty($package_sold_info->pkg_amount))?$package_sold_info->pkg_amount:0;
   return $package_sold_amount;
  }
  public function getTotalInvestAmount()    
  {   
   $package_sold_info=$this->db->select_sum('amount')->from('deposit_investment_amount_request')->get()->row();
   $package_sold_amount=(!empty($package_sold_info->amount))?$package_sold_info->amount:0;
   return $package_sold_amount;
  }
  public function getUserDailyIncome($user_id)
  {
    //echo "select sum(amount)+sum(roi_amount) as total from deposit_investment_amount_request where user_id='".$user_id."'";
    $credit_amount_info=$this->db->query("select sum(roi_amount) as total from deposit_investment_amount_request where user_id='".$user_id."'")->row();
    //pr($credit_amount_info);
    $credit_amount=(!empty($credit_amount_info->total))?$credit_amount_info->total:0;
	  return $credit_amount;
  }
  public function getAllUserDailyIncome()
  {
    $credit_amount_info=$this->db->query('select sum(roi_amount) as total from deposit_investment_amount_request')->row();
    $credit_amount=(!empty($credit_amount_info->total))?$credit_amount_info->total:0;
	  return $credit_amount;
  }
  public function getUserTotalDirectCommission($user_id)
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'5'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
    
	  return $credit_amount+$credit_amount1;
  }
  public function getUserTotalLevelCommission($user_id)
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'6'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount;
  }
  public function getUserTotalBinaryCommission($user_id)
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'9'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount+$credit_amount1;
  }
  public function getUserTotalMatchingCommission($user_id)
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'7'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	
	$credit_amount_info1=$this->db->select_sum('credit_amt')->from('secondry_wallet_credit_debit')->where(array('user_id'=>$user_id,'reason'=>'7'))->get()->row();
    $credit_amount1=(!empty($credit_amount_info1->credit_amt))?$credit_amount_info1->credit_amt:0;
    
	
	return $credit_amount+$credit_amount1;
  }
  ///////@for member/////
  public function getAllUserTotalDirectCommission()
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('5'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	
	$credit_amount_info1=$this->db->select_sum('credit_amt')->from('secondry_wallet_credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('5'))->get()->row();
    $credit_amount1=(!empty($credit_amount_info1->credit_amt))?$credit_amount_info1->credit_amt:0;
    
	
	return $credit_amount+$credit_amount1;  
  }
  public function getAllUserTotalLevelCommission()
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('6'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount;  
  }
  public function getAllUserTotalBinaryCommission()
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('9'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
    return $credit_amount+$credit_amount1;  
  }
  public function getAllUserTotalMatchingCommission()
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('7'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	
	$credit_amount_info1=$this->db->select_sum('credit_amt')->from('secondry_wallet_credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('7'))->get()->row();
    $credit_amount1=(!empty($credit_amount_info1->credit_amt))?$credit_amount_info1->credit_amt:0;
    
	
	return $credit_amount+$credit_amount1;  
  }
  public function getAllUserTotalSignupBonus()
  {
    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('24'))->get()->row();
    $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	
	$credit_amount_info1=$this->db->select_sum('credit_amt')->from('secondry_wallet_credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('24'))->get()->row();
    $credit_amount1=(!empty($credit_amount_info1->credit_amt))?$credit_amount_info1->credit_amt:0;
    
	return $credit_amount+$credit_amount1;  
  }
  
}//end class
?>