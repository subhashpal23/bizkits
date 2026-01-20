<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/account_model
*/
class Account_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getUserDetails($user_id)
  {
    $res=$this->db->select('*')->from('user_login')->where('user_id', $user_id)->or_where('username',$user_id)->get()->row();
    $res=(!empty($res))?$res:array();
    return $res;
  }//end method  
  /*
  @Desc: It's used to check weather the username or user_id is exist and also active
  */
  public function isActiveUserExist($username)
  {
    $where="(username='$username' || user_id='$username') and active_status='1'";
    $total=$this->db->select('id')->from('user_registration')->where($where)->get()->num_rows();
    if($total>0)
      return true;
    else
      return false;
  }//end method
  /*
  @Desc: It's used to just check weather the username or user_id is exist
  */
  public function isUserExist($username)
  {
    $where="(username='$username' || user_id='$username')";
    $total=$this->db->select('id')->from('user_login')->where($where)->get()->num_rows();
    if($total>0)
      return true;
    else
      return false;
  }//end method
  public function isUplineUserExist($username)
  {
    $where="(username='$username' || user_id='$username') and active_status='1'";
    $total=$this->db->select('id')->from('user_registration')->where($where)->get()->num_rows();
    if($total>0)
    {
        // check upline have open block or not
        $userinfo=$this->db->select('user_id')->from('user_registration')->where($where)->get()->row();
        $nom_id=$userinfo->user_id;
        
        $total1=$this->db->select('id')->from('user_registration')->where('nom_id',$nom_id)->get()->num_rows();
        //echo $this->db->last_query();
        if($total1>1)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    else
    {
      return false;
    }
  }//end method
}//end class
?>