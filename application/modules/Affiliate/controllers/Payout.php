<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/payout
*/
class Payout extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		affiliate_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('ewallet_model');
		$this->load->model('payout_model');
	} 
	/*
	@Desc: It's used to generate unique withdrawl request id
	*/
	public function generateUniqueWithdrawlRequestId()
	{
	    $random_number="M".mt_rand(100000, 999999);
	    if($this->db->select('request_id')->from('withdrawl_wallet_amount_request')->where('request_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueWithdrawlRequestId();
	    }
	    return $random_number;
	}
	/*
	@Desc:Validation method
	*/
	public function check_valid_tran_password($password)
	{
		if(empty($password))
		{
		$this->form_validation->set_message('check_valid_tran_password','Please enter Transaction Password!');
		  return false;
		}
		else 
		{
			$query=$this->db->query("SELECT * FROM (`user_registration`) WHERE (`user_id` = '$this->userId') AND `t_code` = '$password'");
			if($query->num_rows()<1)
			{
			$this->form_validation->set_message('check_valid_tran_password','Please enter valid Transaction Password!');
			  return false;
			}
		}
		return true;
	}//end method
	public function check_valid_request_amount($amount)
	{
	  if(empty($amount))
	  {
		$this->form_validation->set_message('check_valid_amount','Please enter amount!');
		  return false;
	  }
	  else 
	  {
	  	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
	  	$exist_amount=$user->amount;
	  	if($amount>$exist_amount)
	  	{
		  $this->form_validation->set_message('check_valid_amount',"Sorry you don't have sufficent balance into your ewallet");
			  return false;
        return false;
	  	}
	  }
	  return true;
	}//end method
	/*
	@Desc: It's used to Withdrawl Fund from Ewallet
	*/
	public function withdrawlMyFund()
	{
	    $current_balance=$this->ewallet_model->getEwalletBalance($this->userId);
	    if(!empty($this->input->post('btn')))
	    {
	    $request_title=$this->input->post('request_title');	
	    $request_amount=$this->input->post("request_amount");
	    $final_balance=(float)$current_balance-(float)$request_amount;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('request_amount','Request Amount','callback_check_valid_request_amount');
		$this->form_validation->set_rules('tran_password','Username','callback_check_valid_tran_password');
        /*if(!$this->form_validation->run()==false)
	       {*/
		        $this->db->insert('withdrawl_wallet_amount_request',array(
		        	'request_id'=>$this->generateUniqueWithdrawlRequestId(),
		        	'amount'=>$request_amount,
		        	'user_id'=>$this->userId,
		        	'title'=>$request_title
		        	));
		        $this->db->update('final_e_wallet', array('amount'=>$final_balance),array('user_id'=>$this->userId));
		        $insert_data_credit_debit=array(
		          'transaction_no'=>generateUniqueTranNo(),
		          'user_id'=>$this->userId,
		          'debit_amt'=>$request_amount,
		          'balance'=>$final_balance,
		          'receiver_id'=>$this->userId,
		          'sender_id'=>$this->userId,
		          'receive_date'=>date('d-m-Y'),
		          'ttype'=>'Withdrawl Request',
		          'TranDescription'=>'Withdrawl Request amount deduction',
		          'status'=>'0', ///it's indicate debit status
		          'reason'=>'13' //Debit Amount for Withdrawl wallet amount request
		          );
		        $this->db->insert('credit_debit',$insert_data_credit_debit);     
		        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Your withdrawl request is processed successfully!</h5>');
		        redirect(ci_site_url()."Affiliate/Payout/withdrawlMyFund");	        	
	       /* }*/
	    }//end submit if here
		$data['title']='Withdrawl My Fund';
		$data['current_balance']=$current_balance;
		$data['user_id']=$this->userId;
		_userLayout("payout-mgmt/withdrawl-my-fund",$data);
	}
	/*
	@Desc: It's used to view the completed payout request list
	*/
	public function completedPayoutRequestList()
	{
		$data['title']='Complated Request';
		$data['all_completed_request']=$this->payout_model->getAllCompletedPayoutRequest($this->userId);
		_userLayout("payout-mgmt/completed-payout-request-list",$data);
	}
	/*
	@Desc: It's used to view the pending payout request list
	*/
	public function pendingPayoutRequestList()
	{
		$data['title']='Pending Request';
		$data['all_pending_request']=$this->payout_model->getAllPendingPayoutRequest($this->userId);
		_userLayout("payout-mgmt/pending-payout-request-list",$data);
	}
	/*
	@Desc: It's used to view the cancelled payout request list
	*/
	public function cancelledPayoutRequestList()
	{
		$data['title']='Cancelled Request';
		$data['all_cancelled_request']=$this->payout_model->getAllCancelledPayoutRequest($this->userId);
		_userLayout("payout-mgmt/cancelled-payout-request-list",$data);
	}

}//end class
