<?php
ob_start();
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
		affiliate_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		//$this->load->helper('user_package_helper');
		$this->load->model('package_model');
		$this->load->model("account_model");
		$this->load->helper('registration_helper');
		$this->load->helper('commission_helper');
	} 
	/*
	@Desc:It's shows the current user activated package
	*/
	public function callPlisio($new_pkg_id)
	{
	    /*$registration_info=$this->session->userdata('registration_info');
	    $pkg_amount=$registration_info['sponsor_and_account_info']['pkg_amount'];*/
	    $user_id=$this->session->userdata('user_id');
	    $userinfo=$this->account_model->getUserDetails($user_id);
		$sponser_id=$userinfo->ref_id;
		$pkg_id=$userinfo->pkg_id;
		$pkg_amount=$userinfo->pkg_amount;
		
	    require_once(APPPATH . '/PlisioClient.php');
	    $secretKey = 'ePcR4oeZU3BIeOdrxx7Em0mmYdIcUT2Etj6VaMiNPzz0srsccoWQIaDeHNX7XV4p';
	    $this->plisio = new PlisioClient($secretKey);
	    $order_number=generatePlisioTranNo();
	    $order_amount=$pkg_amount;
	    
        $invoiceData = array (
        'order_number' => $order_number, //Order number should be uniq for each order.
        'order_name' => 'Upgrade Account',
        'source_amount' => number_format($order_amount, 8, '.', ''), //Order amount in source currency.
        'source_currency' => 'USD', //For example: 'USD'.
        'cancel_url' => base_url().'fail' , //Url to which Plisio will redirect customer in a case of a cancelled order.
        'callback_url' => base_url().'checkstatus', //Url to which Plisio will send order related info about status changes.
        'success_url' => base_url().'success', //Url to which Plisio will redirect customer in a case of successful order.
        'email' => $userinfo->email, //Customer email. If not specified - customer will be prompted to enter email on Plisio side.
        'plugin' => 'Picnic', //Specify uniq name related to your shop, so it'll be easier to track issues with your invoices if any occurs.
        'version' => '1' //Specify plugin version.
        );
        $registration_info['invoiceData']=$invoiceData;
        $registration_info['username']=$userinfo->username;
        $registration_info['user_id']=$userinfo->user_id;
        $registration_info['pkg_id']=$userinfo->pkg_id;
        $registration_info['new_pkg_id']=$new_pkg_id;
        $registration_info['email']=$userinfo->email;
        $registration_info['ordernumber']=$order_number;
    $this->db->insert('plisio_payment',array(
                        'ordernumber'=>$order_number,
    					'request'=>json_encode($registration_info),
    					'username'=>$userinfo->username,
    					'user_id'=>$userinfo->user_id,
    					'email'=>$userinfo->email,
    					'amount'=>$order_amount,
    					'request_date'=>date('Y-m-d'),
    					'status'=>'started'
    					));
        $response = $this->plisio->createTransaction($invoiceData);
        //pr($response);
        if ($response && $response['status'] !== 'error' && !empty($response['data'])) {
        $invoiceUrl = $response['data']['invoice_url'];
        redirect($invoiceUrl);
    
        exit();
        } else {
            error_log('Error occurred while processing the payment:  ' . implode(',', json_decode($response['data']['message'], true))); //Log error message from Plisio. You can add error message for a customer to specify the reason of order creation failed (Min sum limit for a cryptocurrency for example).
            redirect(base_url()."Package/upgradePackage/"); //Redirect to invoice creation page.
            exit();
        }
	}
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
        $data['old_package']=$old_package_details;
        $data['packages']=$this->package_model->getAllExcludedActivePackage($this->user_id,floatval($old_package_details->amount));
        
        //matrix_commission_direct_difference($this->user_id,'direct_matrix_downline',$user_details->pkg_id,$user_details->pkg_amount,6,$user_details->pkg_amount);
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
		$data['pkg_id']=$pkg_id;
		/////////
		$this->session->set_userdata('upgrade_package',$pkg_id);
		$data['all_products']=$this->db->query("select * from eshop_products where featured='1'")->result();
		$state=$user_details->state;
		 /*$data['all_stockist']=$this->db->query("select * from user_stockist as s inner join 
user_registration as u on s.user_id=u.user_id where u.member_type='2';")->result(); */// and s.state='".$state."'
		_userLayout("package-mgmt/select-payment-method",$data);
	}//end method
	public function ewalletPayment()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
		    
			$package_id=$this->session->userdata('upgrade_package');
			$pkg_details=$this->package_model->getPackageDetails($package_id);
			//pr($pkg_details); exit;
			$user_details=get_user_details($this->user_id);
            $sponsor_id=$user_details->ref_id;
            $nom_id=$user_details->nom_id;
            $rank_id=$user_details->rank_id;
			$tran_password=$this->input->post('tran_password');
			$this->load->library('form_validation');
			
			//$this->form_validation->set_rules('tran_password','Transaction Password','callback_check_valid_tran_password');
			
			//$this->package_model->upgradePackage($this->user_id,$package_id);
			
			$username=$this->user_id;
    		if(empty($tran_password))
    		{
    		    $this->session->set_flashdata('error_msg','Please enter Transaction Password!');
    		    redirect(base_url().'Affiliate/Package/ewalletPayment');exit;
    		}
    		else 
    		{
    			$query=$this->db->query("SELECT * FROM (`user_login`) WHERE `user_id` = '$username' AND `t_code` = '$tran_password'");
    			if($query->num_rows()<1)
    			{
    			    $this->session->set_flashdata('error_msg','Please enter valid Transaction Password!');
    		        redirect(base_url().'Affiliate/Package/ewalletPayment');exit;
    			}
    			else 
    			{
    				//$pkg_id=$this->session->userdata('upgrade_package');
    				
    				//$pkg_details=$this->package_model->getPackageDetails($pkg_id);
    				
    				$pkg_amount=$pkg_details->amount;
    				$user_details=get_user_details($this->user_id);
    				
    				$current_pkg_details=$this->package_model->getPackageDetails($user_details->pkg_id);
    				$diff_amount=$pkg_details->amount-$current_pkg_details->amount;
    				//////////////
    				
    				$result=$this->db->select('amount')->from('final_product_wallet')->where('user_id',$this->user_id)->get()->row();
    				
    				
    				$ewalletAmount=$result->amount;
    				
    				
    				if($ewalletAmount<$diff_amount)
    				{
    					$this->session->set_flashdata('error_msg','Sorry your wallet amount is less than to selected package amount!');
    		            redirect(base_url().'Affiliate/Package/ewalletPayment');exit;
    				}
    			}
    		}
		
			
				$query_obj=$this->db->select('amount')->from('final_product_wallet')->where('user_id',$this->user_id)->get()->row();
	
				$current_pkg_details=$this->package_model->getPackageDetails($user_details->pkg_id);
					
			    $diff_amount=$pkg_details->amount-$current_pkg_details->amount;
			    $diff_pv=$pkg_details->pv-$current_pkg_details->pv;
				
				$balance=$query_obj->amount-$diff_amount;
	
				$pkg_amount=$diff_amount;
				
				if($diff_amount>0 && !empty($this->session->userdata('cart')))
				{
				
    				$this->db->update('final_product_wallet',array('amount'=>$balance),array('user_id'=>$this->user_id));
    				$transaction_no=generateUniqueTranNo();
    	
    				$this->db->insert('credit_debit_product',array(
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
    				'pkg_id'=>$pkg_details->id,
    				'pkg_amount'=>$diff_amount,
    				'ewallet_used_by'=>'Withdrawal Wallet',
    				'current_url'=>ci_site_url(),
    				'reason'=>'26'
    				));
				    ///////////
				    //$this->creditCommission($package_id,$pkg_amount);
				    //$this->creditKnowLedgePoints($package_id,$this->user_id);
				    //$this->signupBonus($package_id,$pkg_amount);
				    //creditUnilevelCommission($package_id,$this->user_id,$pkg_amount,$pkg_details->title);
				    /////////
				
				    $this->package_model->upgradePackage($this->user_id,$package_id,'1','Ewallet-Payment',$transaction_no);
				    $l=1;
    				/*while($sponsor_id!='cmp')
                	{
                        if($sponsor_id!='cmp')
                        {
                        	$direct_downline_data[]=array(
                        		'down_id'=>$this->user_id,
                        		'income_id'=>$sponsor_id,
                        		'l_date'=>date('Y-m-d H:i:s'),
                        		'status'=>'0',
                        		'level'=>$l,
                        		'pv'=>$diff_pv
                        		);
                        	
                			$l++;
                			
                             $nom_info=$this->db->select('ref_id')->from('user_registration')->where('user_id',$sponsor_id)->get()->row();
                             $sponsor_id=$nom_info->ref_id;
                			}
                	}
                	
                	$nom_id;*/
                	$spninfo=$this->db->select('idno')->from('user_registration')->where(array('user_id'=>$this->user_id))->get()->row();
                	if($spninfo->idno=='Free')
                	{
                	    $this->db->insert('userfreelog',array('ref_id'=>$this->user_id,'user_id'=>$this->user_id,'type'=>'upgrade'));
                	}
                	else
                	{
                    	$binaryinfo=$this->db->select('*')->from('level_income_binary')->where('down_id',$this->user_id)->get()->result();
                    	$direct_downline_data=array();
                    	foreach($binaryinfo as $key=>$val)
                    	{
                    	    $direct_downline_data[]=array(
                            		'down_id'=>$this->user_id,
                            		'income_id'=>$val->income_id,
                            		'l_date'=>date('Y-m-d H:i:s'),
                            		'status'=>'0',
                            		'level'=>$val->level,
                            		'leg'=>$val->leg,
                            		'pv'=>$diff_pv,
                            		'type'=>'upgrade'
                            		);
                    	}
                    	if(count($direct_downline_data)>0)
                    	{
                    	    $this->db->insert_batch('matrix_downline_pv',$direct_downline_data);
                    	}
        				//echo $this->user_id.'==direct_matrix_downline=='.$pkg_details->id."==".$pkg_details->amount."==".$user_details->pkg_id."==".$user_details->pkg_amount; exit;
        				matrix_commission_direct_difference($this->user_id,'direct_matrix_downline',$pkg_details->id,$pkg_details->amount,$user_details->pkg_id,$user_details->pkg_amount);
                	
    				// check user rank and update according to it
    				//updateRankUsers($this->user_id);
    				//$this->updateRank();
    				$rankinfo=$this->db->select('*')->from('rank_bonus')->where(array('user_id'=>$this->user_id,'status'=>0))->get()->row();
    				$id=$rankinfo->id;
    				$rank_id=$rankinfo->nextrank_id;
    				$bonus_amount=$rankinfo->bonus;
    				$rankinfo->bonus_date;
    				$rankinfo=$this->db->select('*')->from('rank')->where(array('id'=>$rank_id))->get()->row();
    				$rank_name=$rankinfo->rank_name;
				
					$query_obj=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->user_id)->get()->row();
        							$balance=$query_obj->amount+$bonus_amount;
        							$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$this->user_id));
        							$this->db->insert('credit_debit',array(
        							'transaction_no'=>generateUniqueTranNo(),
        							'user_id'=>$this->user_id,
        							'credit_amt'=>$bonus_amount,
        							'debit_amt'=>'0',
        							'balance'=>$balance,
        							'receiver_id'=>$this->user_id,
        							'sender_id'=>$this->user_id,
        							'receive_date'=>date('Y-m-d'),
        							'ttype'=>'Rank Bonus',
        							'TranDescription'=>'Rank Bonus from rank '.$rank_name,
        							'Cause'=>'Rank Bonus from rank '.$rank_name,
        							'Remark'=>'Rank Bonus from rank '.$rank_name,
        							'invoice_no'=>'',
        							'product_name'=>'main',
        							'deposit_id'=>'1',
        							'status'=>'1',
        							'rank_id'=>$rank_id,
                        			'rank_name'=>$rank_name,
        							'ewallet_used_by'=>'Withdrawal Wallet',
        							'current_url'=>site_url(),
        							'reason'=>'13', //credit for matrix commission
        							));
        							$this->db->update('rank_bonus',array('status'=>'1'),array('id'=>$id));
        							$this->db->insert('rank_log',array(
            								'user_id'=>$this->user_id,
            								'rank_id'=>$rank_id,
            								'rank_name'=>$rank_name,
            								'updated_date'=>date('Y-m-d H:i:s')
            								));
                        			$this->db->update('user_registration',array(
                        								'rank_id'=>$rank_id,
                        								'rank_name'=>$rank_name
                        								),array('user_id'=>$this->user_id));
                	}
				$this->session->unset_userdata('upgrade_package');
				
				// create order 
				$user_id=$this->user_id;
				$stockist_id=$this->session->userdata('stockist_id');
				
				$cart_reg=$this->session->userdata('cart');
				
				//pr($cart_reg); exit;
				$total_products=$this->session->userdata('total_products');
				//$cart_reg=$stockist_id=(!empty($registration_info['sponsor_and_account_info']['cart_reg']))?$registration_info['sponsor_and_account_info']['cart_reg']:1;//(!empty($registration_info->cart_reg))?$registration_info->cart_reg:null;
	            $cart_reg_final_price=0;
	            //$total_products=$stockist_id=(!empty($registration_info['sponsor_and_account_info']['total_products']))?$registration_info['sponsor_and_account_info']['total_products']:1;//(!empty($registration_info->total_products))?$registration_info->total_products:null;
	            if(!empty($cart_reg) && !empty($total_products))
				{
				//$cart_reg1=json_decode($cart_reg);
				$cart=(object)$cart_reg;
				$order_id=generateUniqueOrderId();
				//	pr($cart); exit;
				$bonus_date=date('Y-m-d');
				$total_pv=0;
				foreach($cart as $product)
				{
					$product=(object)$product;
					$product_stock_info=$this->db->select(array('qty','total_order','guest_point','new_price'))->from('eshop_products')->where('id',$product->product_id)->get()->row();
					$final_stock=$product_stock_info->qty-$product->qty;
					$total_order=$product_stock_info->total_order+1;
					$guest_point=$product_stock_info->guest_point;
					$new_price=$product_stock_info->new_price;
					$cart_reg_final_price=$cart_reg_final_price+($product_stock_info->new_price*$product->qty);
				    $this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));
				
					$product_id=$product->product_id;
					//$cart_final_price=$cart_reg_final_price;
					$pv=$guest_point*$product->qty;
					$total_pv=$total_pv+$pv;
				}
				//exit;
				
				
				$cart_final_price=$cart_reg_final_price;
				//$cart_final_bv=$this->session->userdata('cart_final_bv');
				$this->db->insert('eshop_orders',array(
				'order_id'=>$order_id,
				'role'=>(string)$role,
				'user_id'=>$user_id,
				'owner_user_id'=>$stockist_id,
				'order_from'=>'upgrade',
				/*'guest_id'=>$guest_id,*/
				'order_details'=>json_encode($cart_reg),
				'total_products'=>$total_products,
				'discount'=>0,
				'final_price'=>$cart_reg_final_price,
				'final_pv'=>$total_pv,
				'payment_method'=>'2'
				));
				
				
				/////////////////////
				$nom_info=$this->db->select('*')->from('user_registration')->where(array('user_id'=>$user_id))->get()->row();
				$this->db->insert('eshop_guest_delivery_address',array(
					'role'=>2,
					'guest_id'=>$user_id,
					'name'=>$nom_info->first_name.' '.$nom_info->last_name,
					'mobile_no'=>$nom_info->contact_no,
					'address'=>$nom_info->address,
					'city'=>$nom_info->city,
					'order_id'=>$order_id,
					'state'=>$nom_info->state,
					'crate_date'=>date('Y-m-d'),
					'type'=>'0'
					));
				
				$this->session->unset_userdata('stockist_id');
				$this->session->unset_userdata('cart');
				$this->session->unset_userdata('total_products');
				$this->session->unset_userdata('cart_final_price');
			}
				// end create order
				$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Package is activated successfully!</h5>');;	
				redirect(ci_site_url()."Affiliate/Package/myActivePackage");
				exit;
		    }
		    else
		    {
		       $this->session->set_flashdata("error_msg",'<h5 class="panel-title" style="color:red">Opps! Server Error.</h5>');;	
				redirect(ci_site_url()."Affiliate/Package/myActivePackage");
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
				/*if($user_details->pkg_id!='22')
				{
					$current_pkg_details=$this->package_model->getPackageDetails($user_details->pkg_id);
				    $diff_amount=$pkg_details->amount-$current_pkg_details->amount;
				}
				else 
				{
					$diff_amount=$pkg_details->amount;
				}*/
				$current_pkg_details=$this->package_model->getPackageDetails($user_details->pkg_id);
				$diff_amount=$pkg_details->amount-$current_pkg_details->amount;
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
