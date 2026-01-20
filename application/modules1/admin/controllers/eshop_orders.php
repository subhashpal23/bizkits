<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/eshop_orders
*/
class Eshop_Orders extends Common_Controller 
{
	private $moduleName;
	private $user_id;
	private $role;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->model('eshop_model');
		$this->load->helper("layout_helper");
		$this->user_id=$this->session->userdata('user_id');
		$this->moduleName=$this->router->fetch_module();
		$this->role='1';
		
	}
	//end constructor 
	/////////////orders function   all,complete,rejected,pending delivered//////////////////////
	
	public function allOrdersCommission()
	{	  	 
		$data['title']='All Commissions';	
		//$all_order=$this->db->select('*')->from('eshop_orders')->order_by('id','desc')->get()->result();
		$where='';
		$order_id=$this->input->post('orderid');
		
		    $where.=" where e.order_id='$order_id'";
		
		$all_order=$this->db->query("SELECT sum(c.credit_amt) as amount,c.order_id,e.order_id,e.user_id,e.final_price,e.final_bv,e.order_date FROM `credit_debit` as c inner join eshop_orders as e on c.order_id=e.order_id $where group by c.order_id")->result();
		//pr($all_order); exit;
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['order_id']=$order_id;
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders-commission",$data);
	}
	public function allOrders()
	{	  	 
		$data['title']='All Orders';	
		$all_order=$this->db->select('*')->from('eshop_orders')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	public function allOrdersTax()
	{	  	 
		$data['title']='All Orders';	
		$all_order=$this->db->select('*')->from('eshop_orders')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='tax';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	public function allPendingOrders()
	{
		$data['title']='Pending Orders';	
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where('order_status','0')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='pending';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	
	public function allConfirmedOrder()
	{
		$data['title']='Confirmed Orders';		
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where('order_status','1')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='confirmed';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	
	public function allRejectedOrders()
	{
		$data['title']='Rejected Orders';		
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where('order_status','2')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='rejected';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	
	public function allDeliveredOrders()
	{
		$data['title']='Delivered Orders';		
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where('order_status','3')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='delivered';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	public function allStockistOrders()
	{	  	 
		$data['title']='All Orders';
		$all_order1=$this->db->select('*')->from('eshop_stockist_sell')->order_by('id','desc')->get()->result();
		foreach($all_order1 as $val)
		{
		    $res=$this->db->select('*')->from('eshop_orders')->where('order_id',$val->order_id)->order_by('id','desc')->get()->row();
		    
		    //$res[] = (object) ['stockist_id' => $val->stockist_id];
		    $stockinfo=$this->getstockistuserid($val->stockist_id);
		    //pr($stockinfo);
		    $res->stockist_id=$val->stockist_id;
		    $res->stockist_user_id=$stockinfo->user_id;
		    $res->stockist_username=$stockinfo->username;
		    $all_order[]=$res;
		}
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-stockist-orders",$data);
	}
	public function getstockistuserid($id)
	{
	    $res=$this->db->select('*')->from('admin_sub')->where('id',$id)->order_by('id','desc')->get()->row();
	    return $res;
	}
	public function change_status($order_id=null,$order_status=null,$url=null)
    {
        //$order_id='OR672872';
		//$order_status='1';
		$this->db->update('eshop_orders',array('order_status'=>$order_status),array('order_id'=>$order_id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Status Changed Successfully</span>');
		redirect(site_url().$this->moduleName."/eshop_orders/".$url);
		exit();
    }
	public function change_status123($order_id=null,$order_status=null,$url=null)
    {
        //$order_id='OR672872';
		//$order_status='1';
		$this->db->update('eshop_orders',array('order_status'=>$order_status),array('order_id'=>$order_id));
		
		///////////////////////////////////////
		$order_info=$this->db->select('*')->from('eshop_orders')->where('order_id',$order_id)->get()->row();
		if(!empty($order_info->order_status) && $order_info->order_status=='1' && $order_info->role=='2')
		{
			$upliner_level_commission=array();
			$direct_commission=array();
			$guest_point=array();
			
			
			$user_id=$order_info->user_id;
			$user_details=get_user_details($user_id);
			$sponser_id=$user_details->ref_id;
			
			$role=$order_info->role;//2=>user,3=>admin
			$all_product=json_decode($order_info->order_details);
			
			
			///////////////////
			foreach($all_product as $product)
			{
				$commission_info=$this->db->select(array('direct_commission','guest_point'))->from('eshop_products')->where(array('id'=>$product->product_id))->get()->row();
					  
				$direct_commission[]=(object)array('product_id'=>$product->product_id,'commission'=>$commission_info->direct_commission,'qty'=>$product->qty);
					  
				$guest_point[]=array('product_id'=>$product->product_id,'point'=>$commission_info->guest_point,'qty'=>$product->qty);
					  
				$level_commission=$this->db->select('*')->from('eshop_product_level_commission')->where('product_id',$product->product_id)->get()->result();
					  
				$upliner_level_commission[]=(object)array('product_id'=>$product->product_id,'level_commission'=>$level_commission,'qty'=>$product->qty);
			}
			///commission distribute code from here
			//@credit direct commission
			
			foreach($direct_commission as $commission)
			{
			 if(!empty($commission->commission) && $commission->commission>0)
			 {
				 $paid_commission=$commission->commission*$commission->qty;
				 $qty=$commission->qty;
				 $pid=$commission->product_id;
				 ////////////////////////////////
				 $sponsor_amount_info=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$sponser_id)->get()->row();
				 $current_balance=$sponsor_amount_info->amount;
				 $balance=$current_balance+$paid_commission;
				 
				 $this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id));
				 /////////////////
				 
				 $this->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$sponser_id,
					'credit_amt'=>$paid_commission,
					'debit_amt'=>'0',
					'balance'=>$balance,
					'admin_charge'=>'0',
					'receiver_id'=>$sponser_id,
					//'pkg_id'=>$pkg_id,
					//'pkg_amount'=>$pkg_amount,
					'product_id'=>$pid,
					'product_qty'=>$qty,
					'product_commission'=>$commission->commission,
					'sender_id'=>$user_id,
					'receive_date'=>date('d-m-Y'),
					'ttype'=>'product direct commission',
					'TranDescription'=>'product direct commission',
					'Cause'=>'product direct commission',
					'Remark'=>'product direct commission',
					'invoice_no'=>'',
					'product_name'=>'',
					'status'=>'1',
					'ewallet_used_by'=>'Withdrawal Wallet',
					'current_url'=>site_url(),
					'reason'=>'38' //38=>product direct commission
					)); 
			 }//end commission>0 if
			}
			//@credit guest point
			foreach($guest_point as $point)
			{
						
			}
			//@credit upliner level commission
			//pr($upliner_level_commission);
			foreach($upliner_level_commission as $commission)
			{
				$pid=$commission->product_id;
				$qty=$commission->qty;
				if(!empty($commission->level_commission))
				{
					foreach($commission->level_commission as $commission)
					{
						
						$commission->qty=$qty;
						pr($commission);
						$upliner_info=$this->db->select(array('income_id'))->from('matrix_downline')->where(array(
						'down_id'=>$user_id,
						'level'=>$commission->level
						))->get()->row();
						if(!empty($upliner_info->income_id) && $commission->commission)
						{
								////////////////////////////////
								 $upliner=$upliner_info->income_id;
								 $paid_commission=$commission->commission*$commission->qty;
								 $qty=$commission->qty;
								 $pid=$commission->product_id;
								 
								 $sponsor_amount_info=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
								 $current_balance=$sponsor_amount_info->amount;
								 $balance=$current_balance+$paid_commission;
								 
								 $this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
								 /////////////////
								 
								 $this->db->insert('credit_debit',array(
									'transaction_no'=>generateUniqueTranNo(),
									'user_id'=>$upliner,
									'credit_amt'=>$paid_commission,
									'debit_amt'=>'0',
									'balance'=>$balance,
									'admin_charge'=>'0',
									'receiver_id'=>$upliner,
									//'pkg_id'=>$pkg_id,
									//'pkg_amount'=>$pkg_amount,
									'product_id'=>$pid,
									'product_qty'=>$qty,
									'product_commission'=>$commission->commission,
									'level'=>$commission->level,
									'sender_id'=>$user_id,
									'receive_date'=>date('d-m-Y'),
									'ttype'=>'product level commission',
									'TranDescription'=>'product level commission',
									'Cause'=>'product level commission',
									'Remark'=>'product level commission',
									'invoice_no'=>'',
									'product_name'=>'',
									'status'=>'1',
									'ewallet_used_by'=>'Withdrawal Wallet',
									'current_url'=>site_url(),
									'reason'=>'39' //39=>product level commission
									)); 
						}
					}
				}
			}	
		}//end order status if here
		/////////////////////
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Status Changed Successfully</span>');
		redirect(site_url().$this->moduleName."/eshop_orders/".$url);
		exit();
    }
	
	public function getProduct($id)
	{
		 $result=$this->db->query("SELECT * from eshop_products where id='".$id."' order by id desc")->row();	     	
		 return $result;
		 //$data['module_name']=$this->moduleName;
		//_adminLayout("ecommerce/eshop-mgmt/all-products",$data);
	}
	/////////////orders function   all,complete,rejected,pending delivered//////////////////////
	public function getOrderDetails()
	{
		$order_id=$this->input->post('order_id');
		//$order_id='OR172321';
		$order_info=$this->db->select('*')->from('eshop_orders')->where('order_id',$order_id)->get()->row();
		//pr($order_info);
		$order_details=json_decode($order_info->order_details);
		if($order_info->role=='2')
		{
			//eshop_member_delivery_address
			$delivery_info=$this->db->select('*')->from('eshop_member_delivery_address')->where('user_id',$order_info->user_id)->get()->row();
			
			
		}
		else if($order_info->role=='3')
		{
			//eshop_guest_delivery_address
			$delivery_info=$this->db->select('*')->from('eshop_guest_delivery_address')->where('guest_id',$order_info->guest_id)->get()->row();
		}
		//pr($delivery_info);
		$result_stockist=$this->db->query("SELECT * from eshop_stockist_sell where order_id='".$order_id."' order by id desc")->row();
		$result_stockist->stockist_id;
		if($result_stockist)
		{
		    $resultuser=$this->db->query("SELECT * from admin_sub where id='".$result_stockist->stockist_id."' order by id desc")->row();	 
		    $stockist_userid=$resultuser->user_id;
		}
	?>
		<div class="panel panel-white" >
               <div class="panel-heading">
                  <h6 class="panel-title">Order Details</h6>
                  <div class="heading-elements">
                  </div>
               </div>
               <div class="panel-body no-padding-bottom">
                  <div class="row">
					 <div class="col-md-6 content-group">
                        <img src="<?php echo base_url(); ?>front_assets/images/logo.png" class="content-group mt-10" alt="" style="width: 120px;">
                     </div>
                     <div class="col-md-6 content-group">
                        <div class="invoice-details">
                           <ul class="list-condensed list-unstyled">
                              <li>Order ID: <span class="text-semibold"><?php echo $order_info->order_id;?></span></li>
							  <li>Order Date: <span class="text-semibold"><?php echo date("jS F, Y", strtotime($order_info->order_date)); ?></span></li>
							  <?php
							  if($result_stockist)
							  {
							  ?>
    							  <li>GSTIN: <span class="text-semibold"><?php echo $resultuser->gstin; ?></span></li>
    							  <li>Stockist ID: <span class="text-semibold"><?php echo $resultuser->user_id; ?></span></li>
							  <?php
							  }
							  ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="table-responsive">
                  <table class="table table-lg table-striped table-hover">
                     <thead>
                        <?php
							  if($result_stockist)
							  {
							  ?>
                               <th>#</th>
                               <th>Title</th>
                               <th>Image</th>
                               <th>Old Price</th>
                               <th>Discount</th>
                               <th>Price</th>
                               <th>Qty</th>
                               <th>BV</th>
                               <th>Total Price</th>
                           <?php
							  }
							  else
							  {
                           ?>
                               <th>#</th>
                               <th>Title</th>
                               <th>Image</th>
                               <th>Price</th>
                               <th>Qty</th>
                               <th>BV</th>
                               <th>Total Price</th>
                           <?php
							  }
                           ?>
                     </thead>
                     <tbody>
                        <?php 
						$sno=0;
						foreach($order_details as $details)
						{
							$sno++;
						?>
						<tr>
                           <td><?php echo $sno;?></td>
                           <?php
							  if($result_stockist)
							  {
							      $productoption=$this->getProduct($details->product_id);
							      ?>
							   <td><?php echo $details->product_name;?></td>
                               <td><img width="80" height="80" src="<?php echo base_url().'product_images/'.$details->product_image;?>"></td>
                               <td><?php echo number_format($productoption->old_price,2)."".currency();?></td>
                               <td>20%</td>
                               <td><?php echo number_format($details->product_price,2)."".currency();?></td>
                               <td><?php echo $details->qty;?></td>
                               <td><?php echo $details->bv;?></td>
                               <td><?php echo number_format($details->product_price*$details->qty,2)."".currency();?></td>
							      <?php
							      $bv=$bv+$details->bv;
							  }
							  else
							  {
							  ?>
                                <td><?php echo $details->product_name;?></td>
                                <td><img width='80' height='80' src="<?php echo base_url().'product_images/'.$details->product_image;?>"></td>
                                <td><?php echo number_format($details->product_price,2)."".currency();?></td>
                                <td><?php echo $details->qty;?></td>
                                <td><?php echo $details->bv;?></td>
                                <td><?php echo number_format($details->product_price*$details->qty,2)."".currency();?></td>
                           <?php
                           $bv=$bv+$details->bv;
							  }
                           ?>
                        </tr>
						<?php 
						}
						?>
						
                     </tbody>
                  </table>
               </div>
               <div class="panel-body">
                  <div class="row invoice-payment">
                     <div class="col-sm-6">
                     </div>
                     <div class="col-sm-6">
                        <div class="content-group">
                           <div class="table-responsive no-border">
                              <table class="table table-striped table-hover">
                                 <tbody>
                                     <tr>
                                       <th>Tax:</th>
                                       <td class="text-primary">
                                          <h5 class="text-semibold">Included</h5>
                                       </td>
                                    </tr>
                                    
                                     <tr>
                                       <th>Total BV:</th>
                                       <td class="text-primary">
                                          <h5 class="text-semibold"><?php echo $order_info->final_bv;?></h5>
                                       </td>
                                    </tr>
                                    <tr>
                                       <th>Grand Total:</th>
                                       <td class="text-primary">
                                          <h5 class="text-semibold"><?php echo number_format($order_info->final_price,2)." ".currency();?></h5>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
							  if(!$result_stockist)
							  {
							  ?>
                  <div class="row">
                     <div class="col-md-6 col-lg-9 content-group">
                        <h5>Deliver Address:</h5>
                        <div class="table-responsive">
                           <table class="table table-lg table-striped table-hover">
                              <tbody>
                                 <tr>
                                    <th>Name</th>
                                    <th><?php echo $delivery_info->name;?></th>
                                 </tr>
								 <tr>
                                    <th>Mobile No.</th>
                                    <th><?php echo $delivery_info->mobile_no;?></th>
                                 </tr>
								 <tr>
                                    <th>State</th>
                                    <th><?php echo $delivery_info->state;?></th>
                                 </tr>
								 <tr>
                                    <th>City</th>
                                    <th><?php echo $delivery_info->city;?></th>
                                 </tr>
								 <tr>
                                    <th>Address</th>
                                    <th><?php echo $delivery_info->address;?></th>
                                 </tr>
								<tr>
                                    <th>Landmark</th>
                                    <th><?php echo $delivery_info->landmark;?></th>
                                </tr>
								<tr>
                                    <th>Alternate Mobile No.</th>
                                    <th><?php echo $delivery_info->alternate_mobile_no;?></th>
                                 </tr> 
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <?php
	}
                  ?>
                  <p class="text-muted">Thank you from Jivan</p>
               </div>
        </div>	
	<?php 
	}//end function
}//end class
?>	