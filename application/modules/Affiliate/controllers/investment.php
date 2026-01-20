<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/investment
*/
class Investment extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->load->model('investment_model');
		$this->load->model('member_model');
		$this->userId=$this->session->userdata('user_id');
	} 
	/*
	@Desc: It's used to view the investment balance
	*/
	public function viewInvestBalance()
	{
		$data['title']='investment Balance';
		$data['psi_balance']=$this->investment_model->getInvestmentBalance($this->userId,'psi');
		$data['roi_balance']=$this->investment_model->getInvestmentBalance($this->userId,'roi');
		$data['staking_balance']=$this->investment_model->getInvestmentBalance($this->userId,'staking');
		_userLayout("investment-mgmt/view-investment-balance",$data);
	}
	public function purchaseList()
	{
		$data=array();
        $all_statements=$this->investment_model->getInvestmentHistory($this->userId);
		$data['all_statements']=$all_statements;
		_userLayout("investment-mgmt/view-investment-history",$data);
	}
	public function roiHistory($deposit_id)
	{
		$data=array();
        $all_statements=$this->investment_model->getInvestmentStatements($this->userId,$deposit_id);
		$data['all_statements']=$all_statements;
		_userLayout("investment-mgmt/view-investment-statement",$data);
	}
	/*
	@Desc: Validation method
	*/
	public function check_valid_username($username)
	{
		if(empty($username))
		{
		$this->form_validation->set_message('check_valid_username','Please enter Username/userid!');
		  return false;
		}
		else 
		{
			$this->db->where('username',$username);
			$this->db->or_where('user_id',$username);
			$query=$this->db->select('*')->from('user_registration')->get();
			if($query->num_rows()<1)
			{
			$this->form_validation->set_message('check_valid_username','Please enter valid Username/userid!');
			  return false;
			}
		}
		return true;
	}//end method
	/*
	@Desc:Validation method
	*/
	public function check_valid_tran_password($password)
	{
		//$username=$this->input->post('username');
		if(empty($password))
		{
		$this->form_validation->set_message('check_valid_tran_password','Please enter Transaction Password!');
		  return false;
		}
		else 
		{
			$query=$this->db->query("SELECT * FROM (`user_registration`) WHERE ( `user_id` = '".$this->userId."') AND `password` = '$password'");
			if($query->num_rows()<1)
			{
			$this->form_validation->set_message('check_valid_tran_password','Please enter valid Transaction Password!');
			  return false;
			}
		}
		return true;
	}//end method
	public function check_valid_amount($amount)
	{
	  //$username=$this->input->post('username');
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
		  $this->form_validation->set_message('check_valid_amount',"Sorry you don't have sufficent balance for your investment");
			  return false;
        return false;
	  	}
	  }
	  return true;
	}//end method
	/*
	@Desc: It's used to purchase the fund
	*/
	public function purchaseFund()
	{
	   // echo "asasd"; exit;
    	
    	$data['title']='Invest Fund';
    	$data['current_balance']=$this->investment_model->getEwalletBalance($this->userId);
    	//echo "select id from deposit_investment_amount_request where user_id='".$this->userId."' and status='0'";
    	$data['invest_count']=$this->db->query("select id from deposit_investment_amount_request where user_id='".$this->userId."' and status='0'")->num_rows();
    	$data['invest_info']=$this->db->query("select * from deposit_investment_amount_request where user_id='".$this->userId."' and status='0'")->row();
        if(!empty($this->input->post('deposit_amount')) && !empty($this->input->post('deposit_title')) && !empty($this->input->post('tran_password')))
        {
            //pr($_POST); exit;
            $deposit_amount=$amount=$this->input->post('deposit_amount');
            $deposit_title=$this->input->post('deposit_title');
            $tran_password=$this->input->post('tran_password');
    		
    		$this->load->library('form_validation');
            $this->form_validation->set_rules('amount','Amount','callback_check_valid_amount');
		    $user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
    	  	$exist_amount=$user->amount;
    	  	if(($amount>$exist_amount) || ($amount<$exist_amount))
    	  	{
    		    $this->session->set_flashdata("error_msg","Please enter amount as in wallet.");
                redirect(ci_site_url()."user/investment/purchaseFund");
                exit;
    	  	}
    	  	$sql="SELECT * FROM (`user_registration`) WHERE  `user_id` = '".$this->userId."' AND `password` = '$tran_password'";
    	  	//echo $sql; exit;
            $query=$this->db->query($sql);
			if($query->num_rows()<1)
			{
			    $this->session->set_flashdata("error_msg",' Please enter valid Password!');
                redirect(ci_site_url()."user/investment/purchaseFund");
                exit;
			}
            
            if($deposit_amount<200)
                {
                    $this->session->set_flashdata("error_msg",' Please enter minimum 200USD!');
                redirect(ci_site_url()."user/investment/purchaseFund");
                exit;
                }
                else if($deposit_amount>=200 && $deposit_amount<10000)
                {
                    if($deposit_title=='psi')
                    {
                        $per='0.20';
                    }
                    else if($deposit_title=='roi')
                    {
                        $per='0.40';
                    }
                    else if($deposit_title=='staking')
                    {
                        $per='0.55';
                    }
                    
                }
                else if($deposit_amount>=10000)
                {
                    if($deposit_title=='psi')
                    {
                        $per='0.25';
                    }
                    else if($deposit_title=='roi')
                    {
                        $per='0.50';
                    }
                    else if($deposit_title=='staking')
                    {
                        $per='0.60';
                    }
                }
                else
                {
                    
                }
    	    $this->db->insert('deposit_investment_amount_request',array(
           	'deposit_id'=>$this->generateUniqueDepositRequestId(),
           	'user_id'=>$this->userId,
           	'amount'=>$this->input->post('deposit_amount'),
           	'title'=>$this->input->post('deposit_title'),
           	'roi_per'=>$per,
           	'roi_upto'=>'200',
           	'request_date'=>date('Y-m-d H:i:s')
           	));
           	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
		  	$final_balance=$user->amount-$amount;
		  	$this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$this->userId));
			
            $array=array('','psi','roi','staking');
            $reason=$array[$deposit_title];
			//@debit entry
			$this->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$this->userId,
					'credit_amt'=>null,
					'debit_amt'=>$amount,
					'balance'=>$final_balance,
					'admin_charge'=>'0',
					'receiver_id'=>$this->userId,
					'sender_id'=>$this->userId,
					'receive_date'=>date('d-m-Y'),
					'ttype'=>'Invest in '.$deposit_title.' income',
					'TranDescription'=>'Invest in '.$deposit_title.' income',
					'status'=>'0',//debit amount
					'current_url'=>ci_site_url(),
					'deposit_type'=>$deposit_title,
					'reason'=>'1'//debit amount for fund transfer
					));
            $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> You purchase fund request sent successfully!');
            redirect(ci_site_url()."user/investment/purchaseList");
            exit;
		    
         }//end submit if here
    	_userLayout("investment-mgmt/purchase-fund",$data);
	}
	/*
	@Desc: It's used to transfer the ewallet fund
	*/
	public function ewalletFundTransfer()
	{
		$data['title']='E-Wallet Fund Transfer';
		if(!empty($this->input->post('btn')))
		{
		 $username=$this->input->post('username');
		 $amount=$this->input->post('amount');
		 $tran_password=$this->input->post('tran_password');
		 $this->load->library('form_validation');
		 $this->form_validation->set_rules('username','Username','required');
		 $this->form_validation->set_rules('username','Username','callback_check_valid_username');
		 $this->form_validation->set_rules('amount','Amount','callback_check_valid_amount');
		 $this->form_validation->set_rules('tran_password','Username','callback_check_valid_tran_password');
		 if(!$this->form_validation->run()==false)
		  {
		  	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
		  	$final_balance=$user->amount-$amount;
		  	$this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$this->userId));
			$to_user=$this->member_model->getUserId($username);

			//@debit entry
			$this->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$this->userId,
					'credit_amt'=>null,
					'debit_amt'=>$amount,
					'balance'=>$final_balance,
					'admin_charge'=>'0',
					'receiver_id'=>$to_user,
					'sender_id'=>$this->userId,
					'receive_date'=>date('d-m-Y'),
					'ttype'=>'Fund Transfer Debit Amount',
					'TranDescription'=>'Fund Transfer Debit Amount',
					'status'=>'0',//debit amount
					'current_url'=>ci_site_url(),
					'reason'=>'11'//debit amount for fund transfer
					));
		  	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$to_user)->get()->row();
		  	$final_balance=$user->amount+$amount;
		  	$this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$to_user));
			//@credit entry
			$this->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$to_user,
					'credit_amt'=>$amount,
					'debit_amt'=>null,
					'balance'=>$final_balance,
					'admin_charge'=>'0',
					'receiver_id'=>$to_user,
					'sender_id'=>$this->userId,
					'receive_date'=>date('d-m-Y'),
					'ttype'=>'Fund Transfer Credit Amount',
					'TranDescription'=>'Fund Transfer Credit Amount',
					'status'=>'1',//credit amount
					'current_url'=>ci_site_url(),
					'reason'=>'12'//credit amount by fund transfer
					));
	        $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span>fund transfer is done successfully!');
	        redirect(ci_site_url()."user/ewallet/ewalletFundTransfer");
			 exit;
		  }//end form validation if here!
		}
		_userLayout("ewallet-mgmt/ewallet-fund-transfer",$data);
	}
	/*
	@Desc: It's used to generate unique deposit request id
	*/
	public function generateUniqueDepositRequestId()
	{
	    $random_number="Invest".mt_rand(100000, 999999);
	    if($this->db->select('deposit_id')->from('deposit_investment_amount_request')->where('deposit_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueDepositRequestId();
	    }
	    return $random_number;
	}
	/*End method*/
	/*
	*/
	public function viewEwalletStatement()
	{
		$data=array();
        $all_statements=$this->ewallet_model->getEwalletStatements($this->userId);
		$data['all_statements']=$all_statements;
		_userLayout("ewallet-mgmt/view-ewallet-statement",$data);
	}//end method
	public function allFundTransfer()
	{
		$data['all_statements']=$this->ewallet_model->getAllFundTransferStatement($this->userId);
		$data['title']='All Fund Transfer';
		_userLayout("ewallet-mgmt/all-fund-transfer",$data);
	}//end method

///////////////////////////
	/*
	@Desc: It's used to  request for wallet amount deposit
	*/
	public function depositWalletAmountRequestList()
	{

	    $data['deposit_request']=$this->ewallet_model->getDepositWalletAmountRequest($this->userId);

	    $data['title']="Deposit Wallet Amount Request List";
	    $data['breadcrumb']='<li class="active">Deposit Wallet Amount Request List</li>';
		_userLayout("ewallet-mgmt/deposit-wallet-amount-request-list",$data);
	}
	/*
	@Desc: It's used to  request for wallet amount deposit
	*/
	public function depositWalletAmountRequest()
	{
      $current_balance=$this->ewallet_model->getEwalletBalance($this->userId);
      if(!empty($this->input->post('btn')))
       {

	        $image_upload_path='/images/';
	        $deposit_proof=adImageUpload($_FILES['deposit_proof'],1, $image_upload_path);
	        $deposit_proof=(!empty($deposit_proof))?$deposit_proof:'';
       	   $this->db->insert('deposit_wallet_amount_request',array(
       		'deposit_id'=>$this->generateUniqueDepositRequestId(),
       		'user_id'=>$this->userId,
       		'amount'=>$this->input->post('deposit_amount'),
       		'title'=>$this->input->post('deposit_title'),
       		'file_proof'=>$deposit_proof
       		));
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Your deposit request is processed successfully!</h5>');
        redirect(ci_site_url()."user/ewallet/depositWalletAmountRequestList");
       }//end submit if here
	    $data['title']="Deposit Wallet Amount Request";
	    $data['current_balance']=$current_balance;
	    $data['action']='add';
	    $data['action_url']='depositWalletAmountRequest';
	    $data['breadcrumb']='<li class="active">Deposit Wallet Amount Request</li>';
		_userLayout("ewallet-mgmt/deposit-wallet-amount-request",$data);
	}	

}//end class
