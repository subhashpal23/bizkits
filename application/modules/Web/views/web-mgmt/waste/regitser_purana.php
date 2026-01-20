
<script type= "text/javascript" src = "<?php echo base_url();?>frontassets/js/countries.js"></script>
  <?php 
     ///sponsor and account info
     $sponsor_id=(!empty($registration_info['sponsor_and_account_info']['ref_user_name']))?$registration_info['sponsor_and_account_info']['ref_user_name']:null;
      if(!empty($replicated_username))	
	  {			
		$sponsor_id=$replicated_username;					 
	  }
	 $ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:null;
	 $username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:null;
     $email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
     $password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:null;
     $t_code=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:null;
     ///personal info
     $first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
     $last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
     $contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
     $country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
     $state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
     $city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
     $address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
     ///sponsor and account info
     $account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
     $account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
     $bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
     $branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	 
	 $bit_coin_id=(!empty($registration_info['bit_coin_info']['bit_coin_id']))?$registration_info['bit_coin_info']['bit_coin_id']:null;
     ?>
     <div id="wrapper_full"  class="content_all_warpper">
     <?php 
      if(!empty($this->session->flashdata('error_msg')))
      {
      ?>
          <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">
              <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
              <?php echo $this->session->flashdata('error_msg');?>
          </div>
      <?php    
      }
      ?>
  
    <div id="content" class="site-content ">
        <div class="container">
            <div class="row default_row">
                <div class="col-xl-2">&nbsp;</div>
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-5 mb-lg-5 mb-xl-0">
                <!--<div class="col-xl-12" style="max-width: 560px !important;margin: 0 auto;">-->
                    <section class="contact_form_box_all type_two">
                                 <div class="contact_form_box_inner">
                                    <div class="contact_form_shortcode" style="max-width:100% !important">
                                       <!--<div class="heading">
                                          <h2>Register</h2>
                                       </div>-->
                                       <div class="_form">
                                          <div role="form" class="wpcf7">
               <h2 class="text-center mb-4">Register</h2>
    <!--<form>
      <div class="mb-3">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" placeholder="Enter your first name">
      </div>
      <div class="mb-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" placeholder="Enter your last name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email address">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter your password">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="terms">
        <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
      </form>-->
              <form name="registration" method="post" action="<?php echo site_url();?>Web/register">
                  
                    <div class="mb-3">
                    <label for="firstName" class="form-label">Sponsor Information</label>
                    <input type="text"  placeholder="Sponsor Username" value="<?php echo $sponsor_id;?>" name="sponsor_id" required="" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" title="Sponsor name" class="wpcf7-form-control-wrap">&nbsp;&nbsp;&nbsp;&nbsp;
                          <span id="check_sponsor"></span>
                    </div>
                    <div class="mb-3">
                    <label for="firstName" class="form-label">Position</label>
                    <input type="radio" name="ref_leg_position" value="left" checked> Left &nbsp;&nbsp;
                          <input type="radio" name="ref_leg_position" value="right"> Right 
                    </div>
                    <?php
                    $currency=currency();
                    ?>
                    <div class="mb-3">
                    <label for="firstName" class="form-label">Package Information</label>
                    <select name="package" id="package" class="form-control">
                         <?php
                         if($_GET['pkg']=='')
                         {
                             echo "<option value=''>Select Package</option>";
                         }
                                    $s=1;
                                    foreach($all_active_package as $key=>$val)
                                    {
                                        echo "<option value='".$val->id."'>".$val->title."(".$currency.$val->amount.")</option>";
                                    }
                                    ?>
                        
                     </select>
                     <span id="check_package"></span>
                    </div>
                    
                    <div class="mb-3">
                    <label for="firstName" class="form-label">Username</label>
                    <input type="text"  name="username" value="<?php echo $username;?>" required="" id="username" onblur="check_username(this.value)" placeholder="Enter Username" class="form-control">&nbsp;&nbsp;&nbsp;&nbsp;  
                          <span id="check_username"></span>
                    </div>
                    <!-- <div class="d-flex align-items-center br2 p-1 rounded-4 bg1-color">
                      <input type="checkbox" value="1"  name='con_sponsor'   id='con_no' /> Select if you dont have a sponsor   
                    </div> -->
                    <!--<span>Sponsor Information</span>
                        <div class="buy_crypto__formarea-group mb-md-6">
                        <div class="d-flex align-items-center br2 p-1 rounded-4 bg1-color">
                          <input type="text"  placeholder="Sponsor Username" value="<?php echo $sponsor_id;?>" name="sponsor_id" required="" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" title="Sponsor name" class="wpcf7-form-control-wrap">&nbsp;&nbsp;&nbsp;&nbsp;
                          
                        </div>
                        <span id="check_sponsor"></span>
                    </div>-->
                    
                    
                    
                    <!-- <div class="d-flex align-items-center br2 p-1 rounded-4 bg1-color">
                      <input type="checkbox" value="1"  name='con_sponsor'   id='con_no' /> Select if you dont have a sponsor   
                    </div> -->
                    
                
                    <div class="mb-3 ">
                        <label for="firstName" class="form-label">Password</label>
                        <input type="password"  value="<?php echo $password;?>" name="password" required="" value="123" id="passwords" maxlength="12" title="Password" placeholder="Enter Password">
                    </div>
                    <div class="mb-3 " >
                        <label for="firstName" class="form-label">Confirm Password</label>
                        <input type="password"  value="<?php echo $password;?>" name="confirm_password" required=""  value="123" title="Confirm Password" maxlength="12" id="confirm_password" onkeyup="checkPasswordMatch();"  placeholder="Confirm Password">
                        <button class="btn btn-outline-secondary" type="button" id="eye-icon" onclick="myFunction('passwords','confirm_password')">
                          <i class="fa fa-eye"></i>
                        </button>
                        
                    </div>
                    <!--<div class="col-md-1" style="float:right">
                        <button type="button" class="btn-primary" onclick="myFunction('passwords','confirm_password')"><i class="fa fa-eye"></i></button>
                    </div>-->
                    <div class="mb-3 col-md-12">
                        <span id="valid_confirm_password"></span>
                    </div>
                
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Transaction Password</label>
                        <input type="password"  value="<?php echo $password;?>" name="t_code" required=""  id="tpasswords" maxlength="12" title="Password" placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Confirm Transaction Password</label>
                        <input type="password"  value="<?php echo $password;?>" name="confirm_t_code" required=""  title="Confirm Password" maxlength="12" id="confirm_tpassword" onkeyup="checkPasswordMatch();"  placeholder="Confirm Password">
                        
                        <button type="button" class="btn btn-outline-secondary" onclick="myFunction('tpasswords','confirm_tpassword')"><i class="fa fa-eye"></i></button>
                    </div>
                    <div class="mb-3 col-md-12">
                        <span id="valid_confirm_password1"></span>
                    </div>
                    
            
            
                    <span>Personal Information</span>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                            <input type="text"  name="first_name" value="<?php echo $first_name;?>"  value="User" placeholder="Please enter your first name" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="valid_firstname"></span>
                        
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Last Name</label>
                            <input type="text"  name="last_name" value="<?php echo $last_name;?>"  value="123" placeholder="Please enter your last name" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="valid_firstname"></span>
                        
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Email</label>
                          <input type="email"  value="<?php echo $email;?>" name="email"  value="123user@gmail.com" placeholder="E-mail" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                        
                    </div>
                   <div class="mb-3">
                        <label for="firstName" class="form-label">Phone No</label>
                            <input type="tel"  name="contact_no" value="<?php echo $contact_no;?>"  value="1234567890" placeholder="Please enter your phone number" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="valid_phone"></span>
                       
                    </div>
                    
                   
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Country</label>
                            <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country" class="form-control"></select>
                            <!--<input type="tel"  name="country" value="<?php echo $country;?>" placeholder="Please enter your country" required="">-->&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="valid_country"></span>
                        
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">State</label>
                            <!--<input type="tel"  name="state" value="<?php echo $state;?>" placeholder="Please enter your state" required="">-->
                            <select name ="state" id ="state" class="form-control"></select>&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="valid_state"></span>
                       
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">City</label>
                            <input type="tel"  name="city" value="<?php echo $city;?>"  value="Abia" placeholder="Please enter your city" required="" class="form-control">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="valid_city"></span>
                        
                    </div>
                
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="term_cond" required="" checked='true'>
                      <label class="custom-control-label" for="form-checkbox">I agree to the <a href="#!">Terms &
                          Conditions</a></label>
                    </div>
                    <button type="submit" name="btn" id="btn" value="submit" class="wpcf7-form-control has-spinner wpcf7-submit">Create Account</button>
                  </form>
              
                    <p id="backtoblog">Already have an account? <a href="<?php echo base_url();?>Web/login">Sign in here</a></p>
              
                                        </div>
                                       </div>
                                    </div>
                                </div>
                    </section>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- signup-area-end -->
    <style>
        select {
    padding: 12px 20px;
    color: rgba(var(--db), 1);
    width: 100%;
    font-family: var(--body-font);
    outline-color: rgba(0, 0, 0, 0);
    font-size: 16px;
    border-radius: 10px;
    background-color: rgba(0, 0, 0, 0);
    border: 1px solid rgba(var(--b1), 0.3);
}

    </style>