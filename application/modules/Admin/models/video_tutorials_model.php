<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package teacher/video_tutorials_model
*/
class Video_Tutorials_Model extends Common_Model
{
  	public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    public function getAllTeacher()
	{
		return $this->db->select('*')->from('teacher')->get()->result();
	}
	public function getVideo($id)
	{
		return $this->db->select('*')->from('subject_video')->where('id',$id)->get()->row();
	}
	public function getAllVideo()
	{
		return $this->db->select(array('sv.*','sc.category_name','s.subject_name','th.username'))
		->join('subject as s','s.id=sv.subject_id')
		->join('subject_category as sc','sc.id=sv.category_id')
		->join('teacher as th','th.user_id=sc.teacher_id')
		->where(array('sv.teacher_approve_status'=>'1'))
		->from('subject_video as sv')
		->get()
		->result();
	}
	public function getAllApprovedVideo()
	{
		return $this->db->select(array('sv.*','sc.category_name','s.subject_name','th.username'))
		->join('subject as s','s.id=sv.subject_id')
		->join('subject_category as sc','sc.id=sv.category_id')
		->join('teacher as th','th.user_id=sc.teacher_id')
		->from('subject_video as sv')
		->where(array('sv.admin_approve_status'=>'1','sv.teacher_approve_status'=>'1'))
		->get()
		->result();
	}
	public function getAllUnapprovedVideo()
	{
		return $this->db->select(array('sv.*','sc.category_name','s.subject_name','th.username'))
		->join('subject as s','s.id=sv.subject_id')
		->join('subject_category as sc','sc.id=sv.category_id')
		->join('teacher as th','th.user_id=sc.teacher_id')
		->from('subject_video as sv')
		->where(array('sv.admin_approve_status'=>'0','sv.teacher_approve_status'=>'1'))
		->get()
		->result();
	}
	///////////////
   	public function getAllSubject($teacher_id)
	{
		return $this->db->select('*')->from('subject')->where('teacher_id',$teacher_id)->order_by('position','asc')->get()->result();
		
	}
	public function getSubjectCategory($subject_id)
	{
		return $this->db->select('*')->from('subject_category')
		->order_by('position','asc')
		->where('subject_id',$subject_id)
		->get()
		->result();
	}
	public function getCategoryVideo($category_id)
	{
		return $this->db->select('*')->from('subject_video')
		->order_by('position','asc')
		->where(array('category_id'=>$category_id,'teacher_approve_status'=>'1','admin_approve_status'=>'1'))
		->get()
		->result();
	}
	public function getTotalSoldSubject()
	{
		return $this->db->select(array('pv.*','s.subject_name','s.subject_image','t.username as teacher_name','u.username'))->from('purchased_video as pv')
		->join('teacher as t','t.user_id=pv.teacher_id')
		->join('user_registration as u','u.user_id=pv.user_id')
		->join('subject as s','s.id=pv.subject_id')
		->get()
		->result();
	}
	////////////////////
}//end class
?>