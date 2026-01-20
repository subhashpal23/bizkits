<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/marketing_tools_todel
*/
class Marketing_Tools_Model extends Common_Model
{
  	public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    public function getAllPublishedMarketingImages($user_id)
    {
      return $this->db->select("*")->from('marketing_images')->where(array('user_id'=>$user_id))->order_by('create_date','desc')->get()->result();
    }
    public function getAllPublishedMarketingVideos($user_id)
    {
      return $this->db->select("*")->from('marketing_videos')->where(array('user_id'=>$user_id))->order_by('create_date','desc')->get()->result();
    }
}//end class
?>