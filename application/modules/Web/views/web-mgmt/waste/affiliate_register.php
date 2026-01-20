

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
  

  <!-- breadcrumb-banner-area -->
    <div class="breadcrumb-banner-area bg-img-2 bg-opacity-2 ptb-50">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumb-text">
              <div class="breadcrumb-menu">
                <ul>
                  <li><a href="<?php echo base_url();?>">home</a></li>
                  <li><span>Affiliate Signup</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- breadcrumb-banner-area-end -->

    <!-- signup-area-start -->
    <div class="signup-area ptb-80">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="single-signup">
             <!-- <div class="sign-logo text-center">
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>webassets/img/logo/1.png" alt="" /></a>
              </div>-->
              <!--<div class="sign-content">
                <p class="message-register">Register For This Site</p>
              </div>-->
              <form name="registration" method="post" action="<?php echo site_url();?>Web/affiliate-signup">
        <span>Create Account</span>
        <!-- <div class="form-group">
          <input type="checkbox" value="1"  name='con_sponsor'   id='con_no' /> Select if you dont have a sponsor   
        </div> -->
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Sponsor Username" value="<?php echo $sponsor_id;?>" name="sponsor_id" required="" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" title="Sponsor name" value="">&nbsp;&nbsp;&nbsp;&nbsp;
                                       <span id="check_sponsor"></span>
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required="" id="username" onblur="check_username(this.value)" placeholder="Enter Username">&nbsp;&nbsp;&nbsp;&nbsp;  
                                       <span id="check_username"></span>
        </div>
        <div class="form-group">
          <input type="email" class="form-control" value="<?php echo $email;?>" name="email" placeholder="E-mail" required="">&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="form-group">
          <input type="password" class="form-control" value="<?php echo $password;?>" name="password" required="" id="passwords" maxlength="12" title="Password" placeholder="Enter Password">&nbsp;&nbsp;&nbsp;&nbsp;
                                       
        </div>
        <div class="form-group">
          <input type="password" class="form-control" value="<?php echo $password;?>" name="confirm_password" required="" title="Confirm Password" maxlength="12" id="confirm_password"  placeholder="Confirm Password">&nbsp;&nbsp;&nbsp;&nbsp;
                                          <span id="valid_confirm_password"></span>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="firstname" value="<?php echo $first_name;?>" placeholder="Please enter your name" required="">&nbsp;&nbsp;&nbsp;&nbsp;
          <span id="valid_firstname"></span>
        </div>
        <div class="form-group">
          <input type="tel" class="form-control" name="phone" value="<?php echo $contact_no;?>" placeholder="Please enter your phone number" required="">&nbsp;&nbsp;&nbsp;&nbsp;
          <span id="valid_phone"></span>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="term_cond" required="" checked='true'>
          <label class="custom-control-label" for="form-checkbox">I agree to the <a href="#!">Terms &
              Conditions</a></label>
        </div>
        <button type="submit" name="btn" id="btn" value="submit" class="btn btn-primary">Create Account</button>
      </form>
              
              <p id="backtoblog">Already have an account? <a href="<?php echo base_url();?>login">Sign in here</a></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <!-- signup-area-end -->