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
		admin_auth();
		$this->load->model('eshop_model');
		$this->load->helper("layout_helper");
		$this->user_id=$this->session->userdata('user_id');
		$this->moduleName=$this->router->fetch_module();
		$this->role='1';
		
	}
	//end constructor 
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
	public function invoicereturn($order_id=null)
	{
	    $order_info=$this->db->select('*')->from('eshop_order_return')->where('order_id',$order_id)->get()->row();
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
		_userLayout("ecommerce/order-mgmt/invoicereturn",$data);
	}
	
	public function monthlyBill()
	{
	    // get total orders amount and discount and taxes
	    // get total return amount and discount and taxes
	    // calculat total amounts and discount and taxes
	    //pr($_POST);
	    if(!empty($this->input->post('search')))
	    {
	        $user_id=$this->input->post('user_id');
	        $month=$this->input->post('month');
	        $year=$this->input->post('year');
	        $fromdate=date($year.'-'.$month.'-01 00:00:00');
	        $todate=date($year.'-'.$month.'-t 23:59:59');
	        
	        // get all transfered between this period
	        $trasfered=$this->db->query("select * from eshop_orders where user_id='".$user_id."' and order_date between '".$fromdate."' and '".$todate."' and order_status=1 ")->result();
	        //pr($trasfered);
	        $returned=$this->db->query("select * from eshop_order_return where user_id='".$user_id."' and order_date between '".$fromdate."' and '".$todate."' and order_status=1 ")->result();
	       //pr($returned);
	    }
	    $data['callfunc']=$this;
	    
	    $data['trasfered']=$trasfered;
	    $data['returned']=$returned;
	    $data['allusers']=$this->db->select('*')->from('user_registration')->get()->result();;
	    $data['title']='All Monthly Stock';
	    _userLayout("ecommerce/order-mgmt/monthlybill",$data);
	    
	}
	public function printBill($user_id=null,$month,$year)
	{
	    $fromdate=date($year.'-'.$month.'-01 00:00:00');
	        $todate=date($year.'-'.$month.'-t 23:59:59');
	    // get all transfered between this period
	        $trasfered=$this->db->query("select * from eshop_orders where user_id='".$user_id."' and order_date between '".$fromdate."' and '".$todate."' and order_status=1 ")->result();
	        //pr($trasfered);
	        $returned=$this->db->query("select * from eshop_order_return where user_id='".$user_id."' and order_date between '".$fromdate."' and '".$todate."' and order_status=1 ")->result();
	       //pr($returned);
		$data['module_name']=$this->moduleName;
		$total_transfered=0;
		foreach($trasfered as $key=>$val)
		{
		    $order_detail[]=$val->order_details;
		    $total=$val->final_price;
		    $tax=$val->final_pv;
		    $discount=$val->discount;
		    $subtoal=$total+$tax-$discount;
		    $total_transfered=$total_transfered+$subtoal;
		}
		$order_details=$order_detail;
		$data['order_details']=$order_details;
		$total_return=0;
		foreach($returned as $key=>$val)
		{
		    $return_detail[]=$val->order_details;
		    $total=$val->final_price;
		    $tax=$val->final_pv;
		    $discount=$val->discount;
		    $subtoal=$total+$tax-$discount;
		    $total_return=$total_return+$subtoal;
		}
		
		$data['return_details']=$return_detail;
		$data['total_transfered']=$total_transfered;
		$data['total_return']=$total_return;
		$binfo=$this->db->select('*')->from('user_registration')->where(array('user_id'=>$user_id))->get()->row();
		$data['billinginfo']=$binfo->ref_leg_position;
		
		$data['shippinginfo']=$binfo->ref_nom_Position;
		//pr($data);
		_userLayout("ecommerce/order-mgmt/printbill",$data);
	}
	
	public function allStockHistory($pid=null,$user_id=null)
	{
	    if($pid!='' && $user_id!='')
	    {
	        $order_info=$this->db->select('eshop_products.title,eshop_stock_stockist_history.stockist_id,eshop_stock_stockist_history.qty,eshop_stock_stockist_history.order_id,eshop_stock_stockist_history.type,eshop_stock_stockist_history.ts')->from('eshop_stock_stockist_history')
	    ->join('eshop_products','eshop_stock_stockist_history.product_id=eshop_products.id')->where(array('eshop_stock_stockist_history.product_id'=>$pid,'eshop_stock_stockist_history.stockist_id'=>$user_id))->order_by('eshop_stock_stockist_history.id','desc')->get()->result();
	    }
	    else
	    {
	    $order_info=$this->db->select('eshop_products.title,eshop_stock_stockist_history.stockist_id,eshop_stock_stockist_history.qty,eshop_stock_stockist_history.order_id,eshop_stock_stockist_history.type,eshop_stock_stockist_history.ts')->from('eshop_stock_stockist_history')
	    ->join('eshop_products','eshop_stock_stockist_history.product_id=eshop_products.id')->order_by('eshop_stock_stockist_history.id','desc')->get()->result();
	    }
	    $data['allstcoks']=$order_info;
	    $data['title']='All Stock History';
	    _userLayout("ecommerce/order-mgmt/allstockhistory",$data);
	}
	public function allStocks()
	{
	    //pr($_POST);
	    
	    if($this->input->post('search')!='')
	    {
	       $user_id=$this->input->post('user_id');
	       $month=$this->input->post('month');
	       $year=$this->input->post('year');
	       $fromdate=date($year.'-'.$month.'-01 00:00:00');
	       $todate=date($year.'-'.$month.'-t 23:59:59');
	       /*$order_info=$this->db->select('eshop_products.id,eshop_products.title,eshop_stock_stockist.qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where(array('eshop_stock_stockist.stockist_id'=>$user_id,''))->get()->result();*/
	        $order_info=$this->db->select('eshop_products.id,eshop_products.title,sum(eshop_stock_stockist.qty) as qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where(array('eshop_stock_stockist.stockist_id'=>$user_id,'start_date >='=>$fromdate,'end_date <='=>$todate))
	       ->group_by('eshop_stock_stockist.product_id')->get()->result();
	    }
	    else
	    {
	        $year=date('Y');
	        $month=date('m');
	        $fromdate=date($year.'-'.$month.'-01 00:00:00');
	        $todate=date($year.'-'.$month.'-t 23:59:59');
	        /*$order_info=$this->db->select('eshop_products.id,eshop_products.title,eshop_stock_stockist.qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->get()->result();*/
	        $order_info=$this->db->select('eshop_products.id,eshop_products.title,sum(eshop_stock_stockist.qty) as qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where(array('start_date >='=>$fromdate,'end_date <='=>$todate))->group_by('eshop_stock_stockist.product_id')->get()->result();
	       
	    }
	    
	    /*$order_info=$this->db->select('eshop_products.title,user_products.*')->from('user_products')
	    ->join('eshop_products','user_products.product_id=eshop_products.id')->where('user_products.user_id',$this->user_id)->get()->result();*/
	    
	    $data['callfunc']=$this;
	    
	    $data['allstcoks']=$order_info;
	    $data['allusers']=$this->db->select('*')->from('user_registration')->get()->result();;
	    $data['title']='All Monthly Stock';
	    _userLayout("ecommerce/order-mgmt/allstocks",$data);
	}
	
	public function allReports($user_id)
	{
	    $user_id=ID_decode($user_id);
	    //pr($_POST);
	    $year=date('Y');
	    $month=date('m');
	    $fromdate=date($year.'-'.$month.'-01 00:00:00');
	    $todate=date($year.'-'.$month.'-t 23:59:59');
	       /*$order_info=$this->db->select('eshop_products.id,eshop_products.title,eshop_stock_stockist.qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where(array('eshop_stock_stockist.stockist_id'=>$user_id,''))->get()->result();*/
	    $order_info=$this->db->select('eshop_products.id,eshop_products.title,sum(eshop_stock_stockist.qty) as qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where(array('eshop_stock_stockist.stockist_id'=>$user_id,'start_date >='=>$fromdate,'end_date <='=>$todate))
	       ->group_by('eshop_stock_stockist.product_id')->get()->result();
	    
	    
	    $all_order=$this->db->select('*')->from("eshop_order_return where user_id='".$user_id."'")->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
	    
	    $data['callfunc']=$this;
	    
	    $data['allstcoks']=$order_info;
	    //$data['allusers']=$this->db->select('*')->from('user_registration')->get()->result();;
	    $data['title']='All Monthly Stock';
	    _userLayout("ecommerce/order-mgmt/customerstocks",$data);
	}
	public function getproductquantity($product_id,$user_id)
	{
	    $year=date('Y');
	        $month=date('m');
	        $fromdate=date($year.'-'.$month.'-01 00:00:00');
	        $todate=date($year.'-'.$month.'-t 23:59:59');
	        $order_info=$this->db->select('sum(eshop_stock_stockist.qty) as qty')->from('eshop_stock_stockist')->where(array('eshop_stock_stockist.product_id'=>$product_id,'eshop_stock_stockist.stockist_id'=>$user_id,'start_date >='=>$fromdate,'end_date <='=>$todate,'end_date <>'=>'0000-00-00'))->group_by('eshop_stock_stockist.product_id')->get()->row();
	        //echo $this->db->last_query();
	        return $order_info->qty;
	}
	public function stockReturn($product_id,$user_id)
	{
	    //pr($_POST);
	    //echo $product_id.'=='.$user_id; exit;
	   
	        $year=date('Y');
	        $month=date('m');
	        $fromdate=date($year.'-'.$month.'-01 00:00:00');
	        $todate=date($year.'-'.$month.'-t 23:59:59');
	        /*$order_info=$this->db->select('eshop_products.id,eshop_products.title,eshop_stock_stockist.qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->get()->result();*/
	        $order_info=$this->db->select('eshop_products.id,eshop_products.title,sum(eshop_stock_stockist.qty) as qty,eshop_stock_stockist.stockist_id')->from('eshop_stock_stockist')
	       ->join('eshop_products','eshop_stock_stockist.product_id=eshop_products.id')->where(array('eshop_products.id'=>$product_id,'eshop_stock_stockist.stockist_id'=>$user_id,'start_date >='=>$fromdate,'end_date <='=>$todate,'end_date <>'=>'0000-00-00'))->group_by('eshop_stock_stockist.product_id')->get()->result();
	       
	    
	    //echo $this->db->last_query();
	    /*$order_info=$this->db->select('eshop_products.title,user_products.*')->from('user_products')
	    ->join('eshop_products','user_products.product_id=eshop_products.id')->where('user_products.user_id',$this->user_id)->get()->result();*/
	    
	    $data['callfunc']=$this;
	    $data['product_id']=$product_id;
	    $data['user_id']=$user_id;
	    $data['allstcoks']=$order_info;
	    $data['allusers']=$this->db->select('*')->from('user_registration')->get()->result();;
	    $data['title']='All Monthly Stock';
	    _userLayout("ecommerce/order-mgmt/returnstocks",$data);
	}
	
	public function generateUniqueOrderId()
	{
	    $random_number="RT".mt_rand(100000, 999999);
	    if($this->db->select('order_id')->from('eshop_order_return')->where('order_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueOrderId();
	    }
	    return $random_number;
	}
	public function returnStocks($product_id,$user_id)
	{
	    /*pr($_POST);
	    echo $product_id.'=='.$user_id; exit;*/
	    
	    $owner_user_id=$this->session->userdata('user_id');
	    $order_id=$this->generateUniqueOrderId();
	    $product_stock_info=$this->db->select(array('title','qty','total_order','guest_point','new_price','discount','discount_type','product_image','tax'))->from('eshop_products')->where('id',$product_id)->get()->row();
	    $final_stock=$product_stock_info->qty+$_POST['return'];
	    $total_order=$product_stock_info->total_order+1;
	    $new_price=$product_stock_info->new_price;
	    $product_image=$product_stock_info->product_image;
	    $product_name=$product_stock_info->title;
	    $discount1=(int)$product_stock_info->discount;
	    $discount=$discount1*$_POST['return'];
	    $cart_final_price=$_POST['return']*$new_price;
	    if($product_stock_info->discount_type=='per')
		 {
		     $discount=((int)$product_stock_info->new_price*(int)$product_stock_info->discount)/100;
		     $cart_total_discount=$cart_total_discount+($_POST['return']*$discount);
		 }
		 else
		 {
		     $discount=$product_stock_info->discount;
		    $cart_total_discount=$cart_total_discount+($_POST['return']*$discount);
		 }
    	$discount1=(int)$discount;
    	$tax=((int)$product_stock_info->new_price*(int)$product_stock_info->tax)/100;
        		     $cart_total_tax=$cart_total_tax+($_POST['return']*$tax);
	    $date=date('Y-m-d');
	    $this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product_id));
    	$this->db->update('eshop_stock',array('qty'=>$final_stock),array('product_id'=>$product_id));
    	//$stock_count=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product_id,'stockist_id'=>$user_id,'start_date >='>$date,'end_date <='=>$date))->get()->num_rows();
    	$stock_count=$this->db->query('select * from eshop_stock_stockist where product_id='.$product_id.' and stockist_id="'.$user_id.'" and "'.$date.'" between start_date and end_date')->num_rows();
         //echo $this->db->last_query(); exit;
		if($stock_count)
		{
		    $fdate=date('Y-m-1');
        	$tdate=date('Y-m-t');
		    //$stock_info=$this->db->select_sum('qty')->from('eshop_stock_stockist')->where(array('product_id'=>$product_id,'stockist_id'=>$user_id,'start_date >='>$fdate,'end_date <='=>$tdate))->get()->row();
		    //echo $stock_info->qty.'=='.$_POST['return'];
		    $stock_info=$this->db->query('select qty,id from eshop_stock_stockist where product_id='.$product_id.' and stockist_id="'.$user_id.'" and start_date>="'.$fdate.'" and end_date>="'.$tdate.'"')->row();
        
		    //echo $this->db->last_query(); exit;
		    $user_final_stock=$stock_info->qty-$_POST['return']; 
		    $this->db->update('eshop_stock_stockist',array('qty'=>$user_final_stock),array('id'=>$stock_info->id));
		    //$this->db->insert('eshop_stock_stockist_history',array('type'=>0,'qty'=>$_POST['return'],'product_id'=>$product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
		}
      
         			
	    $items[]=array('product_id'=>$product_id,'product_name'=>$product_name,'qty'=>$_POST['return'],'product_price'=>$new_price,'product_image'=>$product_image);
	    $eshopdata=array(
        				'order_id'=>$order_id,
        				'user_id'=>$user_id,
        				'owner_user_id'=>$owner_user_id,
        				'order_from'=>'eshop',
        				'order_details'=>json_encode($items),
        				'total_products'=>1,
        				'total_product_qty'=>$_POST['return'],
        				'discount'=>$cart_total_discount,
        				'final_price'=>$cart_final_price,
        				'final_pv'=>$cart_total_tax
        				);
        				//pr($eshopdata); exit;
        				$this->db->insert('eshop_order_return',$eshopdata);
        				
        				redirect(base_url().'Admin/Eshop_orders/allStocks');
	}
	public function allOrdersCommission()
	{	  	 
		$data['title']='All Commissions';	
		//$all_order=$this->db->select('*')->from('eshop_orders')->order_by('id','desc')->get()->result();
		$where='';
		$order_id=$this->input->post('orderid');
		
		    $where.=" where e.order_id='$order_id'";
		
		$all_order=$this->db->query("SELECT sum(c.credit_amt) as amount,c.order_id,e.order_id,e.user_id,e.final_price,e.final_bv,e.discount,e.order_date FROM `credit_debit` as c inner join eshop_orders as e on c.order_id=e.order_id $where group by c.order_id")->result();
		//pr($all_order); exit;
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['order_id']=$order_id;
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders-commission",$data);
	}
	public function monthlyOrders()
	{	  	 
		$data['title']='All Orders';	
		$all_order=$this->db->select('*')->from('eshop_orders')->where('bill',1)->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/monthly-orders",$data);
	}
	public function allOrders()
	{	  	 
		$data['title']='All Orders';	
		$all_order=$this->db->select('*')->from('eshop_orders')->where('bill',1)->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	public function allReturnOrders()
	{	  	 
		$data['title']='All Returns';	
		$all_order=$this->db->select('*')->from('eshop_order_return')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-return-orders",$data);
	}
	public function allEOrders()
	{	  	 
		$data['title']='All Orders';	
		$all_order=$this->db->select('*')->from('eshop_orders')->where('order_from','eshop')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	public function allROrders()
	{	  	 
		$data['title']='All Orders';	
		$all_order=$this->db->select('*')->from('eshop_orders')->where('order_from','register')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	public function allUOrders()
	{	  	 
		$data['title']='All Orders';	
		$all_order=$this->db->select('*')->from('eshop_orders')->where('order_from','upgrade')->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		$data['callfunc']=$this;
		_adminLayout("ecommerce/order-mgmt/all-orders",$data);
	}
	
	public function getpackagediff($oldpkg_id,$nwpkg_id)
	{
	    $oldinfo=$this->db->select('*')->from('package')->where('id',$oldpkg_id)->order_by('id','desc')->get()->row();
	    //echo $this->db->last_query();
	    $newinfo=$this->db->select('*')->from('package')->where('id',$nwpkg_id)->order_by('id','desc')->get()->row();
	    //echo $this->db->last_query();
	    $diffamount=$newinfo->amount-$oldinfo->amount;
	    $diffpv=$newinfo->pv-$oldinfo->pv;
	    return json_encode(array('amount'=>$diffamount,'pv'=>$diffpv));
	}
	public function OldUpgradeOrders()
	{	  	 
		$data['title']='Old Upgrade Orders';	
		$all_order=$this->db->select('*')->from('user_package_log')->where(array('old_package_id !='=>'NULL','id <'=>1524))->order_by('id','desc')->get()->result();
		//pr($all_order);
		$data['all_orders']=$all_order;
		$data['order_type']='all';
		$data['module_name']=$this->moduleName;
		$data['callfunc']=$this;
		_adminLayout("ecommerce/order-mgmt/all-u-orders",$data);
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
		$user_id=$this->session->userdata('user_id');
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('order_status'=>'0','quote'=>1,'bill'=>0))->order_by('id','desc')->get()->result();
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
		$all_order=$this->db->select('*')->from('eshop_orders')->where(array('order_status'=>'1','quote'=>1,'bill'=>1))->order_by('id','desc')->get()->result();
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
	public function change_status($order_id=null,$order_status=null,$url=null)
    {
        //$order_id='OR672872';
		//$order_status='1';
		$date=date('Y-m-d');
		$this->db->update('eshop_orders',array('order_status'=>$order_status,'bill'=>1,'confirm_date'=>date('Y-m-d')),array('order_id'=>$order_id));
		$order_info=$this->db->select(array('*'))->from('eshop_orders')->where(array('order_id'=>$order_id))->get()->row();
		$arr=json_decode($order_info->order_details);
		$user_id=$order_info->user_id;
		foreach($arr as $key=>$product)
		{
		    
		    $product_stock_info=$this->db->select(array('qty','total_order','guest_point','new_price'))->from('eshop_products')->where('id',$product->product_id)->get()->row();
		    $final_stock=$product_stock_info->qty-$product->qty;
		    $total_order=$product_stock_info->total_order+1;
		    $this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));
		    $this->db->update('eshop_stock',array('qty'=>$final_stock),array('product_id'=>$product->product_id));
		    
		    $stock_count=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id,'start_date >='>$date,'end_date <='=>$date))->get()->num_rows();
				if($stock_count)
				{
				    $stock_info=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id))->get()->row();
				    $user_final_stock=$stock_info->qty+$product->qty;
				    $this->db->update('eshop_stock_stockist',array('qty'=>$user_final_stock),array('product_id'=>$product->product_id,'stockist_id'=>$user_id,'start_date >='>$date,'end_date <='=>$date));
				    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
				}
				else
				{
				    $fdate=date('Y-m-01');
				    $tdate=date('Y-m-31');
				    $user_final_stock=$product->qty;
				    $this->db->insert('eshop_stock_stockist',
				    array(
				        'qty'=>$user_final_stock,
				        'product_id'=>$product->product_id,
				        'stockist_id'=>$user_id,
				        'start_date'=>$fdate,
				        'end_date'=>$tdate));
				    
				    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
				}
		}
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Status Changed Successfully</span>');
		redirect(site_url().$this->moduleName."/Eshop_orders/".$url);
		exit();
    }
    public function change_status_upgrade($upgrade_id=null)
    {
        //$order_id='OR672872';
		//$order_status='1';
		$order_info=$this->db->select('*')->from('user_package_log')->where('id',$upgrade_id)->get()->row();
	    
	    if(($order_info->stockist_bonus!='1') && ($this->session->userdata('username')=='admineshop'))
	    {
	        $nwpkg_id=$order_info->new_package_id;
	        $oldpkg_id=$order_info->old_package_id;
	        $redd=$this->getpackagediff($oldpkg_id,$nwpkg_id);
	        $reddarray=json_decode($redd);
	        $stockist_bonus=1;
    	    $user_info=$this->db->select('*')->from('user_registration')->where('user_id',$order_info->user_id)->get()->row();
    	    $pkg_id=$user_info->pkg_id;
    	    $pkg_amount=$user_info->pkg_amount;
    	    $pkg_info=$this->db->select('*')->from('package')->where('id',$user_info->pkg_id)->get()->row();
    	    $commission_amount=(($reddarray->pv*8)/100)*500;
    	    $sponser_id=123456;
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
		        
		        $this->db->update('user_package_log',array('stockist_bonus'=>$stockist_bonus),array('id'=>$upgrade_id));
	    }
		
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Status Changed Successfully</span>');
		redirect(site_url().$this->moduleName."/Eshop_orders/OldUpgradeOrders");
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
	/*	$result_stockist=$this->db->query("SELECT * from eshop_stockist_sell where order_id='".$order_id."' order by id desc")->row();
		$result_stockist->stockist_id;
		if($result_stockist)
		{
		    $resultuser=$this->db->query("SELECT * from admin_sub where id='".$result_stockist->stockist_id."' order by id desc")->row();	 
		    $stockist_userid=$resultuser->user_id;
		}*/
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
                        
                               <th>#</th>
                               <th>Title</th>
                               <th>Image</th>
                               <th>Price</th>
                               <th>Qty</th>
                               <!--<th>PV</th>-->
                               <th>Total Price</th>
                           
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
                          
                                <td><?php echo $details->product_name;?></td>
                                <td><img width='80' height='80' src="<?php echo base_url().'product_images/'.$details->product_image;?>"></td>
                                <td><?php echo number_format($details->product_price,2)."".currency();?></td>
                                <td><?php echo $details->qty;?></td>
                                <!--<td><?php echo $details->final_pv;?></td>-->
                                <td><?php echo number_format($details->product_price*$details->qty,2)."".currency();?></td>
                           
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
                  <!--<div class="row">
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
                  </div>-->
                  <?php
	}
                  ?>
                  <p class="text-muted">Thank you from Dhanasvi Office Solutions</p>
               </div>
        </div>	
	<?php 
	}//end function
	
	public function getReturnDetails()
	{
		$order_id=$this->input->post('order_id');
		//$order_id='OR172321';
		$order_info=$this->db->select('*')->from('eshop_order_return')->where('order_id',$order_id)->get()->row();
		//pr($order_info);
		$order_details=json_decode($order_info->order_details);
		//pr($order_details);
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
	/*	$result_stockist=$this->db->query("SELECT * from eshop_stockist_sell where order_id='".$order_id."' order by id desc")->row();
		$result_stockist->stockist_id;
		if($result_stockist)
		{
		    $resultuser=$this->db->query("SELECT * from admin_sub where id='".$result_stockist->stockist_id."' order by id desc")->row();	 
		    $stockist_userid=$resultuser->user_id;
		}*/
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
                        
                               <th>#</th>
                               <th>Title</th>
                               <th>Image</th>
                               <th>Price</th>
                               <th>Qty</th>
                               <!--<th>PV</th>-->
                               <th>Total Price</th>
                           
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
                          
                                <td><?php echo $details->product_name;?></td>
                                <td><img width='80' height='80' src="<?php echo base_url().'product_images/'.$details->product_image;?>"></td>
                                <td><?php echo number_format($details->product_price,2)."".currency();?></td>
                                <td><?php echo $details->qty;?></td>
                                <!--<td><?php echo $details->final_pv;?></td>-->
                                <td><?php echo number_format($details->product_price*$details->qty,2)."".currency();?></td>
                           
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
                  <!--<div class="row">
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
                  </div>-->
                  <?php
	}
                  ?>
                  <p class="text-muted">Thank you from Dhanasvi Office Solutions</p>
               </div>
        </div>	
	<?php 
	}//end function
}//end class
?>	