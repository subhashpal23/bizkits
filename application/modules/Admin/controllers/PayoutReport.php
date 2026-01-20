<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/PayoutReport
*/
class PayoutReport extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("payout_model");
	}//end constructor
	
	public function processCsv()
	{
	    $data=array();
	    if(!empty($this->input->post('upload')))
	    {
	        //pr($_FILES['csv']['tmp_name']);
	        $file = fopen($_FILES['csv']['tmp_name'],"r");
	        $s=1;
while(! feof($file))
  {
      if($s>1)
      $getcsv=fgetcsv($file);
      //pr($getcsv);
      $all_active_payout[]=$getcsv;
  $s++;
  }
  
fclose($file);
$data['all_active_payout']=$all_active_payout;
	    }
		_adminLayout("payout-report-mgmt/process-payout",$data);
	}
	public function generateUniqueWithdrawlRequestId()
	{
	    $random_number="i3Empire".mt_rand(100000, 999999);
	    if($this->db->select('request_id')->from('withdrawl_wallet_amount_request')
	    ->where('request_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueWithdrawlRequestId();
	    }
	    return $random_number;
	}
	public function generateUniqueRankRequestId()
	{
	    $random_number="i3Empire".mt_rand(100000, 999999);
	    if($this->db->select('request_id')->from('withdrawl_rank_amount_request')
	    ->where('request_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueRankRequestId();
	    }
	    return $random_number;
	}
	public function exportPayout($id)
	{
	    $filename = "PayoutList_" . date('Y-m-d') . ".csv"; 
        $delimiter = ",";
        
        $f = fopen('php://memory', 'w'); 
        //$fields = array('Request Id', 'Amount', 'User' , 'Username', 'Request date', 'Payout Date','Bank Name','Sort Code','Benifiecieary Name','Account Number');
        $fields = array('Benifiecieary Name','Account Number', 'Amount','Sort Code');
        fputcsv($f, $fields, $delimiter);
        $cominfo=$this->db->select('*')->from('payout')->where(array('id'=>$id))->get()->row();
        $payout_date=$cominfo->payout_date;
        $cominfo=$this->db->select('*')->from('withdrawl_wallet_amount_request as w')
        ->join('user_registration as u1', 'w.user_id=u1.user_id')
	    ->where(array('w.payout_date'=>$payout_date))->get()->result();
        if (count($cominfo) > 0) 
        {
            foreach($cominfo as $key=>$val)
            {
                $account_no=str_pad($val->account_no, 10, '0', STR_PAD_LEFT);
                //$lineData = array($val->request_id, $val->amount, $val->user_id, get_user_name($val->user_id), $val->request_date, $val->payout_date, $val->bank_name, $val->branch_name, $val->account_holder_name, $val->account_no); 
                $lineData = array($val->account_holder_name, $account_no, $val->amount, $val->branch_name); 
                fputcsv($f, $lineData, $delimiter);
            }
        } 
        
        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        fpassthru($f);
        exit();
	}
	
	public function createNewPayout()
	{
	    $this->db->insert('payout',array(
	        'payout_date'=>date('Y-m-d'),
	        'status'=>1
	        ));
	   // minimum withdraw 1200
	   // withdraw charge 200
	   $minwithdraw=1200;
	   $withdrawcharge=200;
	    $cominfo=$this->db->select('*')->from('final_e_wallet')->where(array('amount >'=>'0'))->get()->result();
	    $s=1;
	    foreach($cominfo as $key=>$val)
	    {
	        
	        $request_amount=$val->amount;
	        $request_title='Payout Of '.$val->user_id;
	        if($request_amount>=$minwithdraw)
	        {
	            $this->db->insert('withdrawl_wallet_amount_request',array(
		        	'request_id'=>$this->generateUniqueWithdrawlRequestId(),
		        	'amount'=>($request_amount-$withdrawcharge),
		        	'withdraw_charge'=>$withdrawcharge,
		        	'user_id'=>$val->user_id,
		        	'request_date'=>date('Y-m-d H:i:s'),
		        	'payout_date'=>date('Y-m-d'),
		        	'response_date'=>date('Y-m-d H:i:s'),
    	            'status'=>'1',
		        	'title'=>$request_title
		        	));
		        	$final_balance=$val->amount-$request_amount;
		        	echo $s."--".$val->user_id.'=='.$val->amount."--".$final_balance;echo "<br>";
		        	$s++;
		        $this->db->update('final_e_wallet', array('amount'=>$final_balance),array('user_id'=>$val->user_id));
		        $insert_data_credit_debit=array(
		          'transaction_no'=>generateUniqueTranNo(),
		          'user_id'=>$val->user_id,
		          'debit_amt'=>$request_amount,
		          'balance'=>$final_balance,
		          'receiver_id'=>$val->user_id,
		          'sender_id'=>$val->user_id,
		          'receive_date'=>date('Y-m-d'),
		          'ttype'=>'Withdrawl Request',
		          'TranDescription'=>'Withdrawl Request amount deduction',
		          'status'=>'0', ///it's indicate debit status
		          'reason'=>'14' //Debit Amount for Withdrawl wallet amount request
		          );
		        $this->db->insert('credit_debit',$insert_data_credit_debit); 
	        }
	    }
	    
	    $this->session->set_flashdata('flash_msg','Payout generated successfully');
	    redirect(base_url().'Admin/PayoutReport/activePayout');
	}
	public function activePayout($id=null)
	{
		$data=array();
		$data['all_active_payout']=array();
		if($id!='')
		{
		    $cominfo=$this->db->select('*')->from('payout')->where(array('id'=>$id))->get()->row();
            $payout_date=$cominfo->payout_date;
            $data['all_active_payout']=$this->payout_model->getAllCompletedPayoutList($payout_date);
            //echo $this->db->last_query();
            $data['payout_id']=$id;
		}
		else
		{
		    //$data['all_active_payout']=$this->payout_model->getAllCompletedPayoutRequest();
		}
		
		$data['all_payout']=$this->db->select('*')->from('payout')->get()->result();
		//pr($data['all_active_payout']);
		_adminLayout("payout-report-mgmt/active-payout",$data);
	}
	
	public function rankPayout($id=null)
	{
		$data=array();
		$data['all_active_payout']=array();
		if($id!='')
		{
		    $cominfo=$this->db->select('*')->from('payout_rank')->where(array('id'=>$id))->get()->row();
            $payout_date=$cominfo->payout_date;
            $data['all_active_payout']=$this->payout_model->getAllRankedPayoutList($payout_date);
            //echo $this->db->last_query();
            $data['payout_id']=$id;
		}
		else
		{
		    //$data['all_active_payout']=$this->payout_model->getAllCompletedPayoutRequest();
		}
		
		$data['all_payout']=$this->db->select('*')->from('payout_rank')->get()->result();
		//pr($data['all_active_payout']);
		$data['rank_list']=$this->db->select('*')->from('rank')->get()->result();
		_adminLayout("payout-report-mgmt/rank-payout",$data);
	}
	
	public function createRankPayout($rank_id)
	{
	    if($rank_id!='')
	    {
	        // check and get valid rank
	        $count=$this->db->select('*')->from('rank')->where('id',$rank_id)->get()->num_rows();
	        if($count>0)
	        {
	    $this->db->insert('payout_rank',array(
	        'payout_date'=>date('Y-m-d'),
	        'status'=>1
	        ));
	   // minimum withdraw 1200
	   // withdraw charge 200
	   $minwithdraw=1200;
	   $withdrawcharge=200;
	   //$count=$this->db->select('*')->from('user_registration')->where('id',$rank_id)->get()->row();
	   $cominfo=$this->db->select('final_reward_wallet.*')->from('final_reward_wallet')->join('user_registration','final_reward_wallet.user_id=user_registration.user_id')
	   ->where(array('amount >'=>'0'))->where_in('user_registration.rank_id',$rank_id)->get()->result();
	   //echo $this->db->last_query();
	   //pr($cominfo); exit;
	    //$cominfo=$this->db->select('*')->from('final_reward_wallet')->where(array('amount >'=>'0'))->get()->result();
	    $s=1;
	    if(count($cominfo)>0)
	    {
	    foreach($cominfo as $key=>$val)
	    {
	        
	        $request_amount=$val->amount;
	        $request_title='Payout Of '.$val->user_id;
	        if($request_amount>=$minwithdraw)
	        {
	            $this->db->insert('withdrawl_rank_amount_request',array(
		        	'request_id'=>$this->generateUniqueRankRequestId(),
		        	'amount'=>($request_amount-$withdrawcharge),
		        	'withdraw_charge'=>$withdrawcharge,
		        	'user_id'=>$val->user_id,
		        	'request_date'=>date('Y-m-d H:i:s'),
		        	'payout_date'=>date('Y-m-d'),
		        	'response_date'=>date('Y-m-d H:i:s'),
    	            'status'=>'1',
		        	'title'=>$request_title
		        	));
		        	$final_balance=$val->amount-$request_amount;
		        	echo $s."--".$val->user_id.'=='.$val->amount."--".$final_balance;echo "<br>";
		        	$s++;
		        $this->db->update('final_reward_wallet', array('amount'=>$final_balance),array('user_id'=>$val->user_id));
		        $insert_data_credit_debit=array(
		          'transaction_no'=>generateUniqueTranNo(),
		          'user_id'=>$val->user_id,
		          'debit_amt'=>$request_amount,
		          'balance'=>$final_balance,
		          'receiver_id'=>$val->user_id,
		          'sender_id'=>$val->user_id,
		          'receive_date'=>date('Y-m-d'),
		          'ttype'=>'Withdrawl Request',
		          'TranDescription'=>'Withdrawl Request amount deduction',
		          'status'=>'0', ///it's indicate debit status
		          'reason'=>'14' //Debit Amount for Withdrawl wallet amount request
		          );
		        $this->db->insert('credit_debit_reward',$insert_data_credit_debit); 
	        }
	    }
	    
	    $this->session->set_flashdata('flash_msg','Payout generated successfully');
	    redirect(base_url().'Admin/PayoutReport/rankPayout');
	    }
	    else
	    {
	        $this->session->set_flashdata('error_msg','No users available for rank');
	        redirect(base_url().'Admin/PayoutReport/rankPayout');
	    }
	        }
	        else
	        {
	            $this->session->set_flashdata('error_msg','Please select valid rank');
	        redirect(base_url().'Admin/PayoutReport/rankPayout');
	        }
	    }
	    else
	    {
	        $this->session->set_flashdata('error_msg','Please select rank');
	        redirect(base_url().'Admin/PayoutReport/rankPayout');
	    }
	}
	
	public function exportRankPayout($id)
	{
	    $filename = "PayoutList_" . date('Y-m-d') . ".csv"; 
        $delimiter = ",";
        
        $f = fopen('php://memory', 'w'); 
        //$fields = array('Request Id', 'Amount', 'User' , 'Username', 'Request date', 'Payout Date','Bank Name','Sort Code','Benifiecieary Name','Account Number');
        $fields = array('Benifiecieary Name','Account Number', 'Amount','Sort Code');
        fputcsv($f, $fields, $delimiter);
        $cominfo=$this->db->select('*')->from('payout_rank')->where(array('id'=>$id))->get()->row();
        $payout_date=$cominfo->payout_date;
        $cominfo=$this->db->select('*')->from('withdrawl_rank_amount_request as w')
        ->join('user_registration as u1', 'w.user_id=u1.user_id')
	    ->where(array('w.payout_date'=>$payout_date))->get()->result();
        if (count($cominfo) > 0) 
        {
            foreach($cominfo as $key=>$val)
            {
                //$lineData = array($val->request_id, $val->amount, $val->user_id, get_user_name($val->user_id), $val->request_date, $val->payout_date, $val->bank_name, $val->branch_name, $val->account_holder_name, $val->account_no); 
                $lineData = array($val->account_holder_name, $val->account_no, $val->amount, $val->branch_name); 
                fputcsv($f, $lineData, $delimiter);
            }
        } 
        
        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        fpassthru($f);
        exit();
	}
	public function payoutCompleted()
	{
		$data=array();
		$data['all_completed_payout_request']=$this->payout_model->getAllCompletedPayoutRequest();
		//pr($this->payout_model->getAllCompletedPayoutRequest());die;
		_adminLayout("payout-report-mgmt/payout-completed",$data);
	}
	public function payoutCancelled()
	{
		$data=array();
		$data['all_cancelled_payout_request']=$this->payout_model->getAllCancelledPayoutRequest();
		_adminLayout("payout-report-mgmt/payout-cancelled",$data);
	}
	public function payoutGraph()
	{
		$data=array();
		_adminLayout("payout-report-mgmt/payout-graph",$data);
	}
	public function approvePayoutRequest($request_id)
	{
	    $id=ID_decode($request_id);
	    $this->db->update(
	      'withdrawl_wallet_amount_request',
	      array('status'=>'1', 'response_date'=>date("Y-m-d H:i:s")),
	      array('id'=>$id)
	      );
	    $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is approved successfully');
	    redirect(ci_site_url()."Admin/PayoutReport/payoutCompleted");
	}
	public function cancelPayoutRequest($request_id)
	{
	    $id=ID_decode($request_id);
	    $this->db->update('withdrawl_wallet_amount_request', array('status'=>'2', 'response_date'=>date("Y-m-d H:i:s")), array('id'=>$id));
	    $request=$this->db->select('*')->from('withdrawl_wallet_amount_request')->where('id',$id)->get()->row();
	    $wallet=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$request->user_id)->get()->row();
	    $final_balance=$wallet->amount+$request->amount;
	    $this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$request->user_id));
	    $insert_data_credit_debit=array(
	            'transaction_no'=>generateUniqueTranNo(),
	            'user_id'=>$request->user_id,
	            'credit_amt'=>$request->amount,
	            'balance'=>$final_balance,
	            'receiver_id'=>$request->user_id,
	            'sender_id'=>COMP_USER_ID,
	            'receive_date'=>date('d-m-Y'),
	            'ttype'=>'withdrawl request cancelled refund',
	            'TranDescription'=>'withdrawl request cancelld refund',
	            'status'=>'1', ///it's indicate credit status
	            'reason'=>'14' //it's indicate withdrawal request cancel refund
	            );//end credit debit data
	    $this->db->insert('credit_debit',$insert_data_credit_debit);
	    $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is cancelled successfully');
	    redirect(ci_site_url()."Admin/PayoutReport/payoutCancelled");
	}
}//end class