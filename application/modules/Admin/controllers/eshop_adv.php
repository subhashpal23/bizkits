<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/eshop_adv
*/
class Eshop_Adv extends Common_Controller 
{
	private $moduleName;
	private $userId;
	private $role;
	private $controllerName;
	private $view_file_path;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->user_id=$this->session->userdata('user_id');
		$this->load->model('eshop_adv_model','adv_model');
		////////////////
		$this->moduleName=$this->router->fetch_module();
		$this->controllerName=$this->router->fetch_class();
		$this->view_file_path="ecommerce/eshop-adv-mgmt";
		/////////////////
		$this->role='1';
		
	} 
	public function sliderImageList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		$all_slider=$this->adv_model->getAllSlider();
		//pr($all_slider);
		$data['all_slider']=$all_slider;
		_adminLayout($this->view_file_path."/slider-image-list",$data);
	}//end method
	public function addNewSliderImage()
	{
		if(!empty($this->input->post('btn')))
	   {
		   $image_upload_path='/eshop_images/slider_images/';
		   $slider_image=adImageUpload($_FILES['slider_image'],1, $image_upload_path);
		   $slider_caption=$this->input->post('slider_caption');
		   $active_status=$this->input->post('active_status');
		   $position=$this->db->select_max('position')->from('eshop_adv_slider')->get()->row();
		   if(!empty($position->position))
		   {
				$position=$position->position+1;
		   }
		   else 
		   {
				$position=1;
		   }
		   $this->db->insert('eshop_adv_slider',array(
		   'slider_image'=>$slider_image,
		   'slider_caption'=>$slider_caption,
		   'position'=>$position,
		   'active_status'=>$active_status
		   ));
		   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New Slider is added successfully!</h5>');	
		   redirect(site_url().$this->moduleName."/".$this->controllerName."/sliderImageList");
		   exit;
	   }
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		_adminLayout($this->view_file_path."/add-new-slider-image",$data);
	}//end method
	public function editSliderImage($id)
	{
	   $id=ID_decode($id);
	   if(!empty($this->input->post('btn')))
	   {
		   $image_upload_path='/eshop_images/slider_images/';
		   $slider_image=adImageUpload($_FILES['slider_image'],1, $image_upload_path);
		   
		   $slider_image=(!empty($slider_image))?$slider_image:$this->input->post('slider_old_image');
		   
		   $slider_caption=$this->input->post('slider_caption');
		   $active_status=$this->input->post('active_status');
		   $this->db->update('eshop_adv_slider',array(
		   'slider_image'=>$slider_image,
		   'slider_caption'=>$slider_caption,
		   'active_status'=>$active_status
		   ),array('id'=>$id));
		   
		   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Slider is edited successfully!</h5>');	
		   redirect(site_url().$this->moduleName."/".$this->controllerName."/sliderImageList");
		   exit;
	   }
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		$slider=$this->adv_model->getSlider($id);
		//pr($slider);
		$data['slider']=$slider;
		_adminLayout($this->view_file_path."/edit-slider-image",$data);
	}//end method
	public function deleteSliderImage($id)
	{
	   $id=ID_decode($id);
	   $this->db->delete('eshop_adv_slider',array('id'=>$id));
	   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Slider is deleted successfully!</h5>');	
	   redirect(site_url().$this->moduleName."/".$this->controllerName."/sliderImageList");
	   exit;
	}//end method
   public function moveUp($tableName,$current_position,$upper_position)
   {
	   moveUp($tableName,$current_position,$upper_position);
	   if($tableName=='eshop_adv_slider')
	   {
		 $this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span> Slider Position is changed successfully.</h4>');
		 redirect(site_url().$this->moduleName."/".$this->controllerName.'/sliderImageList');
		 exit;
	   }
	   if($tableName=='eshop_adv_slider_sidebar')
	   {
		 $this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span>Sidebar Image Position is changed successfully.</h4>');
		 redirect(site_url().$this->moduleName."/".$this->controllerName.'/sliderSideImageList');
		 exit;
	   }
	   if($tableName=='eshop_adv_banner')
	   {
		 $this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span> Banner Position is changed successfully.</h4>');
		 redirect(site_url().$this->moduleName."/".$this->controllerName.'/bannerImageList');
		 exit;
	   }
   }
	////////////////////
	public function sliderSideImageList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		$all_slider=$this->adv_model->getAllSliderSiderBarImage();
		//pr($all_slider);
		$data['all_slider']=$all_slider;
		_adminLayout($this->view_file_path."/slider-side-image-list",$data);
	}//end method
	public function editSliderSideBarImage($id)
	{
		$id=ID_decode($id);
	   if(!empty($this->input->post('btn')))
	   {
		   $image_upload_path='/eshop_images/slider_sidebar_images/';
		   $sidebar_image=adImageUpload($_FILES['sidebar_image'],1, $image_upload_path);
		   
		   $sidebar_image=(!empty($sidebar_image))?$sidebar_image:$this->input->post('sidebar_old_image');
		   
		   $caption_text=$this->input->post('caption_text');
		   $active_status=$this->input->post('active_status');
		   $this->db->update('eshop_adv_slider_sidebar',array(
		   'sidebar_image'=>$sidebar_image,
		   'caption_text'=>$caption_text,
		   ),array('id'=>$id));
		   
		   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Slider Sidebar Image is edited successfully!</h5>');	
		   redirect(site_url().$this->moduleName."/".$this->controllerName."/sliderSideImageList");
		   exit;
	   }
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		///////////////////
		$slider=$this->adv_model->getSliderSideBar($id);
		//pr($slider);
		$data['slider']=$slider;
		_adminLayout($this->view_file_path."/edit-slider-side-bar-image",$data);
	}
	///////////////////////
	public function bannerImageList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		$all_banner=$this->adv_model->getAllBanner();
		//pr($all_slider);
		$data['all_banner']=$all_banner;
		_adminLayout($this->view_file_path."/banner-image-list",$data);
	}//end method
	public function addNewBanner()
	{
		if(!empty($this->input->post('btn')))
	   {
		  $title=$this->input->post('title');
		  $parent_category_id=$this->input->post('parent_category_id');
		  $category_id=$this->input->post('category_id');
		  $image_upload_path='/eshop_images/banner_images/';
		   $banner_image=adImageUpload($_FILES['banner_image'],1, $image_upload_path);
		   
		   $banner_caption=$this->input->post('banner_caption');
		   $active_status=$this->input->post('active_status');
		   $position=$this->db->select_max('position')->from('eshop_adv_banner')->get()->row();
		   if(!empty($position->position))
		   {
				$position=$position->position+1;
		   }
		   else 
		   {
				$position=1;
		   }
		   $this->db->insert('eshop_adv_banner',array(
		   'title'=>$title,
		   'banner_image'=>$banner_image,
		   'banner_caption'=>$banner_caption,
		   'position'=>$position,
		   'parent_category_id'=>$parent_category_id,
		   'category_id'=>$category_id,
		   'active_status'=>$active_status
		   ));
		   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New Banner is added successfully!</h5>');	
		   redirect(site_url().$this->moduleName."/".$this->controllerName."/bannerImageList");
		   exit;
	   }
		$data=array();
		$result=$this->db->query("SELECT * from eshop_category")->result_array();
		 $data['all_category']=$result;
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		_adminLayout($this->view_file_path."/add-new-banner",$data);
	}//end method
	public function editBannerImage($id)
	{
	   $id=ID_decode($id);
	   if(!empty($this->input->post('btn')))
	   {
		   $title=$this->input->post('title');
		   $parent_category_id=$this->input->post('parent_category_id');
		   $category_id=$this->input->post('category_id');
		   $image_upload_path='/eshop_images/banner_images/';
		   $banner_image=adImageUpload($_FILES['banner_image'],1, $image_upload_path);
		   
		   $banner_image=(!empty($banner_image))?$banner_image:$this->input->post('banner_old_image');
		   
		   $banner_caption=$this->input->post('banner_caption');
		   $active_status=$this->input->post('active_status');
		   $this->db->update('eshop_adv_banner',array(
		   'title'=>$title,
		   'banner_image'=>$banner_image,
		   'banner_caption'=>$banner_caption,
		   'parent_category_id'=>$parent_category_id,
		   'category_id'=>$category_id,
		   'active_status'=>$active_status
		   ),array('id'=>$id));
		   
		   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Banner is edited successfully!</h5>');	
		   redirect(site_url().$this->moduleName."/".$this->controllerName."/bannerImageList");
		   exit;
	   }
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['controller_name']=$this->controllerName;
		$banner=$this->adv_model->getBanner($id);
		
		$result=$this->db->select('*')->from('eshop_adv_banner')->where(array('id'=>$id))->get()->row_array();
		
		$result1=$this->db->query("SELECT * from eshop_category")->result_array();
		 $data['all_category']=$result1;
		 
		$sub_category=$this->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$result['parent_category_id']))->get()->result();
		
		$data['sub_category']=$sub_category;
		
		$data['banner']=$banner;
		_adminLayout($this->view_file_path."/edit-banner-image",$data);
	}//end method
	public function deleteBannerImage($id)
	{
	   $id=ID_decode($id);
	   $this->db->delete('eshop_adv_banner',array('id'=>$id));
	   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Banner is deleted successfully!</h5>');	
	   redirect(site_url().$this->moduleName."/".$this->controllerName."/bannerImageList");
	   exit;
	}//end method
	
}//end class
