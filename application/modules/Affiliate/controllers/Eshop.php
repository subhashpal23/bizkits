<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/ewallet
*/
class Eshop extends Common_Controller 
{
	private $moduleName;
	private $userId;
	private $role;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		affiliate_auth();
		$this->load->model('eshop_model');
		$this->load->helper("layout_helper");	
		$this->load->helper("commission_helper");	
		$this->userId=$this->session->userdata('user_id');
		$this->user_id=$this->session->userdata('user_id');
		$this->cart_items=$this->session->userdata('cart');
		$this->moduleName=$this->router->fetch_module();
		$this->role='2';
	} 
	
	
	public function index()
	{
		$data=array();
		$result=$this->db->query("select(select count(order_id) from eshop_orders) as total_order,(select count(order_id) from eshop_orders where order_status='0') as pending_order,(select count(order_id) from eshop_orders where order_status='1') as confirmed_order,(select count(order_id) from eshop_orders where order_status='2') as rejected_order,(select count(order_id) from eshop_orders where order_status='3') as delivered_order")->row_array();
		$data['order_data']=$result;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/eshop-mgmt/eshop-dashboard",$data);
	}
	public function allCategoryList()
	{
		 $result=$this->db->query("SELECT * FROM eshop_customer order by position")->result_array();	     	
		 $data['all_category']=$result;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this->controllerName;
		_adminLayout("ecommerce/eshop-mgmt/all-category",$data);
	}
	
	public function addNewCategory()
	{
		if(!empty($this->input->post('btn')))
		{
			
			$category_name=$this->input->post('category_name');
			$active_status=$this->input->post('active_status');
			$date=date('d-M-Y');
			$role=$this->role;
			
			$position=$this->db->select_max('position')->from('eshop_category')->get()->row();
			if(!empty($position->position))
			{
				$position=$position->position+1;
			}
			else 
			{
				$position=1;
			}
			$insert_data = array(
            'category_name' => $category_name,
            'active_status' => $active_status,
			'create_date'=>$date,
			'role'=>$this->role,
			'position'=>$position
            );
            $this->db->insert('eshop_customer', $insert_data);
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Customer Added Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allCategoryList");
			exit();
		}
		
		 $result=$this->db->query("SELECT * from eshop_customer")->result_array();
		 $data['module_name']=$this->moduleName;
		 $data['all_category']=$result;
		_adminLayout("ecommerce/eshop-mgmt/add-category",$data);
	}
	
	public function deleteCategory($del_id)
	{
		    /*redirect(site_url().'Admin/Eshop/allCategoryList');
			exit;*/
			
			$del_id=ID_decode($del_id);
			
		
			$this->db->delete('eshop_customer', array('id' => $del_id));

			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Customer Deleted Successfully</span>');
			
			redirect(site_url().$this->moduleName."/Eshop/allCategoryList");
			exit();
			
	}
	
	public function editCategory($fetch_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
			
			$hidid=$this->input->post('hidid');
			
			$category_name=$this->input->post('category_name');
			$active_status=$this->input->post('active_status');
			$date=date('d-M-Y');
			$role=$this->role;
			
			$update_data = array(
			'category_name' => $category_name,
			'active_status' => $active_status,
			'create_date' => $date,
             );
			
			$this->db->where('id', $hidid);
			$this->db->update('eshop_customer', $update_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Customer Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allCategoryList");
			exit();
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_customer where id='".$fetch_id."'")->row_array();
		 $data['category_data']=$result;
		 
		 $result1=$this->db->query("SELECT * from eshop_customer where id!='".$fetch_id."'")->result_array();
		 $data['all_category']=$result1;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/edit-category",$data);    
	}
	/*********************************/
	public function addNewSale()
	{
		if(!empty($this->input->post('btn')))
		{
			//pr($_POST); exit;
			$customer_id=$this->input->post('customer_id');
			$items=$this->input->post('items');
			$item_name=$this->input->post('item_name');
			$item_consumption=$this->input->post('item_consumption');
			$item_cost=$this->input->post('item_cost');
			$order_id=$this->generateCustomerOrderId();
			$res=array();
			$final_price=0;
			$user_id=$this->userId;
			foreach($items as $key=>$val)
			{
			    $arr['product_id']=$val;
			    $arr['product_name']=$item_name[$val];
			    $arr['qty']=$item_consumption[$val];
			    $arr['product_price']=$item_cost[$val];
			    $res[]=$arr;
			    $price=$item_consumption[$val]*$item_cost[$val];
			    $final_price=$final_price+$price;
			    
			    $stock_count=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$val,'stockist_id'=>$user_id))->get()->num_rows();
				if($stock_count)
				{
				    $stock_info=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$val,'stockist_id'=>$user_id))->get()->row();
				    $user_final_stock=$stock_info->qty-$item_consumption[$val];
				    $this->db->update('eshop_stock_stockist',array('qty'=>$user_final_stock),array('product_id'=>$val,'stockist_id'=>$user_id));
				    $this->db->insert('eshop_stock_stockist_history',array('type'=>0,'qty'=>$item_consumption[$val],'product_id'=>$val,'stockist_id'=>$user_id,'order_id'=>$order_id));
				}
				
			}
			$order_details=json_encode($res);
			$active_status=$this->input->post('active_status');
			$date=date('Y-m-d H:i:s');
		    
			
			$insert_data = array(
            'order_id' => $order_id,
            'user_id' => $user_id,
            'guest_id' => $customer_id,
            'order_status' => $active_status,
			'order_date'=>$date,
			'final_price'=>$final_price,
			'total_products'=>$total_products,
			'order_details'=>$order_details
            );
            $this->db->insert('eshop_orders_customer', $insert_data);
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Sold Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop_Orders/AllSales");
			exit();
		}
		
		 $result=$this->db->query("SELECT * from eshop_customer")->result_array();
		 $data['module_name']=$this->moduleName;
		 $data['all_customers']=$result;
		 $user_id=$this->user_id;
		 $result=$this->db->query("SELECT eshop_stock_stockist.*,eshop_products.title from eshop_stock_stockist inner join eshop_products on eshop_stock_stockist.product_id=eshop_products.id where stockist_id='".$user_id."'")->result_array();
		 $data['all_products']=$result;
		_adminLayout("ecommerce/eshop-mgmt/add-sale",$data);
	}
	
	public function deleteSale($del_id)
	{
		$del_id=ID_decode($del_id);
		$this->db->delete('eshop_orders_customer', array('id' => $del_id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Customer Deleted Successfully</span>');
		redirect(site_url().$this->moduleName."/Eshop_Orders/AllSales");
		exit();
	}
	
	public function editSale($fetch_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
			
			$hidid=$this->input->post('hidid');
			
			$category_name=$this->input->post('category_name');
			$active_status=$this->input->post('active_status');
			$date=date('d-M-Y');
			$role=$this->role;
			
			$update_data = array(
			'category_name' => $category_name,
			'active_status' => $active_status,
			'create_date' => $date,
             );
			
			$this->db->where('id', $hidid);
			$this->db->update('eshop_orders_customer', $update_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Customer Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop_Orders/AllSales");
			exit();
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_customer where id='".$fetch_id."'")->row_array();
		 $data['category_data']=$result;
		 
		 $result1=$this->db->query("SELECT * from eshop_customer where id!='".$fetch_id."'")->result_array();
		 $data['all_category']=$result1;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/edit-category",$data);    
	}
	/**********************/
	function getAjaxSubCategory()
	{
		$parent_category_id=$this->input->post('parent_category_id');
		$result=$this->db->select('*')->from('eshop_category')->where(array('parent_id'=>$parent_category_id,'active_status'=>'1'))->get()->result();
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}//end method
	
	
	public function ourStore()
	{
		$all_category=$this->eshop_model->getCategory();
		$data['all_category']=$all_category;
		$data['module_name']=$this->moduleName;
		$data['controller'] = $this;
		$user_id=$this->user_id;
		$user_details=get_user_details($user_id);
	 $state=$user_details->state;
	 /*$data['all_stockist']=$this->db->query("select * from user_stockist as s inner join 
user_registration as u on s.user_id=u.user_id where u.member_type='2' and s.state='".$state."';")->result();*/
		_userLayout("ecommerce/eshop-mgmt/our-store",$data);
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
	public function generateCustomerOrderId()
	{
	    $random_number="OR".mt_rand(100000, 999999);
	    if($this->db->select('order_id')->from('eshop_orders_customer')->where('order_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateCustomerOrderId();
	    }
	    return $random_number;
	}
	public function ourCart()
	{
	    /*$order_id=$this->session->userdata('cart_order_id');
	    if($order_id=='')
	    {
		$order_id=$this->generateUniqueOrderId();
		$this->session->set_userdata('cart_order_id',$order_id);
	    }*/
	    $cart_item=$this->session->userdata('cart');
	    //echo "Subhash";pr($this->cart_items); exit;
	    //$this->session->unset_userdata('cart_order_id');
		if($cart_item)
		{
	    $output .= '
          <div class="table-responsive">
             <table class="table table-bordered table-striped">
              <thead>
              <tr>
               <th>Product Name</th>
               <th>SKU</th>
               <th>Price</th>
               <th>BV</th>
               <th>Qty</th>
              <th>Remove</th>
              </tr>
              </thead>
              <tbody>
          ';
		
		//pr($cart_item);
          foreach($cart_item as $item)
          {
              $row=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row();
          $price=$item['qty']*$row->new_price;
              $pv=$item['qty']*$row->guest_point;
              $tqty=$tqty+$item['qty'];
              $tprice=$tprice+$price;
              $tpv=$tpv+$pv;
              //$total_tax=$total_tax+$item['tax'];
              //$total_ship=$total_ship+$item['shipment_charge'];
          $output .= '
              <tr>
             
               <td>'.$row->title.'</td>
               <td>'.$row->sku.'</td>
               <td>'.currency().$price.'</td>
               <td>'.$pv.'</td>
               
               <td><input type="text" name="qty" class="form-control" value="'.$item['qty'].'" onchange="updatecart('.$row->id.',this.value)">';
               if($flag)
               {
                   $output .='<span style="color:red;">Total Stock '.$stock_data['qty'].'</span>';
               }
               $output .='</td>
               <td><a class="btn btn-warning" href="javscript:void(0)" onclick="removefromcartrepurchase('.$row->id.')">Remove</a></td>
              </tr>
            ';
          }
          $output .= '
          </tbody>
          <tfoot>
              <tr>
               <td>&nbsp;</td>
               <td>Sub Total</td>
               <td>'.currency().$tprice.'</td>
               <td>'.$tpv.'</td>
               <td>&nbsp;</td>
               
              </tr>
              <tr>
               <td>&nbsp;</td>
               <td>Tax</td>
               <td>Included</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               
              </tr>
              <tr>
               <td>&nbsp;</td>
               <td>Shipment Charge</td>
               <td>'.currency().$total_ship.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               
              </tr>
              <tr>
               <td>&nbsp;</td>
               <td>Grand Total</td>
               <td>'.currency().$this->session->userdata('cart_final_price').'</td>
               <td>'.$tpv.'</td>
               <td>'.$tqty.'</td>
               
              </tr>
              <tr>
               <td colspan="5">&nbsp;</td>
               
               <td><button class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" onclick="proceedtopay()">Proceed To Pay</button></td>
              </tr>
            </tfoot></table></div>';
		}
		else
		{
		    $output.='<div class="table-responsive">
             <table class="table table-bordered table-striped">
              <tfoot>
              <tr>
               <td colspan="5">No Item In Cart.</td>
               
              </tr></tfoot></table></div>';
		}
         //echo $output; exit;
         $data['cartlistdetail']=$output;
         $data['order_id']=$order_id;
		$data['module_name']=$this->moduleName;
		$data['controller'] = $this;
		_userLayout("ecommerce/eshop-mgmt/our-cart",$data);
	}
	public function generateInvoice($typw=NULL)
	{
	    $order_id=$this->session->userdata('cart_order_id');
	    $this->session->set_userdata('cart_paymode',$typw);
	    if($order_id=='')
	    {
		$order_id=$this->generateUniqueOrderId();
		$this->session->set_userdata('cart_order_id',$order_id);
	    }
	    $cart_item=$this->session->userdata('cart');
	    //$this->session->unset_userdata('cart_order_id');
	    
		if($cart_item)
		{
	    $output .= '
          <div class="table-responsive">
             <table class="table table-bordered table-striped">
              <thead>
              <tr>
               <th>Product Name</th>
               <th>SKU</th>
               <th>Price</th>
               <th>BV</th>
               <th>Qty</th>
              
              </tr>
              </thead>
              <tbody>
          ';
		
		
          foreach($cart_item as $item)
          {
              $row=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row();
          $price=$item['qty']*$row->new_price;
              $pv=$item['qty']*$row->guest_point;
              $tqty=$tqty+$item['qty'];
              $tprice=$tprice+$price;
              $tpv=$tpv+$pv;
              //$total_tax=$total_tax+$item['tax'];
              //$total_ship=$total_ship+$item['shipment_charge'];
          $output .= '
              <tr>
             
               <td>'.$row->title.'</td>
               <td>'.$row->sku.'</td>
               <td>'.currency().$price.'</td>
               <td>'.$pv.'</td>
               
               <td>'.$item['qty'].'</tr>';
               
              
          }
          $output .= '
          </tbody>
          <tfoot>
              <tr>
               <td>&nbsp;</td>
               <td>Sub Total</td>
               <td>'.currency().$tprice.'</td>
               <td>'.$tpv.'</td>
               <td>&nbsp;</td>
               
              </tr>
              <tr>
               <td>&nbsp;</td>
               <td>Tax</td>
               <td>Included</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               
              </tr>
              <tr>
               <td>&nbsp;</td>
               <td>Shipment Charge</td>
               <td>'.currency().$total_ship.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               
              </tr>
              <tr>
               <td>&nbsp;</td>
               <td>Grand Total</td>
               <td>'.currency().$this->session->userdata('cart_final_price').'</td>
               <td>'.$tpv.'</td>
               <td>'.$tqty.'</td>
               
              </tr>
              
              <tr>
               <td>Paymnet Mode</td>
               <td><input type="radio" name="payment_mode" value="ewallet" checked> &nbsp; Ewallet</td>
               
               <td>&nbsp;</td>
               <td><button class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" onclick="proceedtopay1()">Proceed To Pay</button></td>
              </tr>
            </tfoot></table></div>';
		}
		else
		{
		    $output.='<div class="table-responsive">
             <table class="table table-bordered table-striped">
              <tfoot>
              <tr>
               <td colspan="5">No Item In Cart.</td>
               
              </tr></tfoot></table></div>';
		}
           // echo $output; exit;
         $data['cartlistdetail']=$output;
         $data['order_id']=$order_id;
		$data['module_name']=$this->moduleName;
		$data['controller'] = $this;
		_userLayout("ecommerce/eshop-mgmt/our-cart",$data);
	}
	
	public function ewalletPayment($center_leader=null)
	{
	    $user_id=$this->session->userdata('user_id');
	    
	    
		$role=$this->session->userdata('userType');
		$all_payment_method=$this->db->select('*')->from('eshop_payment_method')->get()->result();
		$payment_method=array();
		foreach($all_payment_method as $method)
		{
			  $payment_method[$method->payment_method]=$method->payment_mode_status;
		}
		///////////////////////////////
		//pr($payment_method); exit;
		if(!empty($this->session->userdata('cart')) && !empty($this->session->userdata('total_products')) && !empty($this->session->userdata('cart_final_price')) && $role=='2' && $payment_method['ewallet']=='1')
		{
			 $data=array();
			 
			_userLayout("ecommerce/eshop-mgmt/ewallet_payment",$data);
		}
		else 
		{
			redirect(site_url().'user/eshop/ourStore');
			exit;	
		}
	}
	
	public function ewalletPaymentConfirm()
	{
	    
		if(!empty($this->input->post('ewallet_payment_btn')))
		{
			
				$user_id=$this->session->userdata('user_id');
				//$center_leader=$this->session->userdata('center_leader');
				$role=$this->session->userdata('userType');
				$owner_user_id=$this->session->userdata('stockist_id');
				//echo $role.'--'.$user_id.'---'.$owner_user_id; exit;
				if(empty($user_id) || empty($role) && ($role!='2'))
				{
					$this->session->set_flashdata('error_msg','Kindly login first!');
					redirect(site_url().'Affiliate/');
					exit;
				}
				
				$t_code=$this->input->post('t_password');
				$is_user_exist=$this->db->select('id')->from('user_registration')->where(array('user_id'=>$user_id,'t_code'=>$t_code,'active_status'=>'1'))->get()->num_rows();
				//echo $t_code.'##'.$is_user_exist; exit;
				if($is_user_exist<=0)
				{
					$this->session->set_flashdata('error_msg','Sorry , your transaction password is not correct!');
					redirect(site_url().'Affiliate/Eshop/ewalletPayment');
					exit;	
				}
				$ewallet_info=$this->db->select('amount')->from('final_product_wallet')->where('user_id',$user_id)->get()->row();
				if($this->session->userdata('cart_final_price')>$ewallet_info->amount)
				{
					$this->session->set_flashdata('error_msg',"Sorry , you don't have sufficient fund in your wallet!");
					redirect(site_url().'Affiliate/Eshop/ewalletPayment');
					exit;
				}
				
				
				
				if(!empty($this->session->userdata('cart')) && !empty($this->session->userdata('total_products')) && !empty($this->session->userdata('cart_final_price')))
				{
				$cart=(object)$this->session->userdata('cart');
				$order_id=$this->generateUniqueOrderId();
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
				    $this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));
					//$this->db->update('eshop_stock',array('assign_web'=>$final_stock),array('product_id'=>$product->product_id));
					//$commission_info=$this->db->select('*')->from('eshop_product_level_commission')->where('product_id',$product->product_id)->get()->result();
					//print_r($commission_info);
					$product_id=$product->product_id;
					$cart_final_price=$this->session->userdata('cart_final_price');
					$pv=$guest_point*$product->qty;
					$total_pv=$total_pv+$pv;
				}
				//exit;
				
				$role=$this->session->userdata('userType');
				$user_id=null;
				$guest_id=null;
				if($role=='2')
				{
					$user_id=$this->session->userdata('user_id');
				}
				else if($role=='3')
				{
					$guest_id=$this->session->userdata('user_id');
				}
				$cart_final_price=$this->session->userdata('cart_final_price');
				//$cart_final_bv=$this->session->userdata('cart_final_bv');
				$owner_user_id=$this->session->userdata('stockist_id');
				$this->db->insert('eshop_orders',array(
				'order_id'=>$order_id,
				'role'=>(string)$role,
				'user_id'=>$user_id,
				'guest_id'=>$guest_id,
				'owner_user_id'=>$owner_user_id,
				'order_from'=>'eshop',
				'order_details'=>json_encode($this->session->userdata('cart')),
				'total_products'=>$this->session->userdata('total_products'),
				'discount'=>0,
				'final_price'=>$cart_final_price,
				'final_pv'=>$total_pv,
				'payment_method'=>'2'
				));
				
				// start manage pv
				/*$pv_info=$this->db->select('*')->from('level_income_binary')->where(array('down_id'=>$user_id))->get()->result();
				foreach($pv_info as $keypv=>$valpv)
				{
				    $datapv=array(
				        'downline_id'=>$user_id,
				        'income_id'=>$valpv->income_id,
				        'level'=>$valpv->level,
				        'knowledge_points'=>$guest_point*$product->qty,
				        'bv'=>$new_price*$product->qty,
				        'description'=>'Product Purchase',
				        'type'=>1,
				        'unique_id'=>'3',
				        'position'=>$valpv->leg,
				        'date'=>date('Y-m-d')
				        );
				        $this->db->insert('manage_bv_history',$datapv);
				}
				$datapv=array(
				        'downline_id'=>$user_id,
				        'income_id'=>$user_id,
				        'level'=>0,
				        'knowledge_points'=>$guest_point*$product->qty,
				        'bv'=>$new_price*$product->qty,
				        'description'=>'Product Purchase',
				        'type'=>1,
				        'unique_id'=>'3',
				        'position'=>'self',
				        'date'=>date('Y-m-d')
				        );
				        $this->db->insert('manage_bv_history',$datapv);
				        
				        $pv=$guest_point*$product->qty;
				        //$this->directrefferalcommission($user_id,$pv,$order_id);
				        $this->repurchaseCommission($user_id,$pv,$order_id);
				*/
				$pv_info=$this->db->select('*')->from('direct_matrix_downline')->where(array('down_id'=>$user_id))->get()->result();
				foreach($pv_info as $keypv=>$valpv)
				{
				    $datapv=array(
				        'down_id'=>$user_id,
				        'income_id'=>$valpv->income_id,
				        'level'=>$valpv->level,
				        'pv'=>$total_pv,
				        
				        'description'=>'Product Purchase',
				        'type'=>'team',
				        'l_date'=>date('Y-m-d H:i:s')
				        );
				        $this->db->insert('matrix_direct_pv',$datapv);
				}
				$datapv=array(
				        'down_id'=>$user_id,
				        'income_id'=>$user_id,
				        'level'=>0,
				        'pv'=>$total_pv,
				        
				        'description'=>'Product Purchase',
				        'type'=>'self',
				        'l_date'=>date('Y-m-d H:i:s')
				        );
				        $this->db->insert('matrix_direct_pv',$datapv);
				        
				        //$pv=$guest_point*$product->qty;
				        //$this->directrefferalcommission($user_id,$pv,$order_id);
				        $this->repurchaseCommission($user_id,$total_pv,$order_id);
				// end manage pv
				///////////////
				$query_obj=$this->db->select('amount')->from('final_product_wallet')->where('user_id',$user_id)->get()->row();
				 
				$balance=$query_obj->amount-$cart_final_price;
				
				$this->db->update('final_product_wallet',array('amount'=>$balance),array('user_id'=>$user_id));
				
				$this->db->insert('credit_debit_product',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$user_id,
					'credit_amt'=>'0',
					'debit_amt'=>$cart_final_price,
					'balance'=>$balance,
					'admin_charge'=>'0',
					'order_id'=>$order_id,
					'receiver_id'=>$user_id,
					'sender_id'=>$user_id,
					'receive_date'=>date('Y-m-d'),
					'ttype'=>'Purchase',
					'TranDescription'=>'Shopping done with order-id'.$order_id,
					'tran_description'=>'Shopping done with order-id'.$order_id,
					'status'=>'0',
					'payment_method'=>'1',
					'payment_method_name'=>'E-wallet',
					'current_url'=>site_url(),
					'reason'=>'30'
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
				$this->session->unset_userdata('cart');
				$this->session->unset_userdata('total_products');
				$this->session->unset_userdata('cart_final_price');
				$this->session->unset_userdata('registration_with_cart');
				redirect(site_url().'Affiliate/Eshop/order_successful?order_id='.$order_id);
				exit;
			}
			else 
			{
				
				redirect(site_url().'Affiliate/Eshop/ourStore');
				exit;
			}
		}//end cash_payment btn if
		else 
		{
			if(!empty($this->session->userdata('cart')) && !empty($this->session->userdata('total_products')) && !empty($this->session->userdata('cart_final_price')))
			{
				redirect(site_url().'Affiliate/Eshop/ewalletPayment');
			}
			else 
			{
				redirect(site_url().'Affiliate/Eshop/ourStore');
				exit;	
			}
		}
	}// end if
	public function order_successful()
	{
	    $data=array();
	    $order_id=$_GET['order_id'];
	    $data['order_id']=$order_id;
	    $info=$this->db->select('quote,bill')->from('eshop_orders')->where('order_id',$order_id)->get()->row();
	    $data['bill']=$info->bill;
	    $data['quote']=$info->quote;
	    $data['module_name']=$this->moduleName;
	    _userLayout("ecommerce/eshop-mgmt/order_successful",$data);
	}
	public function paytmPayment()
	{
	    $cart_final_price=$this->session->userdata('cart_final_price');
	    $order_id=$this->generateUniqueOrderId();
	    $user_id=$this->session->userdata('user_id');
	    //print_r($order_id);
	    ?>
	    <form method="post" action="http://globaljivan.com/estore/paytmFormSubmit" name="paytm">
         <table border="1">
            <tbody>
               <input type="hidden" name="MID" value="MDagpU12028460275325">
               <input type="hidden" name="WEBSITE" value="WEBSTAGING">
               <input type="hidden" name="ORDER_ID" value="<?php echo $order_id;?>">
               <input type="hidden" name="CUST_ID" value="<?php echo $user_id;?>">
               <input type="hidden" name="INDUSTRY_TYPE_ID" value="Retail">
               <input type="hidden" name="CHANNEL_ID" value="WEB">
               <input type="hidden" name="TXN_AMOUNT" value="<?php echo $cart_final_price;?>">
               <input type="hidden" name="MOBILE_NO" value="9990694126">
               <input type="hidden" name="EMAIL" value="subhashsws1@gmail.com">
               <input type="hidden" name="CALLBACK_URL" value="http://globaljivan.com/estore/paytmPaymentConfirm">
            </tbody>
         </table>
         <script type="text/javascript">
            document.paytm.submit();
         </script>
      </form>
	    <?php
	}
	
	public function checkUserMonthlyPurchase($user_id)
	{
	    $query_obj=$this->db->select_sum('final_price')->from('eshop_orders')->where(array('user_id'=>$user_id))->get()->row();
	    $balance=$query_obj->final_pv;
	    if($balance>=14)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}
	public function checkUserLevelForUnilevel($user_id)
	{
	    $query_obj=$this->db->select('pkg_id')->from('user_registration')->where(array('user_id'=>$user_id))->get()->row();
	    $pkg_id=$query_obj->pkg_id;
	    $query_obj=$this->db->select('to_level')->from('package')->where(array('id'=>$pkg_id))->get()->row();
	    $balance=$query_obj->to_level;
	    return $balance;
	}
	public function repurchaseCommission($user_id,$pv,$order_id)
	{
	    $checklevel=$this->checkUserLevelForUnilevel($user_id);
	    
    	    $query_obj=$this->db->select('commission_amount')->from('unilevel_stage_level_commission_meta')->where(array('level'=>0))->get()->row();
    	    $commissionself=($pv*$query_obj->commission_amount)/100;
    	    $commissionself=$commissionself*500;
    	        //$query_obj=$this->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$user_id,'wallet_type_id'=>1,'wallet_type'=>'main'))->get()->row();
                //$balance=$query_obj->amount+$commissionself;
                //$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id,'wallet_type_id'=>1,'wallet_type'=>'main'));
            	$this->db->insert('credit_debit_cash',array(
            	    'transaction_no'=>generateUniqueTranNo(),
            	    'user_id'=>$user_id,
            	    'credit_amt'=>$commissionself,
            	    'debit_amt'=>'0',
            	    'balance'=>$balance,
            	    'admin_charge'=>'0',
            	    'receiver_id'=>$user_id,
            	    'sender_id'=>$user_id,
            	    'receive_date'=>date('Y-m-d'),
            	    'ttype'=>'Repurchase Commission',
            	    'TranDescription'=>currency().$commissionself.' Repurchase Commission from '.$user_id." Purchase",
            	    'tran_description'=>currency().$commissionself.' Repurchase Commission from '.$user_id." Purchase",
            	    'status'=>'1',
            	    'level'=>0,
            	    'deposit_id'=>0,
            	    'product_name'=>'main',
            	    'payment_method'=>'1',
            	    'payment_method_name'=>'E-wallet',
            	    'current_url'=>site_url(),
            	    'reason'=>'10',
            	    'order_id'=>$order_id
                    ));
    	if($checklevel>0)
	    {
    	    $query=$this->db->select('*')->from('direct_matrix_downline')->where('down_id',$user_id)->get()->result();
    	    foreach($query as $key=>$val)
    	    {
    	        $down_id=$val->down_id;
    	        $income_id=$val->income_id;
    	        $level=$val->level;
    	        
    	         $query_obj=$this->db->select('commission_amount')->from('unilevel_stage_level_commission_meta')->where(array('level'=>$level))->get()->row();
    	        $commission=($pv*$query_obj->commission_amount)/100;
    	        $commission=$commission*500;
    	        //$commission=($pv*$per)/100;
    	        
    	        /*if($this->checkUserMonthlyPurchase($income_id))
    	        {*/
        	        //$query_obj=$this->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$income_id,'wallet_type_id'=>1,'wallet_type'=>'main'))->get()->row();
                    //$balance=$query_obj->amount+$commission;
                    //$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$income_id,'wallet_type_id'=>1,'wallet_type'=>'main'));
                	$this->db->insert('credit_debit_cash',array(
                	    'transaction_no'=>generateUniqueTranNo(),
                	    'user_id'=>$income_id,
                	    'credit_amt'=>$commission,
                	    'debit_amt'=>'0',
                	    'balance'=>$balance,
                	    'admin_charge'=>'0',
                	    'receiver_id'=>$income_id,
                	    'sender_id'=>$user_id,
                	    'receive_date'=>date('Y-m-d'),
                	    'ttype'=>'Repurchase Commission',
                	    'TranDescription'=>currency().$commission.' Repurchase Commission from '.$user_id." Purchase",
                	    'tran_description'=>currency().$commission.' Repurchase Commission from '.$user_id." Purchase",
                	    'status'=>'1',
                	    'level'=>$level,
                	    'deposit_id'=>0,
                	    'product_name'=>'main',
                	    'payment_method'=>'1',
                	    'payment_method_name'=>'E-wallet',
                	    'current_url'=>site_url(),
                	    'reason'=>'10',
                	    'order_id'=>$order_id
                        ));
    	        /*}*/       
    	        if($level>$checklevel)
    	        {
    	            break;
    	        }
    	    }
	    }
	}
	public function directrefferalcommission($user_id,$pv,$order_id)
	{
	    /*$query_ref=$this->db->select('ref_id')->from('user_registration')->where('user_id',$user_id)->get()->row();
	    $ref_id=$query_ref->ref_id;
	    $commission=$pv*10/100;
	    $query_obj=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$ref_id)->get()->row();
                        	$balance=$query_obj->amount+$commission;
                        	$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$ref_id));
                    	
                        	$this->db->insert('credit_debit',array(
                        	    'transaction_no'=>generateUniqueTranNo(),
                        	    'user_id'=>$ref_id,
                        	    'credit_amt'=>$commission,
                        	    'debit_amt'=>'0',
                        	    'balance'=>$balance,
                        	    'admin_charge'=>'0',
                        	    'receiver_id'=>$ref_id,
                        	    'sender_id'=>$user_id,
                        	    'receive_date'=>date('d-m-Y'),
                        	    'ttype'=>'Refferal Commission',
                        	    'TranDescription'=>currency().$commission.' Refferal Commission from '.$user_id." Purchase",
                        	    'tran_description'=>currency().$commission.' Refferal Commission from '.$user_id." Purchase",
                        	    'status'=>'1',
                        	    'payment_method'=>'1',
                        	    'payment_method_name'=>'E-wallet',
                        	    'current_url'=>site_url(),
                        	    'reason'=>'5',
                        	    'order_id'=>$order_id
                                ));
                                
                        //$arr_income=array('',6,7,9,9,11,11,12,15);
                        $arr_income=array('',14,12,10,7,6,4,4,3,3,3,2,2);
        $ref = $ref_id;
        $l=1;
        while($ref!='cmp')
        {
            if($ref!='cmp' && $ref!='')
            {
                $commission=$pv*$arr_income[$l]/100;
	            $query_obj=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$ref)->get()->row();
                $balance=$query_obj->amount+$commission;
                $this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$ref));
                    	
            	$this->db->insert('credit_debit',array(
            	    'transaction_no'=>generateUniqueTranNo(),
            	    'user_id'=>$ref,
            	    'credit_amt'=>$commission,
            	    'debit_amt'=>'0',
            	    'balance'=>$balance,
            	    'admin_charge'=>'0',
            	    'receiver_id'=>$ref,
            	    'sender_id'=>$user_id,
            	    'receive_date'=>date('d-m-Y'),
            	    'ttype'=>'Unilevel Commission',
            	    'TranDescription'=>currency().$commission.' Unilevel Commission from '.$user_id." Purchase",
            	    'tran_description'=>currency().$commission.' Unilevel Commission from '.$user_id." Purchase",
            	    'status'=>'1',
            	    'level'=>$l,
            	    'payment_method'=>'1',
            	    'payment_method_name'=>'E-wallet',
            	    'current_url'=>site_url(),
            	    'reason'=>'6',
            	    'order_id'=>$order_id
                    ));
                    
                    if($l==12)
                    {
                        break;
                    }
            
                    $query_ref=$this->db->select('ref_id')->from('user_registration')->where('user_id',$ref)->get()->row();
    	            $ref=$query_ref->ref_id;
    	            $l++;
            }
        }*/
	}
	public function productslist($sub_cat_id)
	{
	    $data=array();
		 $where = "status ='1'";
		 
		 $where .=" and parent_category_id ='".$sub_cat_id."'"; 	 
		 
		 $all_products=$this->db->select('*')->from('eshop_products')->where($where)->get()->result_array();
		
		 return $all_products;
	}
	public function allProductList()
	{
		 $result=$this->db->select('*')->from('eshop_products')->where(array('user_id'=>$this->userId))->get()->result_array();	     	
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		_userLayout("ecommerce/eshop-mgmt/all-products",$data);
	}
	public function purchaseProduct()
	{
	    if(!empty($this->input->post('btn')))
		{
		    $pkg_id=2;
		    $amount=500;
		    $password=$this->input->post('tran_password');
		    
    	  	if(empty($password))
    		{
    			$this->session->set_flashdata("error_msg", '<h5 class="panel-title">Please enter Transaction Password!</h5>'); 
    			redirect(site_url() . "user/eshop/purchaseProduct");                 
    			exit();
    		}
    		else 
    		{
    
    			$query=$this->db->query("SELECT * FROM (`user_registration`) WHERE `user_id` = '".$this->userId."' AND `t_code` = '$password'");
    			if($query->num_rows()<1)
    			{
    				$this->session->set_flashdata("error_msg", '<h5 class="panel-title">Please enter valid Transaction Password!
    			</h5>'); 
    			redirect(site_url() . "user/eshop/purchaseProduct");                  
    			exit();
    			}
    		}
    	    
    	    $user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
    	    $exist_amount=$user->amount;
    	  	
    	  	if($amount>$exist_amount)
    	  	{
    				$this->session->set_flashdata("error_msg", '<h5 class="panel-title">Sorry you do not have sufficient balance into your E-wallet</h5>'); 
    					redirect(site_url() . "user/eshop/purchaseProduct");                
    			exit();
    	  	}
    	  	else
    	  	{
    	  	    $user_id=$this->userId;
    	  	    // deduct amount from ewallet
	            $balance=$exist_amount-$amount;
	            $this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id));
	            $this->db->insert('credit_debit',array(
        	    'transaction_no'=>generateUniqueTranNo(),
        	    'user_id'=>$user_id,
        	    'credit_amt'=>'0',
        	    'debit_amt'=>$amount,
        	    'balance'=>$balance,
        	    'admin_charge'=>'0',
        	    'receiver_id'=>123456,
        	    'sender_id'=>$user_id,
        	    'pkg_id'=>$pkg_id,
            	'pkg_amount'=>$amount,
        	    'receive_date'=>date('d-m-Y'),
        	    'ttype'=>'Product Purchased',
        	    'TranDescription'=>'Product Purchase On '.date('d-m-Y'),
        	    'Cause'=>'Product Purchase On '.date('d-m-Y'),
        	    'Remark'=>'Product Purchase On '.date('d-m-Y'),
        	    'invoice_no'=>'',
        	    'product_name'=>'',
        	    'status'=>'0',
        	    'ewallet_used_by'=>'Withdrawal Wallet',
        	    'current_url'=>site_url(),
        	    'reason'=>'1'
                ));
        	    
        	    $this->db->insert('user_package_log',array(
            	'user_id'=>$user_id,
            	'new_package_id'=>$pkg_id,
            	'active_status'=>'1',
            	'purchased_date'=>date('Y-m-d H:i:s')
            	));
            	$this->db->insert('product_sell',array(
            	'user_id'=>$user_id,
            	'pkg_id'=>$pkg_id,
            	'pkg_amount'=>$amount,
            	'status'=>'0',
            	'purchase_date'=>date('Y-m-d H:i:s')
            	));
            	
            	matrix_commission_level($user_id,'matrix_downline',$pkg_id);
            	matrix_commission_pending_paid($user_id,'matrix_downline',$pkg_id);
            	redirect(site_url().'user'); exit;
            	exit;
    	  	}
		}
		$data=array();
    	_userLayout("ewallet-mgmt/ewallet-payment",$data);
	}
	public function products()
	{
    	 $data['title']='Products';
    	 
    	 _userLayout("shop-mgt/products",$data);
	}
	public function sellProduct($amount)
	{
	    $this->session->set_userdata('amount',$amount);
    	$data=array();
    	$data['title']='Products';
    	_userLayout("ewallet-mgmt/ewallet-payment-product",$data);
	}
	public function sellProductAmount()
	{
	    $amount=$this->session->userdata('amount');
    	$data=array();
    	$data['title']='Products';
    	_userLayout("ewallet-mgmt/ewallet-payment-product",$data);
    	if(!empty($this->input->post('btn')))
		{
		    $password=$this->input->post('tran_password');
		    
    	  	if(empty($password))
    		{
    			$this->session->set_flashdata("error_msg", '<h5 class="panel-title">Please enter Transaction Password!</h5>'); 
    			redirect(site_url() . "user/eshop/products");                 
    			exit();
    		}
    		else 
    		{
    
    			$query=$this->db->query("SELECT * FROM (`user_registration`) WHERE `user_id` = '".$this->userId."' AND `t_code` = '$password'");
    			if($query->num_rows()<1)
    			{
    				$this->session->set_flashdata("error_msg", '<h5 class="panel-title">Please enter valid Transaction Password!</h5>'); 
    			    redirect(site_url() . "user/eshop/products");                  
    			    exit();
    			}
    		}
    	    
    	    $user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
    	    $exist_amount=$user->amount;
    	  	
    	  	if($amount>$exist_amount)
    	  	{
    			$this->session->set_flashdata("error_msg", '<h5 class="panel-title">Sorry you do not have sufficient balance into your E-wallet</h5>'); 
    			redirect(site_url() . "user/eshop/products");                
    			exit();
    	  	}
    	  	else
    	  	{
    	  	    $user_id=$this->userId;
    	  	    // deduct amount from ewallet
    	  	    $balance=$exist_amount-$amount;
	            $this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id));
	            $this->db->insert('credit_debit',array(
        	    'transaction_no'=>generateUniqueTranNo(),
        	    'user_id'=>$user_id,
        	    'credit_amt'=>'0',
        	    'debit_amt'=>$amount,
        	    'balance'=>$balance,
        	    'admin_charge'=>'0',
        	    'receiver_id'=>123456,
        	    'sender_id'=>$user_id,
        	    'pkg_id'=>$pkg_id,
            	'pkg_amount'=>$amount,
        	    'receive_date'=>date('d-m-Y'),
        	    'ttype'=>'Product Purchased',
        	    'TranDescription'=>'Sell Set Of Bottle Of Amount '.currency().$amount.' On'.date('d-m-Y'),
        	    'Cause'=>'Sell Set Of Bottle Of Amount '.currency().$amount.' On'.date('d-m-Y'),
        	    'Remark'=>'Sell Set Of Bottle Of Amount '.currency().$amount.' On'.date('d-m-Y'),
        	    'invoice_no'=>'',
        	    'product_name'=>'',
        	    'status'=>'0',
        	    'ewallet_used_by'=>'Withdrawal Wallet',
        	    'current_url'=>site_url(),
        	    'reason'=>'1'
                ));
                
            	$this->db->insert('product_sell_bottle',array(
            	'user_id'=>$user_id,
            	'pkg_amount'=>$amount,
            	'remark'=>'Sell Set Of Bottle Of Amount '.currency().$amount,
            	'status'=>'0',
            	'purchase_date'=>date('Y-m-d H:i:s')
            	));
            	$this->session->set_flashdata("flash_msg", '<h5 class="panel-title">Product Purchase Successfully</h5>'); 
            	redirect(site_url().'user/eshop/products');
    	  	}
		}
	}
	
	public function eshopReport()
	{
	 $result=$this->db->query("select * from product_sell_bottle where user_id='".$this->userId."'")->result_array();
	 
	 $data['all_order']=$result;
	 $data['title']='My Order';
	 
	 _userLayout("shop-mgt/product-order",$data);
	}
	
	
	public function myOrder()
	{
	 $result=$this->db->query("select a.*,b.* from orders as a,orders_clients as b where a.id=b.for_id and a.user_id='".$this->userId."'")->result_array();
	 
	 $data['all_order']=$result;
	 $data['title']='My Order';
	 
	 _userLayout("shop-mgt/my-order",$data);
	}
	public function getAjaxOrderDetails($id)
	{
	  	
	 $result=$this->db->query("select a.*,b.* from orders as a,orders_clients as b where  a.id='".$id."' and a.id=b.for_id and a.user_id='".$this->userId."'")->row_array();
	 
	 
	 $products=unserialize($result['products']);
	
	 
	 ?>
	 <h2 class="bg-blue" style="text-align:center;">
	 Your Order Details
	 </h2>
	<table class="table table-responsive">
	<tr>
	<td><b>Order Id :</b> </td><td><?php echo $result['order_id']; ?></td>
	<td><b>Order Date :</b></td><td><?= date('d-M-Y / H:m:s', $result['date']); ?></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	</tr>
	
	<?php
	foreach ($products as $k=>$p)
	{
		$row=$this->db->query("select a.*,b.* from products as a , products_translations as b where a.id='".$k."' and a.id=b.for_id")->row_array();
		
	?>
	<tr>
	<td><b>Product Name :</b> </td><td><?php echo $row['title']; ?></td>
	<td><b>Image :</b> </td><td> <img src="<?= base_url('attachments/shop_images/' . $row['image']) ?>" alt="Product" style="width:100px; margin-right:10px;" class="img-responsive"></td>
	<td><b>Price :</b> </td><td>N <?php echo $row['price']; ?></td>
	<td><b>Qty :</b> </td><td><?php echo $p; ?></td>
	<td><b>Total :</b> </td><td>N <?php echo $p*$row['price']; ?></td>
	
	</tr>
    <?php	
	}
	?>
	
	<tr>
	<td><b>Order Total Price :</b> </td><td>N <?php echo $result['order_total_price']; ?></td>
	<td></td><td></td><td></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	</tr>
    </table>	
	 <?php
	 
	}
	
    public function addNewProduct()
	{
		if(!empty($this->input->post('btn')))
		{
			$parent_category_id=$this->input->post('parent_category_id');
			$category_id=$this->input->post('category_id');
			$title=$this->input->post('title');
			$old_price=$this->input->post('old_price');
			$new_price=$this->input->post('new_price');
			$qty=$this->input->post('qty');
			$sku=$this->input->post('sku');
			$status=$this->input->post('status');
			$tax=($this->input->post('tax'))?$this->input->post('tax'):0;
			$shipment_charge=($this->input->post('shipment_charge'))?$this->input->post('shipment_charge'):0;
			$description=$this->input->post('description');
			$long_description=$this->input->post('long_description');
			$featured=$this->input->post('featured');
			$role=$this->role;
			////////////////////////////////////////////////////////////////
			$direct_commission=$this->input->post('direct_commission');
			$guest_point=$this->input->post('guest_point');
			
			$level_commission=$this->input->post('level_commission');
			
			
			////////////////////////////////////////////////////////////
			
			
			$image_upload_path='/product_images/';
	        $product_image=adImageUpload($_FILES['product_image'],1, $image_upload_path);
			
			 /*$update_sub_img=array();
			 for($i=0;$i<count($_FILES['sub_img']['name']);$i++)
			 {
				 $sub_image=array(
				 'name'=>$_FILES['sub_img']['name'][$i],
				 'type'=>$_FILES['sub_img']['type'][$i],
				 'tmp_name'=>$_FILES['sub_img']['tmp_name'][$i],
				 'error'=>$_FILES['sub_img']['error'][$i],
				 'size'=>$_FILES['sub_img']['size'][$i]	
				 );
				
				$uploaded_sub_img=adImageUpload($sub_image,1, $image_upload_path);	
				
				$update_sub_img[]=array(
				'sub_img'=>$uploaded_sub_img
				);
			 }*/
			$insert_data = array(
			'user_id'=>$this->user_id,
            'parent_category_id'=>$parent_category_id,
			'category_id' => $category_id,
            'product_image' => $product_image,
            'title' => $title,
            'old_price' => $old_price,
			'new_price'=>$new_price,
			'sku'=>$sku,
			'qty'=>$qty,
			'description'=>$description,
			'long_description'=>$long_description,
			'featured'=>$featured,
			'role'=>$this->role,
			'direct_commission'=>$direct_commission,
			'guest_point'=>$guest_point,
			'tax'=>$tax,
			'shipment_charge'=>$shipment_charge
            );
            $this->db->insert('eshop_products', $insert_data);
			$update_sub_img=serialize($update_sub_img);
			//////////////////////////////////
			$product_id=$this->db->insert_id();
			$this->db->update('eshop_products',array('sub_images'=>$update_sub_img),array('id'=>$product_id));
			//$this->db->insert('eshop_stock',array('product_id'=>$product_id,'qty'=>$qty,));
			//$eshop_product_level_commission=array();
			//echo $this->moduleName; exit;
			////////////////////
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allProductList");
			exit();
			
		}
		 $result=$this->db->query("SELECT * from eshop_category where parent_id=0")->result_array();
		 $data['all_category']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/add-product",$data);
	}
	
	public function deleteProduct($del_id)
	{
		   /* redirect(site_url().'admin/eshop/allProductList/');
			exit;*/
			$del_id=ID_decode($del_id);
			$this->db->delete('eshop_products', array('id' => $del_id));	
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Deleted Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allProductList");
			exit();
	}
	
	public function editProduct($fetch_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
			$hidid=$this->input->post('hidid');
			$category_id=$this->input->post('category_id');
			$title=$this->input->post('title');
			$old_price=$this->input->post('old_price');
			$new_price=$this->input->post('new_price');
			$sku=$this->input->post('sku');
			$status=$this->input->post('status');
			$description=$this->input->post('description');
            $long_description=$this->input->post('long_description');
			$featured=$this->input->post('featured');
			$role=$this->role;
			$tax=($this->input->post('tax'))?$this->input->post('tax'):0;
			$shipment_charge=($this->input->post('shipment_charge'))?$this->input->post('shipment_charge'):0;
			/////////////
			$direct_commission=$this->input->post('direct_commission');
			$guest_point=$this->input->post('guest_point');
			$level_commission=$this->input->post('level_commission');
			////////////////////////
			$image_upload_path='/product_images/';
			if($_FILES['product_image']['name']=='')
			{
			$product_image=$this->input->post('hidden_image');	
			}
			else
			{
	        $product_image=adImageUpload($_FILES['product_image'],1, $image_upload_path);
			}
			/*$upload_sub_img=array();
			$old_sub_images=$this->input->post('old_sub_images');
			foreach($old_sub_images as $old_img)
			{
				$upload_sub_img[]=array(
				'sub_img'=>$old_img
				);
			}
			for($i=0;$i<count($_FILES['sub_img']['name']);$i++)
			{
				 $sub_image=array(
				 'name'=>$_FILES['sub_img']['name'][$i],
				 'type'=>$_FILES['sub_img']['type'][$i],
				 'tmp_name'=>$_FILES['sub_img']['tmp_name'][$i],
				 'error'=>$_FILES['sub_img']['error'][$i],
				 'size'=>$_FILES['sub_img']['size'][$i]	
				 );
								
				$uploaded_sub_img=adImageUpload($sub_image,1, $image_upload_path);	
				
				$upload_sub_img[]=array(
				'sub_img'=>$uploaded_sub_img
				);
			 }*/
			//pr($upload_sub_img);die; 
			$update_data = array(
            'category_id' => $category_id,
			'product_image' => $product_image,
            'title' => $title,
            'old_price' => $old_price,
			'new_price'=>$new_price,
			'sku'=>$sku,
			'status'=>$status,
			'description'=>$description,
            'long_description'=>$long_description,
			'featured'=>$featured,
			'role'=>$this->role,
			'direct_commission'=>$direct_commission,
			'guest_point'=>$guest_point,
			'tax'=>$tax,
			'shipment_charge'=>$shipment_charge
            );
            $this->db->where('id', $hidid);
			$this->db->update('eshop_products', $update_data);
			
			///////updating level commission///
			/*$eshop_product_level_commission=array();
			if(!empty($level_commission))
			{
				$level=1;
				foreach($level_commission as $k=>$commission)
				{
					$eshop_product_level_commission[]=array(
					'product_id'=>$hidid,
					'level'=>$level,
					'commission'=>$commission
					);
				    $level++;
				}
			}
			$this->db->delete('eshop_product_level_commission',array(
			'product_id'=>$hidid
			));
			if(!empty($eshop_product_level_commission))
			{
				$this->db->insert_batch('eshop_product_level_commission',$eshop_product_level_commission);	
			}*/
			///////////////////////////////////
			
			$upload_sub_img=serialize($upload_sub_img);
			
			$this->db->update('eshop_products',array('sub_images'=>$upload_sub_img),array('id'=>$hidid));
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allProductList");
			exit();
			
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_products where id='".$fetch_id."'")->row_array();
		 $data['product_data']=$result;
		 $data['sub_images']=unserialize($result['sub_images']);
		 
		 $result1=$this->db->query("SELECT * from eshop_category where parent_id=0")->result_array();
		 $data['all_category']=$result1;
		 
		 $result1=$this->db->query("SELECT * from eshop_category where parent_id='".$result['parent_category_id']."'")->result();
		 $data['sub_category']=$result1;
		 
		 /*$sub_category=$this->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$result['parent_category_id']))->get()->result();
		 $data['sub_category']=$sub_category;*/
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/edit-product",$data);
	}
	public function getProductViewDetails()
	{
	    $order_id=$this->input->post('order_id');
		//$order_id='OR172321';
		
		$product =$this->eshop_model->getOneProduct($order_id);
//pr($product);
$filename=showproductimage($product['product_image']);
    	?>
    		<div class="panel panel-white" >
                   <!--<div class="panel-heading">
                      <h6 class="panel-title">Order Details</h6>
                      <div class="heading-elements">
                      </div>
                   </div>-->
                   <div class="panel-body no-padding-bottom">
                      <div class="row">
    					 <div class="col-md-6 content-group">
    					     <div class="img-responsive">
                                  <img data-sizes="auto" src="<?php echo base_url();?>product_images/<?php echo $product['product_image'];?>" alt="<?php echo $product['title'];?>" class="lazyload img-responsive">
                                 
                              </div>
                         </div>
                         <div class="col-md-6 content-group">
                            <div class="invoice-details1">
                               <ul class="list-condensed list-unstyled">
                                  <li><b><?php echo $product['title'];?></b></li>
                                  <li><?php if($product['qty']){ echo "<samp>Available</samp>";}else{ echo "<samp>Out Of Stock</samp>";} ?></li>
                                  <li><?php echo $product['description'];?></li>
                               </ul>
                            </div>
                         </div>
                         <div class="col-md-12 content-group">
                             <?php echo $product['long_description'];?>
                         </div>
                      </div>
                   </div>
                   
                   
            </div>	
    	<?php 
	}
}
?>