<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/dashboard_model
*/
class Dashboard_Model extends Common_Model
{
   public function __construct()
   {
        //@call to parent CI_Model constructor
        parent::__construct();
		$this->load->model("unilevel_tree_model");
   }
   /*
   @Desc:It's used to return the rank name on the basis of user_id
   */
   public function getRank($user_id)
   {
   	$rank_info=$this->db->select('r.rank_name')->from('user_registration as u')->join('rank as r','r.id=u.rank_id')->where('u.user_id',$user_id)->get()->row();
      $rank=(!empty($rank_info->rank_name))?$rank_info->rank_name:Null;
      return $rank;

   }
   /*
   @Desc:It's used to return the payout in process on the basis of user_id
   */
   public function getPayOutInProcess($user_id)
   {
   	return $this->db->select('w.id')->from('withdrawl_wallet_amount_request as w')->where(array('user_id'=>$user_id,'status'=>'0'))->get()->num_rows();
   }
   /*
   @Desc:It's used to return the success payout on the basis of user_id
   */
   public function getPayOutSuccess($user_id)
   {
   	return $this->db->select('w.id')->from('withdrawl_wallet_amount_request as w')->where(array('user_id'=>$user_id,'status'=>'1'))->get()->num_rows();
   }
   /*
   @Desc:It's used to return the user details on the basis of user_id
   */
   public function getUserDetails($user_id)
   {
   	$user_details=$this->unilevel_tree_model->getUserDetails($user_id);
   	return $user_details;
   }
   /*
   @Desc:It's used to return the sponsor details on the basis of user_id
   */
   public function getSponsorDetails($user_id)
   {
     $sponsor_details=$this->unilevel_tree_model->getSponsorDetails($user_id);
     return $sponsor_details;

   }
   /*
   @Desc: It's used to get all the enabled commission type as per user reggistered / upgraded package
   */
   public function getEnabledCommission($package_id)
   {
      $commission_info=$this->db->select(array('comm_type_id','status'))->from('commission_permission')->where('pkg_id',$package_id)->get()->result();
      $enabled_commission=array();
      foreach ($commission_info as $commission) 
      {
         if($commission->comm_type_id==1)
         {
            $enabled_commission['direct_commission']=$commission->status;
         }
         if($commission->comm_type_id==2)
         {
            $enabled_commission['binary_commission']=$commission->status;
         }
         if($commission->comm_type_id==3)
         {
            $enabled_commission['matching_commission']=$commission->status;
         }
         if($commission->comm_type_id==4)
         {
            $enabled_commission['unilevel_commission']=$commission->status;
         }
         $enabled_commission['direct_commission']=(!empty($enabled_commission['direct_commission']))?$enabled_commission['direct_commission']:0;
         $enabled_commission['binary_commission']=(!empty($enabled_commission['binary_commission']))?$enabled_commission['binary_commission']:0;
         $enabled_commission['matching_commission']=(!empty($enabled_commission['matching_commission']))?$enabled_commission['matching_commission']:0;
         $enabled_commission['unilevel_commission']=(!empty($enabled_commission['unilevel_commission']))?$enabled_commission['unilevel_commission']:0;
      }//end foreach here!
      return $enabled_commission;
   }
   ///////////@for user
   public function getUserTotalDirectCommission($user_id)
   {
     $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'5'))->get()->row();
     
     $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:'0';
	 
	 
	 
	 return $credit_amount+$credit_amount1;
     
   }
   public function getUserTotalLevelCommission($user_id)
   {
     $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'9'))->where_in('reason',array('9'))->get()->row();
     
     $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:'0';
	 
	 
	 
	 
	 
     return $credit_amount+$credit_amount1;
     
   }
	public function getUserTotalBinaryCommission($user_id)
	{
		 $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'6'))->get()->row();
		 
		 $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:'0';
		 
		 
		 
		 
		 
		 return $credit_amount+$credit_amount1;
	}
	public function getUserTotalMatchingCommission($user_id)
	{
	   $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'7'))->get()->row();
	   $credit_amount=(!empty($credit_amount_info->credit_amt))?
	   $credit_amount_info->credit_amt:'0';

	   
	   return $credit_amount+$credit_amount1;
	}
	public function getUserTotalSignUpBonus($user_id)
	{
	    $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id,'reason'=>'24'))->get()->row();
		$credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:'0';
		
		
		
		return $credit_amount+$credit_amount1;
	}
	
	////
	public function getLeftKnowledgePointsForBinary($user_id)
	{
		$result=$this->db->select_sum('knowledge_points')->from('manage_bv_history')->where(array('income_id'=>$user_id,'position'=>'left','status'=>'0'))->get()->row();
		$knowledge_points=(!empty($result->knowledge_points))?$result->knowledge_points:0;
		return $knowledge_points;
	}
	public function getRightKnowledgePointsForBinary($user_id)
	{
		$result=$this->db->select_sum('knowledge_points')->from('manage_bv_history')->where(array('income_id'=>$user_id,'position'=>'right','status'=>'0'))->get()->row();
		$knowledge_points=(!empty($result->knowledge_points))?$result->knowledge_points:0;
		return $knowledge_points;
	}
	///////////
	public function getSelfKnowledgePointsForRank($user_id)
	{
		$result=$this->db->select_sum('rank_knowledge_points')->from('rank_knowledge_points')->where(array('income_id'=>$user_id,'position'=>'self'))->get()->row();
		$knowledge_points=(!empty($result->rank_knowledge_points))?$result->rank_knowledge_points:0;
		return $knowledge_points;
	}
	public function getLeftKnowledgePointsForRank($user_id)
	{
		$result=$this->db->select_sum('rank_knowledge_points')->from('rank_knowledge_points')->where(array('income_id'=>$user_id,'position'=>'left'))->get()->row();
		$knowledge_points=(!empty($result->rank_knowledge_points))?$result->rank_knowledge_points:0;
		return $knowledge_points;
	}
	public function getRightKnowledgePointsForRank($user_id)
	{
		$result=$this->db->select_sum('rank_knowledge_points')->from('rank_knowledge_points')->where(array('income_id'=>$user_id,'position'=>'right'))->get()->row();
		$knowledge_points=(!empty($result->rank_knowledge_points))?$result->rank_knowledge_points:0;
		return $knowledge_points;
	}
	///////////////////////
}//end class
?>