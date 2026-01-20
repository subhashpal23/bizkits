<?php
ob_start();
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
		affiliate_auth();
		$this->load->model('eshop_model');
		$this->load->helper("layout_helper");
		$this->user_id=$this->session->userdata('user_id');
		$this->moduleName=$this->router->fetch_module();
		$this->role='2';
		
	}
	//end constructor 
	public function allStockHistory()
	{
	    $order_info=$this->db->select('eshop_products.title,eshop_stock_stockist_history.qty,eshop_stock_stockist_history.order_id,eshop_stock_stockist_history.type,eshop_stock_stockist_history.ts')->from('eshop_stock_stockist_history')
	    ->join('eshop_products','eshop_stock_stockist_history.product_id=eshop_products.id')->where(array('stockist_id'=>$this->user_id))->order_by('eshop_stock_stockist_history.id','desc')->get()->result();
	    $data['allstcoks']=$order_info;
	    $data['title']='All Stock History';
	    _userLayout("ecommerce/order-mgmt/allstockhistory",$data);
	}
	public function allStocks()
	{
	    $order_info=$this->db->select('eshop_products.title,eshop_stock_stockist.qty')->from('eshop_stock_stockist')
	    ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where('stockist_id',$this->user_id)->get()->result();
	    
	    /*$order_info=$this->db->select('eshop_products.title,user_products.*')->from('user_products')
	    ->join('eshop_products','user_products.product_id=eshop_products.id')->where('user_products.user_id',$this->user_id)->get()->result();*/
	    
	    $data['callfunc']=$this;
	    
	    $data['allstcoks']=$order_info;
	    $data['title']='All Monthly Stock';
	    _userLayout("ecommerce/order-mgmt/allstocks",$data);
	}
	
	public function allStockReport()
	{
	    /*$order_info=$this->db->select('eshop_products.title,eshop_stock_stockist.qty')->from('eshop_stock_stockist')
	    ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where('stockist_id',$this->user_id)->get()->result();*/
	    
	    $order_info=$this->db->select('order_details,date(confirm_date) as monthdate')->from('eshop_orders')->where('eshop_orders.user_id',$this->user_id)->get()->result();
	    
	    $data['callfunc']=$this;
	    
	    $data['allstcoks']=$order_info;
	    $data['title']='All Monthly Stock';
	    _userLayout("ecommerce/order-mgmt/allstockreport",$data);
	}
	
	public function getproductquantity($product_id)
	{
	    $order_info=$this->db->select('*')->from('eshop_orders')->where(array('user_id'=>$this->user_id))->get()->result();
	    foreach($order_info as $key=>$val)
	    {
	        $json=json_decode($val->order_details);
	        $qty=0;
	        foreach($json as $k=>$v)
	        {
	            if($v->product_id==$product_id)
	            {
	            $v->product_id;
	            $qty=$qty+$v->qty;
	            $arr[$v->product_id]=$qty;
	            }
	        }
	    }
	    echo $arr[$product_id];
	}
	public function checkStock()
	{
	    $order_id=$this->input->post('order_id');
	    $order_info=$this->db->select('*')->from('eshop_orders')->where('order_id',$order_id)->get()->row();
	    //echo $this->db->last_query();
	    $sponser_id=$order_info->owner_user_id;
	    $arr=json_decode($order_info->order_details);
	    $t=0;
	    $f=0;
	    $tqty=0;
	        foreach($arr as $key=>$val)
	        {
	            $product_id=$val->product_id;
	            $qty=$val->qty;
	            //echo $product_id.'=='.$qty;echo "\n";
	            $tqty=$tqty+$qty;
	            $countstockist=$this->db->query("SELECT * from eshop_stock_stockist where product_id='".$product_id."' and stockist_id='".$sponser_id."'")->num_rows();
	            //echo $this->db->last_query();
	            if($countstockist)
            	{
            	    $resstock=$this->db->query("SELECT * from eshop_stock_stockist where product_id='".$product_id."' and stockist_id='".$sponser_id."'")->row();
            	    //echo $resstock->qty.'>='.$qty;echo "\n";
            	    if($resstock->qty>0 && ($resstock->qty>=$qty))
            	    {
            	        $t=$t+$qty;
            	    }
            	    else
            	    {
            	        $t=$t-$qty;
            	    }
            	}
            	else
            	{
            	    $t=$t-$qty;
            	}
	        }
	        //echo $tqty.'=='.$t;
	        if($t==$tqty)
	        {
	            echo 'success';
	        }
	}
	public function change_status_stockist($order_id,$order_status,$url)
	{
	    //echo $order_id.",".$order_status.",".$url;
	    $order_info=$this->db->select('*')->from('eshop_orders')->where('order_id',$order_id)->get()->row();
	    $sponser_id=$order_info->owner_user_id;
	    if($order_status==1 && $order_info->order_status==0 && $order_info->stockist_bonus=='')
	    {
	        $arr=json_decode($order_info->order_details);
	        foreach($arr as $key=>$val)
	        {
	            $product_id=$val->product_id;
	            $qty=$val->qty;
	            
	            $result=$this->db->query("SELECT * from eshop_stock where product_id='".$product_id."'")->row();
        	    $assign_stockist_all=$result->assign_stockist;
        	    $qtyall=0;
        	    $qtyall=$assign_stockist_all-$qty;
        	        
        	    if($assign_stockist_all>0 && ($assign_stockist_all>=$qty))
        	    {
        	        $this->db->update('eshop_stock',array('assign_stockist'=>$qtyall),array('product_id'=>$product_id));
        	        $countstockist=$this->db->query("SELECT * from eshop_stock_stockist where product_id='".$product_id."' and stockist_id='".$sponser_id."'")->num_rows();
        	        //echo $this->db->last_query();
        	        //echo $countstockist;
            	     if($countstockist)
            	     {
            	         $resstock=$this->db->query("SELECT * from eshop_stock_stockist where product_id='".$product_id."' and stockist_id='".$sponser_id."'")->row();
            	         //echo $this->db->last_query();
            	         $qtystock=$resstock->qty-$qty;
            	         if($resstock->qty>0 && ($resstock->qty>=$qty))
            	         {
            	            $this->db->update('eshop_stock_stockist',array('qty'=>$qtystock),array('product_id'=>$product_id,'stockist_id'=>$sponser_id));
            	            $this->db->insert('eshop_stock_stockist_history',array('qty'=>$qty,'product_id'=>$product_id,'stockist_id'=>$sponser_id,'order_id'=>$order_id,'type'=>2));
            	         }
            	     }
        	    }
	        }
	        $stockist_bonus=1;
    	    $user_info=$this->db->select('*')->from('user_registration')->where('user_id',$order_info->user_id)->get()->row();
    	    $pkg_id=$user_info->pkg_id;
    	    $pkg_amount=$user_info->pkg_amount;
    	    $pkg_info=$this->db->select('*')->from('package')->where('id',$user_info->pkg_id)->get()->row();
    	    $commission_amount=(($order_info->final_pv*8)/100)*500;
    	    
    	    $query_obj=$this->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
			$balance=$query_obj->amount+$commission_amount;
			$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1));
			$this->db->insert('credit_debit',array(
			    'transaction_no'=>generateUniqueTranNo(),
			    'user_id'=>$sponser_id,
			    'credit_amt'=>$commission_amount,
			    'debit_amt'=>'0',
			    'balance'=>$balance,
			    'admin_charge'=>'0',
			    'receiver_id'=>$sponser_id,
				/*'pkg_id'=>$pkg_id,*/
				'order_id'=>$order_id,
				/*'pkg_amount'=>$pkg_amount,*/
			    'sender_id'=>$order_info->user_id,
			    'receive_date'=>date('Y-m-d'),
			    'ttype'=>'Stockist Bonus',
			    'TranDescription'=>'Stockist Bonus',
			    'Cause'=>'Stockist Bonus',
			    'Remark'=>'Stockist Bonus',
			    'product_name'=>'main',
			    'deposit_id'=>1,
			    'status'=>'1',
			    'ewallet_used_by'=>'Withdrawal Wallet',
			    'current_url'=>site_url(),
			    'reason'=>'18' //credit for matrix direct commission
		        ));
		        
		        $this->db->update('eshop_orders',array('stockist_bonus'=>$stockist_bonus),array('order_id'=>$order_id));
	    }
		        $this->db->update('eshop_orders',array('order_status'=>$order_status,'confirm_date'=>date('Y-m-d H:i:s')),array('order_id'=>$order_id));
		        redirect(base_url().'Affiliate/Eshop_Orders/'.$url);
	}
	/////////////orders function   all,complete,rejected,pending delivered//////////////////////
	public function invoice($order_id=null)
	{
	    $order_info=$this->db->select('*')->from('eshop_orders')->where('order_id',$order_id)->get()->row();
		//pr($order_info);
		$order_details=json_decode($order_info->order_details);
		$data['module_name']=$this->moduleName;
		$data['order_details']=$order_details;
		$data['cart']=$order_details;
		$data['info']=$order_info;
			
		$binfo=$this->db->select('*')->from('eshop_guest_delivery_address')->where(array('order_id'=>$order_id,'type'=>0))->get()->row();
		$data['billinginfo']=$binfo;
		
		$sinfo=$this->db->select('*')->from('eshop_guest_delivery_address')->where(array('order_id'=>$order_id,'type'=>1))->get()->row();
		$data['shippinginfo']=$sinfo;
		//pr($data);
		_userLayout("ecommerce/order-mgmt/invoice",$data);
	}
	public function saleinvoice($order_id=null)
	{
	    $order_info=$this->db->select('*')->from('eshop_orders_customer')->where('order_id',$order_id)->get()->row();
		//pr($order_info);
		$order_details=json_decode($order_info->order_details);
		$data['module_name']=$this->moduleName;
		$data['order_details']=$order_details;
		$data['guest_id']=$guest_id=$order_info->guest_id;
		$data['cart']=$order_details;
		$data['info']=$order_info;
			
		$binfo=$this->db->select('*')->from('eshop_customer')->where(array('id'=>$guest_id))->get()->row();
		$data['billinginfo']=$binfo;
		$data['userinfo']=get_userdetail($this->user_id);
	
		//pr($data);
		_userLayout("ecommerce/order-mgmt/saleinvoice",$data);
	}
	public function allOrders($type=false)
	{	  	 
		$data['title']='All '.ucfirst($type).'s';
		$data['type']=$type;
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('user_id'=>$this->user_id,$type=>1))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	public function allSales($type=false)
	{	  	 
		$data['title']='All Sales';
		$data['type']=$type;
		$all_order=$this->db->select('*')->from('eshop_orders_customer')->where(array('user_id'=>$this->user_id))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-sales",$data);
	}
	public function allStockistOrders()
	{	  	 
		$data['title']='All Orders';
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('owner_user_id'=>$this->user_id))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-stockist-orders",$data);
	}
	
	public function bvList()
	{	  	 
		$data['title']='All PV List';	
		$all_order=$this->db->select('*')->from('matrix_direct_pv')->where(array('income_id'=>$this->user_id))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-bv",$data);
	}
	
	public function getBVList($month,$level)
	{	  	 
		$data['title']='All PV List';
		$where['income_id']=$this->user_id;
		if($level=='All')
		{
		    
		}
		else
		{
		    $where['level']=$level;
		}
		if($month=='All')
		{
		   $month=date('m');
		     
		}
		$sdate=date('Y-'.$month.'-01');
		$edate=date('Y-'.$month.'-31'); 
		$where['l_date >= ']=$sdate;
		$where['l_date <= ']=$edate;
		//array('income_id'=>$this->user_id,'level'=>$level,'l_date >= '=>$sdate,'l_date <= '=>$edate);
		
		$all_order=$this->db->select('*')->from('matrix_direct_pv')->where($where)->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['level']=$level;
		$data['month']=$month;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-bv",$data);
	}
	
	public function allPendingOrders()
	{
		$data['title']='Pending Orders';	
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('order_status'=>'0','user_id'=>$this->user_id))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-pending-orders",$data);
	}
	
	public function allConfirmedOrder()
	{
		$data['title']='Confirmed Orders';		
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('order_status'=>'1','user_id'=>$this->user_id))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-confirmed-orders",$data);
	}
	
	public function allRejectedOrders()
	{
		$data['title']='Rejected Orders';		
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('order_status'=>'2','user_id'=>$this->user_id))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-rejected-orders",$data);
	}
	
	public function allDeliveredOrders()
	{
		$data['title']='Delivered Orders';		
		$data['module_name']=$this->moduleName;
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('order_status'=>'3','user_id'=>$this->user_id))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['module_name']=$this->moduleName;
		_userLayout("ecommerce/order-mgmt/all-delivered-orders",$data);
	}
	/////////////orders function   all,complete,rejected,pending delivered//////////////////////
	public function getProduct($id)
	{
		 $result=$this->db->query("SELECT * from eshop_products where id='".$id."' order by id desc")->row();	     	
		 return $result;
		 //$data['module_name']=$this->moduleName;
		//_adminLayout("ecommerce/eshop-mgmt/all-products",$data);
	}
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
			$delivery_info=$this->db->select('*')->from('eshop_guest_delivery_address')->where('order_id',$order_id)->where('type',1)->get()->row();
			$address_info=json_decode($delivery_info->address_info);
			$name = $address_info->fname.' '.$address_info->lname ;
			$mobile_no =$address_info->phone ;
			$state =$address_info->state ;
			$city =$address_info->city ;
			$country =$address_info->country ;
			$zipcode =$address_info->zipcode ;
			$address = $address_info->address ;
			$email = $address_info->email;
			
		}
		else if($order_info->role=='3')
		{
			//eshop_guest_delivery_address
			$delivery_info=$this->db->select('*')->from('eshop_guest_delivery_address')->where('order_id',$order_id)->where('type',1)->get()->row();
			$name = $delivery_info->name ;
			$mobile_no =$delivery_info->mobile_no ;
			$state =$delivery_info->state ;
			$city =$delivery_info->city ;
			$address = $delivery_info->address ;
			$landmark = $delivery_info->landmark;
		}
		if(empty($delivery_info))
		{
			$delivery_info_user=$this->db->select('*')->from('user_registration')->where('user_id',$order_info->user_id)->get()->row();
			$name = $delivery_info_user->first_name." ".$delivery_info_user->last_name;
			$mobile_no = $delivery_info_user->contact_no;
			$state =$delivery_info_user->state;
			$city = $delivery_info_user->city;
			$address =$delivery_info_user->address_line1." ".$delivery_info_user->address_line2;
			$landmark =$delivery_info_user->country;
			
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
               <!--<div class="panel-heading">
                  <h6 class="panel-title">Order Details</h6>
                  <div class="heading-elements">
                  </div>
               </div>-->
               <div class="panel-body no-padding-bottom">
                  <div class="row">
					 <div class="col-md-6 content-group">
                        <img src="<?php echo base_url(); ?>estore_assets/images/logo.png" class="content-group mt-10" alt="" style="width: 120px;">
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
                        <tr>
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
                           <th>Transaction Fees</th>
						   <th>handling Fees</th>
                           <th>Price</th>
                           <th>Qty</th>
                           <th>Total Price</th>
                           <?php
							  }
                           ?>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
						$sno=0;
						$bv=0;
						foreach($order_details as $details)
						{
							//pr($details);
							foreach($details->pickup_region as $keyr=>$valr)
								   {
									   foreach($valr as $keyl=>$vall)
									   {
										   foreach($vall as $keyd=>$vald)
										   {
											   foreach($vald as $keyt=>$valt)
											   {
												   //$total_amount=$details['product_price']*$valt['qty'];
												   //$grant_total_amount=$grant_total_amount+$total_amount;
												   //$total_qty=$total_qty+$valt['qty'];
												   
											   
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
								  $subtotal=$details->product_price*$valt->qty;
								  $handling_fees=($subtotal*2.9)/100;
								 $total=$subtotal+$order_info->transaction_fees+$handling_fees; 
							  ?>
                           <td><?php echo $details->product_name;?>
						   <br>
										<span><strong>Pickup Region:</strong> <?php $pickup_region = str_replace("-", " ", $keyr); echo strtoupper($pickup_region);?></span><br>
										<span><strong>Pickup Locations:</strong> <?php $pickup_location = str_replace("-", " ", $keyl); echo strtoupper($pickup_location);?></span><br>
										<span><strong>Available Pickup Date:</strong> <?php $pickup_date = str_replace("-", " ", $keyd); echo strtoupper($pickup_date);?></span><br>
										<span><strong>Preferred Pickup Time:</strong> <?php $pickup_time = str_replace("-", " ", $keyt); echo strtoupper($pickup_time);?></span></td>
                           <td><?php echo number_format($order_info->transaction_fees,2)."".currency();?></td>
						   <td><?php echo number_format($order_info->handling_fees,2)."".currency();?></td>
                           <td><?php echo number_format($details->product_price,2)."".currency();?></td>
                           <td><?php echo $valt->qty;?></td>
                           <td><?php echo number_format($total,2)."".currency();?></td>
                           <?php
							  }
                           ?>
                        </tr>
						<?php 
											}
										   }
									   }
								   }
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
                                       <th>Shipping:</th>
                                       <td class="text-primary">
                                          <h5 class="text-semibold">Included</h5>
                                       </td>
                                    </tr>
                                    <?php
        							  if($result_stockist)
        							  {
        							?>
                                     <tr>
                                       <th>Total BV:</th>
                                       <td class="text-primary">
                                          <h5 class="text-semibold"><?php echo $bv;?></h5>
                                       </td>
                                    </tr>
                                    <?php
        							  }
                                    ?>
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
                  <div class="row">
                     <div class="col-md-6 col-lg-9 content-group">
                        <h5>Deliver Address:</h5>
                        <div class="table-responsive">
                           <table class="table table-lg table-striped table-hover">
                              <tbody>
                                 <tr>
                                    <th>Name</th>
                                    <th><?php echo $name;?></th>
                                 </tr>
								 
								 <tr>
                                    <th>State</th>
                                    <th><?php echo $state;?></th>
                                 </tr>
								 <tr>
                                    <th>City</th>
                                    <th><?php echo $city;?></th>
                                 </tr>
								 <tr>
                                    <th>Address</th>
                                    <th><?php echo $address;?></th>
                                 </tr>
								<tr>
                                    <th>Country</th>
                                    <th><?php echo ucfirst($country);?></th>
                                </tr>
								<tr>
                                    <th>Zip Code</th>
                                    <th><?php echo ucfirst($zipcode);?></th>
                                </tr>
								
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <p class="text-muted">Thank you from  Cargolink International</p>
               </div>
        </div>	
	<?php 
	}//end function
}//end class
?>	