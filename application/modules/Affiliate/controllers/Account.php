<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/account
*/
class Account extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		affiliate_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->helper("commission_helper");
		$this->load->model("account_model");
	} 
	/* end method */
	public function activeAccount()
	{
		$user_id=$this->session->userdata('user_id');
		if(!empty($this->input->post('btn')))
		{
			$transaction_password=$this->input->post('transaction_password');
			$this->load->library("form_validation");
			$userinfo=$this->account_model->getUserDetails($user_id);
			$sponser_id=$userinfo->ref_id;
			$pkg_id=$userinfo->pkg_id;
		       $pkg_amount=$userinfo->pkg_amount;
			$usercount=$this->db->select('t_code')->from('user_login')->where(array('user_id'=>$sponser_id,'t_code'=>$transaction_password))->get()->num_rows();
			if($usercount==0)
			{
			    $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:red">Sorry sponsor transaction password is wrong!</h5>');
		       redirect(ci_site_url()."Affiliate/Account/activeAccount");exit;
			}
			// check spsonor wallet balance
			$walletinfo=$this->db->select('*')->from('final_e_wallet')->where(array('user_id'=>$sponser_id,'wallet_type_id'=>1))->get()->row();
			$balance=$walletinfo->amount;
			if($balance>=$pkg_amount)
			{
			    $balance=$balance-$pkg_amount;
            	
            	$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id,'wallet_type_id'=>1));
            	
            	
            	
            	//'1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
            	/*
            	Note:status field '0'=>debit,'1'=>credit
            	*/
            	$this->db->insert('credit_debit',array(
            	    'transaction_no'=>generateUniqueTranNo(),
            	    'user_id'=>$sponser_id,
            	    'credit_amt'=>'0',
            	    'debit_amt'=>$pkg_amount,
            	    'balance'=>$balance,
            	    'admin_charge'=>'0',
            	    'receiver_id'=>$user_id,
            	    'sender_id'=>$sponser_id,
            	    'receive_date'=>date('Y-m-d'),
            	    'ttype'=>'Package Purchased',
            	    'TranDescription'=>'Package Purchase by '.$user_id,
            	    'Cause'=>'Package Purchase by '.$user_id,
            	    'Remark'=>'Package Purchase by '.$user_id,
            	    'invoice_no'=>'',
            	    'product_name'=>'main',
            	    'deposit_id'=>1,
            	    'status'=>'0',
            	    'pkg_id'=>$pkg_id,
            	    'pkg_amount'=>$pkg_amount,
            	    'ewallet_used_by'=>'Withdrawal Wallet',
            	    'current_url'=>ci_site_url(),
            	    'reason'=>'1'
                    ));
			}
			else
			{
			    $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:red">Sorry sponsor do not have sufficience balance in wallet!</h5>');
		       redirect(ci_site_url()."Affiliate/Account/activeAccount");exit;
			}
			/*$this->form_validation->set_rules('transaction_password', 'Transaction Password','callback_check_transaction_password');
			
			if(!$this->form_validation->run()==FALSE)
			{*/
		       $this->db->update('user_registration',array('active_status'=>'1'),array('user_id'=>$user_id));
		       $this->db->update('user_login',array('active_status'=>'1'),array('user_id'=>$user_id));
		       
		       
		       $this->db->insert('user_package_log',array(
                	'user_id'=>$user_id,
                	'new_package_id'=>$pkg_id,
                	'active_status'=>'1',
                	'purchased_date'=>date('Y-m-d H:i:s')
                	));
            
            	$this->db->insert('package_sold_amount',array(
            	'user_id'=>$user_id,
            	'pkg_id'=>$pkg_id,
            	'pkg_amount'=>$pkg_amount
            	));
		       matrix_commission_direct($user_id,'direct_matrix_downline',$pkg_id,$pkg_amount);
		       $l=1;
		       $packageinfo=$this->db->select('*')->from('package')->where(array('id'=>$pkg_id))->get()->row();
		       $pv=$packageinfo->pv;
		       $from_level=$packageinfo->from_level;
		       $to_level=$packageinfo->to_level;
		       
		       
                while($sponser_id!='cmp')
            	{
                    if($sponser_id!='cmp')
                    {
                    	$direct_downline_data[]=array(
                    		'down_id'=>$user_id,
                    		'income_id'=>$sponser_id,
                    		'l_date'=>date('Y-m-d H:i:s'),
                    		'status'=>'0',
                    		'level'=>$l,
                    		'pv'=>$pkg_id
                    		);
                    	if($to_level>=$l)
                    	{
                    	    break;
                    	}
            			$l++;
            			
                         $nom_info=$this->db->select('ref_id')->from('user_registration')->where('user_id',$sponser_id)->get()->row();
                         $sponser_id=$nom_info->ref_id;
            			}
            	}
            	$this->db->insert_batch('matrix_downline_pv',$direct_downline_data);
		       $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Account activated successfully!</h5>');
		       redirect(ci_site_url()."Affiliate/Account/activeAccount");exit;
			/*}*/
		}
        $data['title']="Activate Account";
        $data['user']=$this->account_model->getUserDetails($user_id);
        $data['breadcrumb']='<li class="active">Activate Account</li>';
        $data['action_url']="activeAccount";
        $data['action']="edit";
		_userLayout("account-mgmt/active-account",$data);
	}
	public function check_old_password($old_password)
	{
		$user_id=$this->session->userdata('user_id');
		$user=$this->db->select('password')->from('user_registration')->where('user_id',$user_id)->get()->row();
		//$user->password;
		if($old_password!=$user->password)
		{
         $this->form_validation->set_message('check_old_password', 'Sorry old password is wrong!');
         return false;
		}
		return true;
	}
	public function changePassword()
	{
		$user_id=$this->session->userdata('user_id');
		if(!empty($this->input->post('btn')))
		{
			$old_password=$this->input->post('old_password');
			$new_password=$this->input->post('new_password');
			$confirm_password=$this->input->post('confirm_password');
			$this->load->library("form_validation");
			$usercount=$this->db->select('password')->from('user_registration')->where(array('user_id'=>$user_id,'password'=>$old_password))->get()->num_rows();
			if($usercount==0)
			{
			    $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:red">Sorry old password is wrong!</h5>');
		       redirect(ci_site_url()."Affiliate/Account/changePassword");exit;
			}
			//$this->form_validation->set_rules('old_password', 'Old Password','callback_check_old_password');
			$this->form_validation->set_rules('new_password', 'New Password','required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password','required');
			if(!$this->form_validation->run()==FALSE)
			{
		       $this->db->update('user_registration',array('password'=>$new_password),array('user_id'=>$user_id));
		       $this->db->update('user_login',array('password'=>$new_password),array('user_id'=>$user_id));
		       $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Password is updated successfully!</h5>');
		       redirect(ci_site_url()."Affiliate/Account/changePassword");exit;
			}
		}
        $data['title']="Change Password";
        $data['user']=$this->account_model->getUserDetails($user_id);
        $data['breadcrumb']='<li class="active">Change Password</li>';
        $data['action_url']="changePassword";
        $data['action']="edit";
		_userLayout("account-mgmt/change-password",$data);
	}
	//////////////////////
	public function check_transaction_password($old_password)
	{
		$user=$this->db->select('t_code')->from('user_registration')->where('user_id',$this->user_id)->get()->row();
		//$user->password;
		if($old_password!=$user->t_code)
		{
         $this->form_validation->set_message('check_transaction_password', 'Sorry transaction password is wrong!');
         return false;
		}
		return true;
	}
	public function check_old_transaction_password($old_password)
	{
		$user=$this->db->select('t_code')->from('user_registration')->where('user_id',$this->user_id)->get()->row();
		//$user->password;
		if($old_password!=$user->t_code)
		{
         $this->form_validation->set_message('check_old_transaction_password', 'Sorry old transaction password is wrong!');
         return false;
		}
		return true;
	}

	public function changeTranscationPassword()
	{
		if(!empty($this->input->post('btn')))
		{
			$old_password=$this->input->post('old_password');
			$new_password=$this->input->post('new_password');
			$confirm_password=$this->input->post('confirm_password');
			$this->load->library("form_validation");
			
			$this->form_validation->set_rules('old_password', 'Old Password','callback_check_old_transaction_password');
			$this->form_validation->set_rules('new_password', 'New Password','required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password','required');
			if(!$this->form_validation->run()==FALSE)
			{
		       $this->db->update('user_registration',array('t_code'=>$new_password),array('user_id'=>$this->user_id));
		       $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Transaction Password is updated successfully!</h5>');
		       redirect(ci_site_url()."user/account/changeTranscationPassword");
			}
		}
        $data['title']="Change Transaction Password";
        $data['user']=$this->account_model->getUserDetails($this->user_id);
        $data['breadcrumb']='<li class="active">Change Transaction Password</li>';
        $data['action_url']="changeTranscationPassword";
        $data['action']="edit";
		_userLayout("account-mgmt/change-transaction-password",$data);
	}
	//////////////////////
	public function viewProfile()
	{
        $data['title']="View/Update Profile";
        $data['breadcrumb']='<li class="active">View OR Update Profile</li>';
        $data['action_url']="profileManagement";
        $data['action']="edit";
        $data['all_bank']=$this->db->query("select * from bank_accounts")->result();
        $data['user_details']=$user_details=$this->account_model->getUserDetails($this->user_id);
        //pr($user_details);
        $billing=json_decode($user_details->ref_leg_position);
        foreach($billing as $key=>$val)
        {
            $data[$key]=$val;
        }
        $billing=json_decode($user_details->nom_leg_position);
        foreach($billing as $key=>$val)
        {
            $data[$key]=$val;
        }
	   _userLayout("account-mgmt/view-profile",$data);
	}
	public function updatePersonalInformation()
	{
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $address_line1=$this->input->post('address_line1');
        $address_line2=$this->input->post('address_line2');
        $city=$this->input->post('city');
        $state=$this->input->post('state');
        $zip_code=$this->input->post('zip_code');
        $email=$this->input->post('email');
        $country=$this->input->post('country');
        $contact_no=$this->input->post('contact_no');
        $idno=$this->input->post('idno');
        $aadharno=$this->input->post('aadharno');
	    //$image_upload_path='/images/';
	    //$profile_pic=adImageUpload($_FILES['profile_pic'],1, $image_upload_path);
	    //$profile_pic=(!empty($profile_pic))?$profile_pic:$this->input->post('profile_pic_old');
	    ///////////
        $this->db->update('user_registration',array(
        	'first_name'=>$first_name,
        	'last_name'=>$last_name,
        	'address_line1'=>$address_line1,
        	/*'address_line2'=>$address_line2,*/
        	'city'=>$city,
        	/*'state'=>$state,*/
        	'zip_code'=>$zip_code,
        	'email'=>$email,
        	/*'country'=>$country,*/
        	'contact_no'=>$contact_no,
        	'idno'=>$idno,
        	'aadharno'=>$aadharno
        	/*'image'=>$profile_pic*/
        	),array('user_id'=>$this->user_id));
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Profile is updated successfully!</h5>');
        /////////////
        redirect(ci_site_url().'Affiliate/Account/viewProfile');
	}
	public function updateBillingInformation()
	{
		///////////////////
		$this->db->update('user_registration',array(
			'ref_leg_position'=>json_encode($_POST)
			),array('user_id'=>$this->user_id));

		///////////////////
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Billing information is updated successfully!</h5>');
        redirect(ci_site_url().'Affiliate/Account/viewProfile');
	}
	public function updateShippingInformation()
	{
		///////////////////
		$this->db->update('user_registration',array(
			'nom_leg_position'=>json_encode($_POST)
			),array('user_id'=>$this->user_id));

		///////////////////
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Shipping information is updated successfully!</h5>');
        redirect(ci_site_url().'Affiliate/Account/viewProfile');
	}
	public function updateBankInformation()
	{
		$bank_name=$this->input->post('bank_name');
		$branch_name=$this->input->post('branch_name');
		$bankinfo=$this->db->select('*')->from('bank_accounts')->where('id',$bank_name)->get()->row();
     	$bank_name=$bankinfo->name;
     	$branch_name=$bankinfo->iban;
		$account_holder_name=$this->input->post('account_holder_name');
		$account_no=$this->input->post('account_no');
		///////////////////
		$this->db->update('user_registration',array(
			'bank_name'=>$bank_name,
			'branch_name'=>$branch_name,
			'account_holder_name'=>$account_holder_name,
			'account_no'=>$account_no
			),array('user_id'=>$this->user_id));

		///////////////////
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Bank information is updated successfully!</h5>');
        redirect(ci_site_url().'Affiliate/Account/viewProfile');
	}
	public function updateSocialMediaInformation()
	{
		$facebook_link=$this->input->post('facebook_link');
		$twitter_link=$this->input->post('twitter_link');
		$linkedin_link=$this->input->post('linkedin_link');
		$google_plus_link=$this->input->post('google_plus_link');
		/////////////////////////////
		$this->db->update('user_registration',array(
			'facebook_link'=>$facebook_link,
			'twitter_link'=>$twitter_link,
			'linkedin_link'=>$linkedin_link,
			'google_plus_link'=>$google_plus_link
			),array('user_id'=>$this->user_id));
		/////////////////////////////
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Social media information is updated successfully!</h5>');
        redirect(ci_site_url().'Affiliate/Account/viewProfile');
	}
}//end class
