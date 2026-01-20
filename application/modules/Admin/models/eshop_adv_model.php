<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/eshop_adv_model
*/
class Eshop_Adv_Model extends Common_Model
{
  public function __construct()
  {
        //@call to parent CI_Model constructor
        parent::__construct();
  }
  public function getAllSlider()
  {
    return $this->db->select('*')->from('eshop_adv_slider')->order_by('position')->get()->result();
  }//end method 
  public function getSlider($id)
  {
    return $this->db->select('*')->from('eshop_adv_slider')->where('id',$id)->get()->row();
  }//end method 
  public function getAllSliderSiderBarImage()
  {
    return $this->db->select('*')->from('eshop_adv_slider_sidebar')->order_by('position')->get()->result();
  }//end method   
  public function getSliderSideBar($id)
  {
    return $this->db->select('*')->from('eshop_adv_slider_sidebar')->where('id',$id)->get()->row();
  }//end method 
  /////////
  public function getAllBanner()
  {
     return $this->db->select('*')->from('eshop_adv_banner')->order_by('position')->get()->result();
  }//end method	
  public function getBanner($id)
  {
    return $this->db->select('*')->from('eshop_adv_banner')->where('id',$id)->get()->row();
  }//end method   
}//end class
?>