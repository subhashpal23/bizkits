<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package teacher/video_tutorials
*/
class Video_Tutorials extends Common_Controller 
{
   public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("video_tutorials_model");
	} 
   ///@view course List
   public function viewAllTeacher()
   {
	   $data=array();
	   
	   $data['all_teacher']=$this->video_tutorials_model->getAllTeacher();
	   //pr($data['all_teacher']);
	   _adminLayout("video-tutorials-mgmt/teacher-list",$data); 
   }	
   public function viewAllVideoList()
   {
		$data=array();
		$data['all_videos']=$this->video_tutorials_model->getAllVideo();
		_adminLayout("video-tutorials-mgmt/view-all-video-list",$data);
   }
   public function viewAllApprovedVideoList()
   {
		$data=array();
		$data['all_videos']=$this->video_tutorials_model->getAllApprovedVideo();
		_adminLayout("video-tutorials-mgmt/view-all-approved-video-list",$data);
   }
   public function viewAllUnapprovedVideoList()
   {
		$data=array();
		$data['all_videos']=$this->video_tutorials_model->getAllUnapprovedVideo();
		_adminLayout("video-tutorials-mgmt/view-all-unapproved-video-list",$data);
   }
   public function changeVideoStatus($id,$status)
   {
		$id=ID_decode($id);
		
		$this->db->update('subject_video',array('admin_approve_status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<h4><span class="text-semibold">Well done!</span>  Video status is changed successfully.</h4>');
		redirect(ci_site_url().'admin/video_tutorials/viewAllVideoList');
		exit;
	}
   public function courseList($teacher_id,$subject_id=null)
   {
	   $data=array();
	   $teacher_id=ID_decode($teacher_id);
	   $all_subject=$this->video_tutorials_model->getAllSubject($teacher_id);
	   $data['all_subject']=$all_subject;
	   ////////////////////////////////////////////////
	   if(!empty($subject_id))
	   {
		   $subject_id=ID_decode($subject_id);
		   $subject_category=$this->video_tutorials_model->getSubjectCategory($subject_id);
	   }
	   else 
	   {
		   $subject_category=$this->video_tutorials_model->getSubjectCategory($all_subject[0]->id);
	   }
	   //////////////////////////////////
	   $all_category=array();
	   $video_path=null;
	   foreach($subject_category as $category)
	   {
		   $all_video=$this->video_tutorials_model->getCategoryVideo($category->id);
		   if(!empty($all_video) && count($all_video))
		   {
			   if(empty($video_path))
			   $video_path=$all_video[0]->video_path;
		   }
		   $category->all_video=$all_video;
		   $all_category[]=$category;
	   }
	   //pr($all_category);
	   $data['all_category']=$all_category;
	   $data['video_path']=$video_path;
	   //////////////////////////////////////
	   _adminLayout("video-tutorials-mgmt/course-list",$data); 
   }
   public function totalSoldSubject()
   {
	   $data=array();
	   $data['all_subject']=$this->video_tutorials_model->getTotalSoldSubject();
	   _adminLayout("video-tutorials-mgmt/total-sold-subject",$data); 
   }
}//end class
?>