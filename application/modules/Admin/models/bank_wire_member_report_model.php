<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/account_model
*/
class Bank_Wire_Member_Report_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @Desc: It's used to get all the pending member
  */  
  public function getPendingMember()
  {
   return $this->db->select('*')->from('bank_wired_user_registration')->where(array('status'=>'0'))->get()->result();
  }
  /*
  @Desc: It's used to get all the approved member
  */  
  public function getApprovedMember()
  {
   return $this->db->select('*')->from('bank_wired_user_registration')->where(array('status'=>'1'))->get()->result();
  }
  /*
  @Desc: It's used to get all the cancelled member
  */  
  public function getCancelledMember()
  {
   return $this->db->select('*')->from('bank_wired_user_registration')->where(array('status'=>'2'))->get()->result();
  }
  /*
  @Desc: It's used to get the bank wire details
  */
  public function getBankWirePaymentDetailsList($user_id,$id=null)
  {
    if(!empty($id))
      return $this->db->select('*')->from('bank_wire_payment_details')->where(array('user_id'=>$user_id,'id'=>$id))->get()->row();
    else 
      return $this->db->select('*')->from('bank_wire_payment_details')->where('user_id',$user_id)->get()->result();


  }
}//end class
?>