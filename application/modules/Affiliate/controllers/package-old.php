<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/package
*/
class Package extends Common_Controller 
{
	private $user_id;
	/*
	@Constructor
	*/
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->helper('user_package_helper');
		$this->load->model('package_model');
		$this->load->helper('registration_helper');
		
	} 
	/*
	@Desc:It's shows the current user activated package
	*/
	public function myActivePackage()
	{
        $data['title']="Active Package";
        $data['breadcrumb']='<li class="active">Active Package</li>';
	    $data['my_active_ackage']=$this->package_model->getMyActivePackage($this->user_id);
	    $data['package_log']=$this->package_model->getUpgradedPackageLogInformation($this->user_id);
	    //pr($data['package_log']);
	   _userLayout("package-mgmt/active-package",$data);	
	}
	/*
	@Desc:It's shows the all active package list, excluded current user active package
	*/
	public function upgradePackage()
	{
	   	$account_model=$this->load->model('account_model');
	   	$user_details=$this->account_model->getUserDetails($this->user_id);
	   	$old_package_details=$this->package_model->getPackageDetails($user_details->pkg_id);
        $data['title']="Upgrade Package";
        $data['breadcrumb']='<li class="active">Upgrade Package</li>';
        $data['packages']=$this->package_model->getAllExcludedActivePackage($this->user_id,floatval($old_package_details->amount));
	   _userLayout("package-mgmt/upgrade-package",$data);	
	}//end method
	public function selectPaymentMethod($pkg_id)
	{
		$data=array();
		$pkg_id=ID_decode($pkg_id);
		/////////////

		$pkg_details=$this->package_model->getPackageDetails($pkg_id);

		$user_details=get_user_details($this->user_id);
		$data['package_fee']=$pkg_details->amount;
		
		if($user_details->pkg_id!='22')
		{
			$data['diff_amount']=$pkg_details->amount-$user_details->pkg_amount;
		}
		else 
		{
			$data['diff_amount']=$pkg_details->amount;
		}
		$data['email']=$user_details->email;
		/////////
		$this->session->set_userdata('upgrade_package',$pkg_id);
		_userLayout("package-mgmt/select-payment-method",$data);
	}//end method
	public function ewalletPayment()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$package_id=$this->session->userdata('upgrade_package');
			$pkg_details=$this->package_model->getPackageDetails($package_id);
			
			$user_details=get_user_details($this->user_id);

			$tran_password=$this->input->post('tran_password');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('tran_password','Transaction Password','callback_check_valid_tran_password');
			
			//$this->package_model->upgradePackage($this->user_id,$package_id);
			if(!$this->form_validation->run()==false)
		    {
				$query_obj=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->user_id)->get()->row();
	
				if($user_details->pkg_id!='22')
				{
					$current_pkg_details=$this->package_model->getPackageDetails($user_details->pkg_id);
					
					$diff_amount=$pkg_details->amount-$current_pkg_details->amount;
				}
				else 
				{
					$diff_amount=$pkg_details->amount;
				}
				
				$balance=$query_obj->amount-$diff_amount;
	
				$pkg_amount=$diff_amount;
				
				$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$this->user_id));
				$transaction_no=generateUniqueTranNo();
	
				$this->db->insert('credit_debit',array(
				'transaction_no'=>$transaction_no,
				'user_id'=>$this->user_id,
				'credit_amt'=>'0',
				'debit_amt'=>$diff_amount,
				'balance'=>$balance,
				'admin_charge'=>'0',
				'receiver_id'=>COMP_USER_ID,
				'sender_id'=>$this->user_id,
				'receive_date'=>date('d-m-Y'),
				'ttype'=>'Package Upgraded',
				'TranDescription'=>'Package Upgraded by '.$this->user_id,
				'Cause'=>'Package Upgraded by '.$this->user_id,
				'Remark'=>'Package Upgraded by '.$this->user_id,
				'invoice_no'=>'',
				'product_name'=>'',
				'status'=>'0',
				'ewallet_used_by'=>'Withdrawal Wallet',
				'current_url'=>ci_site_url(),
				'reason'=>'26'
				));
				///////////
				$this->creditCommission($package_id,$pkg_amount);
				
				$this->creditKnowLedgePoints($package_id,$this->user_id);
				
				$this->signupBonus($package_id,$pkg_amount);
				//creditUnilevelCommission($package_id,$this->user_id,$pkg_amount,$pkg_details->title);
				
				/////////
				$this->package_model->upgradePackage($this->user_id,$package_id,'1','Ewallet-Payment',$transaction_no);
				$this->updateRank();
				$this->session->unset_userdata('upgrade_package');
				$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Package is activated successfully!</h5>');;	
				redirect(ci_site_url()."user/package/myActivePackage");
				exit;
			}
		}
		_userLayout("package-mgmt/ewallet-payment",$data);
	}//end method
	public function payStackPayment()
	{
		$result=(!empty($_POST))?$_POST:$_GET;
		$transaction_no=$result['reference'];
		$transaction_report=$this->verifyTransaction($transaction_no);
		if(!empty($transaction_report->status) && $transaction_report->status==1 )
		{
			$paystack_reference=$transaction_report->data->reference;
			$package_id=$this->session->userdata('upgrade_package');
			
			///////////
			$pkg_details=$this->package_model->getPackageDetails($package_id);
			
			$user_details=get_user_details($this->user_id);
			
			if($user_details->pkg_id!='22')
			{
				$current_pkg_details=$this->package_model->getPackageDetails($user_details->pkg_id);
					
				$diff_amount=$pkg_details->amount-$current_pkg_details->amount;
			}
			else 
			{
				$diff_amount=$pkg_details->amount;
			}
			/////////////
			//$pkg_amount=$pkg_details->amount;
			$pkg_amount=$diff_amount;
			
			$this->creditCommission($package_id,$pkg_amount);
			
			$this->creditKnowLedgePoints($package_id,$this->user_id);
			
			$this->signupBonus($package_id,$pkg_amount);
			//creditUnilevelCommission($package_id,$this->user_id,$pkg_amount,$pkg_details->title);
			/////////
			
			$this->package_model->upgradePackage($this->user_id,$package_id,'2','Paystack-Payment',$transaction_no,$paystack_reference);
			
			$this->updateRank();
			
			$this->session->unset_userdata('upgrade_package');
			$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Package is activated successfully!</h5>');
			redirect(ci_site_url()."user/package/myActivePackage");
			exit;
		}
		else 
		{
			redirect(ci_site_url()."user/package/selectPaymentMethod/");
			exit;
		}
	}//end method
	/*
	@Desc: It's used to activate the new user package
	*/
	public function activatePackage($package_id)
	{
	   $this->package_model->upgradePackage($this->user_id,$package_id);
	   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Package is activated successfully!</h5>');;	
	   redirect(ci_site_url()."user/package/myActivePackage");
	   exit;
	}
	public function verifyTransaction($transaction_no=null)
	{
			/////////////Second request with auth token
			$ch = curl_init();
			$token="sk_test_2129931c7ef0185b746875e27cce790d4cdd8213";
			//$transaction_no='58313';
			curl_setopt($ch, CURLOPT_URL,"https://api.paystack.co/transaction/verify/".$transaction_no);
			//curl_setopt($ch, CURLOPT_POST, 0);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				 'Authorization: Bearer '.$token
				));

			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec ($ch);
			curl_close ($ch);

			$output=json_decode($server_output);
			return $output;
		///////////////////////
	}//end method
	public function check_valid_tran_password($password)
	{
		$username=$this->user_id;
		if(empty($password))
		{
		$this->form_validation->set_message('check_valid_tran_password','Please enter Transaction Password!');
		  return false;
		}
		else 
		{
			$query=$this->db->query("SELECT * FROM (`user_registration`) WHERE (`username` = '$username' OR `user_id` = '$username') AND `t_code` = '$password'");
			if($query->num_rows()<1)
			{
			$this->form_validation->set_message('check_valid_tran_password','Please enter valid Transaction Password!');
			  return false;
			}
			else 
			{
				$pkg_id=$this->session->userdata('upgrade_package');
				
				$pkg_details=$this->package_model->getPackageDetails($pkg_id);
				
				$pkg_amount=$pkg_details->amount;
				$user_details=get_user_details($this->user_id);
				/////////////
				if($user_details->pkg_id!='22')
				{
					$current_pkg_details=$this->package_model->getPackageDetails($user_details->pkg_id);
				    $diff_amount=$pkg_details->amount-$current_pkg_details->amount;
				}
				else 
				{
					$diff_amount=$pkg_details->amount;
				}
				//////////////
				
				$result=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->user_id)->get()->row();
				
				
				$ewalletAmount=$result->amount;
				
				
				if($ewalletAmount<$diff_amount)
				{
					$this->form_validation->set_message('check_valid_tran_password','Sorry your wallet amount is less than to selected package amount!');
					return false;	
				}
			}
		}
		return true;
	}//end method
   public function creditCommission($pkg_id,$pkg_amount)
   {
	   ///////////////////////////////
				$package_status=$this->db->select('status')->from('package')->where('id', $pkg_id)->get()->row();
				
				$user_details=get_user_details($this->user_id);
				$sponser_id=$user_details->ref_id;
				$user_id=$this->user_id;
				$commission_permission=$this->db->select('status')->from('commission_permission')->where(array('comm_type_id'=>'1', 'pkg_id'=>$pkg_id))->get()->row();//'comm_type_id'=>'1' is used for direct commission type
				$pkg_name=get_package_name($pkg_id);	
				if($commission_permission->status=='1' && !empty($package_status->status) && $package_status->status=='1')
				{
				
				creditDirectCommission($sponser_id,$pkg_id,$user_id,$pkg_name,$pkg_amount);
				}
				$commission_permission=$this->db->select('status')->from('commission_permission')->where(array('comm_type_id'=>'4', 'pkg_id'=>$pkg_id))->get()->row();//'comm_type_id'=>'1' is used for unilevel commission type
				
				if($commission_permission->status=='1' && !empty($package_status->status) && $package_status->status=='1')
				{
				creditUnilevelCommission($pkg_id,$user_id,$pkg_amount,$pkg_name);
				}
				///////////////////
   }
   public function creditKnowLedgePoints($pkg_id,$user_id)
   {
	    $pkg_info=$this->db->select('*')->from('package')->where(array('id'=>$pkg_id))->get()->row();
	    $knowledge_points=$pkg_info->knowledge_points;
		$pkg_amount=$pkg_info->amount;
		
		$upliners_query=$this->db->select('*')->from('level_income_binary')->where('down_id',$user_id)->get();
		//while($upline=mysql_fetch_array($upliners))
		$bvdata=array();
		foreach($upliners_query->result_array() as $upliner)
		{
			$income_id=$upliner['income_id'];
			$position=$upliner['leg'];
			//$user_level=level_countdd($user_id,$income_id); 
			$user_level=$upliner['level']; 
			
			$bvdata[]=array(
				'income_id'=>$income_id,
				'downline_id'=>$user_id,
				'level'=>$user_level,
				'bv'=>$pkg_amount,
				'knowledge_points'=>$knowledge_points,
				'position'=>$position,
				'description'=>'package upgrade',
				'date'=>date('Y-m-d'),
				'status'=>0,
				);
	   }
	   if(count($bvdata)>0)
	   {
		$this->db->insert_batch('manage_bv_history',$bvdata);
	   }
	   ////entry for rank knowledge_points
	   $all_direct_upliners=$this->db->select('*')->from('direct_matrix_downline')->where(array('down_id'=>$user_id))->get()->result();
		
	   $rank_data=array();
		/////////////////////////////
	   foreach($all_direct_upliners as $upliner)
		{
				$income_id=$upliner->income_id;
				$position=$upliner->ref_leg_position;
				//$user_level=level_countdd($user_id,$income_id); 
				$user_level=$upliner->level; 
				
				$rank_data[]=array(
					'income_id'=>$income_id,
					'downline_id'=>$user_id,
					'level'=>$user_level,
					'rank_knowledge_points'=>$knowledge_points,
					'position'=>$position,
					'date'=>date('Y-m-d'),
					'pkg_id'=>$pkg_id
					);
		}
		if(count($rank_data)>0)
		{
		$this->db->insert_batch('rank_knowledge_points',$rank_data);
		}
		///crediting self knowledge_points
		$this->db->insert('rank_knowledge_points',array(
				'income_id'=>$user_id,
				'downline_id'=>$user_id,
				'level'=>'0',
				'rank_knowledge_points'=>$knowledge_points,
				'position'=>'self',
				'date'=>date('Y-m-d'),
				'pkg_id'=>$pkg_id
		));
		////////////////////////////////////
   }//end method
   public function updateRank()
   {
	   $all_upliners=$this->db->select('*')->from('matrix_downline')->where('down_id',$this->user_id)->get()->result();
	   foreach($all_upliners as $upliner)
	   {
			update_rank($upliner->income_id);
	   }
   }
   public function signupBonus($pkg_id,$pkg_amount)
   {
	   $user_id=$this->user_id;

	   $sign_up_bonus=($pkg_amount*10)/100;
		
		if(is_active_secondry_ewallet())
		{
			$sign_up_bonus1=$sign_up_bonus;
			$deduction_percent=get_secondry_wallet_deduction();
			$secondry_wallet_commission=($sign_up_bonus*$deduction_percent)/100;
			$sign_up_bonus=$sign_up_bonus-$secondry_wallet_commission;
			
			$query_obj=$this->db->select('amount')->from('secondry_e_wallet')->where('user_id',$user_id)->get()->row();
			$balance=$query_obj->amount+$secondry_wallet_commission;
			$this->db->update('secondry_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id));
			
			$this->db->insert('secondry_wallet_credit_debit',array(
			'transaction_no'=>generateUniqueTranNo(),
			'user_id'=>$user_id,
			'credit_amt'=>$secondry_wallet_commission,
			'debit_amt'=>'0',
			'balance'=>$new_balance,
			'admin_charge'=>'0',
			'receiver_id'=>$user_id,
			'sender_id'=>COMP_USER_ID,
			'receive_date'=>date('d-m-Y'),
			'ttype'=>$deduction_percent.'% of Sign Up Bonus'.$sign_up_bonus1,
			'TranDescription'=>$deduction_percent.'% of Sign Up Bonus'.$sign_up_bonus1,
			'Cause'=>$deduction_percent.'% of Sign Up Bonus'.$sign_up_bonus1,
			'Remark'=>$deduction_percent.'% of Sign Up Bonus'.$sign_up_bonus1,
			'invoice_no'=>'',
			'product_name'=>'',
			'status'=>'1',
			'ewallet_used_by'=>'',
			'current_url'=>ci_site_url(),
			'reason'=>'24',
			'pkg_id'=>$pkg_id,
			'pkg_amount'=>$pkg_amount
			));
		}
		$query_objs=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$user_id)->get()->row();
		$new_balance=$query_objs->amount+$sign_up_bonus;
		$this->db->update('final_e_wallet',array('amount'=>$new_balance),array('user_id'=>$user_id));
		$this->db->insert('credit_debit',array(
		'transaction_no'=>generateUniqueTranNo(),
		'user_id'=>$user_id,
		'credit_amt'=>$sign_up_bonus,
		'debit_amt'=>'0',
		'balance'=>$new_balance,
		'admin_charge'=>'0',
		'receiver_id'=>$user_id,
		'sender_id'=>COMP_USER_ID,
		'receive_date'=>date('d-m-Y'),
		'ttype'=>'10% Sign Up Bonus',
		'TranDescription'=>'10% Sign Up Bonus',
		'Cause'=>'10% Sign Up Bonus',
		'Remark'=>'10% Sign Up Bonus',
		'invoice_no'=>'',
		'product_name'=>'',
		'status'=>'1',
		'ewallet_used_by'=>'',
		'current_url'=>ci_site_url(),
		'reason'=>'24',
		'pkg_id'=>$pkg_id,
		'pkg_amount'=>$pkg_amount
		));
   }
}//end class
