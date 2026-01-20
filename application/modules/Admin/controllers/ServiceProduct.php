<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/package
*/
class ServiceProduct extends Common_Controller 
{
	private $moduleName;
	private $controllerName;
	private $userId;
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
		$this->controllerName=$this->router->fetch_class();
		$this->role='1';
		$this->load->helper('estore_helper');
	}//end constructor 
	public function assignProducts($pid=false)
	{
	    //echo $user_id;
	    $pid=ID_decode($pid);
	    $assign_products=$this->db->select('user_products.*,eshop_service_products.title')->from('user_products')->join('eshop_service_products','user_products.product_id=eshop_service_products.id')->where('user_products.product_id',$pid)->get()->result_array();
	    //echo $this->db->last_query();
	    $data=array();
	    $data['assign_products']=$assign_products;
	    _adminLayout("ecommerce/service-product/assign-product-quantity",$data);
	}
	
	public function index()
	{
		$data=array();
		$result=$this->db->query("select(select count(order_id) from eshop_orders) as total_order,(select sum(final_price) from eshop_orders) as total_price,(select count(order_id) from eshop_orders where order_status='0') as pending_order,(select count(order_id) from eshop_orders where order_status='1') as confirmed_order,(select sum(final_price) from eshop_orders where order_status='0') as pending_price,(select sum(final_price) from eshop_orders where order_status='1') as confirmed_price,(select count(order_id) from eshop_orders where order_status='2') as rejected_order,(select count(order_id) from eshop_orders where order_status='3') as delivered_order")->row_array();
		$data['order_data']=$result;
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/eshop-dashboard",$data);
	}
	
	public function StockistDashboard()
	{
	    $where='';
	    if(!empty($this->input->post('btn')))
	    {
	        //pr($_POST);
	        $owner_user_id=$this->input->post('stockist');
	        $from_date=$this->input->post('fromdate');
	        $to_date=$this->input->post('todate');
	        $fdate=date('Y-m-d 00:00:00',strtotime($from_date));
	        $tdate=date('Y-m-d 23:59:59',strtotime($to_date));
	        
	        if($owner_user_id!='')
    	    {
    	        $where=" and owner_user_id='".$owner_user_id."'";
    	    }
    	    if($from_date!='' && $to_date!='')
    	    {
    	        $where.=" and order_date>='".$fdate."' and order_date<='".$tdate."'";
    	    }
    	    else if($from_date!='')
    	    {
    	        $where.=" and order_date>='".$fdate."'";
    	    }
    	    else if($to_date!='')
    	    {
    	        $where.=" and order_date<='".$tdate."'";
    	    }
	    }
	    
		$data=array();
		$result=$this->db->query("select(select count(order_id) from eshop_orders where 1=1 $where) as total_order,(select sum(final_price) from eshop_orders where 1=1 $where) as total_price,(select count(order_id) from eshop_orders where order_status='0' $where) as pending_order,(select count(order_id) from eshop_orders where order_status='1' $where) as confirmed_order,(select sum(final_price) from eshop_orders where order_status='0' $where) as pending_price,(select sum(final_price) from eshop_orders where order_status='1' $where) as confirmed_price,(select count(order_id) from eshop_orders where order_status='2' $where) as rejected_order,(select count(order_id) from eshop_orders where order_status='3' $where) as delivered_order")->row_array();
		//echo $this->db->last_query();
		$data['order_data']=$result;
		 $result=$this->db->query("SELECT * FROM user_registration where member_type='2' order by id")->result();	     	
		 $data['all_category']=$result;
		 $data['owner_user_id']=$owner_user_id;
		 $data['from_date']=$from_date;
		 $data['to_date']=$to_date;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this->controllerName;
		_adminLayout("ecommerce/service-product/stockist-dashboard",$data);
	}
	public function allCategoryList()
	{
		 $result=$this->db->query("SELECT * FROM eshop_service_product order by position")->result_array();	     	
		 $data['all_category']=$result;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this->controllerName;
		_adminLayout("ecommerce/service-product/all-category",$data);
	}
	
	public function addNewCategory()
	{
		if(!empty($this->input->post('btn')))
		{
			
			$category_name=$this->input->post('category_name');
			$active_status=$this->input->post('active_status');
			$date=date('d-M-Y');
			$role=$this->role;
			
			$position=$this->db->select_max('position')->from('eshop_service_product')->get()->row();
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
            $this->db->insert('eshop_service_product', $insert_data);
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Category Added Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allCategoryList");
			exit();
		}
		
		 $result=$this->db->query("SELECT * from eshop_service_product")->result_array();
		 $data['module_name']=$this->moduleName;
		 $data['all_category']=$result;
		_adminLayout("ecommerce/service-product/add-category",$data);
	}
	
	public function deleteCategory($del_id)
	{
		    /*redirect(site_url().'Admin/ServiceProduct/allCategoryList');
			exit;*/
			
			$del_id=ID_decode($del_id);
			
			$this->db->delete('eshop_service_products', array('category_id' => $del_id));
			
			$this->db->delete('eshop_service_product_subcategory', array('parent_id' => $del_id));
			
			$this->db->delete('eshop_service_product', array('id' => $del_id));

			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Category Deleted Successfully</span>');
			
			redirect(site_url().$this->moduleName."/ServiceProduct/allCategoryList");
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
			$this->db->update('eshop_service_product', $update_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allCategoryList");
			exit();
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_service_product where id='".$fetch_id."'")->row_array();
		 $data['category_data']=$result;
		 
		 $result1=$this->db->query("SELECT * from eshop_service_product where id!='".$fetch_id."'")->result_array();
		 $data['all_category']=$result1;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/edit-category",$data);    
	}
	
	
	public function allSubCategoryList()
	{
		 $result=$this->db->select(array(
		 'sc.*',
		 'mc.category_name'
		 ))
		 ->from('eshop_service_product_subcategory as sc')
		 ->join('eshop_service_product as mc','mc.id=sc.parent_id')
		 ->order_by('sc.position','asc')
		 ->get()
		 ->result_array();
		 $data['all_subcategory']=$result;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this->controllerName;
		 _adminLayout("ecommerce/service-product/all-subcategory",$data);
	}
	
	public function addNewSubCategory()
	{
		 if(!empty($this->input->post('btn')))
		{
			
			$parent_id=$this->input->post('parent_id');
			$subcategory_name=$this->input->post('subcategory_name');
			$active_status=$this->input->post('active_status');
			$is_display_on_home=$this->input->post('is_display_on_home');
			$display_home_position=$this->input->post('display_home_position');
			
			$home_position_exist=$this->db->select('*')->from('eshop_service_product_subcategory')->where(array('display_home_position'=>$display_home_position,'is_display_on_home'=>'1'))->get()->num_rows();
			
			if($home_position_exist>0)
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Sorry, this home page position is already exist</span>');
				redirect(site_url().$this->moduleName."/ServiceProduct/addNewSubCategory");
				exit();
			}
			
			$date=date('d-M-Y');
			$role=$this->role;
			
			$position=$this->db->select_max('position')->from('eshop_service_product_subcategory')->get()->row();
			if(!empty($position->position))
			{
				$position=$position->position+1;
			}
			else 
			{
				$position=1;
			}
			
			$insert_data = array(
			'parent_id'=>$parent_id,
            'subcategory_name' => $subcategory_name,
            'active_status' => $active_status,
			'is_display_on_home' => $is_display_on_home,
			'display_home_position' => $display_home_position,
			'create_date'=>$date,
			'role'=>$this->role,
			'position'=>$position
            );

            $this->db->insert('eshop_service_product_subcategory', $insert_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Sub Category Added Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allSubCategoryList");
			exit();
			
		}
		
		 $result=$this->db->query("SELECT * from eshop_service_product")->result_array();
		 $data['all_category']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/add-subcategory",$data);
	}
	
	public function editSubCategory($fetch_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
			$hidid=$this->input->post('hidid');
			$parent_id=$this->input->post('parent_id');
			$category_name=$this->input->post('category_name');
			$active_status=$this->input->post('active_status');
			$is_display_on_home=$this->input->post('is_display_on_home');
			$display_home_position=$this->input->post('display_home_position');
			
			$home_position_exist=$this->db->select('*')->from('eshop_service_product_subcategory')->where(array('display_home_position'=>$display_home_position, 'id !='=>$hidid))->get()->num_rows();
			
			if(!empty($is_display_on_home) && $is_display_on_home=='1' && $home_position_exist>0)
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Sorry, this home page position is already exist</span>');
				redirect(site_url().$this->moduleName."/ServiceProduct/editSubCategory/".ID_encode($hidid));
				exit();
			}
			
			
			if($is_display_on_home!=1)
			{
				$display_home_position=null;	
			}
			$date=date('d-M-Y');
			$role=$this->role;
			$update_data = array(
			'parent_id' => $parent_id,
			'subcategory_name' => $category_name,
			'active_status' => $active_status,
			'is_display_on_home' => $is_display_on_home,
			'display_home_position' => $display_home_position,
			'create_date' => $date
             );
			
			$this->db->where('id', $hidid);
			$this->db->update('eshop_service_product_subcategory', $update_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allSubCategoryList");
			exit();
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_service_product_subcategory where id='".$fetch_id."'")->row_array();
		 
		 $category=$this->db->query("SELECT * from eshop_service_product")->result_array();
		 
		 $data['subcategory_data']=$result;
		 $data['all_category']=$category;
		 $data['module_name']=$this->moduleName;
		 
		_adminLayout("ecommerce/service-product/edit-subcategory",$data);    
	}
	
	public function deleteSubCategory($del_id)
	{
		    /*redirect(site_url().'admin/eshop/allSubCategoryList');
			exit;*/
			$del_id=ID_decode($del_id);

			$this->db->delete('eshop_service_products', array('parent_category_id' => $del_id));	
			
			$this->db->delete('eshop_service_product_subcategory', array('id' => $del_id));	
		
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Sub Category Deleted Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allSubCategoryList");
			exit();
			
	}
	
	
	public function allProductList()
	{
		 $result=$this->db->query("SELECT * from eshop_products Where serve_type = '1' order by id desc")->result_array();	     	
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/all-products",$data);
	}
	public function assignProductList()
	{
		 $result=$this->db->query("SELECT * from eshop_service_products  order by id desc")->result_array();	     	
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/assign-products",$data);
	}
	public function allProductStock()
	{
		 $result=$this->db->query("SELECT * from eshop_stock  order by id desc")->result_array();
		 //pr($result);
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this;
		_adminLayout("ecommerce/service-product/all-stocks",$data);
	}
	public function getProduct($id)
	{
		 $result=$this->db->query("SELECT * from eshop_service_products where id='".$id."' order by id desc")->row();	     	
		 return $result;
		 //$data['module_name']=$this->moduleName;
		//_adminLayout("ecommerce/service-product/all-products",$data);
	}
	public function setAjaxStock()
	{
	    $qty=$this->input->post('qty');
	    $assign_web=$this->input->post('assign_web');
	    $type=$this->input->post('type');
	    $id=$this->input->post('id');
	    $result=$this->db->query("SELECT * from eshop_stock where product_id='".$id."'")->row();
	    $assign_stockist=$result->assign_stockist;
	    $qty_all=$result->qty;
	    $assign_web_all=$result->assign_web;
	    $total_qty=$assign_web+$assign_stockist;
	    
	    if($qty>=$total_qty)
	    {
	       if($qty>$assign_web)
	       {
	           if($type=='qty')
	           {
	               $data=array(
	                   'qty'=>$qty
	                   );
	               $where=array(
	                   'product_id'=>$id
	                   );
	               $this->db->update('eshop_stock',$data,$where);
	               $status="success";
	               $msg="Stock Quantity Updated Successfully";
	           }
	           if($type=='assign_web')
	           {
	               $where=array(
	                   'product_id'=>$id
	                   );
	               
	               $qty_remain=$qty-$assign_web+$assign_web_all;
	               $data=array(
	                   'assign_web'=>$assign_web,
	                   'qty'=>$qty_remain
	                   );
	               $qty=$qty_remain;
	               $this->db->update('eshop_stock',$data,$where);
	               $wherep=array(
	                   'id'=>$id
	                   );
	               $datap=array(
	                   'qty'=>$assign_web
	                   ); 
	               $this->db->update('eshop_service_products',$datap,$wherep);
	               $status="success";
	               $msg="Web Quantity Updated Successfully";
	           }
	       }
	       else
	       {
	           $status="fail";
	           $msg="Stock Quantity Should be greater than web and stcokist stock.";
	       }
	    }
	    else
	    {
	        $status="fail";
	        $msg="Stock Quantity Should be greater than or equal to web and stcokist stock.";
	    }
	    
	    echo json_encode(array('status'=>$status,'msg'=>$msg,'type'=>$type,'qty'=>$qty,'assign_web'=>$assign_web));
	}
	public function addNewProduct()
	{
		if(!empty($this->input->post('btn')))
		{
			$parent_category_id=$this->input->post('parent_category_id');
			$category_id=$this->input->post('category_id');
			$subcat_id=$this->input->post('2category_id');
			$title=$this->input->post('title');
			$old_price=$this->input->post('old_price');
			$new_price=$this->input->post('new_price');
			$qty=$this->input->post('qty');
			$sku=$this->input->post('sku');
			$status=$this->input->post('status');
			$tax=$this->input->post('tax');
			$shipment_charge=$this->input->post('shipment_charge');
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
			
			 $update_sub_img=array();
			 /*for($i=0;$i<count($_FILES['sub_img']['name']);$i++)
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
			'subcat_id' => $subcat_id,
            'product_image' => $product_image,
            'title' => $title,
            /*'old_price' => $old_price,
			'new_price'=>$new_price,
			'sku'=>$sku,*/
			'status'=>$status,
			'description'=>$description,
			'long_description'=>$long_description,
			'serve_type'=>1
			/*'featured'=>$featured,
			'role'=>$this->role,
			'direct_commission'=>$direct_commission,
			'guest_point'=>$guest_point,
			'tax'=>$tax,
			'qty'=>$qty,
			'shipment_charge'=>$shipment_charge*/
            );
            $this->db->insert('eshop_products', $insert_data);
			$update_sub_img=serialize($update_sub_img);
			//////////////////////////////////
			$product_id=$this->db->insert_id();
			$this->db->update('eshop_products',array('sub_images'=>$update_sub_img),array('id'=>$product_id));
			//$this->db->insert('eshop_stock',array('product_id'=>$product_id,'qty'=>$qty));
			$eshop_product_level_commission=array();
			/*if(!empty($level_commission))
			{
				$level=1;
				foreach($level_commission as $k=>$commission)
				{
					$eshop_product_level_commission[]=array(
					'product_id'=>$product_id,
					'level'=>$level,
					'commission'=>$commission,
					);
				    $level++;
				}
			}
			if(!empty($eshop_product_level_commission))
			{
				$this->db->insert_batch('eshop_product_level_commission',$eshop_product_level_commission);	
			}*/
			////////////////////
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Service Added Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allProductList");
			exit();
			
		}
		 $result=$this->db->query("SELECT * from eshop_category where active_status=0")->result_array();
		 $data['all_category']=$result;
		  $sub_category=$this->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$result['parent_category_id'],'active_status'=>'0'))->get()->result();
		 $data['sub_category']=$sub_category;
		 $sub_2category=$this->db->select('*')->from('eshop_sub2category')->where(array('parent_id'=>$result['parent_category_id'],'subcat_id'=>$result['category_id'],'active_status'=>'0'))->get()->result();
		// print_r($sub_2category);
		 $data['sub_2category']=$sub_2category;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/add-product",$data);
	}
	public function deleteProduct($del_id)
	{
		    /*redirect(site_url().'admin/eshop/allProductList/');
			exit;*/
			$del_id=ID_decode($del_id);
			$this->db->delete('eshop_products', array('id' => $del_id));	
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Service Deleted Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allProductList");
			exit();
	}
	
	public function editProduct($fetch_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
		    //pr($_POST); exit;
			$hidid=$this->input->post('hidid');
			$parent_category_id=$this->input->post('parent_category_id');
			$category_id=$this->input->post('category_id');
			$sub_category_id=$this->input->post('2category_id');
			$title=$this->input->post('title');
			$old_price=$this->input->post('old_price');
			$new_price=$this->input->post('new_price');
			$sku=$this->input->post('sku');
			$qty=$this->input->post('qty');
			$status=$this->input->post('status');
			$description=$this->input->post('description');
            $long_description=$this->input->post('long_description');
			$featured=$this->input->post('featured');
			$role=$this->role;
			$tax=$this->input->post('tax');
			$shipment_charge=$this->input->post('shipment_charge');
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
			$upload_sub_img=array();
			$old_sub_images=$this->input->post('old_sub_images');
			/*foreach($old_sub_images as $old_img)
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
			'parent_category_id'=>$parent_category_id,
            'category_id' => $category_id,
            'subcat_id' => $sub_category_id,
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
			'qty'=>$qty,
			'shipment_charge'=>$shipment_charge
            );
            $this->db->where('id', $hidid);
			$this->db->update('eshop_products', $update_data);
			
			///////updating level commission///
			$eshop_product_level_commission=array();
			/*if(!empty($level_commission))
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
			//$this->db->update('eshop_stock',array('qty'=>$qty),array('product_id'=>$product_id));
			$upload_sub_img=serialize($upload_sub_img);
			
			$this->db->update('eshop_products',array('sub_images'=>$upload_sub_img),array('id'=>$hidid));
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Service Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/ServiceProduct/allProductList");
			exit();
			
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_products where id='".$fetch_id."'")->row_array();
		 //print_r($fetch_id);die;
		 $data['product_data']=$result;
		 $data['sub_images']=unserialize($result['sub_images']);
		 
		 $result1=$this->db->query("SELECT * from eshop_category where active_status=0")->result_array();
		 $data['all_category']=$result1;
		 
		 $sub_category=$this->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$result['parent_category_id'],'active_status'=>'0'))->get()->result();
		 $data['sub_category']=$sub_category;
		 $sub_2category=$this->db->select('*')->from('eshop_sub2category')->where(array('parent_id'=>$result['parent_category_id'],'subcat_id'=>$result['category_id'],'active_status'=>'0'))->get()->result();
		// print_r($sub_2category);
		 $data['sub_2category']=$sub_2category;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/edit-product",$data);
	}
	function getAjaxSubCategory()
	{
		$parent_category_id=$this->input->post('parent_category_id');
		$result=$this->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$parent_category_id,'active_status'=>'1'))->get()->result();
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}//end method
	function getAjaxSub2Category()
	{
		$parent_category_id=$this->input->post('parent_category_id');
		$result=$this->db->select('*')->from('eshop_sub2category')->where(array('subcat_id'=>$parent_category_id,'active_status'=>'1'))->get()->result();
		
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}//end method
	///////////////////////
   public function moveUp($tableName,$current_position,$upper_position)
   {

	   moveUp($tableName,$current_position,$upper_position);
	   if($tableName=='eshop_service_product')
	   {
		 $this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span> Category Position is changed successfully.</h4>');
		 redirect(site_url().$this->moduleName."/".$this->controllerName.'/allCategoryList');
		 exit;
	   }
	   if($tableName=='eshop_service_product_subcategory')
	   {
		 $this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span> Subcategory Position is changed successfully.</h4>');
		 redirect(site_url().$this->moduleName."/".$this->controllerName.'/allSubCategoryList');
		 exit;
	   }
	  
   }
   	public function enquirylist()
	{
		 $result=$this->db->query("SELECT * from enquiries  order by id desc")->result_array();	     	
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/service-product/all-enquiry",$data);
	}
	public function updateSeenStatus() {
        // Ensure the request is AJAX
        if (!$this->input->is_ajax_request()) {
            show_error("No direct access allowed", 403);
        }
    
        // Get input data
        $input = json_decode($this->input->raw_input_stream, true);
    
        if (isset($input['id'])) {
            $enquiryId = $input['id'];
    
            // Update the "seen" status
            $this->db->where('id', $enquiryId);
            $updated = $this->db->update('enquiries', ['seen' => 1]);
    
            // Send response
            echo json_encode(['success' => $updated]);
        } else {
            // Invalid input
            echo json_encode(['success' => false, 'message' => 'Invalid enquiry ID']);
        }
    }


}//end class
