<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/admin_video_tutorials
*/
class Admin_Video_Tutorials extends Common_Controller 
{
   public function __construct()
   {
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model('admin_video_tutorials_model','tutorials_model');
   }
   public function addNewVideo()
   {
	   $data=array();
	   $data['all_video_category']=$this->tutorials_model->getAllVideoCategory();
	   if(!empty($this->input->post('btn')))
		{
		 $title=$this->input->post('title');
         $video_categories_id=$this->input->post('video_categories_id');
         $assign_status=(!empty($video_categories_id))?'1':'0';
		 
		 
		 $video_path=$this->input->post('video_path');
		 $video_desc=$this->input->post('video_desc');
		 $approve_status=$this->input->post('approve_status');
		 
		 
		 $result=$this->db->select('*')->from("video_categories")->where('id',$video_categories_id)->get()->row();
		 $pkg_id=$result->pkg_id;
		 
		 
         
		 ///////////////////////////////////
		 $this->db->insert("video",array(
				'pkg_id'=>$pkg_id,
				'video_categories_id'=>$video_categories_id,
				"title"=>$title,
				"teacher_id"=>null,
				"video_path"=>$video_path,
				"video_desc"=>$video_desc,
				"role_type"=>'1',
				"approve_status"=>$approve_status,
				"assign_status"=>$assign_status
				));
		 $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New Video is added successfully!</h5>');       
         redirect(ci_site_url()."admin/admin_video_tutorials/addNewVideo");
		 exit;
		}
	   //pr($data['all_video_category']);
	   _adminLayout("admin-video-tutorials-mgmt/add-new-video",$data);
   }//end method
   
   public function editVideo($id)
   {
	   $data=array();
	   $id=ID_decode($id);
	   if(!empty($this->input->post('btn')))
		{
		 $title=$this->input->post('title');
         //die;
		 $video_categories_id=$this->input->post('video_categories_id');
         $assign_status=(!empty($video_categories_id))?'1':'0';
		 $video_path=$this->input->post('video_path');
		 $video_desc=$this->input->post('video_desc');
		 $approve_status=$this->input->post('approve_status');
		 $result=$this->db->select('*')->from("video_categories")->where('id',$video_categories_id)->get()->row();
		 $pkg_id=$result->pkg_id;
		 ///////////////////////////////////
		 $this->db->update("video",array(
				'pkg_id'=>$pkg_id,
				'video_categories_id'=>$video_categories_id,
				"title"=>$title,
				"teacher_id"=>null,
				"video_path"=>$video_path,
				"video_desc"=>$video_desc,
				"role_type"=>'1',
				"approve_status"=>$approve_status,
				"assign_status"=>$assign_status
				),array('id'=>$id));
		 $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Video is edited successfully!</h5>');       
         redirect(ci_site_url()."admin/admin_video_tutorials/editVideo/".ID_encode($id));
		 exit;
		}
		$data['id']=$id;
		$data['all_video_category']=$this->tutorials_model->getAllVideoCategory();
	    $data['video']=$this->tutorials_model->getVideo($id);
		//pr($data['video']);
	   _adminLayout("admin-video-tutorials-mgmt/edit-video",$data);
   }//end method
   
   public function viewAllVideoList()
   {
	   $data=array();
	   $all_video=$this->tutorials_model->getAllVideo();
	   $data['all_video']=$all_video;
	   _adminLayout("admin-video-tutorials-mgmt/view-all-video-list",$data);
   }//end method
   public function viewAllApprovedVideoList()
   {
	   $data=array();
	   $all_video=$this->tutorials_model->getAllApprovedVideo();
	   $data['all_video']=$all_video;
	   _adminLayout("admin-video-tutorials-mgmt/view-all-approved-video-list",$data);
   }//end method
   public function viewAllUnapprovedVideoList()
   {
	   $data=array();
	   $all_video=$this->tutorials_model->getAllUnapprovedVideo();
	   $data['all_video']=$all_video;
	   _adminLayout("admin-video-tutorials-mgmt/view-all-unapproved-video-list",$data);
   }//end method
   public function viewAllAssignedVideoList()
   {
	   $data=array();
	   $all_video=$this->tutorials_model->getAllAssignedVideo();
	   $data['all_video']=$all_video;
	   _adminLayout("admin-video-tutorials-mgmt/view-all-assigned-video-list",$data);
   }//end method
   public function viewAllUnassignedVideoList()
   {
	   $data=array();
	   $all_video=$this->tutorials_model->getAllUnassignedVideo();
	   //pr($all_video);
	   $data['all_video']=$all_video;
	   _adminLayout("admin-video-tutorials-mgmt/view-all-unassigned-video-list",$data);
   }//end method
   public function changeVideoStatus($id,$status)
   {
		$id=ID_decode($id);
		$this->db->update('video',array('approve_status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span>  Video status is changed successfully.</h4>');
		redirect(ci_site_url().'admin/admin_video_tutorials/viewAllVideoList');
		exit;
	}
}//end class
?>