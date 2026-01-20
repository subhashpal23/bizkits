<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/MarketingTools
*/
class Students extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		school_auth();
		$this->load->helper("layout_helper");
		$this->load->helper("registration_helper");
		$this->load->model("student_model");	
		$this->userId=$this->session->userdata('user_id');		
	} 
	public function allStudents()
	{
	    $data=array();
		$data['all_students']=$this->student_model->getAllStudents($this->userId);
		//pr($data['all_images']);
	 	_userLayout("student-mgmt/allstudents",$data);
	}
	public function viewReferralLinks()
	{
		$data=array();
		$user_info=$this->db->select('username')->from('user_registration')->where('user_id',$this->userId)->get()->row();
		$data['referral_link']=ci_site_url().'join-us/'.$user_info->username;
		//$data['referral_affiliate_link']=ci_site_url().'join-us/'.$user_info->username;
		//$data['referral_school_link']=ci_site_url().'join-us/'.$user_info->username;
		$data['referral_affiliate_link']=base_url().'Web/affiliate-signup/'.$user_info->username;
        $data['referral_school_link']=base_url().'Web/listaschool/'.$user_info->username;
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
    public function addStudent()
	{
	    // pr($_POST);
		if(!empty($this->input->post('btn')))
		{
		    //pr($_POST);exit;
		    $user_id=$this->userId;
		    $username=$this->input->post('username');
		    $user_count=$this->db->select('*')->from('user_registration')->where(array('username'=>$username))->get()->num_rows();
			
			if($user_count==1)
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Username already exist</span>');
				redirect(site_url()."School/Students/addStudent");
				exit();
			}
		    $password=$this->input->post('password');
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			$gender=$this->input->post('gender');
			$date_of_birth=$this->input->post('date_of_birth');
			$email=$this->input->post('email');
			$contact_no=$this->input->post('contact_no');
			
			$message=$this->input->post('message');
			$rollno=$this->input->post('rollno');
			$bloodgroup=$this->input->post('bloodgroup');
			$religion=$this->input->post('religion');
			$class=$this->input->post('class');
			$section=$this->input->post('section');
			
			
		    $image_upload_path='/images/';
		    $image_path=adImageUpload($_FILES['photo'],1, $image_upload_path);
		    $user_id=generateUserId();
			$user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
    		'parent_id'=>$this->userId,
    		/*'nom_id'=>$nom_id,*/
    		'username'=>$username,
    		'password'=>$password,
    		't_code'=>$password,
    		'ref_leg_position'=>'left',
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'address_line1'=>$date_of_birth,
    		 'gender'=>$gender,
    		 'registration_date'=>date('d-m-Y'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
    		 'registration_status'=>'0',
    		 'registration_method'=>'2',
			 'registration_method_name'=>'Free',
			 'member_type'=>'3'
    		);
            $this->db->insert('user_registration',$user_registration_data);
            $this->db->insert_id();
            
            
            $student_details_data=array(
    		/*Sponsor and account informtaion*/
    		'student_id'=>$user_id,
    		 'about_us'=>$message,
    		 'rollno'=>$rollno,
    		 'bloodgroup'=>$bloodgroup,
    		 'religion'=>$religion,
    		 'class'=>$class,
    		 'section'=>$section
    		);
            $this->db->insert('student_details',$student_details_data);
            
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Student is added successfully.');
			redirect(ci_site_url().'School/Students/allStudents');
			exit;
		}
		$data=array();
	 	_userLayout("student-mgmt/add-student",$data);
	}
	public function changeStatus($id,$status)
	{
		$id=ID_decode($id);
		$this->db->update('marketing_images',array('status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image status is changed successfully.');
		redirect(ci_site_url().'School/MarketingTools/viewAllImages');
		exit;
	}
	public function deleteImage($id)
	{
		$id=ID_decode($id);
		$this->db->delete("marketing_images",array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image is deleted successfully.');
		redirect(ci_site_url().'School/MarketingTools/viewAllImages');
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
			redirect(ci_site_url().'School/MarketingTools/viewAllVideo');
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
		redirect(ci_site_url().'School/MarketingTools/viewAllVideo');
		exit;
	}
	public function deleteVideo($id)
	{
		$id=ID_decode($id);
		$this->db->delete("marketing_videos",array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Video is deleted successfully.');
		redirect(ci_site_url().'School/MarketingTools/viewAllVideo');
		exit;
	}
}//end class
