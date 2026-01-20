<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/MarketingTools
*/
class MarketingTools extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		affiliate_auth();
		$this->load->helper("layout_helper");
		$this->load->model("marketing_tools_model");	
		$this->userId=$this->session->userdata('user_id');
	} 
	public function viewReferralLinks()
	{
		$data=array();
		$user_info=$this->db->select('username')->from('user_registration')->where('user_id',$this->userId)->get()->row();
		$data['referral_affiliate_link']=ci_site_url().'Web/register/'.$user_info->username;
		//$data['referral_affiliate_link']=ci_site_url().'join-us/'.$user_info->username;
		//$data['referral_school_link']=ci_site_url().'join-us/'.$user_info->username;
		//$data['referral_affiliate_link']=base_url().'Web/affiliate-signup/'.$user_info->username;
        //$data['referral_school_link']=base_url().'Web/listaschool/'.$user_info->username;
	 	_userLayout("marketing-tools-mgmt/view-referral-links",$data);
	}


	public function viewAllImages()
	{
		$data=array();
		$data['all_images']=$this->marketing_tools_model->getAllPublishedMarketingImages($this->userId);
		//pr($data['all_images']);
	 	_userLayout("marketing-tools-mgmt/view-image-list",$data);
	}
	public function viewAllVideo()
	{
		$data=array();
		$data['all_videos']=$this->marketing_tools_model->getAllPublishedMarketingVideos($this->userId);
	 	_userLayout("marketing-tools-mgmt/view-video-list",$data);
	}
    public function addMarketingImage()
	{
		if(!empty($this->input->post('btn')))
		{
		    $user_id=$this->userId;
			$title=$this->input->post('title');
			$description=$this->input->post('description');
		    $image_upload_path='/images/';
		    $image_path=adImageUpload($_FILES['image_path'],1, $image_upload_path);
			$this->db->insert('marketing_images',array(
				'title'=>$title,
				'description'=>$description,
				'image_path'=>$image_path,
				'user_id'=>$user_id,
				'status'=>'1'
				));
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image is added successfully.');
			redirect(ci_site_url().'Affiliate/MarketingTools/viewAllImages');
			exit;
		}
		$data=array();
	 	_userLayout("marketing-tools-mgmt/add-marketing-image",$data);
	}
	public function changeStatus($id,$status)
	{
		$id=ID_decode($id);
		$this->db->update('marketing_images',array('status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image status is changed successfully.');
		redirect(ci_site_url().'Affiliate/MarketingTools/viewAllImages');
		exit;
	}
	public function deleteImage($id)
	{
		$id=ID_decode($id);
		$this->db->delete("marketing_images",array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image is deleted successfully.');
		redirect(ci_site_url().'Affiliate/MarketingTools/viewAllImages');
		exit;
	}
	public function addMarketingVideo()
	{
		if(!empty($this->input->post('btn')))
		{
		    $user_id=$this->userId;
			$title=$this->input->post('title');
			$description=$this->input->post('description');
			$video_path=$this->input->post('video_path');
			$this->db->insert('marketing_videos',array(
				'title'=>$title,
				'description'=>$description,
				'video_path'=>$video_path,
				'user_id'=>$user_id,
				'status'=>'1'
				));
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Video is added successfully.');
			redirect(ci_site_url().'Affiliate/MarketingTools/viewAllVideo');
			exit;
		}
		$data=array();
	 	_userLayout("marketing-tools-mgmt/add-marketing-video",$data);
	}
	public function changeVideoStatus($id,$status)
	{
		$id=ID_decode($id);
		$this->db->update('marketing_videos',array('status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Video status is changed successfully.');
		redirect(ci_site_url().'Affiliate/MarketingTools/viewAllVideo');
		exit;
	}
	public function deleteVideo($id)
	{
		$id=ID_decode($id);
		$this->db->delete("marketing_videos",array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Video is deleted successfully.');
		redirect(ci_site_url().'Affiliate/MarketingTools/viewAllVideo');
		exit;
	}
}//end class
