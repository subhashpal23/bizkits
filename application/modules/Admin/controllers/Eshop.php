<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/package
*/
class Eshop extends Common_Controller 
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
	    $assign_products=$this->db->select('user_products.*,eshop_products.title')->from('user_products')->join('eshop_products','user_products.product_id=eshop_products.id')->where('user_products.product_id',$pid)->get()->result_array();
	    //echo $this->db->last_query();
	    $data=array();
	    $data['assign_products']=$assign_products;
	    _adminLayout("ecommerce/eshop-mgmt/assign-product-quantity",$data);
	}
	
	public function index()
	{
		$data=array();
		$result=$this->db->query("select(select count(order_id) from eshop_orders) as total_order,(select sum(final_price) from eshop_orders) as total_price,(select count(order_id) from eshop_orders where order_status='0') as pending_order,(select count(order_id) from eshop_orders where order_status='1') as confirmed_order,(select sum(final_price) from eshop_orders where order_status='0') as pending_price,(select sum(final_price) from eshop_orders where order_status='1') as confirmed_price,(select count(order_id) from eshop_orders where order_status='2') as rejected_order,(select count(order_id) from eshop_orders where order_status='3') as delivered_order")->row_array();
		$data['order_data']=$result;
		$data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/eshop-dashboard",$data);
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
		_adminLayout("ecommerce/eshop-mgmt/stockist-dashboard",$data);
	}
	public function allCategoryList()
	{
		 $result=$this->db->query("SELECT * FROM eshop_category order by position")->result_array();	     	
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
            $this->db->insert('eshop_category', $insert_data);
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Category Added Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allCategoryList");
			exit();
		}
		
		 $result=$this->db->query("SELECT * from eshop_category")->result_array();
		 $data['module_name']=$this->moduleName;
		 $data['all_category']=$result;
		_adminLayout("ecommerce/eshop-mgmt/add-category",$data);
	}
	
	public function deleteCategory($del_id)
	{
		    /*redirect(site_url().'Admin/Eshop/allCategoryList');
			exit;*/
			
			$del_id=ID_decode($del_id);
			
			$this->db->delete('eshop_products', array('category_id' => $del_id));
			
			$this->db->delete('eshop_subcategory', array('parent_id' => $del_id));
			
			$this->db->delete('eshop_category', array('id' => $del_id));

			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Category Deleted Successfully</span>');
			
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
			$this->db->update('eshop_category', $update_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allCategoryList");
			exit();
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_category where id='".$fetch_id."'")->row_array();
		 $data['category_data']=$result;
		 
		 $result1=$this->db->query("SELECT * from eshop_category where id!='".$fetch_id."'")->result_array();
		 $data['all_category']=$result1;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/edit-category",$data);    
	}
	
	
	public function allSubCategoryList()
	{
		 $result=$this->db->select(array(
		 'sc.*',
		 'mc.category_name'
		 ))
		 ->from('eshop_subcategory as sc')
		 ->join('eshop_category as mc','mc.id=sc.parent_id')
		 ->order_by('sc.position','asc')
		 ->get()
		 ->result_array();
		 $data['all_subcategory']=$result;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this->controllerName;
		 _adminLayout("ecommerce/eshop-mgmt/all-subcategory",$data);
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
			
			/*$home_position_exist=$this->db->select('*')->from('eshop_subcategory')->where(array('display_home_position'=>$display_home_position,'is_display_on_home'=>'1'))->get()->num_rows();
			
			if($home_position_exist>0)
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Sorry, this home page position is already exist</span>');
				redirect(site_url().$this->moduleName."/Eshop/addNewSubCategory");
				exit();
			}*/
			
			$date=date('d-M-Y');
			$role=$this->role;
			
			/*$position=$this->db->select_max('position')->from('eshop_subcategory')->get()->row();
			if(!empty($position->position))
			{
				$position=$position->position+1;
			}
			else 
			{
				$position=1;
			}*/
			$image_upload_path='/product_images/';
	        $product_image=adImageUpload($_FILES['product_image'],1, $image_upload_path);
			$insert_data = array(
			'parent_id'=>$parent_id,
            'subcategory_name' => $subcategory_name,
            'active_status' => $active_status,
            'image' => $product_image,
			/*'is_display_on_home' => $is_display_on_home,
			'display_home_position' => $display_home_position,*/
			'create_date'=>$date,
			/*'role'=>$this->role,
			'position'=>$position*/
            );

            $this->db->insert('eshop_subcategory', $insert_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Sub Category Added Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allSubCategoryList");
			exit();
			
		}
		
		 $result=$this->db->query("SELECT * from eshop_category")->result_array();
		 $data['all_category']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/add-subcategory",$data);
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
			
			$home_position_exist=$this->db->select('*')->from('eshop_subcategory')->where(array('display_home_position'=>$display_home_position, 'id !='=>$hidid))->get()->num_rows();
			
			if(!empty($is_display_on_home) && $is_display_on_home=='1' && $home_position_exist>0)
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Sorry, this home page position is already exist</span>');
				redirect(site_url().$this->moduleName."/Eshop/editSubCategory/".ID_encode($hidid));
				exit();
			}
			
			
			if($is_display_on_home!=1)
			{
				$display_home_position=null;	
			}
// 			 $image_upload_path='/product_images/';
// 			if($_FILES['product_image']['name']=='')
// 			{
// 			    $product_image=$this->input->post('hidden_image');	
// 			}
// 			else
// 			{
// 	            $product_image=adImageUpload($_FILES['product_image'],1, $image_upload_path);
// 			}
			$image_upload_path = '/product_images/';
            $delete_image = $this->input->post('delete_image');
            
            if (!empty($delete_image) && $delete_image == 1) {
                // Delete image from the server
                $image_path = FCPATH . "product_images/" . $this->input->post('hidden_image');
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $product_image = ""; // Remove image from database
            } else {
                if ($_FILES['product_image']['name'] == '') {
                    $product_image = $this->input->post('hidden_image');
                } else {
                    $product_image = adImageUpload($_FILES['product_image'], 1, $image_upload_path);
                }
            }
			$date=date('d-M-Y');
			$role=$this->role;
			$update_data = array(
			'parent_id' => $parent_id,
			'subcategory_name' => $category_name,
			'active_status' => $active_status,
			'image' => $product_image,
			'is_display_on_home' => $is_display_on_home,
			'display_home_position' => $display_home_position,
			'create_date' => $date
             );
			
			$this->db->where('id', $hidid);
			$this->db->update('eshop_subcategory', $update_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allSubCategoryList");
			exit();
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_subcategory where id='".$fetch_id."'")->row_array();
		 
		 $category=$this->db->query("SELECT * from eshop_category")->result_array();
		 
		 $data['subcategory_data']=$result;
		 $data['all_category']=$category;
		 $data['module_name']=$this->moduleName;
		 
		_adminLayout("ecommerce/eshop-mgmt/edit-subcategory",$data);    
	}
	
	public function deleteSubCategory($del_id)
	{
		    /*redirect(site_url().'admin/eshop/allSubCategoryList');
			exit;*/
			$del_id=ID_decode($del_id);

		//	$this->db->delete('eshop_products', array('parent_category_id' => $del_id));	
			
			$this->db->delete('eshop_subcategory', array('id' => $del_id));	
		
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Sub Category Deleted Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allSubCategoryList");
			exit();
			
	}
	
	/******************* leve2 Sub Category *************************/
	public function showSubCategory($parent_id)
	{
	    $result=$this->db->select(array('sc2.*'))
		 ->from('eshop_subcategory as sc2')
		 ->where('sc2.parent_id',$parent_id)
		 ->get()
		 ->result();
		  $str.='<option value="">Select Sub Category</option>';
		 foreach($result as $key=>$val)
		 {
		     $str.='<option value="'.$val->id.'">'.$val->subcategory_name.'</option>';
		 }
		 echo $str;
	}
	public function allSub2CategoryList()
	{
		 $result=$this->db->select(array('sc2.*','mc.category_name','sc.subcategory_name as subcat_name'))
		 ->from('eshop_sub2category as sc2')
		 ->join('eshop_subcategory as sc','sc.id=sc2.subcat_id')
		 ->join('eshop_category as mc','mc.id=sc.parent_id')
		 ->order_by('sc.position','asc')
		 ->get()
		 ->result_array();
		 $data['all_subcategory']=$result;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this->controllerName;
		 _adminLayout("ecommerce/eshop-mgmt/all-sub2category",$data);
	}
	
	public function addNewSub2Category()
	{
		if(!empty($this->input->post('btn')))
		{
			
			$parent_id=$this->input->post('parent_id');
			$category_id=$this->input->post('category_id');
			$subcategory_name=$this->input->post('subcategory_name');
			$active_status=$this->input->post('active_status');
			
			$is_display_on_home=$this->input->post('is_display_on_home');
			$display_home_position=$this->input->post('display_home_position');
			$image_upload_path='/product_images/';
	        $product_image=adImageUpload($_FILES['product_image'],1, $image_upload_path);
			
			$date=date('d-M-Y');
			
			$insert_data = array(
			'parent_id'=>$parent_id,
			'subcat_id'=>$category_id,
            'subcategory_name' => $subcategory_name,
            'image' => $product_image,
            'active_status' => $active_status,
			'create_date'=>$date
            );

            $this->db->insert('eshop_sub2category', $insert_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Sub Category Added Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allSub2CategoryList");
			exit();
		}
		
		 $result=$this->db->query("SELECT * from eshop_category")->result_array();
		 $data['all_category']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/add-sub2category",$data);
	}
	
	public function editSub2Category($fetch_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
			$hidid=$this->input->post('hidid');
			$parent_id=$this->input->post('parent_id');
			$category_id=$this->input->post('category_id');
			$category_name=$this->input->post('category_name');
			$active_status=$this->input->post('active_status');
			 
		
			$image_upload_path = '/product_images/';
            $delete_image = $this->input->post('delete_image');
            
            if (!empty($delete_image) && $delete_image == 1) {
                // Delete image from the server
                $image_path = FCPATH . "product_images/" . $this->input->post('hidden_image');
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $product_image = ""; // Remove image from database
            } else {
                if ($_FILES['product_image']['name'] == '') {
                    $product_image = $this->input->post('hidden_image');
                } else {
                    $product_image = adImageUpload($_FILES['product_image'], 1, $image_upload_path);
                }
            }
			
			
			
			$date=date('d-M-Y');
			
			$update_data = array(
			'parent_id' => $parent_id,
			'subcat_id' => $category_id,
			'subcategory_name' => $category_name,
			'active_status' => $active_status,
			'image' => $product_image,
			'create_date' => $date
             );
			
			$this->db->where('id', $hidid);
			$this->db->update('eshop_sub2category', $update_data);
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Updated Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allSub2CategoryList");
			exit();
		}
		
		 $fetch_id=ID_decode($fetch_id);
		 $result=$this->db->query("SELECT * from eshop_sub2category where id='".$fetch_id."'")->row_array();
		 //pr($result);
		 $data['subcategory_data']=$result;
		 $category=$this->db->query("SELECT * from eshop_category")->result_array();
		 $data['all_category']=$category;
		 $sql="SELECT * from eshop_subcategory where parent_id='".$result['parent_id']."'";
		 $category=$this->db->query($sql)->result_array();
		 $data['all_subcategory']=$category;
		 $data['module_name']=$this->moduleName;
		 
		_adminLayout("ecommerce/eshop-mgmt/edit-sub2category",$data);    
	}
	
	public function deleteSub2Category($del_id)
	{
		    /*redirect(site_url().'admin/eshop/allSubCategoryList');
			exit;*/
			$del_id=ID_decode($del_id);

		//	$this->db->delete('eshop_products', array('parent_category_id' => $del_id));	
			
			$this->db->delete('eshop_sub2category', array('id' => $del_id));	
		
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Sub Category Deleted Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allSub2CategoryList");
			exit();
			
	}
	
	/******************************** level2 Sub Category ****************************************/
	
	public function allProductList()
	{
		 $result=$this->db->query("SELECT * from eshop_products where serve_type = '0'  order by id desc")->result_array();	     	
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/all-products",$data);
	}
	public function multipleDeleteProducts()
    {
        $ids = $this->input->post('ids');
        if(!empty($ids)){
            foreach($ids as $id){
                $this->db->where('id', $id);
                $this->db->delete('eshop_products');
            }
            echo "success";
        } else {
            echo "no ids";
        }
    }

	public function assignProductList()
	{
		 $result=$this->db->query("SELECT * from eshop_products  order by id desc")->result_array();	     	
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/assign-products",$data);
	}
	public function allProductStock()
	{
		 $result=$this->db->query("SELECT * from eshop_stock  order by id desc")->result_array();
		 //pr($result);
		 $data['all_products']=$result;
		 $data['module_name']=$this->moduleName;
		 $data['controller_name']=$this;
		_adminLayout("ecommerce/eshop-mgmt/all-stocks",$data);
	}
	public function getProduct($id)
	{
		 $result=$this->db->query("SELECT * from eshop_products where id='".$id."' order by id desc")->row();	     	
		 return $result;
		 //$data['module_name']=$this->moduleName;
		//_adminLayout("ecommerce/eshop-mgmt/all-products",$data);
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
	               $this->db->update('eshop_products',$datap,$wherep);
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
			$sub_category_id=$this->input->post('2category_id');
			$title=$this->input->post('title');
			$old_price=$this->input->post('old_price');
			$new_price=$this->input->post('new_price');
			$price1=$this->input->post('price1');
			$price2=$this->input->post('price2');
			$price3=$this->input->post('price3');
			$qty=$this->input->post('qty');
			$sku=$this->input->post('sku');
			$status=$this->input->post('status');
			$tax=$this->input->post('tax');
			$shipment_charge=$this->input->post('shipment_charge');
			$discount=$this->input->post('discount');
			$discount_type=$this->input->post('discount_type');
			$description=$this->input->post('description');
			$description2=$this->input->post('description2');
			$long_description=$this->input->post('long_description');
			$featured=$this->input->post('featured');
			$role=$this->role;
			////////////////////////////////////////////////////////////////
			$direct_commission=$this->input->post('direct_commission');
			$guest_point=$this->input->post('guest_point');
			
			$level_commission=$this->input->post('level_commission');
			
			
			////////////////////////////////////////////////////////////
			
			//echo '<pre>';			print_r($_FILES);
			$image_upload_path='/product_images/';
	        $product_image=adImageUpload($_FILES['product_image'],1, $image_upload_path);
	        $basic_image=adImageUpload($_FILES['basic_image'],2, $image_upload_path);
	        $economy_image=adImageUpload($_FILES['economy_image'],3, $image_upload_path);
	        $enterprise_image=adImageUpload($_FILES['enterprise_image'],4, $image_upload_path);
			
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
			$result_zip1 = upload_zip_file('userfile1', './uploads/', 100240); // 100MB
			$file_zip1= $result_zip1['data']['file_name'];
			
			$result_zip2 = upload_zip_file('userfile2', './uploads/', 100240); // 100MB
			$file_zip2= $result_zip2['data']['file_name'];
			
			$result_zip3 = upload_zip_file('userfile3', './uploads/', 100240); // 100MB
			$file_zip3= $result_zip3['data']['file_name'];
					
			$calls1=$this->input->post('calls1');
			$calls2=$this->input->post('calls2');
			$calls3=$this->input->post('calls3'); 
			$insert_data = array(
			'user_id'=>$this->user_id,
            'parent_category_id'=>$parent_category_id,
			'product_image' => $product_image,
			'basic_image' => $basic_image,
			'economy_image' => $economy_image,
			'enterprise_image' => $enterprise_image,
            'title' => $title,
            'price1' => $price1,
			'price2'=>$price2,
			'price3'=>$price3,
			'calls1' => $calls1,
			'calls2'=>$calls2,
			'calls3'=>$calls3,
			'status'=>$status,
			'description'=>$description,
			'description2'=>$description2,
			'long_description'=>$long_description,
			'zip1'=>$file_zip1,
			'zip2'=>$file_zip2,
			'zip3'=>$file_zip3,			
            );
            //print_r($insert_data);
            $this->db->insert('eshop_products', $insert_data);
			$update_sub_img=serialize($update_sub_img);
			//////////////////////////////////
			$product_id=$this->db->insert_id();
			//$this->db->update('eshop_products',array('sub_images'=>$update_sub_img),array('id'=>$product_id));
			
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
			redirect(site_url().$this->moduleName."/Eshop/allProductList");
			exit();
			
		}
		 $result=$this->db->query("SELECT * from eshop_category where active_status=1")->result_array();
		 $data['all_category']=$result;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/add-product",$data);
	}
	public function deleteProduct($del_id)
	{
		    /*redirect(site_url().'admin/eshop/allProductList/');
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
			//$category_id=$this->input->post('category_id');
			$parent_category_id=$this->input->post('parent_category_id');
			$category_id=$this->input->post('category_id');
			$sub_category_id=$this->input->post('2category_id');
			$title=$this->input->post('title');
			$old_price=$this->input->post('old_price');
			$new_price=$this->input->post('new_price');
			$price1=$this->input->post('price1');
			$price2=$this->input->post('price2');
			$price3=$this->input->post('price3');
			$sku=$this->input->post('sku');
			$qty=$this->input->post('qty');
			$status=$this->input->post('status');
			$description=$this->input->post('description');
			$description2=$this->input->post('description2');
			$long_description=$this->input->post('long_description');
			
            $long_description=$this->input->post('long_description');
			$featured=$this->input->post('featured');
			$role=$this->role;
			$tax=$this->input->post('tax');
			$shipment_charge=$this->input->post('shipment_charge');
			$discount=$this->input->post('discount');
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
            // 2️⃣ Basic image
            if($_FILES['basic_image']['name'] == '') {
                $basic_image = $this->input->post('hidden_basic_image');
            } else {
                $basic_image = adImageUpload($_FILES['basic_image'], 1, $image_upload_path);
            }
            
            // 3️⃣ Enterprise image
            if($_FILES['enterprise_image']['name'] == '') {
                $enterprise_image = $this->input->post('hidden_enterprise_image');
            } else {
                $enterprise_image = adImageUpload($_FILES['enterprise_image'], 1, $image_upload_path);
            }
            
            // 4️⃣ Economy image
            if($_FILES['economy_image']['name'] == '') {
                $economy_image = $this->input->post('hidden_economy_image');
            } else {
                $economy_image = adImageUpload($_FILES['economy_image'], 1, $image_upload_path);
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
			$result_zip1 = upload_zip_file('userfile1', './uploads/', 100240); // 100MB
			$file_zip1   = $result_zip1['status'] ? $result_zip1['data']['file_name'] : $product['zip1'];
			
			
			$result_zip2 = upload_zip_file('userfile2', './uploads/', 100240); // 100MB
			
			$file_zip2   = $result_zip2['status'] ? $result_zip2['data']['file_name'] : $product['zip2'];
			
			$result_zip3 = upload_zip_file('userfile3', './uploads/', 100240); // 100MB
			$file_zip3   = $result_zip3['status'] ? $result_zip3['data']['file_name'] : $product['zip3'];
			
		
			$update_data = array(
            //'category_id' => $category_id,
			'parent_category_id'=>$parent_category_id,
            'category_id' => $category_id,
            'subcat_id' => $sub_category_id,
			'product_image' => $product_image,
			'basic_image' => $basic_image,
            'enterprise_image' => $enterprise_image,
            'economy_image' => $economy_image,

            'title' => $title,
            'old_price' => $old_price,
			'new_price'=>$new_price,
			'price1' => $price1,
			'price2'=>$price2,
			'price3'=>$price3,
			'sku'=>$sku,
			'status'=>$status,
			'description'=>$description,
			'description2'=>$description2,
			'long_description'=>$long_description,
			'featured'=>$featured,
			'role'=>$this->role,
			'direct_commission'=>$direct_commission,
			'guest_point'=>$guest_point,
			'tax'=>$tax,
			'qty'=>$qty,
			'shipment_charge'=>$shipment_charge,
			'discount'=>$discount,
			'zip1'=>$file_zip1,
			'zip2'=>$file_zip2,
			'zip3'=>$file_zip3,
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
			$this->db->update('eshop_stock',array('qty'=>$qty),array('product_id'=>$product_id));
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
		 
		 $result1=$this->db->query("SELECT * from eshop_category where active_status=1")->result_array();
		 $data['all_category']=$result1;
		 
		 $sub_category=$this->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$result['parent_category_id'],'active_status'=>'1'))->get()->result();
		 $data['sub_category']=$sub_category;
		 $sub_2category=$this->db->select('*')->from('eshop_sub2category')->where(array('parent_id'=>$result['parent_category_id'],'subcat_id'=>$result['category_id'],'active_status'=>'1'))->get()->result();
		
		 $data['sub_2category']=$sub_2category;
		 $data['module_name']=$this->moduleName;
		_adminLayout("ecommerce/eshop-mgmt/edit-product",$data);
	}
	function getAjaxSubCategory()
	{
		$parent_category_id=$this->input->post('parent_category_id');
		$service_status=$this->input->post('service_status');
		$result=$this->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$parent_category_id,'active_status'=>$service_status))->get()->result();
		//echo $this->db->last_query();print_r($result);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}//end method
	
	function getAjaxSub2Category()
	{
		$parent_category_id=$this->input->post('parent_category_id');
		$category_id=$this->input->post('category_id');
		$service_status=$this->input->post('service_status');
		$result=$this->db->select('*')->from('eshop_sub2category')->where(array('parent_id'=>$parent_category_id,'subcat_id'=>$category_id,'active_status'=>$service_status))->get()->result();
		//echo $this->db->last_query();print_r($result);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}//end method
	///////////////////////
   public function moveUp($tableName,$current_position,$upper_position)
   {

	   moveUp($tableName,$current_position,$upper_position);
	   if($tableName=='eshop_category')
	   {
		 $this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span> Category Position is changed successfully.</h4>');
		 redirect(site_url().$this->moduleName."/".$this->controllerName.'/allCategoryList');
		 exit;
	   }
	   if($tableName=='eshop_subcategory')
	   {
		 $this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span> Subcategory Position is changed successfully.</h4>');
		 redirect(site_url().$this->moduleName."/".$this->controllerName.'/allSubCategoryList');
		 exit;
	   }
	  
   }
   
   public function showStockistStateWise($user_id)
   {
       //echo "select * from user_registration where user_id='".$user_id."'";
       $info=$this->db->query("select * from user_registration where user_id='".$user_id."'")->row();
       $this->session->set_userdata('selected_user_id',$user_id);
       $str.="Name:".$info->first_name.' '.$info->last_name."<br>";
       $str.="Email:".$info->email."<br>";
       $str.="Mobile:".$info->contact_no."<br>";
       $cart_item=$this->session->userdata('cart');
       if($cart_item)
       {
           $count=count($cart_item);
       }
       echo json_encode(array('total'=>$count,'name'=>$info->first_name.' '.$info->last_name,'email'=>$info->email,'contact_no'=>$info->contact_no));
   }
   public function ourStore()
	{
		$all_category=$this->eshop_model->getCategory();
		$data['all_category']=$all_category;
		$data['module_name']=$this->moduleName;
		$data['controller'] = $this;
		$user_id=$this->user_id;
		$user_details=get_user_details($user_id);
	 $state=$user_details->state;
	 $data['all_stockist']=$this->db->query("select * from user_registration")->result();
		_userLayout("ecommerce/eshop-mgmt/our-store",$data);
	}
	public function ourStoreRetopup()
	{
		$all_category=$this->eshop_model->getCategory();
		$data['all_category']=$all_category;
		$data['module_name']=$this->moduleName;
		$data['controller'] = $this;
		$user_id=$this->user_id;
		$user_details=get_user_details($user_id);
	    $state=$user_details->state;
	    $data['all_stockist']=$this->db->query("select * from user_registration")->result();
		_userLayout("ecommerce/eshop-mgmt/our-store-topup",$data);
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
               
               <th>Price</th>
               <th>Discount</th>
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
                 if($row->discount_type=='per')
        		 {
        		     $discount=((int)$row->new_price*(int)$row->discount)/100;
        		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
        		 }
        		 else
        		 {
        		     $discount=(int)$row->discount;
        		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
        		 }
        		 $tax=((int)$row->new_price*(int)$row->tax)/100;
        		     $cart_total_tax=$cart_total_tax+($item['qty']*$tax);
              //$discount=$item['qty']*(int)$row->discount;
              $tqty=$tqty+$item['qty'];
              $tprice=$tprice+$price;
              $tdiscount=$tdiscount+$discount;
              $tpv=$tpv+$pv;
              //$total_tax=$total_tax+$item['tax'];
              //$total_ship=$total_ship+$item['shipment_charge'];
          $output .= '
              <tr>
             
               <td>'.$row->title.'</td>
               
               <td>'.currency().$price.'</td>
               <td>'.currency().($discount*$item['qty']).'</td>
               
               
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
               <td>Sub Total</td>
               <td>'.currency().$tprice.'</td>
               <td>'.currency().$cart_total_discount.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td>Tax</td>
               <td>'.currency().$cart_total_tax.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td>Discount</td>
               <td>'.currency().$cart_total_discount.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
              
             <tr>
               <td>Grand Total</td>
               <td>'.currency().(($this->session->userdata('cart_final_price')+$cart_total_tax)-$cart_total_discount).'</td>
               <td>&nbsp;</td>
               <td>'.$tqty.'</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td colspan="4">&nbsp;</td>
               <td><button class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" onclick="proceedtopay()">Topup To Client</button></td>
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
	public function ourCartTopup()
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
               
               <th>Price</th>
               <th>Discount</th>
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
                 if($row->discount_type=='per')
        		 {
        		     $discount=((int)$row->new_price*(int)$row->discount)/100;
        		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
        		 }
        		 else
        		 {
        		     $discount=(int)$row->discount;
        		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
        		 }
        		 $tax=((int)$row->new_price*(int)$row->tax)/100;
        		     $cart_total_tax=$cart_total_tax+($item['qty']*$tax);
              //$discount=$item['qty']*(int)$row->discount;
              $tqty=$tqty+$item['qty'];
              $tprice=$tprice+$price;
              $tdiscount=$tdiscount+$discount;
              $tpv=$tpv+$pv;
              //$total_tax=$total_tax+$item['tax'];
              //$total_ship=$total_ship+$item['shipment_charge'];
          $output .= '
              <tr>
             
               <td>'.$row->title.'</td>
               
               <td>'.currency().$price.'</td>
               <td>'.currency().($discount*$item['qty']).'</td>
               
               
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
               
               <td>Sub Total</td>
               <td>'.currency().$tprice.'</td>
               <td>'.currency().$cart_total_discount.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
              </tr>
              <tr>
               <td>Tax</td>
               <td>'.currency().$cart_total_tax.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               
               <td>Discount</td>
               <td>'.currency().$cart_total_discount.'</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
              </tr>
              
              <tr>
               
               <td>Grand Total</td>
               <td>'.currency().(($this->session->userdata('cart_final_price')+$cart_total_tax)-$cart_total_discount).'</td>
               <td>'.currency().$cart_total_discount.'</td>
               <td>'.$tqty.'</td>
               <td>&nbsp;</td>
              </tr>
              <tr>
               <td colspan="4">&nbsp;</td>
               
               <td><button class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" onclick="proceedtopaytopup()">Re-Topup To Client</button></td>
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
	public function productslist($sub_cat_id)
	{
	    $data=array();
		 $where = "status ='1'";
		 
		 $where .=" and parent_category_id ='".$sub_cat_id."'"; 	 
		 
		 $all_products=$this->db->select('*')->from('eshop_products')->where($where)->get()->result_array();
		
		 return $all_products;
	}
	public function ewalletPaymentConfirm()
	{
				$owner_user_id=$this->session->userdata('user_id');
				$user_id=$this->session->userdata('selected_user_id');
				//$center_leader=$this->session->userdata('center_leader');
				$role=$this->session->userdata('userType');
				if(!empty($this->session->userdata('cart')) && !empty($this->session->userdata('total_products')) && !empty($this->session->userdata('cart_final_price')))
				{
    				$cart=(object)$this->session->userdata('cart');
    				$order_id=$this->generateUniqueOrderId();
    				//	pr($cart); exit;
    				$bonus_date=date('Y-m-d');
    				$date=date('Y-m-d');
    				$total_pv=0;
    				$total_discount=0;
    				foreach($cart as $product)
    				{
    					$product=(object)$product;
    					$product_stock_info=$this->db->select(array('qty','total_order','guest_point','new_price','discount','discount_type','tax'))->from('eshop_products')->where('id',$product->product_id)->get()->row();
    					$final_stock=$product_stock_info->qty-$product->qty;
    					$total_order=$product_stock_info->total_order+1;
    					$guest_point=$product_stock_info->tax;
    					$tax=((int)$product_stock_info->new_price*(int)$guest_point)/100;
                                    		     $cart_total_tax=$cart_total_tax+($product->qty*$tax);
    					$new_price=$product_stock_info->new_price;
    					if($product_stock_info->discount_type=='per')
                                    		 {
                                    		     $discount=((int)$product_stock_info->new_price*(int)$product_stock_info->discount)/100;
                                    		     $cart_total_discount=$cart_total_discount+($product->qty*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_stock_info->discount;
                                    		    $cart_total_discount=$cart_total_discount+($product->qty*$discount);
                                    		 }
                                    		 
        		     
    					$discount1=(int)$discount;
    				    $this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));
    					$this->db->update('eshop_stock',array('qty'=>$final_stock),array('product_id'=>$product->product_id));
    					
    					/*$stock_count=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id))->get()->num_rows();
    					if($stock_count)
    					{
    					    $stock_info=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id))->get()->row();
    					    $user_final_stock=$stock_info->qty+$product->qty;
    					    $this->db->update('eshop_stock_stockist',array('qty'=>$user_final_stock),array('product_id'=>$product->product_id,'stockist_id'=>$user_id));
    					    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
    					}
    					else
    					{
    					    $user_final_stock=$product->qty;
    					    $this->db->insert('eshop_stock_stockist',array('qty'=>$user_final_stock,'product_id'=>$product->product_id,'stockist_id'=>$user_id));
    					    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
    					}*/
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
        				    $tdate=date('Y-m-t');
        				    $user_final_stock=$product->qty;
        				    $this->db->insert('eshop_stock_stockist',array('qty'=>$user_final_stock,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'start_date'=>$fdate,'end_date'=>$tdate));
        				    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
        				}
    					//print_r($commission_info);
    					$product_id=$product->product_id;
    					$cart_final_price=$this->session->userdata('cart_final_price');
    					$pv=$guest_point*$product->qty;
    					//$discount=$discount1*$product->qty;
    					$total_pv=$total_pv+$pv;
    					$total_discount=$cart_total_discount;
    				}
        				//exit;
        				
        				
        				$cart_final_price=$this->session->userdata('cart_final_price');
        				//$cart_final_bv=$this->session->userdata('cart_final_bv');
        				//$owner_user_id=$this->session->userdata('stockist_id');
        				$eshopdata=array(
        				'order_id'=>$order_id,
        				'role'=>(string)$role,
        				'user_id'=>$user_id,
        				'guest_id'=>$guest_id,
        				'owner_user_id'=>$owner_user_id,
        				'order_from'=>'eshop',
        				'order_details'=>json_encode($this->session->userdata('cart')),
        				'total_products'=>$this->session->userdata('total_products'),
        				'discount'=>$total_discount,
        				'final_price'=>$cart_final_price,
        				'final_pv'=>$cart_total_tax,
        				'payment_method'=>'2',
        				'bill'=>1,
        				'order_status'=>1
        				);
        				//pr($eshopdata); exit;
        				$this->db->insert('eshop_orders',$eshopdata);
				
				
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
				redirect(site_url().'Admin/Eshop/order_successful?order_id='.$order_id);
				exit;
			}
			else 
			{
				
				redirect(site_url().'Admin/Eshop/ourStore');
				exit;
			}
		
		
	}// end if
	public function ewalletPaymentConfirmTopup()
	{
				$owner_user_id=$this->session->userdata('user_id');
				$user_id=$this->session->userdata('selected_user_id');
				//$center_leader=$this->session->userdata('center_leader');
				$role=$this->session->userdata('userType');
				if(!empty($this->session->userdata('cart')) && !empty($this->session->userdata('total_products')) && !empty($this->session->userdata('cart_final_price')))
				{
    				$cart=(object)$this->session->userdata('cart');
    				$order_id=$this->generateUniqueOrderId();
    				//	pr($cart); exit;
    				$bonus_date=date('Y-m-d');
    				$date=date('Y-m-d');
    				$total_pv=0;
    				$total_discount=0;
    				foreach($cart as $product)
    				{
    					$product=(object)$product;
    					$product_stock_info=$this->db->select(array('qty','total_order','guest_point','new_price','discount','tax'))->from('eshop_products')->where('id',$product->product_id)->get()->row();
    					$final_stock=$product_stock_info->qty-$product->qty;
    					$total_order=$product_stock_info->total_order+1;
    					$guest_point=$product_stock_info->tax;
    					$tax=((int)$product_stock_info->new_price*(int)$guest_point)/100;
                                    		     $cart_total_tax=$cart_total_tax+($product->qty*$tax);
    					$new_price=$product_stock_info->new_price;
    					$discount1=(int)$product_stock_info->discount;
    					
    					/*$tax=((int)$product_stock_info->new_price*(int)$product_stock_info->tax)/100;
        		     $cart_total_tax=$cart_total_tax+($product->qty*$tax);*/
    				    $this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));
    					$this->db->update('eshop_stock',array('qty'=>$final_stock),array('product_id'=>$product->product_id));
    					
    					/*$stock_count=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id))->get()->num_rows();
    					if($stock_count)
    					{
    					    $stock_info=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id))->get()->row();
    					    $user_final_stock=$stock_info->qty+$product->qty;
    					    $this->db->update('eshop_stock_stockist',array('qty'=>$user_final_stock),array('product_id'=>$product->product_id,'stockist_id'=>$user_id));
    					    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
    					}
    					else
    					{
    					    $user_final_stock=$product->qty;
    					    $this->db->insert('eshop_stock_stockist',array('qty'=>$user_final_stock,'product_id'=>$product->product_id,'stockist_id'=>$user_id));
    					    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
    					}*/
    					$stock_count=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id,'start_date >='>$date,'end_date <='=>$date))->get()->num_rows();
        				if($stock_count)
        				{
        				    $stock_info=$this->db->select('*')->from('eshop_stock_stockist')->where(array('product_id'=>$product->product_id,'stockist_id'=>$user_id,'start_date >='>$date,'end_date <='=>$date))->get()->row();
        				    $user_final_stock=$stock_info->qty+$product->qty;
        				    $this->db->update('eshop_stock_stockist',array('qty'=>$user_final_stock),array('product_id'=>$product->product_id,'stockist_id'=>$user_id,'start_date >='>$date,'end_date <='=>$date));
        				    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
        				}
        				else
        				{
        				    $fdate=date('Y-m-01');
        				    $tdate=date('Y-m-t');
        				    $user_final_stock=$product->qty;
        				    $this->db->insert('eshop_stock_stockist',array('qty'=>$user_final_stock,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'start_date'=>$fdate,'end_date'=>$tdate));
        				    $this->db->insert('eshop_stock_stockist_history',array('type'=>1,'qty'=>$product->qty,'product_id'=>$product->product_id,'stockist_id'=>$user_id,'order_id'=>$order_id));
        				}
    					//print_r($commission_info);
    					$product_id=$product->product_id;
    					$cart_final_price=$this->session->userdata('cart_final_price');
    					$pv=$guest_point*$product->qty;
    					$discount=$discount1*$product->qty;
    					$total_pv=$total_pv+$pv;
    					$total_discount=$total_discount+$discount;
    				}
        				//exit;
        				
        				
        				$cart_final_price=$this->session->userdata('cart_final_price');
        				//$cart_final_bv=$this->session->userdata('cart_final_bv');
        				//$owner_user_id=$this->session->userdata('stockist_id');
        				$eshopdata=array(
        				'order_id'=>$order_id,
        				'role'=>(string)$role,
        				'user_id'=>$user_id,
        				'guest_id'=>$guest_id,
        				'owner_user_id'=>$owner_user_id,
        				'order_from'=>'eshop',
        				'order_details'=>json_encode($this->session->userdata('cart')),
        				'total_products'=>$this->session->userdata('total_products'),
        				'discount'=>$total_discount,
        				'final_price'=>$cart_final_price,
        				'final_pv'=>$cart_total_tax,
        				'payment_method'=>'2',
        				'order_status'=>1,
        				'bill'=>1,
        				'retopup'=>1
        				);
        				//pr($eshopdata); exit;
        				$this->db->insert('eshop_orders',$eshopdata);
				
				
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
				$this->session->unset_userdata('cart_total_discount');
				$this->session->unset_userdata('registration_with_cart');
				redirect(site_url().'Admin/Eshop/order_successful?order_id='.$order_id);
				exit;
			}
			else 
			{
				
				redirect(site_url().'Admin/Eshop/ourStore');
				exit;
			}
		
		
	}// end if
	public function order_successful()
	{
	    $data=array();
	    $order_id=$_GET['order_id'];
	    $data['order_id']=$order_id;
	    $data['module_name']=$this->moduleName;
	    _userLayout("ecommerce/eshop-mgmt/order_successful",$data);
	}
	public function uploadCSV() {
        if (!empty($_FILES['csv_file']['name'])) {
            $config['upload_path']   = FCPATH . '/uploads/';
            //print_r($config);die;
            $config['allowed_types'] = 'csv';
            $config['file_name']     = time() . '_' . $_FILES['csv_file']['name'];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('csv_file')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('Admin/Eshop/allProductList');
            } else {
                $fileData = $this->upload->data();
                $filePath = './uploads/' . $fileData['file_name'];
                $this->importCSV($filePath);
            }
        }
    }

    private function importCSV($filePath) {
        $file = fopen($filePath, 'r');
        $rowCount = 0;

        while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($rowCount == 0) { 
                $rowCount++; 
                continue; // Skip header row
            }
           // echo '<pre>';print_r($row);
            //echo $row[10];
            $parent_category_id = $this->pgetCategoryId($row[10]); // Column M (Category)
            $category_id        = $this->sgetCategoryId($row[11]); // Column N (Sub category)
            $subcat_id          = $this->cgetCategoryId($row[12]); // Column O (Sub Sub Category)

            $productData = [
                'user_id'           => $this->user_id,
                'parent_category_id'=> $parent_category_id,
                'category_id'       => $category_id,
                'subcat_id'         => $subcat_id,
                //'sku'               => 'SKU' . rand(1000, 9999), 
                'title'             => $row[1], // Column B (Product Name)
                'product_image'     => $row[3], // Column E (Image URL)
                'old_price'         => preg_replace('/[^0-9]/', '', $row[4]), // Column G (MRP)
                'new_price'         => preg_replace('/[^0-9]/', '', $row[8]), // Column J (Offer Price)
                'qty'               => 10,
                'description'       => $row[2], // Column C (Description)
                //'long_description'  => $row[2], 
                'status'            => '1', 
                'discount'          => str_replace('%', '', $row[5]), // Column H (Discount)
                'tax'               => $row[7], // Column I (GST)
                'shipment_charge'   => NULL,
                'quantity'          => 10, 
                'role'              =>$this->role,
            ];
           // echo '<pre>';print_r($productData);

            $this->db->insert('eshop_products', $productData);
            $rowCount++;
        }
    //   die;

        fclose($file);
        unlink($filePath); // Delete the file after processing
        $this->session->set_flashdata('success', 'Products imported successfully.');
        redirect('Admin/Eshop/allProductList');
    }

    private function pgetCategoryId($category_name) {
        if (!$category_name) {
            return NULL;
        }

        $query = $this->db->get_where('eshop_category', ['category_name' => trim($category_name)]);

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            // 			$date=date('d-M-Y');
            // 			$role=$this->role;
            // 			$position=$this->db->select_max('position')->from('eshop_category')->get()->row();
            // 			if(!empty($position->position))
            // 			{
            // 				$position=$position->position+1;
            // 			}
            // 			else 
            // 			{
            // 				$position=1;
            // 			}
            // 			$insert_data = array(
            //                 'category_name' => trim($category_name),
            //                 'active_status' => 1,
            //     			'create_date'=>$date,
            //     			'role'=>$this->role,
            //     			'position'=>$position
            //             );
            //             $this->db->insert('eshop_category', $insert_data);
            //             return $this->db->insert_id();
        }
    }
    private function sgetCategoryId($category_name) {
        if (!$category_name) {
            return NULL;
        }
        $query = $this->db->get_where('eshop_subcategory', ['subcategory_name' => trim($category_name)]);

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } 
    }
    private function cgetCategoryId($category_name) {
        if (!$category_name) {
            return NULL;
        }
        $query = $this->db->get_where('eshop_sub2category', ['subcategory_name' => trim($category_name)]);

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } 
    }
}//end class
