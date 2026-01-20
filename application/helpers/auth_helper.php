<?php 
/*
@author:Global MLM(aditya)
@date:7 Jun 2017
@param:none
@desc:this function is used for admin login authorization and redirect according to specific user type role
@return:none
*/
if(!function_exists("admin_auth"))
{
	function admin_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			if(!$obj->session->userdata('auth_admin'))
			{
				redirect(ci_site_url()."Admin/Auth/");
				exit;
			}
			else if($obj->session->userdata('auth_admin')) 
			{
				
				  $userType=$obj->session->userdata("userType_admin");
				  if($userType==2)
				  {
					 redirect(ci_site_url()."Affiliate"); 
					 exit;
				  }
				  else if($userType==3)
				  {
					 redirect(ci_site_url()."School"); 
					 exit;
				  }
				  else if($userType==4)
				  {
					 redirect(ci_site_url()."Student"); 
					 exit;
				  }
				
			}
	}//end auth function
}
/*
@author:Global MLM(aditya)
@date:7 Jun 2017
@param:none
@desc:this function is used for user login authorization and redirect according to specific user type role
@return:none
*/
if(!function_exists("user_auth"))
{
	function user_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			//print_r($obj->session->userdata());
			if(!$obj->session->userdata('auth'))
			{
				redirect(ci_site_url()."user/auth/");
				exit;
			}
			else if($obj->session->userdata('auth')) 
			{
				  $userType=$obj->session->userdata("userType");
				  if($userType==1)
				  {
					 redirect(ci_site_url()."admin"); 
					 exit;
				  }
				  else if($userType==3)
				  {
					 redirect(ci_site_url()."user/auth/logout"); 
					 exit;
				  }
				  else if($userType==4)
				  {
					 redirect(ci_site_url()."teacher"); 
					 exit;
				  }
				  
			}
	}//end auth function	
}

if(!function_exists("affiliate_auth"))
{
	function affiliate_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			
			if(!$obj->session->userdata('auth_affiliate'))
			{
				redirect(ci_site_url()."Affiliate/Auth/");
				exit;
			}
			else if($obj->session->userdata('auth_affiliate')) 
			{
				  $userType=$obj->session->userdata("userType");
				  if($userType==1)
				  {
					 redirect(ci_site_url()."Admin"); 
					 exit;
				  }
				  else if($userType==3)
				  {
					 redirect(ci_site_url()."School"); 
					 exit;
				  }
				  else if($userType==4)
				  {
					 redirect(ci_site_url()."Student"); 
					 exit;
				  }
			}
	}//end auth function	
}

/*
@author:Global MLM(aditya)
@date:7 Jun 2017
@param:none
@desc:this function is used for user login authorization and redirect according to specific user type role
@return:none
*/
if(!function_exists("school_auth"))
{
	function school_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			if(!$obj->session->userdata('auth_school'))
			{
				redirect(ci_site_url()."School/Auth/");
				exit;
			}
			else if($obj->session->userdata('auth_school')) 
			{
				  $username=$obj->session->userdata('username');
				  
				  $userType=$obj->session->userdata("userType");
				  if($userType==1)
				  {
					 redirect(ci_site_url()."Admin"); 
					 exit;
				  }
				  else if($userType==2)
				  {
					 redirect(ci_site_url()."Affiliate"); 
					 exit;
				  }
				  else if($userType==4)
				  {
					 redirect(ci_site_url()."Student"); 
					 exit;
				  }
			}
	}//end auth function	
}

if(!function_exists("student_auth"))
{
	function student_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			if(!$obj->session->userdata('auth_student'))
			{
				redirect(ci_site_url()."Student/Auth/");
				exit;
			}
			else if($obj->session->userdata('auth_student')) 
			{
				  $username=$obj->session->userdata('username');
				  
				  $userType=$obj->session->userdata("userType");
				  if($userType==1)
				  {
					 redirect(ci_site_url()."Admin"); 
					 exit;
				  }
				  else if($userType==2)
				  {
					 redirect(ci_site_url()."Affiliate"); 
					 exit;
				  }
				  else if($userType==3)
				  {
					 redirect(ci_site_url()."School"); 
					 exit;
				  }
			}
	}//end auth function	
}

/*
@author:Global MLM(aditya)
@date:7 Jun 2017
@param:none
@desc:this function is used for user login authorization and redirect according to specific user type role
@return:none
*/
if(!function_exists("sub_admin_auth"))
{
	function sub_admin_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			if(!$obj->session->userdata('auth'))
			{
				redirect(ci_site_url()."sub_admin/auth/");
				exit;
			}
			else if($obj->session->userdata('auth')) 
			{
				  $userType=$obj->session->userdata("userType");
				  if($userType==1)
				  {
					 redirect(ci_site_url()."admin/"); 
					 exit;
				  }
				  else if($userType==2)
				  {
					 redirect(ci_site_url()."user/"); 
					 exit;
				  }
				  else if($userType==4)
				  {
					 redirect(ci_site_url()."teacher/"); 
					 exit;
				  }
			}
	}//end auth function	
}


if(!function_exists("stockist_auth"))
{
	function stockist_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			if(!$obj->session->userdata('stockist_auth'))
			{
				redirect(site_url()."stockist/auth/");
				exit;
			}
			else if($obj->session->userdata('auth')) 
			{
				
				  $userType=$obj->session->userdata("userType");
				  if($userType==2)
				  {
					 redirect(site_url()."user"); 
					 exit;
				  }
				  else if($userType==3)
				  {
					 redirect(site_url()."guest"); 
					 exit;
				  }
			}
	}//end auth function
}
/*
@Desc: It's used to sent an email for forgot password link to admin, so that password can be reset
*/
function sendForgotPasswordEmailLinkToAdmin($email,$forgot_password_code)
{

    $email_data['from']='info@globalwealths.org';
    $email_data['to']=$email;
    $email_data['subject']='iRent Reset Password Link';
    $email_data['template-header-title']='iRent Online';
    $email_data['email_verification_msg']= "Please click here to reset your password<b><a href='".site_url()."user/auth/resetPassword/".$forgot_password_code."'>click here</a></b>";
    $email_data['email-template']='admin-forgot-password-email-template';
    _sendEmail($email_data);
}//end function
/*
@Desc: It's used to sent an email for forgot password link to user, so that password can be reset
*/
function sendForgotPasswordEmailLinkToUser($email,$forgot_password_code)
{

    $email_data['from']='support@fortressbarn.com';
    $email_data['to']=$email;
    $email_data['subject']='Fortress Barn Reset Password Link';
    $email_data['template-header-title']='Fortress Barn';
    $email_data['email_verification_msg']= "Please click here to reset your password<b><a href='".site_url()."user/auth/resetPassword/".$forgot_password_code."'>click here</a></b>";
    $email_data['email-template']='forgot-password';
    _sendEmail($email_data);
}//end function
?>