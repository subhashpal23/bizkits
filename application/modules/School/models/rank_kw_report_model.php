<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/rank_kw_report_model
*/
class Rank_Kw_Report_Model extends Common_Model
{
    public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    public function getSelfKw($user_id)
    {
		return $this->db->select('*')->from('rank_knowledge_points')->where(array('income_id'=> $user_id,'position'=>'self'))->get()->result();
    }//end method  
   public function getLeftKw($user_id)
   {
		return $this->db->select('*')->from('rank_knowledge_points')->where(array('income_id'=> $user_id,'position'=>'left'))->get()->result();
   }//end method  
   public function getRightKw($user_id)
   {
		return $this->db->select('*')->from('rank_knowledge_points')->where(array('income_id'=> $user_id,'position'=>'right'))->get()->result();
   }//end method  
   
}//end class
?>