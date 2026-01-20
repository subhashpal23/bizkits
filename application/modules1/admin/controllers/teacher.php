<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/teacher
*/
class Teacher extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("teacher_model");
	} 
	public function generateTeacherId()
	{
		$random_number="T".mt_rand(100000,999999);
	    if($this->db->select('id')->from('teacher')->where('user_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateTeacherId();
	    }
	    return $random_number;
	}
	public function viewAllTeacher()
	{
		$data=array();
		$data['all_teacher']=$this->teacher_model->getAllTeacher();
		//pr($data['all_teacher']);
		_adminLayout("teacher-mgmt/view-all-teacher",$data);
	}
	public function addNewTeacher()
	{
		if(!empty($this->input->post('btn')))
		{
		 $teacher_id=$this->generateTeacherId();
		 $username=$this->input->post('username');
         $password=$this->input->post('password');
         $first_name=$this->input->post('first_name');
         $last_name=$this->input->post('last_name');
		 $phone_no=$this->input->post('phone_no');
		 $email=$this->input->post('email');
		 ///////////////////////////////////
		 $image_upload_path='/images/';
		 $image=adImageUpload($_FILES['image'],1, $image_upload_path);
		 ///////////////////////////////////
		 $this->db->insert("teacher",array(
				'user_id'=>$teacher_id,
				'username'=>$username,
				"password"=>$password,
				"first_name"=>$first_name,
				"last_name"=>$last_name,
				"phone_no"=>$phone_no,
				"email"=>$email,
				"image"=>$image
				));
		 $this->sendWelcomeEmailToTeacher($username,$password,$email);		
		 $this->session->set_flashdata("flash_msg", '<h5><span class="text-semibold">Well done!</span> New Teacher is added successfully</h5>');         
         redirect(ci_site_url()."admin/teacher/viewAllTeacher");
		 exit;
		}
		$data=array();
		_adminLayout("teacher-mgmt/add-new-teacher",$data);
	}
	public function editTeacher($id)
	{
		$data=array();
		$id=ID_decode($id);
		if(!empty($this->input->post('btn')))
		{
         $password=$this->input->post('password');
         $first_name=$this->input->post('first_name');
         $last_name=$this->input->post('last_name');
		 $phone_no=$this->input->post('phone_no');
		 $email=$this->input->post('email');
		 ///////////////////////////////////
		 $image_upload_path='/images/';
		 $image=adImageUpload($_FILES['image'],1, $image_upload_path);
		 
		 $image=(!empty($image))?$image:$this->input->post('old_image');
		 ///////////////////////////////////
		 $this->db->update("teacher",array(
				"password"=>$password,
				"first_name"=>$first_name,
				"last_name"=>$last_name,
				"phone_no"=>$phone_no,
				"email"=>$email,
				"image"=>$image
				),array('id'=>$id));
		 $this->session->set_flashdata("flash_msg", '<h5><span class="text-semibold">Well done!</span> Rank is edited successfully</h5>');         
         redirect(ci_site_url()."admin/teacher/viewAllTeacher/");
         exit;
		}
		$data['teacher']=$this->teacher_model->getTeacher($id);
		//pr($data['teacher']);
		_adminLayout("teacher-mgmt/edit-teacher",$data);
	}
	public function deleteTeacher($id)
	{
		$id=ID_decode($id);
		$teacher=$this->teacher_model->getTeacher($id);
		/////////////////
		
		$this->db->delete('subject',array('teacher_id'=>$teacher->user_id));
		$this->db->delete('subject_category',array('teacher_id'=>$teacher->user_id));$this->db->delete('subject_video',array('teacher_id'=>$teacher->user_id));
		
		////////////////////
		$this->db->delete("teacher",array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<h5><span class="text-semibold">Well done!</span> Teacher is deleted successfully</h5>');         
        redirect(ci_site_url()."admin/teacher/viewAllTeacher/");
	}//end method
	public function isTeacherExists()
	{
		 $username=$this->input->post('username');
		 $total=$this->db->select('*')
		  ->from('teacher')
		  ->where('username',$username)
		  ->get()->num_rows();
		  if($total>0)
		  {
			 $this->output->set_content_type('application/json')->set_output(json_encode(array('exist'=>'1')));
		  }
		  else 
		  {
			 $this->output->set_content_type('application/json')->set_output(json_encode(array('exist'=>'0')));
		  }
	}//end method
	public function changeTeacherStatus($id,$status)
	{
		$id=ID_decode($id);
		$this->db->update('teacher',array('active_status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<h5><span class="text-semibold">Well done!</span>  Teacher status is changed successfully.</h5>');
		redirect(ci_site_url().'admin/teacher/viewAllTeacher');
		exit;
	}
	public function viewAllActiveTeacher()
	{
		$data=array();
		$data['all_teacher']=$this->teacher_model->getAllActiveTeacher();
		//pr($data['all_teacher']);
		_adminLayout("teacher-mgmt/active-teacher",$data);
	}
	public function viewAllInActiveTeacher()
	{
		$data=array();
		$data['all_teacher']=$this->teacher_model->getAllInActiveTeacher();
		//pr($data['all_teacher']);
		_adminLayout("teacher-mgmt/inactive-teacher",$data);
	}
	public function getAjaxTeacherDetails($teacher_id)
	{
	  $teacher=$this->db->select('*')
	  ->from('teacher')
	  ->where('user_id',$teacher_id)
	  ->get()->row_array();
	  $this->output->set_content_type('application/json')->set_output(json_encode($teacher));
	}
	public function sendWelcomeEmailToTeacher($username,$password,$email)
	{

		$email_data['from']='info@globalsoftwebtechnologies.com';
		$email_data['to']=$email;
		$email_data['subject']='Your Teacher Account Is Created Successfully on Merignos';
		$email_data['username']=$username;
		$email_data['password']=$password;
		$email_data['email']=$email;
		$email_data['email-template']='teacher-welcome-email';
		_sendEmail($email_data);
	}//end function 
}//end class
