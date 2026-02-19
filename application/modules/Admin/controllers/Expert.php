<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/member
*/
class Expert extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model('expert_model');
		$this->load->model('account_model');
		$this->load->library('pagination'); 
		$this->perPage = 100;
	}//end constructor 
	
	/**
	 * Admin impersonation: login as an expert and redirect to their dashboard.
	 * Stores current admin session to allow returning back.
	 */
	public function loginAs($user_id)
	{
		admin_auth();
		$user_id = ID_decode($user_id);
		// print_r($user_id);exit;
		$user = $this->db->select('user_id, username, password, active_status')
			->from('user_login')
			->where('user_id', $user_id)
			->get()
			->row();
		// print_r($user);exit;
		if (empty($user) || empty($user->user_id)) {
			$this->session->set_flashdata('error_msg', 'User not found');
			redirect(ci_site_url().'Admin/Expert/viewAllMember');
			return;
		}

		

		// Save admin session so we can restore it later
		if (!$this->session->userdata('impersonator')) {
			$this->session->set_userdata('impersonator', $this->session->userdata());
		}

		// Build a minimal user session similar to normal login
		$userdata = array(
			'username' => $user->username,
			'password' => $user->password,
			'userType' => $user->userType,
			'auth_affiliate' => TRUE,
			'SD_User_Name' => $user->username,
			'user_id' => $user->user_id,
			'userpanel_user_id' => $user->user_id,
			'impersonating' => TRUE,
		);

		$this->session->set_userdata($userdata);
		$this->db->update('user_registration', array('current_login_status' => '1'), array('user_id' => $user->user_id));

		// Redirect to user/expert dashboard (common front/user landing)
		redirect(site_url().'Web/dashboard');
	}

	/**
	 * Restore admin session after impersonation.
	 */
	public function stopImpersonation()
	{
		$impersonator = $this->session->userdata('impersonator');
		if (!empty($impersonator) && is_array($impersonator)) {
			// Clear current session and restore original
			$this->session->sess_destroy();
			$this->session->sess_create();
			$this->session->set_userdata($impersonator);
		}
		redirect(ci_site_url().'Admin/Expert/viewAllMember');
	}
	
	public function generateUniqueOrderId()
	{
	    $random_number="OR".mt_rand(100000, 999999);
	    if($this->db->select('order_id')->from('eshop_orders')->where('order_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueOrderId();
	    }
	    return $random_number;
	}
	public function generateBill($user_id)
	{
	    $user_id=ID_decode($user_id);
	    $res=$this->db->select('*')->from('user_products')->where(array('user_id'=>$user_id))->get()->result();
	    $total_product_qty=0;
	    $cart_final_price=0;
	    $s=0;
	    foreach($res as $key=>$val)
	    {
	        $s++;
	        $pinfo=$this->db->select('id as product_id,title as product_name,product_image,new_price as product_price ')->from('eshop_products')->where(array('id'=>$val->product_id))->get()->row();
	        $pinfo=(array)$pinfo;
	        $pinfo['qty']=$val->quantity;
	        $arr[$val->product_id]=$pinfo;
	        
	        // update stock
	        $product_stock_info=$this->db->select(array('qty','total_order','guest_point','new_price'))->from('eshop_products')->where('id',$val->product_id)->get()->row();
				$final_stock=$product_stock_info->qty-$val->quantity;
				$total_product_qty=$total_product_qty+$val->quantity;
				$total_order=$product_stock_info->total_order+1;
				$guest_point=$product_stock_info->guest_point;
				$new_price=$product_stock_info->new_price;
				$cart_final_price=$cart_final_price+($val->quantity*$product_stock_info->new_price);
			    $this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$val->product_id));
				$this->db->update('eshop_stock',array('qty'=>$final_stock),array('product_id'=>$val->product_id));
				
				$stock_info=$this->db->select('qty')->from('user_products')->where(array('user_id'=>$user_id,'product_id'=>$val->product_id))->get()->row();
				$stock_qty=$stock_info->qty+$val->quantity;
				$this->db->update('user_products',array('qty'=>$stock_qty),array('user_id'=>$user_id,'product_id'=>$val->product_id));
	    }
	    $order_details=json_encode($arr);
	    //echo $order_details;
	    $order_id=$this->generateUniqueOrderId();
	    $guest_id=null;
	    $this->db->insert('eshop_orders',array(
			'order_id'=>$order_id,
			'role'=>2,
			'user_id'=>$user_id,
			'guest_id'=>$guest_id,
			'order_from'=>'admin',
			'order_details'=>$order_details,
			'total_products'=>$s,
			'total_product_qty'=>$total_product_qty,
			'discount'=>0,
			'final_price'=>$cart_final_price,
			'payment_method'=>'2',
			'bill'=>1,
			'confirm_date'=>date('Y-m-d H:i:s'),
			'order_status'=>'1'
			));
			redirect(base_url().'Admin/Eshop_orders/allOrders');
	}
	public function assignProducts($user_id,$pid=false)
	{
	    $user_id=ID_decode($user_id);
	    if(!empty($this->input->post('search')))
	    {
	        //pr($_POST); exit;
	        unset($_POST['search']);
	        $count=$this->db->select('*')->from('user_products')->where(array('user_id'=>$user_id,'product_id'=>$_POST['product_id']))->get()->num_rows();
	        
	        //echo $count;exit;
	        if($count)
	        {
	            $info=$this->db->select('*')->from('user_products')->where(array('user_id'=>$user_id,'product_id'=>$_POST['product_id']))->get()->row();
	            $quantity=$_POST['quantity'];
	            $this->db->update('user_products',array('user_id'=>$user_id,'product_id'=>$_POST['product_id'],'quantity'=>$quantity),array('user_id'=>$user_id,'product_id'=>$_POST['product_id']));
	        }
	        else
	        {
	            $this->db->insert('user_products',$_POST);
	        }
	        redirect(base_url().'Admin/Member/assignProducts/'.ID_encode($user_id)); exit;
	    }
	    
	    //echo $user_id;
	    $assign_products=$this->db->select('user_products.*,eshop_products.title')->from('user_products')->join('eshop_products','user_products.product_id=eshop_products.id')->where('user_products.user_id',$user_id)->get()->result();
	    $data=array();
	    $data['assign_products']=$assign_products;
	    $data['username']=get_user_name($user_id);
	    $data['user_id']=$user_id;
	    $data['button']='Add Product';
	    if($pid)
	    {
	        $data['pid']=$pid;
	        $selp=$this->db->select('*')->from('user_products')->where(array('user_id'=>$user_id,'product_id'=>$pid))->get()->row();
	        $data['qty']=$selp->quantity;
	        $data['button']='Update Product';
	    }
	    $products=$this->db->select('*')->from('eshop_products')->get()->result();
	    //echo $this->db->last_query();exit;
	    $data['products']=$products;
	    _adminLayout("member-mgmt/assign-products",$data);
	}
	public function makeFree($id)
	{
	    $id=ID_decode($id);
	    $this->db->update('user_registration',array('idno'=>'Free'),array('user_id'=>$id));
	    $this->session->set_flashdata('success','User mark as free successfully');
	    redirect(base_url()."Admin/Member/viewAllMember");
	}
	
	public function unmarkFree($id)
	{
	    $id=ID_decode($id);
	    $this->db->update('user_registration',array('idno'=>null),array('user_id'=>$id));
	    $this->session->set_flashdata('success','User mark as paid successfully');
	    redirect(base_url()."Admin/Member/viewAllMember");
	}
	public function makeStockist($id)
	{
	    $id=ID_decode($id);
	    $data['stockist_id']=$id;
	    $data['user_details']=$this->account_model->getStockistDetails($id);
		$data['user_id']=$id;
	    _adminLayout("member-mgmt/make-stockist",$data);
	    /*$this->db->update('user_registration',array('member_type'=>'2'),array('user_id'=>$id));
	    $this->session->set_flashdata('success','Stockist created successfully');
	    redirect(base_url()."Admin/Member/viewAllMember");*/
	}
	public function makeNStockist($id)
	{
	    $id=ID_decode($id);
	    $data['stockist_id']=$id;
	    $data['user_details']=$this->account_model->getStockistDetails($id);
		$data['user_id']=$id;
	    _adminLayout("member-mgmt/make-nstockist",$data);
	    /*$this->db->update('user_registration',array('member_type'=>'2'),array('user_id'=>$id));
	    $this->session->set_flashdata('success','Stockist created successfully');
	    redirect(base_url()."Admin/Member/viewAllMember");*/
	}
	public function removeStockist($id)
	{
	    $id=ID_decode($id);
	    $this->db->update('user_registration',array('member_type'=>'1'),array('user_id'=>$id));
	    $this->session->set_flashdata('success','Stockist removed successfully');
	    redirect(base_url()."Admin/Member/viewAllMember");
	}
	public function commissionList()
	{
	    $data['allcommission']=$all_members=$this->expert_model->getDirectCommission();
	    _adminLayout("member-mgmt/commission-list",$data);
	}
	public function viewAllMember($type=false)
	{
	    //echo "exit";exit;
		$data=array();
		$data = $conditions = array(); 
        $uriSegment = 4; 
         
        // Get record count 
        $conditions['returnType'] = 'count'; 
        if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
        //pr($conditions);
        //$totalRec = $this->post->getRows($conditions); 
        $totalRec=$all_members=$this->expert_model->getAllMembers($conditions);
        //echo $totalRec;exit;
        // Pagination configuration 
        $config['base_url']    = base_url().'Admin/Member/viewAllMember/'; 
        $config['uri_segment'] = $uriSegment; 
        $config['total_rows']  = $totalRec; 
        $config['per_page']    = $this->perPage; 
        
        
        // Initialize pagination library 
        $this->pagination->initialize($config); 
         
        // Define offset 
        $page = $this->uri->segment($uriSegment); 
        $offset = !$page?0:$page; 
         
        // Get records 
        $conditions = array( 
            'start' => $offset, 
            'limit' => $this->perPage 
        ); 
        if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
		//$data['type']=$type;
		$data['conditions']=$conditions;
		$data['all_members']=$all_members=$this->expert_model->getAllMembers($conditions);
		$data['country'] = $this->db
			->select('*')
			->from('countries')
			->get()
			->result();

		// pr($data['country']);
		// exit;

		//echo "<pre>";print_r($all_members);
		_adminLayout("expert-mgmt/all-member",$data);
	}
	
	public function viewPromoMember($type=false)
	{
	    //echo "exit";exit;
		$data=array();
		$data = $conditions = array(); 
        $uriSegment = 4; 
         
        // Get record count 
        $conditions['returnType'] = 'count'; 
        if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
        //pr($conditions);
        //$totalRec = $this->post->getRows($conditions); 
        $totalRec=$all_members=$this->expert_model->getPromoMembers($conditions);
        //echo $totalRec;exit;
        // Pagination configuration 
        $config['base_url']    = base_url().'Admin/Member/viewPromoMember/'; 
        $config['uri_segment'] = $uriSegment; 
        $config['total_rows']  = $totalRec; 
        $config['per_page']    = $this->perPage; 
        
        
        // Initialize pagination library 
        $this->pagination->initialize($config); 
         
        // Define offset 
        $page = $this->uri->segment($uriSegment); 
        $offset = !$page?0:$page; 
         
        // Get records 
        $conditions = array( 
            'start' => $offset, 
            'limit' => $this->perPage 
        ); 
        if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
		//$data['type']=$type;
		$data['conditions']=$conditions;
		$data['all_members']=$all_members=$this->expert_model->getPromoMembers($conditions);
		//echo "<pre>";print_r($all_members);
		_adminLayout("member-mgmt/promo-member",$data);
	}
	public function member_list_ajax($type=false)
	{
		$all_members=$this->expert_model->getAllMembers();
		echo json_encode($all_members);
	}
	public function activeMember($type=false)
	{
		$data=array();
		$data['title']='Active Members';
		$data['all_members']=$all_members=$this->expert_model->getAllActiveMembers();
		_adminLayout("member-mgmt/active-member",$data);
	}
	public function active_member_list_ajax($type=false)
	{
		$all_members=$this->expert_model->getAllActiveMembers();
		echo json_encode($all_members);
	}
	public function inactiveMember($type=false)
	{
		$data=array();
		$data['title']='Inactive Members';
		$data['all_members']=$all_members=$this->expert_model->getAllInActiveMembers();
		_adminLayout("member-mgmt/active-member",$data);
		//_adminLayout("member-mgmt/inactive-member",$data);
	}
	public function inactive_member_list_ajax($type=false)
	{
		$all_members=$this->expert_model->getAllInActiveMembers();
		echo json_encode($all_members);
	}
	public function blockUnblockMember()
	{
		$data=array();
		$data['title']='Block/Unblock Members';
		$data = $conditions = array(); 
        $uriSegment = 4; 
         
        // Get record count 
        $conditions['returnType'] = 'count'; 
        if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
		$totalRec=$all_members=$this->expert_model->getAllBlockUnBlockMembers($conditions);
		$config['base_url']    = base_url().'Admin/Member/viewAllMember/'; 
        $config['uri_segment'] = $uriSegment; 
        $config['total_rows']  = $totalRec; 
        $config['per_page']    = $this->perPage; 
        
        
        // Initialize pagination library 
        $this->pagination->initialize($config); 
         
        // Define offset 
        $page = $this->uri->segment($uriSegment); 
        $offset = !$page?0:$page; 
         
        // Get records 
        $conditions = array( 
            'start' => $offset, 
            'limit' => $this->perPage 
        ); 
        if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
		//$data['type']=$type;
		$data['conditions']=$conditions;
		$data['all_members']=$all_members=$this->expert_model->getAllBlockUnBlockMembers($conditions);
		_adminLayout("expert-mgmt/active-member",$data);
		//_adminLayout("member-mgmt/block-unblock-member",$data);
	}
	public function block_unblock_member_member_list_ajax()
	{
		$all_members=$this->expert_model->getAllBlockUnBlockMembers();
		echo json_encode($all_members);
	}
	public function passwordTracker()
	{
		$data=array();
		$data['title']='Block/Unblock Members';
		//$data['all_members']=$all_members=$this->expert_model->getAllMembersPassword();
		$data = $conditions = array(); 
        $uriSegment = 4; 
         
        // Get record count 
        $conditions['returnType'] = 'count'; 
        if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
        //$totalRec = $this->post->getRows($conditions); 
        $totalRec=$all_members=$this->expert_model->getAllMembersPassword($conditions);
         
        // Pagination configuration 
        $config['base_url']    = base_url().'Admin/Member/passwordTracker/'; 
        $config['uri_segment'] = $uriSegment; 
        $config['total_rows']  = $totalRec; 
        $config['per_page']    = $this->perPage; 
        
        
        // Initialize pagination library 
        $this->pagination->initialize($config); 
         
        // Define offset 
        $page = $this->uri->segment($uriSegment); 
        $offset = !$page?0:$page; 
         
        // Get records 
        $conditions = array( 
            'start' => $offset, 
            'limit' => $this->perPage 
        ); 
		//$data['type']=$type;
		if($this->input->post('search')=='search')
        {
            $conditions['user_id'] = $this->input->post('user_id');
            $conditions['username'] = $this->input->post('username');
        }
        $data['conditions']=$conditions;
		$data['all_members']=$all_members=$this->expert_model->getAllMembersPassword($conditions);
		
		_adminLayout("expert-mgmt/password-tracker",$data);
	}
	public function password_tracker_list_ajax()
	{
		$all_members=$this->expert_model->getAllMembersPassword();
		echo json_encode($all_members);
	}
	public function deleteMember($id)
	{
		$row_id=ID_decode($id);
		$this->db->delete('user_registration',array('id'=>$row_id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Member is deleted Successfully');
		redirect(ci_site_url() . "admin/member/viewAllMember");
        exit;
	}//end method

	public function editMember($user_id)
	{
		$user_id=ID_decode($user_id);
		$data['user_details']=$this->account_model->getUserDetails($user_id);
		$data['user_id']=$user_id;
		$data['country_list'] = $this->db
			->select('*')
			->from('countries')
			->get()
			->result();
		// pr($data['country']);exit;
		_adminLayout("expert-mgmt/edit-member",$data);
	}
	public function updateStockistInformation($user_id)
	{
        $user_id=ID_decode($user_id);
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
	    
	    $count=$this->db->select('id')->from('user_stockist')->where('user_id',$user_id)->get()->num_rows();
	    if($count>0)
	    {
	    ///////////
        $this->db->update('user_stockist',array(
        	'name'=>$first_name,
        	'address'=>$address_line1,
        	'city'=>$city,
        	'state'=>$state,
        	'email'=>$email,
        	'country'=>$country,
        	'contact_no'=>$contact_no
        	),array('user_id'=>$user_id));
	    }
	    else
	    {
	        $this->db->insert('user_stockist',array(
	        'user_id'=>$user_id,
        	'name'=>$first_name,
        	'address'=>$address_line1,
        	'city'=>$city,
        	'state'=>$state,
        	'email'=>$email,
        	'country'=>$country,
        	'contact_no'=>$contact_no
        	));
	    }
	    
	    $this->db->update('user_registration',array(
        	'member_type'=>'2'
        	),array('user_id'=>$user_id));
         $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Member Stockist information is updated successfully');
        /////////////
        redirect(ci_site_url().'Admin/Member/makeStockist/'.ID_encode($user_id));
	}
	public function updateNStockistInformation($user_id)
	{
        $user_id=ID_decode($user_id);
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
	    
	    $count=$this->db->select('id')->from('user_stockist')->where('user_id',$user_id)->get()->num_rows();
	    if($count>0)
	    {
	    ///////////
        $this->db->update('user_stockist',array(
        	'name'=>$first_name,
        	'address'=>$address_line1,
        	'city'=>$city,
        	'state'=>$state,
        	'email'=>$email,
        	'country'=>$country,
        	'contact_no'=>$contact_no
        	),array('user_id'=>$user_id));
	    }
	    else
	    {
	        $this->db->insert('user_stockist',array(
	        'user_id'=>$user_id,
        	'name'=>$first_name,
        	'address'=>$address_line1,
        	'city'=>$city,
        	'state'=>$state,
        	'email'=>$email,
        	'country'=>$country,
        	'contact_no'=>$contact_no
        	));
	    }
	    
	    $this->db->update('user_registration',array(
        	'member_type'=>'3'
        	),array('user_id'=>$user_id));
         $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Member Stockist information is updated successfully');
        /////////////
        redirect(ci_site_url().'Admin/Member/makeNStockist/'.ID_encode($user_id));
	}
	public function updatePersonalInformation($user_id)
	{
        $user_id=ID_decode($user_id);
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
	    $image_upload_path='/uploads/images/';
	    $profile_pic=adImageUpload($_FILES['profile_pic'],1, $image_upload_path);
	    $profile_pic=(!empty($profile_pic))?$profile_pic:$this->input->post('profile_pic_old');
	    ///////////
        $this->db->update('user_registration',array(
        	'first_name'=>$first_name,
        	'last_name'=>$last_name,
        	'address_line1'=>$address_line1,
        	'address_line2'=>$address_line2,
        	'city'=>$city,
        	'state'=>$state,
        	'zip_code'=>$zip_code,
        	'email'=>$email,
        	'country'=>$country,
        	'contact_no'=>$contact_no,
        	'image'=>$profile_pic
        	),array('user_id'=>$user_id));
         $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Member Personal information is updated successfully');
        /////////////
        redirect(ci_site_url().'Admin/Expert/editMember/'.ID_encode($user_id));
	}
	public function updateBankInformation($user_id)
	{
		$user_id=ID_decode($user_id);
		$bank_name=$this->input->post('bank_name');
		$branch_name=$this->input->post('branch_name');
		$account_holder_name=$this->input->post('account_holder_name');
		$account_no=$this->input->post('account_no');
		///////////////////
		$this->db->update('user_registration',array(
			'bank_name'=>$bank_name,
			'branch_name'=>$branch_name,
			'account_holder_name'=>$account_holder_name,
			'account_no'=>$account_no
			),array('user_id'=>$user_id));

		///////////////////
         $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Member Bank information is updated successfully');
        /////////////
        redirect(ci_site_url().'Admin/Member/editMember/'.ID_encode($user_id));
	}
	public function updateUserInformation($user_id)
	{
		$user_id=ID_decode($user_id);
		$username=$this->input->post('username');
		if($username!='')
		{
		    // check user
		    $count=$this->db->select('id')->from('user_login')->where('username',$username)->get()->num_rows();
		    if($count>0)
		    {
		        $this->session->set_flashdata("error_msg", '<span class="text-semibold">Opps!</span> Username should not blank.');
		    }
		    else
		    {
		        	$this->db->update('user_registration',array(
        			'username'=>$username
        			),array('user_id'=>$user_id));
        			$this->db->update('user_login',array(
        			'username'=>$username
        			),array('user_id'=>$user_id));
        		 $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span>username updated successfully');
		    }
		}
		else
		{
		     $this->session->set_flashdata("error_msg", '<span class="text-semibold">Opps!</span> Username should not blank.');
		}
		///////////////////
	
        /////////////
        redirect(ci_site_url().'Admin/Member/editMember/'.ID_encode($user_id));
	}

	public function updateSocialMediaInformation($user_id)
	{
		$user_id=ID_decode($user_id);
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
			),array('user_id'=>$user_id));
		/////////////////////////////
		///////////////////
         $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Member social media information is updated successfully');
        /////////////
        redirect(ci_site_url().'admin/member/editMember/'.ID_encode($user_id));
	}
	public function changeStatus($user_id)
	{
		$user_id=ID_decode($user_id);
		$status_info=$this->db->select('active_status')->from('user_registration')->where('user_id',$user_id)->get()->row();
		$status=($status_info->active_status=='1')?'0':'1';
		$this->db->update('user_registration',array('active_status'=>$status),array('user_id'=>$user_id));
		$this->db->update('user_login',array('active_status'=>$status),array('user_id'=>$user_id));
        $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Member status is changed successfully');
        /////////////
        redirect(ci_site_url().'Admin/Expert/blockUnblockMember/');
	}
	public function resetPassword($user_id=null)
	{
		if(!empty($_POST['btn']))
		{
			$password=$this->input->post('password');
			$user_id=$this->input->post('user_id');
			$this->db->update("user_registration",array('password'=>$password),array('user_id'=>$user_id));
			$this->db->update("user_login",array('password'=>$password),array('user_id'=>$user_id));
			$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Password is reset successfully!</h5>');
			redirect(ci_site_url().'Admin/Expert/passwordTracker/');
			exit;
		}
		$data=array();	
		$data['user_id']=ID_decode($user_id);
		$data['username']="Reset Password Of ".get_user_name($data['user_id']);
		_adminLayout("expert-mgmt/reset-password",$data);	
	}
	
	public function resetTPassword($user_id=null)
	{
		if(!empty($_POST['btn']))
		{
			$password=$this->input->post('password');
			$user_id=$this->input->post('user_id');
			$this->db->update("user_registration",array('t_code'=>$password),array('user_id'=>$user_id));
			$this->db->update("user_login",array('t_code'=>$password),array('user_id'=>$user_id));
			$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Password is reset successfully!</h5>');
			redirect(ci_site_url().'Admin/Expert/passwordTracker/');
			exit;
		}
		$data=array();	
		$data['user_id']=ID_decode($user_id);
		$data['username']="Reset Transaction Password Of ".get_user_name($data['user_id']);
		_adminLayout("expert-mgmt/reset-tpassword",$data);	
	}
	public function register($select_id=null)
	{
		
	    $this->load->helper("registration_helper");
		if(!empty($select_id))
		{
			if($this->front_model->isUserExist($select_id))
			{
			 $data['replicated_username']=$select_id;
			}
		}
	     if(!empty($this->input->post('login')))
	     {
	     	$stockist=$this->input->post("stockist");
	     	$product=$this->input->post("product");
	     	$ref_id=$this->input->post("sponsor_id");
	     	$username=$this->input->post("username");
	     	$pkg_id=(!empty($this->input->post("package")))?$this->input->post("package"):1;
			
			
	     	$email=$this->input->post("email");
	     	$password=$this->input->post("password");
	     	$t_code=$this->input->post("tpassword");
			
			
			$condition=$this->input->post("con_sponsor");
			
			$upline_id=$this->input->post("upline_id");
			
			if($condition==1)
			{
				$ref_id='123456';
			}
			else
			{
				$ref_id=$ref_id;
			}
			
		
		    $user_count=$this->db->select('*')->from('user_registration')->where(array('username'=>$username))->get()->num_rows();
			
			if($user_count==1)
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">Username already exist</span>');
				redirect(site_url()."Admin/Expert/viewAllMember");
				exit();
				
			}
			
			
			$chkpkgcond=$this->db->select('*')->from('user_registration')->where(array('username'=>$username))->get()->num_rows();
			
	     
	     	
	     	$account_type=(!empty($this->input->post("account_type")))?$this->input->post("account_type"):'1';
	     	/////personal informtaion
	     	$first_name=$this->input->post('first_name');
	     	$last_name=$this->input->post('last_name');
	     	$contact_no=$this->input->post('contact_no');
	     	$country=$this->input->post('country');
	     	$state=$this->input->post('state');
	     	$city=$this->input->post('city');
			$country_name = $this->input->post('bill_country');
			$state_name = $this->input->post('bill_state');
			$city_name = $this->input->post('bill_city');
	     	$address_line1=$this->input->post('address');
	     	$date_of_birth=$this->input->post('date_of_birth');
	     	/////Bank account informtaion
	     	$account_holder_name=(!empty($this->input->post('account_holder_name')))?$this->input->post('account_holder_name'):null;
	     	$account_no=(!empty($this->input->post('account_no')))?$this->input->post('account_no'):null;
	     	$bank_name=(!empty($this->input->post('bank_name')))?$this->input->post('bank_name'):null;
	     	$branch_name=(!empty($this->input->post('branch_name')))?$this->input->post('branch_name'):null;
	     	// get bank name from bank_id
	     	$bankinfo=$this->db->select('*')->from('bank_accounts')->where('id',$bank_name)->get()->row();
	     	$bank_name=$bankinfo->name;
	     	$branch_name=$bankinfo->iban;
	     	
	     	
			$bit_coin_id=(!empty($this->input->post('bit_coin_id')))?$this->input->post('bit_coin_id'):null;
			
			
	     	$registration_info=array();
	     	$registration_info['sponsor_and_account_info']=array(
	     		'ref_id'=>$ref_user_info->user_id,
	     		'ref_user_name'=>$ref_user_info->username,
	     		'upline_id'=>$upline_user_info->user_id,
	     		'upline_user_name'=>$upline_user_info->username,
	     		'username'=>$username,
	     		'email'=>$email,
	     		'pkg_id'=>$pkg_id,
	     		'pkg_amount'=>$pkg_amount,
	     		
	     		'ref_leg_position'=>$ref_leg_position,
	     		'password'=>$password,
	     		't_code'=>$t_code,
	     		'stockist_id'=>$stockist,
	     		
				'account_type'=>$account_type,
				'cart_reg'=>json_encode($this->session->userdata('cart_reg')),
				'cart_reg_final_price'=>json_encode($this->session->userdata('cart_reg_final_price')),
				'total_products'=>json_encode($this->session->userdata('total_products'))
	     		);
	     	
	     	$registration_info['personal_info']=array(
	     		'first_name'=>$first_name,
	     		'last_name'=>$last_name,
	     		'contact_no'=>$contact_no,
	     		'country'=>$country,
	     		'state'=>$state,
	     		'city'=>$city,
	     		'address_line1'=>$address_line1,
	     		'date_of_birth'=>$date_of_birth
	     		);
	     	
	     	$registration_info['bank_account_info']=array(
	     		'account_holder_name'=>$account_holder_name,
	     		'account_no'=>$account_no,
	     		'bank_name'=>$bank_name,
	     		'branch_name'=>$branch_name
	     		);
			$registration_info['bit_coin_info']=array(
	     		'bit_coin_id'=>$bit_coin_id,
	     		);
				
	     	$this->session->set_userdata('registration_info',$registration_info);
	     	//pr($registration_info);exit;
	     	//redirect(site_url()."payment-method"); exit;
	     	$user_id=freeUserRegistration();
	     	if($user_id)
	     	{
    	     	$userdata = array
    		              (
    					   'username'         => $username,
    					   'password'         => $password,
    					   'userType'         =>$account_type, 
    					   'auth_affiliate'    => TRUE,
    					   'SD_User_Name'     =>$username,
    					   'user_id'          =>$user_id,
    					   'userpanel_user_id'=>$user_id,
						   'country'		     => $country_name,
						   'state'		     => $state_name,
						   'city'		     => $city_name,
    			           );
    			           //print_r($userdata); exit;
    		  $this->db->update('user_registration',array('current_login_status'=>'1'),array('user_id'=>$user_id));            
    		  $this->session->set_userdata($userdata);
    		  $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done! </span>New Expert information is added successfully');
    		  redirect(site_url()."Admin/Expert/viewAllMember");exit;
	     	}
	     	redirect(site_url()."Admin/Expert/viewAllMember");exit;
	      }
	     $data['registration_info']=(!empty($this->session->userdata('registration_info')) && count($this->session->userdata('registration_info'))>0)?$this->session->userdata('registration_info'):null; 
	     
		 $this->session->unset_userdata('cart_reg');
	     $this->session->unset_userdata('cart_reg_final_price');
		 $this->session->unset_userdata('total_products');
		 _frontLayout("web-mgmt/register",$data);
		 //$this->load->view("web-mgmt/register",$data);
	}
}//end class
