<?php 
/*
  @author   : Aditya
  @signature: void pr(mixed array)
*/
function showproductimage($filename)
{
    //echo $_SERVER['DOCUMENT_ROOT'].'/product_images/'.$filename;
    if(file_exists('../../../../'.$filename))
    {
        return $filename;
    }
    else
    {
        return "default.png";
    }
    
}
function slug($string, $spaceRepl = "-")
{
    $string = str_replace("&", "and", $string);

    $string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);

    $string = strtolower($string);

    $string = preg_replace("/[ ]+/", " ", $string);

    $string = str_replace(" ", $spaceRepl, $string);

    return $string;
}
function checkStockist($username)
{
    $obj=& get_instance();
    $result=$obj->db->select('id')->from('user_registration')->where(array('username'=>$username,'member_type'=>'2'))->order_by('id','desc')->get()->num_rows();
    return $result;
}
function getSubCategory($id,$name)
{
    $obj=& get_instance();
    $result=$obj->db->select('*')->from('eshop_category')->where('parent_id',$id)->order_by('id','desc')->get()->result();
    foreach($result as $key=>$val)
    {
        $str.=$val->category_name.",";
    }
    return $name.'>'.$str;
}
function getCategorySub($id,$type='topmenu')
{
    $obj=& get_instance();
    $res=$obj->db->select('*')->from('eshop_category')->where(array('parent_id'=>$id,$type=>1))->order_by('id','desc')->get()->result();
    //echo $obj->db->last_query();
    return $res;
}
function getMainCategory($id)
{
    $obj=& get_instance();
    $res=$obj->db->select('*')->from('eshop_category')->where(array('id'=>$id))->order_by('id','desc')->get()->row();
    //echo $obj->db->last_query();
    return $res;
}
function getCategorySubCount($id)
{
    $obj=& get_instance();
    return $obj->db->select('id')->from('eshop_category')->where('parent_id',$id)->order_by('id','desc')->get()->num_rows();
}
function getCategory($type='topmenu')
{
    $obj=& get_instance();
    return $obj->db->select('*')->from('eshop_category')->where(array('parent_id'=>0))->order_by('id','desc')->get()->result();
}
function getCategoryName($id)
{
    $obj=& get_instance();
    $info=$obj->db->select('*')->from('eshop_category')->where(array('parent_id'=>0,'id'=>$id))->order_by('id','desc')->get()->row();
    return $info->category_name;
}
function getCategorySubSideBar($id)
{
    $obj=& get_instance();
    $res=$obj->db->select('*')->from('eshop_category')->where(array('parent_id'=>$id))->order_by('id','desc')->get()->result();
    //echo $obj->db->last_query();
    return $res;
}
function getCategorySideBar()
{
    $obj=& get_instance();
    return $obj->db->select('*')->from('eshop_category')->where(array('parent_id'=>0))->order_by('id','desc')->get()->result();
}

function getCategoryList($type='topmenu')
{
    $obj=& get_instance();
    return $obj->db->select('*')->from('eshop_category')->order_by('id','asc')->get()->result();
}

function getSubCategoryList($id)
{
    $obj=& get_instance();
    return $obj->db->select('*')->from('eshop_subcategory')->where(array('parent_id'=>$id))->order_by('id','asc')->get()->result();
}

function getSub2CategoryList($parent_id,$subcat_id)
{
    $obj=& get_instance();
    return $obj->db->select('*')->from('eshop_sub2category')->where(array('parent_id'=>$parent_id,'subcat_id'=>$subcat_id))->order_by('id','asc')->get()->result();
}
function getProductsCount($id)
{
    $obj=& get_instance();
    $result=$obj->db->select('id')->from('eshop_products')->where('parent_category_id',$id)->order_by('id','desc')->get()->num_rows();
    //echo $obj->db->last_query();
    return $result;
}
function getProductsCountbyCategory($id,$subcat)
{
    $obj=& get_instance();
    $result=$obj->db->select('id')->from('eshop_products')->where(array('parent_category_id'=>$id,'category_id'=>$subcat))->order_by('id','desc')->get()->num_rows();
    //echo $obj->db->last_query();
    return $result;
}
function getProducts($id)
{
    $obj=& get_instance();
    $result=$obj->db->select('*')->from('eshop_products')->where('parent_category_id',$id)->order_by('id','desc')->limit(2,0)->get()->result();
    //echo $obj->db->last_query();
    return $result;
}
function getFeatureProducts()
{
    $obj=& get_instance();
    $result=$obj->db->select('*')->from('eshop_products')->where('featured',1)->order_by('id','desc')->get()->result();
    //echo $obj->db->last_query();
    return $result;
}
function getRelatedProducts($id)
{
    $obj=& get_instance();
    $result=$obj->db->select('*')->from('eshop_products')->where(array('id <>'=>$id))->order_by('id','desc')->get()->result();
    //echo $obj->db->last_query();
    return $result;
}
function getCategoryFromProduct($id)
{
    $obj=& get_instance();
    $result=$obj->db->select('parent_category_id')->from('eshop_products')->where('id',$id)->get()->row();
    //echo $obj->db->last_query();
    //pr($result);
    return $result->parent_category_id;
}
function getCategoryWalletId($id)
{
    $obj=& get_instance();
    $result=$obj->db->select('wallet_id')->from('eshop_category')->where(array('id'=>$id))->order_by('id','desc')->get()->row();
    return $result->wallet_id;
}
function get_direct_members_count($user_id)
{
    $obj=& get_instance();
    $udetails=$obj->db->select('id')->from('user_registration')->where('ref_id', $user_id)->get()->num_rows();
    return $udetails;
}
function get_wallet_name($id)
{
    $obj=& get_instance();
    $udetails=$obj->db->select('wallet_name')->from('wallet_type')->where('id', $id)->get()->row();
    return $stage_name=$udetails->wallet_name;
}
function get_wallet_amount_by_name($user_id,$name)
{
    $obj=& get_instance();
    $udetails=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$user_id,'wallet_type'=>$name))->get()->row();
    return $stage_name=$udetails->amount;
}
function rank_name($user_id)
{
    $obj=& get_instance();
    $array=array('feeder_stage','stage_1','stage_2','stage_3','stage_4');
    
    $udetails=$obj->db->select('stage_name')->from('user_registration as u')->where('u.user_id', $user_id)->get()->row();
    $stage_name=$udetails->stage_name;
    $index = array_search($stage_name, array_values($array));//$array[$user_details->stage_name];
    $str='';
    for($i=0;$i<$index;$i++)
    {
    
    $str.='<span class="fa fa-star checked"></span>';
   
    }
    $strr= ($index)?$index.' Star':'Principal';
    return $strr=$strr.'<br>'.$str;
}
function get_rank_name($rank_id)
{
    $obj=& get_instance();
     $udetails=$obj->db->select('rank_name')->from('rank as u')->where('u.id', $rank_id)->get()->row();
    $stage_name=$udetails->rank_name;
    return $stage_name;
    /*$array=array('feeder_stage','stage_1','stage_2','stage_3','stage_4','stage_5');
    
    $index = array_search($stage_name, array_values($array));//$array[$user_details->stage_name];
    $str='';
    for($i=0;$i<$index;$i++)
    {
    
    $str.='<span class="fa fa-star checked"></span>';
   
    }
    $strr= ($index)?$index.' Star':'Principal';
    return $strr=$strr.'<br>'.$str;*/
}
if(!function_exists('get_package_uname'))
{
  function get_package_uname($user_id)
  {
    $obj=&get_instance();
    $udetails=$obj->db->select('pkg_id')->from('user_registration as u')->where('u.user_id', $user_id)->get()->row();
    $pkg_id=$udetails->pkg_id;
    $user=$obj->db->select('title')->from('package')->where('id',$pkg_id)->get()->row();
    $title=(!empty($user->title))?$user->title:null;
    return $title;
  }
}//end function
function eshop_get_user_details($user_id)
{
    $obj=& get_instance();
    $res=$obj->db->select('u.*','address.*')->from('user_registration as u')->where('u.user_id', $user_id)->or_where('u.username',$user_id)
	->join('eshop_member_delivery_address as address','address.user_id=u.user_id')
	->get()->row();
    $res=(!empty($res))?$res:array();
    return $res;
}//end method
function eshop_get_guest_details($guest_id)
{
    $obj=& get_instance();
    $res=$obj->db->select(array('eg.*','address.*'))->from('eshop_guest as eg')
	->join('eshop_guest_delivery_address as address','address.guest_id=eg.guest_id')
	->where('eg.guest_id',$guest_id)->get()->row();
    $res=(!empty($res))?$res:array();
    return $res;
}//end method
if (!function_exists('alert')){
    function alert($data = null) 
    {
      echo "<script>";
      echo 'alert("$data")';
      echo "</script>";
    }
}

if (!function_exists('pr')){
    function pr($data = null) 
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
/*End of Function*/
if (!function_exists('currentuserinfo')){
    function currentuserinfo() 
    {
        $CI     =   &get_instance();
        return $CI->session->userdata("userinfo");
    }
}
/*End of Function*/
if (!function_exists('currUserId')){
    function currUserId() 
    {
        $CI     =   &get_instance();
        return $CI->session->userdata("userinfo")->id;
    }
}
/*End of Function*/
/**
 * _sendEmail
 *
 * This function send mail to the given email id 
 * @param string
 *  
 */
if (!function_exists('_sendEmail')){
    function _sendEmail($email_data)
    {
        $CI                 =   &get_instance();
        $config['protocol'] =   'sendmail';
        $config['mailpath'] =   '/usr/sbin/sendmail';
        $config['charset']  =   'iso-8859-1';
        $config['wordwrap'] =   true;
        $CI->load->library('email');
        $CI->email->set_mailtype("html");
        $CI->email->from($email_data['from'], 'support');
        $CI->email->to($email_data['to']);
        if (!empty($email_data['cc']))
        {
            $CI->email->cc($email_data['cc']);
        }
        if (!empty($email_data['bcc']))
        {
            $CI->email->bcc($email_data['bcc']);
        }
        if (!empty($email_data['file']))
        {
            $CI->email->attach($email_data['file']);
        }
        $CI->email->subject($email_data['subject']);
        //$msg    =   $email_data['message'];
        $data['message']    =   $email_data;
        $msg                =   $CI->load->view('email-template/'.$email_data['email-template'],  $data, true);
        $CI->email->message($msg);
        //echo $CI->email->send(); die();
        if($CI->email->send()){
            return TRUE;
        }else{
           return FALSE;
        }
    }
}
/*End of Function*/
/**
 * Id_encode
 *
 * This function to encode ID by a custom number
 * @param string
 *  
 */
  if (!function_exists('ID_encode')) {
    function ID_encode($id){
        $encode_id = base64_encode($id);
        return $encode_id;
    }
}
/*End of function*/
/**
 * Id_decode
 *
 * This function to decode ID by a custom number
 * @param string
 *  
 */
if (!function_exists('ID_decode')) {
    function ID_decode($encoded_id){
            $id = base64_decode($encoded_id);
            return $id;
    }
}
/*End of function*/
if(!function_exists('post'))
{
    function post($name)
    {
       $obj=&get_instance();
       $val=$obj->input->post($name);
       if(empty($val))
        $val='';
       return $val;
    }
}

if (!function_exists('isPostBack')) {
    function isPostBack()
    {
		if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            return true;
        else
            return false;
    }
}

/////////////////
/////////////start of image uploading function from here//////////////
function adCheckType($type)
{
    switch($type)
        {
        case "png":
            return(true);
        break;
        case "gif":
            return(true);
        break;
        case "jpg":
            return(true);
        break;
        case "jpeg":
            return(true);
        break;
        case "pjpeg":
            return(true);
        break;
        default:
        return(false);
        }
}

        
///////start of image uploading general function from here
///////////////////////////////  IMAGE UPLOAD FUNCTION  ///////////////////////////     
define ("MAX_IMAGE_SIZE","1000000000"); 
        
function adGetExtension($str) 
{
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
}                   

function adMakeThumb($source,$path,$desiredWidth,$desiredHeight) 
{
   $ext=pathinfo($source);
   $ext=$ext['extension'];
   if($ext=="jpg" || $ext=="jpeg")
    {
   /* read the source image */
    list($width, $height) = getimagesize($source);  
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    //$desired_height = 120;
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desiredWidth, $desiredHeight);
    /********************/
    $source_image = imagecreatefromjpeg($source);
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $path);
  
   }
  else if($ext=="png" || $ext=="png")
   {
   /* read the source image */
    list($width, $height) = getimagesize($source);  
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    //$desired_height = 150;
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desiredWidth, $desiredHeight);
    /********************/
    $source_image = imagecreatefrompng($source);
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
    /* create the physical thumbnail image to its destination */
    imagepng($virtual_image, $path);
   
   }
  else if($ext=="gif" || $ext=="gif")
   {
   /* read the source image */
    list($width, $height) = getimagesize($source);  
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    //$desired_height = 150;
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desiredWidth, $desiredHeight);
    /********************/
    $source_image = imagecreatefromgif($source);
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desiredWidth, $desired_height, $width, $height);
    /* create the physical thumbnail image to its destination */
    imagegif($virtual_image, $path);
   }
}
/*
@param: string ImageSource, int countImage, string destinationPath
@out: save image on to destination
*/
function adImageUpload($image, $cnt, $pathss)
        {
                $_FILES['image1']=$image;
                            //This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
                                 //get the original name of the file from the clients machine
                                                    $filename = stripslashes($_FILES['image1']['name']);
                                                //get the extension of the file in a lower case format
                                                    $extension = adGetExtension($filename);
                                                    $extension = strtolower($extension);
                                             
                                             
                                              if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
                                                    {
                                                    //print error successMsg
                                                        //echo "<span class='successMsg'>File Not Uploaded</span>";
                                                        $errors=1;
                                                    }
                                                    else
                                                    {
                                                        
                                                        
                                             $size=filesize($_FILES['image1']['tmp_name']);
                                            
                                            //compare the size with the maxim size we defined and print error if bigger
                                            if ($size > MAX_IMAGE_SIZE*1024)
                                            {
                                                //echo "<span class='successMsg'>File is big in size</span>";
                                                $errors=1;
                                            }
                                            //we will give an unique name, for example the time in unix time format
                                            $image_name=time().$cnt.'.'.$extension;
                                            //the new name will be containing the full path where will be stored (images folder)
                                            //$newname=$pathss.$image_name;
                                           $newname=getcwd().$pathss.$image_name;
                                            $copied = copy($_FILES['image1']['tmp_name'], $newname);
                                            if (!$copied) 
                                            {
                                                //echo "<span class='message'>File not Copied</span>";
                                                $errors=1;
                                            }}
                                                    
                                            return @$image_name;                                             
                                             
                                             
                    }
                    //$image=adImageUpload($_FILES['field_name'],1, $path);
                    //adMakeThumb($source path,$destination_path,$desired_width,$desired_height); 
                    //adMakeThumb("../project_images/".$package_image,"../thumb/".$package_image,100,100); 

///////end of image uploading general function over here
if(!function_exists('generateUniqueTranNo'))
{
    function generateUniqueTranNo(){
        $obj=&get_instance();
        $random_number="T".mt_rand(1000000, 9999999);
        if($obj->db->select('transaction_no')->from('credit_debit')->where('transaction_no',$random_number)->get()->num_rows()>0)
        {
          generateUniqueTranNo();
        }
        return $random_number;
      }
}//end function
if(!function_exists('currency'))
{
  function currency()
  {
      $obj=&get_instance();
      $currency_status=$obj->db->select('status')->from('currency_display')->where('id','1')->get()->row();
      if($currency_status->status=='1')
      {
      $currency=$obj->db->select('currency')->from('currency')->where('active_status','1')->get()->row();
      $currency=(!empty($currency->currency))?$currency->currency:'';
      }
      else 
      {
        $currency='';
      }
     return $currency;
  }
}//end function
if(!function_exists('date_formats'))
{
  function date_formats()
  {
    $obj=&get_instance();
    $date_format=$obj->db->select('date_format')->from('date_format')->where('id','1')->get()->row();
    $date_format=$date_format->date_format;
    return $date_format;
  }
}//end function
if(!function_exists('get_package_list'))
{
  function get_package_list()
  {
    $obj=&get_instance();
    $user=$obj->db->select('*')->from('package')->where('status','1')->get()->result();
    return $user;
  }
}//end function
if(!function_exists('get_package_name'))
{
  function get_package_name($pkg_id)
  {
    $obj=&get_instance();
    $user=$obj->db->select('title')->from('package')->where('id',$pkg_id)->get()->row();
    $title=(!empty($user->title))?$user->title:null;
    return $title;
  }
}//end function
if(!function_exists('get_user_name'))
{
  function get_user_name($user_id)
  {
    $obj=&get_instance();
    $user=$obj->db->select('username')->from('user_login')->where('user_id',$user_id)->get()->row();
    $username=(!empty($user->username))?$user->username:null;
    return $username;
  }
}//end function

if(!function_exists('get_user_id'))
{
  function get_user_id($user_name)
  {
    $obj=&get_instance();
    $user=$obj->db->select('user_id')->from('user_registration')->where('username',$user_name)->get()->row();
    $user_id=(!empty($user->user_id))?$user->user_id:null;
    return $user_id;
  }
}//end function

if(!function_exists('get_userdetail'))
{
  function get_userdetail($user_id)
  {
    $obj=&get_instance();
    $user=$obj->db->select('*')->from('user_registration')->where('user_id',$user_id)->get()->row();
    return $user;
  }
}//end function

if(!function_exists('getPopupContent'))
{
  function getPopupContent($object,$right_tooltip=null)
  {
    //pr($object);die;
    $image='user_small.png';
  ?>
            <div class="pop-up-content <?php echo $right_tooltip;?>">
                            <div class="profile_tooltip_pick">
                              <div class="image_tooltip">
                                <img class="profile-rounded-image-tooltip" src="<?php echo base_url();?>images/<?php echo $image;?>" style="width:100%;height:100%"  alt="<?php echo $object->username;?>" title="<?php echo $object->username;?>"></div>
                            </div>
                             <div class="tooltip_profile_detaile">
                             <!--
                             <dl>
                              <dt>Name</dt>
                              <dd><?php echo $object->first_name;?></dd>
                             </dl>
                           -->
                             <dl>
                              <dt>User Id</dt>
                              <dd><?php echo $object->user_id;?></dd>
                             </dl>
                             <dl>
                              <dt>Username</dt>
                              <dd><?php echo $object->username;?></dd>
                             </dl>
                             
							 <!--<dl>
                              <dt>Total Sales (Left)</dt>
                              <dd>$0.00</dd>
                             </dl>
                             <dl>
                              <dt>Total Sales (Right)</dt>
                              <dd>$0.00</dd>
                             </dl>
                             <dl>
                              <dt>Carry-forward (Right)</dt>
                              <dd>$0.00</dd>
                             </dl>
                             <dl>
                              <dt>Carry-forward (Left)</dt>
                              <dd>$0.00</dd>
                             </dl>-->
                             
							 <dl>
							 
                              <dt>Registration Date</dt>
                              <dd>
                              <?php 
                              echo date("d/m/Y",strtotime($object->registration_date));
                              ?>
                              </dd>
                             </dl>
                             <!--
							 <div class="tooltip_btn"><a href="#">View Profile</a></div>
							 -->
                            </div>                                               
                                              
						</div>
  <?php
  }
}//end function
if(!function_exists('showAddNewMemberOption'))
{
  function showAddNewMemberOption($moudle_name)
  {
    if($moudle_name=='user')
    {
  ?>
  <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/user-add-img_new.png" width="70" height="70" alt="Add new member" title="Add new member"></a></div>
                                                 
   <span class="wrap_content"><a href="#">Add new member</a></span>
  <?php 
    }
    else if($moudle_name=='admin')
    {
  ?>
  <div class="images_wrapper"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/no-member.png" width="70" height="70" alt="Add new member" title="Add new member"></div>
  <?php     
    }
  }  
}//end method
/*
@Desc:It's used to check weather the epin payment method for registration is enabled or not
*/
if(!function_exists('isEpinEnabled'))
{
  function isEpinEnabled()
  {
    $obj=& get_instance();
    $payment_method=$obj->db->select('status')->from('registration_method')->where('id',2)->get()->row();
    if($payment_method->status=='1')
    {
      return 1;
    }
    else 
    {
      return 0;
    }
  }
}//end function
/*
@desc: It's used to check weather the bank wire is enabled or not
*/
if(!function_exists('isBankWireEnables'))
{
  function isBankWireEnables()
  {
    $obj=& get_instance();
    $rows=$obj->db->select('*')->from('registration_method')->where(array('id'=>3, 'status'=>'1'))->get()->num_rows();
    if($rows>0)
    {
      return true;
    }
    else 
    {
      return false;
    }
  }
}//end function
function get_user_details($user_id)
  {
    $obj=& get_instance();
    $res=$obj->db->select('*')->from('user_registration')->where('user_id', $user_id)->or_where('username',$user_id)->get()->row();
    $res=(!empty($res))?$res:array();
    return $res;
  }//end method
function get_wallet_list()
  {
    $obj=& get_instance();
    $res=$obj->db->select('*')->from('wallet_type')->where('status', 0)->get()->result();
    $res=(!empty($res))?$res:array();
    
    return $res;
  }//end method
  function get_menu_list()
  {
    $obj=& get_instance();
    $res=$obj->db->select('*')->from('menu')->where(array('status'=> 1,'parent_id'=> 0))->order_by('position','asc')->get()->result();
    $res=(!empty($res))?$res:array();
    foreach($res as $Key=>$val)
    {
            $result['id']=$val->id;
            $result['menu_name']=$val->menu_name;
            $result['position']=$val->position;
            $result['header_menu']=$val->header_menu;
            $result['parent_id']=$val->parent_id;
            if($val->id>0)
            {
                $res1=$obj->db->select('*')->from('menu')->where(array('status'=> 1,'parent_id'=> $val->id))->order_by('position','asc')->get()->result();
                $result2=array();
                $result4=array();
                foreach($res1 as $Key1=>$val1)
                {
                    $result2['id']=$val1->id;
                    $result2['menu_name']=$val1->menu_name;
                    $result2['position']=$val1->position;
                    $result2['header_menu']=$val1->header_menu;
                    $result4[]=$result2;
                }
                $result['parent']=$result4;
            }
        //pr($result);
        $result1[]=$result;
    }
    //pr($result1);
    return $result1;
  }//end method
function sendUploadProofEmailToUser($username,$password,$email,$transaction_pwd)
{

  $email_data['from']='info@globalsoftwebtechnologies.com';
  $email_data['to']=$email;
  $email_data['subject']='Upload Proof of payment on JKS Shoppers';
    
  $email_data['username']=$username;
  $email_data['password']=$password;
  $email_data['email']=$email;
  $email_data['transaction_pwd']=$transaction_pwd;
  $email_data['email-template']='upload-proof-email';

  _sendEmail($email_data);
}//end function 
function is_active_secondry_ewallet()
{
  $obj=& get_instance();
  $secondry_e_wallet_info=$obj->db->select('*')->from('secondry_e_wallet_status')->where('id','1')->get()->row();
  if($secondry_e_wallet_info->status=='1')
    return true;
  else 
    return false;
}
function get_secondry_wallet_deduction()
{
  $obj=& get_instance();
  $secondry_e_wallet_info=$obj->db->select('*')->from('secondry_e_wallet_status')->where('id','1')->get()->row();
  $deduction_percent=(!empty($secondry_e_wallet_info->deduction_percent))?$secondry_e_wallet_info->deduction_percent:0;
  return $deduction_percent;
}
function ci_site_url()
{
	$CI=& get_instance();
	return $CI->config->site_url();
}
function get_video_category_name($cat_id)
{
   $CI=& get_instance();
   $CI->db->select('name')->from('video_categories')->where('id',$cat_id)->get()->row();
   $cat_name=(!empty($CI->name))?$CI->name:'';
   return $cat_name;
}

function recursion_get_child_category($cat_id)
{
	 //static $child=array();
	 $child=array();
	 $CI=& get_instance();
	 $all_child_category=$CI->db->select('*')->from('video_categories')->order_by('id','asc')->where(array('sub_for'=>$cat_id))->get()->result();
	 if(!empty($all_child_category) && count($all_child_category))
	 {
		 foreach($all_child_category as $category)
		 {
			 //$child[]=array();
			 $sub_child=recursion_get_child_category($category->id);
			 $category->child=$sub_child;
			 $child[]=$category;
		 }
	 }
	 return $child;
}
function get_all_child_category($parent_category_id)
{
	    $CI=& get_instance();
		$all_child_category=$CI->db->select('*')->from('video_categories')->order_by('id','asc')->where(array('sub_for'=>$parent_category_id))->get()->result();
		$all_category=array();
		foreach($all_child_category as $category)
		{
			$child=recursion_get_child_category($category->id);
			$category->child=$child;
			$all_category[]=$category;
		}
		//pr($all_category);
		return $all_category;
}//end function	
///////////////////////////
function recursion_generate_book_index($cat_id)
{
	 //static $child=array();
	 $child=array();
	 $CI=& get_instance();
	 $all_child_category=$CI->db->select('*')->from('video_categories')->order_by('id','asc')->where(array('sub_for'=>$cat_id))->get()->result();
	 if(!empty($all_child_category) && count($all_child_category))
	 {
		 foreach($all_child_category as $category)
		 {
			 //$child[]=array();
			
		?>
			<li class="expanded">
                             <?php echo $category->name;?>
                              <ul>
                                 <?php 
								  $all_video=get_all_video($category->id);
								  if(!empty($all_video) && count($all_video))
									{
										foreach($all_video as $video)
										{
									?>
									<li><a class="video_info" video-id="<?php echo $video->id;?>" href="#"><?php echo $video->title;?></a></li>
									<?php 
										}
									}
								  $sub_child=recursion_generate_book_index($category->id);
								  ?> 
                              </ul>
            </li>
		<?php 
			
		 }
	 }
}
function generate_book_index($parent_category_id)
{
		$CI=& get_instance();
		$all_child_category=$CI->db->select('*')->from('video_categories')->order_by('id','asc')->where(array('sub_for'=>$parent_category_id))->get()->result();
		$all_category=array();
		echo "<ul>";
		foreach($all_child_category as $category)
		{
			$all_category[]=$category;
?>
					 <li class="folder expanded">
                        <?php 
						echo $category->name;
						?>
						<ul>
						<?php 
						$all_video=get_all_video($category->id);
						if(!empty($all_video) && count($all_video))
						{
							foreach($all_video as $video)
							{
						?>
						<li video-info="abc"><a class="video_info" video-id="<?php echo $video->id;?>" href="#"><?php echo $video->title;?>11</a></li>
						<?php 
							}
						}
						recursion_generate_book_index($category->id);
						?>
                        </ul>
                     </li>
<?php 	
		}
	  echo "</ul>";	
}//end function	
/*
@desc: It's used to return all the video object on the basis of category
*/
function get_all_video($category_id)
{
	$obj=& get_instance();
	$all_video=$obj->db->select('*')->from('videos_tutorials')->where(array('categorie_id'=>$category_id,'status'=>'1'))->get()->result();
	return $all_video;
}
function recursion_get_book_first_video($cat_id)
{
	 //static $child=array();
	 $child=array();
	 $CI=& get_instance();
	 $all_child_category=$CI->db->select('*')->from('video_categories')->order_by('id','asc')->where(array('sub_for'=>$cat_id))->get()->result();
	 if(!empty($all_child_category) && count($all_child_category))
	 {
		 foreach($all_child_category as $category)
		 {
			 $all_video=get_all_video($category->id);
			  if(!empty($all_video) && count($all_video))
				{
					foreach($all_video as $video)
						{
						  return $video->video_path;	
						}
				}
				recursion_generate_book_index($category->id);
		 }
	 }
}
function get_book_first_video($parent_category_id)
{
		$CI=& get_instance();
		$all_child_category=$CI->db->select('*')->from('video_categories')->order_by('id','asc')->where(array('sub_for'=>$parent_category_id))->get()->result();
		$all_category=array();
		echo "<ul>";
		foreach($all_child_category as $category)
		{
			$all_category[]=$category;
			$all_video=get_all_video($category->id);
			if(!empty($all_video) && count($all_video))
				{
					foreach($all_video as $video)
						{
						  return $video->video_path;
						  break;
						}
				}
			$video=recursion_generate_book_index($category->id);
			return $video;
		}//end foreach
}//end function
function validRegistrationMethod()
{
	$obj=& get_instance();
	$registration_info=$obj->session->userdata('registration_info');
	if(empty($registration_info))
	{
		redirect(site_url()."user/");
		exit;
	}
}
function moveUp($tableName,$current_position,$upper_position)
{
	$obj=& get_instance();
	$obj->db->update($tableName,array('position'=>'5500'),array('position'=>$upper_position));

	$obj->db->update($tableName,array('position'=>$upper_position),array('position'=>$current_position));
	
	$obj->db->update($tableName,array('position'=>$current_position),array('position'=>'5500'));
}//end function
function get_teacher_total_video($teacher_id)
{
	$obj=& get_instance();
	return $obj->db->select('*')->from('subject_video')
	->where(array(
	'teacher_id'=>$teacher_id,'admin_approve_status'=>'1','teacher_approve_status'=>'1'))
	->get()->num_rows();
}
function getProfileInfo()
{
    $obj=& get_instance();
    $username=$obj->session->userdata('username');
	return $obj->db->select('*')->from('admin')
	->where(array(
	'username'=>$username))
	->get()->row();
}
/*
@Desc: It's used to check the current login user exist in which stages and return all the stages existence status in form of 1 and 0
*/
if(!function_exists('checkUserExistInAllStages'))
{
  function checkUserExistInAllStages($user_id=null)
  {
      $obj=& get_instance();
      $user_id=(!empty($user_id))?$user_id:$obj->session->userdata('user_id');
      $exist=array();
      ///////stage1 login user existence
      $user_details=get_user_details($user_id);
	  
	  $stage1_level1_info=$obj->db->select('id')->from('matrix_downline')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
	  $exist['stage1Tree']=($stage1_level1_info->num_rows()==3)?1:0;
	  
	  ///////stage2 login user existence
      $stage2_level1_info=$obj->db->select('id')->from('matrix_stage1')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage2_level2_info=$obj->db->select('id')->from('matrix_stage1')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	  $exist['stage2Tree']=($stage2_level1_info->num_rows()==3 && $stage2_level2_info->num_rows()==9)?1:0;
      
	  ///////stage3 login user existence
      $stage3_level1_info=$obj->db->select('id')->from('matrix_stage2')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage3_level2_info=$obj->db->select('id')->from('matrix_stage2')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	  
	 
      $exist['stage3Tree']=($stage3_level1_info->num_rows()==3 && $stage3_level2_info->num_rows()==9)?1:0;
       ///////stage4 login user existence
      $stage4_level1_info=$obj->db->select('id')->from('matrix_stage3')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage4_level2_info=$obj->db->select('id')->from('matrix_stage3')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 
      $exist['stage4Tree']=($stage4_level1_info->num_rows()==3 && $stage4_level2_info->num_rows()==9)?1:0;
	  ///////////////////////////////
	  ///////stage5 login user existence
      $stage5_level1_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage5_level2_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
      $exist['stage5Tree']=($stage5_level1_info->num_rows()==3 && $stage5_level2_info->num_rows()==9)?1:0;
	   ///////stage6 login user existence
      /*$stage6_level1_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage6_level2_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 
      $exist['exist_in_stage6']=($stage6_level1_info->num_rows()==3 && $stage6_level2_info->num_rows()==9)?1:0;*/
	  
	 return $exist;
  }
    function getServiceCategory($type='topmenu')
    {
        $obj=& get_instance();
        return $obj->db->select('*')->from('eshop_service_product')->where(array('parent_id'=>0))->order_by('id','desc')->get()->result();
    }
    function getServiceProductsCount($id)
    {
        $obj=& get_instance();
        $result=$obj->db->select('id')->from('eshop_service_products')->where('parent_category_id',$id)->get()->num_rows();
        //echo $obj->db->last_query();
        return $result;
    }
    function getServicesCount()
    {
        $obj=& get_instance();
        $result=$obj->db->select('id')->from('eshop_service_products')->get()->num_rows();
        //echo $obj->db->last_query();
        return $result;
    }
    function getServiceCategoryName($id)
    {
        $obj=& get_instance();
        $info=$obj->db->select('*')->from('eshop_service_product')->where(array('parent_id'=>0,'id'=>$id))->get()->row();
        return $info->category_name;
    }
}//end method

if (!function_exists('upload_zip_file')) {
    function upload_zip_file($field_name, $upload_path = './uploads/', $max_size = 10240)
    {
        $CI =& get_instance(); // CodeIgniter instance

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'zip';
        $config['max_size']      = $max_size; // KB
        $config['overwrite']     = FALSE;

        $CI->load->library('upload', $config);

        if (!$CI->upload->do_upload($field_name)) {
            return array(
                'status' => false,
                'error'  => $CI->upload->display_errors()
            );
        } else {
            return array(
                'status' => true,
                'data'   => $CI->upload->data()
            );
        }
    }
}

?>

