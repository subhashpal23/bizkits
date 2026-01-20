<!DOCTYPE html>
<html lang="en">
<body id="dark">
  <header class="dark-bb">
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="exchange-dark.html"><img src="<?php echo base_url();?>front_assets/img/logo-light.svg" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerMenu"
        aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon ion-md-menu"></i>
      </button>
      <div class="collapse navbar-collapse" id="headerMenu">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>" role="button" >
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>" role="button">
              Exchange
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>" role="button">
              Market
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <a href="<?php echo base_url();?>user" class="btn-1">Sign In</a>
          <a href="<?php echo base_url();?>join-us" class="btn-2">Sign Up</a>
        </ul>
      </div>
    </nav>
  </header>

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
  <div class="vh-100 d-flex justify-content-center">
    <div class="form-access my-auto">
      <form name="registration" method="post" action="<?php echo site_url();?>front/register">
        <span>Create Account</span>
        <!-- <div class="form-group">
          <input type="checkbox" value="1"  name='con_sponsor'   id='con_no' /> Select if you dont have a sponsor   
        </div> -->
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Sponsor Username" value="<?php echo $sponsor_id;?>" name="sponsor_id" required="" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" title="Sponsor name" value="">&nbsp;&nbsp;&nbsp;&nbsp;
                                       <span id="check_sponsor"></span>
        </div>
        <!--<div class="form-group">
          <select name="ref_leg_position" class="form-control">
            <option disabled>Select Position</option>
            <option value="left">Left</option>
            <option value="right">Right</option>
        </select>
        </div>-->
        <div class="form-group">
          <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required="" id="username" onblur="check_username(this.value)" placeholder="Enter Username">&nbsp;&nbsp;&nbsp;&nbsp;  
                                       <span id="check_username"></span>
        </div>
        <div class="form-group">
          <input type="email" class="form-control" value="<?php echo $email;?>" name="email" placeholder="E-mail" required="">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" value="<?php echo $password;?>" name="password" required="" id="passwords" maxlength="12" title="Password" placeholder="Enter Password">
                                       
        </div>
        <div class="form-group">
          <input type="password" class="form-control" value="<?php echo $password;?>" name="confirm_password" required="" title="Confirm Password" maxlength="12" id="confirm_password"  placeholder="Confirm Password">
                                          <span id="valid_confirm_password"></span>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="firstname" value="<?php echo $first_name;?>" placeholder="Please enter your name" required="">
        </div>
        <div class="form-group">
          <input type="tel" class="form-control" name="phone" value="<?php echo $contact_no;?>" placeholder="Please enter your phone number" required="">
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="term_cond" required="" checked='true'>
          <label class="custom-control-label" for="form-checkbox">I agree to the <a href="#!">Terms &
              Conditions</a></label>
        </div>
        <button type="submit" name="btn" id="btn" value="submit" class="btn btn-primary">Create Account</button>
      </form>
      <h2>Already have an account? <a href="<?php echo base_url();?>user">Sign in here</a></h2>
    </div>
  </div>