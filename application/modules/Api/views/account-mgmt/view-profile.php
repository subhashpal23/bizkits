<script type= "text/javascript" src = "<?php echo base_url();?>frontassets/js/countries.js"></script>
<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Account Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Update Profile</li>
                    </ul>
                </div>
               <div class="profile-cover">
                  <div class="profile-cover-img" style="background-image: url(<?php echo base_url();?>images/cover2.jpg)"></div>
                  <!--<div class="media">
                     <div class="media-left">
                        <a href="#" class="profile-thumb">
                        <?php 
                        $profile_pic_old=(!empty($user_details->image))?$user_details->image:'';
                        if(!empty($profile_pic_old) && $profile_pic_old!='')
                        {
                        ?>
                        <img src="<?php echo base_url();?>images/<?php echo $profile_pic_old;?>" class="img-circle" alt="">
                        <?php   
                        }
                        else 
                        {
                        ?>
                        <img src="<?php echo base_url();?>images/face11.jpg" class="img-circle" alt="">
                        <?php   
                        }
                        ?>
                        </a>
                     </div>
                     <div class="media-body">
                        <h5><?php echo $user_details->username;?> <small class="display-block"><?php echo $user_details->user_id;?></small></h5>
                     </div>
                    
                  </div>-->
               </div>
               <!-- /cover area -->
               <!-- Toolbar -->
               <!--<div class="navbar navbar-default navbar-xs content-group">
                  <ul class="nav navbar-nav visible-xs-block">
                     <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                  </ul>
                  <div class="navbar-collapse collapse" id="navbar-filter">
                     <ul class="nav navbar-nav element-active-slate-400">
                        <li class="active"><a href="#activity" data-toggle="tab"><i class="icon-menu7 position-left"></i> My Profile</a></li>
                        
                        <li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Update Profile</a></li>
                     </ul>
                    
                  </div>
               </div>-->
               <!-- /toolbar -->
               <!-- Content area -->
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
                  <!-- User profile -->
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabbable">
                           <div class="tab-content">
                              <div class="in active" id="activity">
                                 <!-- Timeline -->
                                	<div class="content-group">
								<?php 
                        //////////////Personal information////////////////////
                        $first_name=(!empty($user_details->first_name))?$user_details->first_name:'';
                        $last_name=(!empty($user_details->last_name))?$user_details->last_name:'';
                        $email=(!empty($user_details->email))?$user_details->email:'';
                        $contact_no=(!empty($user_details->contact_no))?$user_details->contact_no:'';
                        $gender=(!empty($user_details->gender=='1'))?'Male':'Female';
                        if(!empty($user_details->date_of_birth))
                        {
                           $date_of_birth=date(date_formats(),strtotime($user_details->date_of_birth));
                        }
                        else
                        {
                           $date_of_birth='';
                        }
                        $address_line1=(!empty($user_details->address_line1))?$user_details->address_line1:'';
                        $address_line2=(!empty($user_details->address_line2))?$user_details->address_line2:'';
                        $country=(!empty($user_details->country))?$user_details->country:'';
                        $state=(!empty($user_details->state))?$user_details->state:'';
                        $city=(!empty($user_details->city))?$user_details->city:'';
                        $zip_code=(!empty($user_details->zip_code))?$user_details->zip_code:'';
                       
                        /////////Account information//////
                        $bank_name=(!empty($user_details->bank_name))?$user_details->bank_name:'';
                        $branch_name=(!empty($user_details->branch_name))?$user_details->branch_name:'';
                        $account_holder_name=(!empty($user_details->account_holder_name))?$user_details->account_holder_name:'';
                        $account_no=(!empty($user_details->account_no))?$user_details->account_no:'';
                        ////////Social Media Information//////////
                        $facebook_link=(!empty($user_details->facebook_link))?$user_details->facebook_link:'';
                        $twitter_link=(!empty($user_details->twitter_link))?$user_details->twitter_link:'';
                        $linkedin_link=(!empty($user_details->linkedin_link))?$user_details->linkedin_link:'';
                        $google_plus_link=(!empty($user_details->google_plus_link))?$user_details->google_plus_link:'';
                        $aadharno=(!empty($user_details->aadharno))?$user_details->aadharno:'';
                        $idno=(!empty($user_details->idno))?$user_details->idno:'';
                        echo $this->session->flashdata('flash_msg');
                        ?>
                        <!--<div class="card card-body no-border-top no-border-radius-top">
									<div class="form-group mt-5">
										<label class="text-semibold">First Name : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $first_name;?></a></span>
									</div>

									<div class="form-group">
										<label class="text-semibold">Last Name : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $last_name;?></a></span>
									</div>

									<div class="form-group">
										<label class="text-semibold">Email Id</label>
										<span class="pull-right-sm"><a href="#"><?php echo $email;?></a></span>
									</div>

									<div class="form-group no-margin-bottom">
										<label class="text-semibold">Mobile No</label>
										<span class="pull-right-sm"><a href="#"><?php echo $contact_no;?></a></span>
									</div>
									<div class="form-group no-margin-bottom">
										<label class="text-semibold">Gender : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $gender;?></a></span>
									</div>
										<div class="form-group no-margin-bottom">
										<label class="text-semibold">Date Of Birth : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $date_of_birth;?></a></span>
									</div>
										<div class="form-group no-margin-bottom">
										<label class="text-semibold">Address Line 1 : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $address_line1;?></a></span>
									</div>
									<div class="form-group no-margin-bottom">
										<label class="text-semibold">Address Line 2 : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $address_line2;?></a></span>
									</div>
									<div class="form-group no-margin-bottom">
										<label class="text-semibold">Zip Code : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $zip_code;?></a></span>
									</div>
									<div class="form-group no-margin-bottom">
										<label class="text-semibold">Country : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $country;?></a></span>
									</div>
									<div class="form-group no-margin-bottom">
										<label class="text-semibold">State : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $state;?></a></span>
									</div>
									<div class="form-group no-margin-bottom">
										<label class="text-semibold">City : </label>
										<span class="pull-right-sm"><a href="#"><?php echo $city;?></a></span>
									</div>
								</div>
							</div>-->
                                 <!-- /timeline -->
                              </div>
                              
                              <div class="active" id="settings">
                                 <!-- Profile info -->
                                 <div class="card card-flat">
                                    <div class="card-heading">
                                       <h6 class="card-title">Personal information</h6>
                                       
                                    </div>
                                    <div class="card-body">
                                       <form action="<?php echo ci_site_url().'Affiliate/Account/updatePersonalInformation'?>" method='post' enctype='multipart/form-data'>
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>First Name</label>
                                                   <input type="text" name='first_name' value="<?php echo $first_name;?>" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Last Name</label>
                                                   <input type="text" name="last_name" value="<?php echo $last_name;?>" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <label>Address</label>
                                                   <input type="text" name="address_line1" value="<?php echo $address_line1;?>" class="form-control">
                                                </div>
                                               <!-- <div class="col-md-6">
                                                   <label>Address line 2</label>
                                                   <input type="text" name="address_line2" value="<?php echo $address_line2;?>" class="form-control">
                                                </div>-->
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                  <!--<div class="col-md-4">
                                                   <label>Your country</label>
                                                   
                                                   <select  id="country" name ="country" onchange="print_state('state',this.selectedIndex);" class="form-control">
                                                      
                                                     
                                                     
                                                   </select>
                                                </div>
                                                
                                                
                                                <div class="col-md-4">
                                                   <label>State/Province</label>
                                                   
                                                   <select  id="state" name ="state" class="form-control">
                                                      
                                                      <option value="">Select State</option>
                                                     
                                                   </select>
                                                </div>-->
                                                <div class="col-md-4">
                                                   <label>City</label>
                                                   <input type="text" name="city" value="<?php echo $city;?>" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                   <label>Pincode</label>
                                                   <input type="text" name="zip_code" value="<?php echo $zip_code;?>" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                   <label>Email</label>
                                                   <input type="text" name="email" value="<?php echo $email;?>" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                 
                                                
                                               <div class="col-md-4">
                                                   <label>Phone #</label>
                                                   <input type="text" name="contact_no" value="<?php echo $contact_no;?>" class="form-control">
                                                   <!--<span class="help-block">+234-99-9999-9999</span>-->
                                                </div>
                                                <div class="col-md-4">
                                                   <label>GST No</label>
                                                   <input type="text" name="idno" value="<?php echo $idno;?>" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                   <label>MSME No</label>
                                                   <input type="text" name="aadharno" value="<?php echo $aadharno;?>" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                
                                                <!--<div class="col-md-6">
                                                   <label>Upload profile image</label>
                                                   <input type='hidden' name='profile_pic_old' value='<?php echo $profile_pic_old;?>'>
                                                   <input type="file" name='profile_pic' class="file-styled">
                                                   <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                                </div>-->
                                             </div>
                                          </div>
                                          <div class="text-right">
                                             <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /profile info -->
                                 <!-- Account settings -->
                                 <!--
                                 <div class="card card-flat">
                                    <div class="card-heading">
                                       <h6 class="card-title">Account settings</h6>
                                      
                                    </div>
                                    <div class="card-body">
                                       <form action="#">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>New password</label>
                                                   <input type="password" placeholder="Enter new password" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Repeat password</label>
                                                   <input type="password" placeholder="Repeat new password" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Transaction password</label>
                                                   <input type="password" placeholder="Enter new password" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Repeat Transactin password</label>
                                                   <input type="password" placeholder="Repeat new password" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn btn-primary">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                               -->
                                 <!-- /account settings -->
                                  <!-- Bank settings -->
                                 <div class="card card-flat">
                                    <div class="card-heading">
                                       <h6 class="card-title">Billing Address</h6>
                                      
                                    </div>
                                    <div class="card-body">
                                       <form action="<?php echo ci_site_url();?>Affiliate/Account/updateBillingInformation" method="post">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Name</label>
                                                   <input type="text" name="bill_name" value="<?php echo $bill_name;?>" placeholder="Name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>City</label>
                                                   <input type="text" name="bill_city" value="<?php echo $bill_city;?>" placeholder="City" class="form-control">
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>State</label>
                                                   <input type="text" name="bill_state" value="<?php echo $bill_state;?>" placeholder="State" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Full Address</label>
                                                   <input type="text" name="bill_address" value="<?php echo $bill_address;?>" placeholder="Address" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Landmark</label>
                                                   <input type="text" name="bill_landmark" value="<?php echo $bill_landmark;?>" placeholder="Landmark" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Mobile</label>
                                                   <input type="text" name="bill_mobile" value="<?php echo $bill_mobile;?>" placeholder="Mobile No." class="form-control">
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Email</label>
                                                   <input type="text" name="bill_email" value="<?php echo $bill_email;?>" placeholder="Email" class="form-control">
                                                </div>
                                                
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /Bank Detail settings -->
                                 <!-- Bank settings -->
                                 <div class="card card-flat">
                                    <div class="card-heading">
                                       <h6 class="card-title">Shipping Address</h6>
                                      
                                    </div>
                                    <div class="card-body">
                                       <form action="<?php echo ci_site_url();?>Affiliate/Account/updateShippingInformation" method="post">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Name</label>
                                                   <input type="text" name="ship_name" value="<?php echo $ship_name;?>" placeholder="Name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>City</label>
                                                   <input type="text" name="ship_city" value="<?php echo $ship_city;?>" placeholder="City" class="form-control">
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>State</label>
                                                   <input type="text" name="ship_state" value="<?php echo $ship_state;?>" placeholder="State" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Full Address</label>
                                                   <input type="text" name="ship_address" value="<?php echo $ship_address;?>" placeholder="Address" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Landmark</label>
                                                   <input type="text" name="ship_landmark" value="<?php echo $ship_landmark;?>" placeholder="Landmark" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Mobile</label>
                                                   <input type="text" name="ship_mobile" value="<?php echo $ship_mobile;?>" placeholder="Mobile No." class="form-control">
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Email</label>
                                                   <input type="text" name="ship_email" value="<?php echo $ship_email;?>" placeholder="Email" class="form-control">
                                                </div>
                                                
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /Bank Detail settings -->
                                 <!-- Bank settings -->
                                 <!--<div class="card card-flat">
                                    <div class="card-heading">
                                       <h6 class="card-title">Social Media Setting</h6>
                                      
                                    </div>
                                    <div class="card-body">
                                       <form action="<?php echo ci_site_url();?>Affiliate/Account/updateSocialMediaInformation" method="post">
                                          
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Facebook Link</label>
                                                   <input type="text" name="facebook_link" value="<?php echo $facebook_link;?>" placeholder="Facebook Link" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Twitter Link</label>
                                                   <input type="text" name="twitter_link" value="<?php echo $twitter_link;?>" placeholder="Twitter Link" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Linked In</label>
                                                   <input type="text" name="linkedin_link" value="<?php echo $linkedin_link;?>" placeholder="Linkedin Link" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Google+</label>
                                                   <input type="text" name="google_plus_link" value="<?php echo $google_plus_link;?>" placeholder="Google Plus Link" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>-->
                                 <!-- /Bank Detail settings -->
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  <!-- /user profile -->
                  <!-- Footer -->
                   <?php
                  //$this->load->view("common/footer-text");
                  ?>

                  <!-- /footer -->
               </div>
				<!-- /content area -->
			</div>
<style>
button.btn.btn-default.btn-icon.kv-fileinput-upload{
	display: none;
}
.file-preview-old {
    /*border-radius: 2px;
    border: 1px solid #ddd;*/
    width: 100%;
    margin-bottom: 20px;
    position: relative;
}
</style>
<script>
  /*$(document).ready(function(){
  	$(".file-caption-name").text("No Profile Pic Selected");
  });*///end ready
  
  print_country("country");
  
  var objSelect = document.getElementById("country");

//Set selected
setSelectedValue(objSelect, "<?php echo $country;?>");



function setSelectedValue(selectObj, valueToSet) {
    for (var i = 0; i < selectObj.options.length; i++) {
        if (selectObj.options[i].text== valueToSet) {
            selectObj.options[i].selected = true;
            return;
        }
    }
}

var sel = document.getElementById('country');
//alert(sel.selectedIndex);

print_state('state',sel.selectedIndex);

var objSelect = document.getElementById("state");

//Set selected
setSelectedValue(objSelect, "<?php echo $state;?>");
</script>			