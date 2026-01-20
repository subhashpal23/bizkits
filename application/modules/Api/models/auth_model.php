<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_Model extends Common_Model
{
  public $userName;
  public $userPassword;
  public $user_id;
  public $SD_User_Name;
  public $userpanel_user_id;

  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @author: aditya.php4u@gmail.com
  @last_modified_date: 9 jun 2017
  @desc: it's used to  check weather the user exists or not
  @param: username(String), password(String)
  @return: boolena
  */
  public function userExists($username,$password)
  {
      $where_condition="(username = '$username' OR user_id = '$username') and password='$password'";
      $query1 = $this->db->get_where('user_login', $where_condition);
      //echo $query1->num_rows(); die;
    	if($query1->num_rows() > 0)
    	{
    	    $where_condition="(username = '$username' OR user_id = '$username') and password='$password'";
            $query = $this->db->get_where('user_login', $where_condition);
            $res=$query->row();  
            //pr($res);
        	$this->userName=$res->username;
        	$this->userPassword=$res->password;
        	$this->user_id=$res->user_id;
            $this->SD_User_Name=$res->username;
            $this->userpanel_user_id=$res->user_id;
            $this->member_type=$res->status;
            $guest_ip   = $_SERVER['REMOTE_ADDR'];
            $fullName=$res->first_name." ".$res->last_name;
            $this->db->insert("visitor",array('id' =>NULL,'user_id'=>$res->user_id,'username'=>$res->username,'fullname'=>$fullName,'ipadd'=>$guest_ip));
        	return true;
    	}
      else 
    	return false;
   }//end method
}//end class
?>