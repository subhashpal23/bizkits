<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/ewallet_model
*/
class Investment_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getInvestmentBalance($user_id,$type)
  {
     $res=$this->db->select('SUM(amount+roi_amount) as amount')->from('deposit_investment_amount_request')->where(array('user_id'=>$user_id,'title'=>$type))->get()->row();
     $balance=(!empty($res->amount))?$res->amount:0;
     return $balance;   
  }//end method
  public function getEwalletBalance($user_id)
  {
     $res=$this->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$user_id))->get()->row();
     $balance=(!empty($res->amount))?$res->amount:0;
     return $balance;   
  }//end method
  public function getInvestmentStatements($user_id,$deposit_id)
   {
      $statementQuery=$this->db->select('cd.transaction_no,cd.status, cd.user_id, cd.credit_amt, cd.debit_amt, cd.balance, cd.ttype as title, cd.TranDescription as description, cd.create_date as date')->from('credit_debit_investment as cd')
      ->join('user_registration as u', 'u.user_id=cd.user_id')
      ->order_by('cd.id','DESC')
      ->where(array('u.user_id'=>$user_id,'cd.deposit_id'=>$deposit_id))
      ->get();
      $result=$statementQuery->result();
      $result=(!empty($result))?$result:array();
      return $result;
   }//end method
   public function getInvestmentHistory($user_id)
   {
      $statementQuery=$this->db->select('*')->from('deposit_investment_amount_request')
      ->order_by('id','DESC')
      ->where('user_id',$user_id)
      ->get();
      $result=$statementQuery->result();
      $result=(!empty($result))?$result:array();
      return $result;
   }//end method
   public function getAllFundTransferStatement($user_id)
   {
    $query="select u.username,cd.transaction_no, cd.credit_amt, cd.debit_amt, cd.receiver_id, cd.sender_id,cd.status, cd.receive_date from credit_debit as cd left join user_registration as u on u.user_id=cd.user_id where cd.user_id='$user_id' and (cd.reason='11') order by cd.id desc";
    $query=$this->db->query($query);
    //echo $this->db->last_query();
    //die;
    $result=(!empty($query->result()))?$query->result():array();
    return $result;
   }//end method  
  /*
   @Desc: It's return collection of all the withdrawl request for specific user
   */ 
   public function getDepositWalletAmountRequest($user_id)
   {
    $allRequet=$this->db->select(array(
      'd.id',
      'd.deposit_id',
      'd.amount',
      'd.title',
      'd.file_proof',
      'd.status',
      'd.request_date',
      'd.response_date'
      ))->from('deposit_wallet_amount_request d')->where('user_id',$user_id)->order_by('id', 'desc')->get()->result();
    $request=(!empty($allRequet))?$allRequet:array();
    return $request;
   }//end method
}//end class
?>