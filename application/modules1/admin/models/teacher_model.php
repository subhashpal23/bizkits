<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/teacher_model
*/
class Teacher_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getAllTeacher()
  {
    return $this->db->select('*')->from('teacher')->get()->result();
  }//end method  
  public function getAllActiveTeacher()
  {
    return $this->db->select('*')->from('teacher')
	->where('active_status','1')
	->get()->result();
  }//end method 
  public function getAllInActiveTeacher()
  {
    return $this->db->select('*')->from('teacher')
	->where('active_status','0')
	->get()->result();
  }//end method   
  public function getTeacher($id)
  {
	  return $this->db->select('*')
	  ->from('teacher')
	  ->where('id',$id)
	  ->get()->row();
  }
}//end class
?>