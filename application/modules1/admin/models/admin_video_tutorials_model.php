<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/admin_video_tutorials_model
*/
class Admin_Video_Tutorials_Model extends Common_Model
{
  public function __construct()
  {
        //@call to parent CI_Model constructor
        parent::__construct();
  }
  public function getAllVideoCategory()
  {
    return $this->db->select('*')->from("video_categories")->get()->result();
  }//end method 
  public function getVideo($id)
  {
    return $this->db->select(array('v.*','vc.name as category_name'))
	 ->join('video_categories as vc','vc.id=v.video_categories_id')
	 ->from("video as v")
	 ->where('v.id',$id)
	 ->get()
	 ->row();
  }//end method  
  public function getAllVideo()
  {
    return $this->db->select(array('v.*','vc.name as category_name'))
	 ->join('video_categories as vc','vc.id=v.video_categories_id')
	 ->from("video as v")
	 ->get()
	 ->result();
  }//end method
  public function getAllApprovedVideo()
  {
    return $this->db->select(array('v.*','vc.name as category_name'))
	 ->join('video_categories as vc','vc.id=v.video_categories_id')
	 ->from("video as v")
	 ->where('v.approve_status','1')
	 ->get()
	 ->result();
  }//end method
  public function getAllUnapprovedVideo()
  {
    return $this->db->select(array('v.*','vc.name as category_name'))
	 ->join('video_categories as vc','vc.id=v.video_categories_id')
	 ->from("video as v")
	 ->where('v.approve_status','0')
	 ->get()
	 ->result();
  }//end method
  public function getAllAssignedVideo()
  {
    return $this->db->select(array('v.*','vc.name as category_name'))
	 ->join('video_categories as vc','vc.id=v.video_categories_id')
	 ->from("video as v")
	 ->where('v.assign_status','1')
	 ->get()
	 ->result();
  }//end method
  public function getAllUnassignedVideo()
  {
    return $this->db->select(array('v.*'))
	 ->from("video as v")
	 ->where(array('v.assign_status'=>'0'))
	 ->get()
	 ->result();
  }//end method

}//end class
?>