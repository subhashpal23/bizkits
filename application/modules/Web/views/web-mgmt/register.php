<style>
    .form-group {
    margin: 20px 0;
}
</style>
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <?php 
     ///sponsor and account info
     $sponsor_id=(!empty($registration_info['sponsor_and_account_info']['ref_user_name']))?$registration_info['sponsor_and_account_info']['ref_user_name']:null;
      if(!empty($replicated_username))	
	  {			
		$sponsor_id=$replicated_username;					 
	  }
	  $upline_id=(!empty($registration_info['sponsor_and_account_info']['upline_user_name']))?$registration_info['sponsor_and_account_info']['upline_user_name']:null;
      if(!empty($upline_username))	
	  {			
		$upliner_id=$upline_username;					 
	  }
	 $upline_leg_position=(!empty($registration_info['sponsor_and_account_info']['upline_leg_position']))?$registration_info['sponsor_and_account_info']['upline_leg_position']:null;
	 if(!empty($upline_position))	
	  {			
		$upline_position=$upline_position;					 
	  }
	 $ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'Left';
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
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-12 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            <p class="mb-30">Already have an account? <a href="<?php echo base_url();?>/Web/login">Login</a></p>
                                        </div>
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
                                        <form method="POST" action="<?php echo base_url();?>Web/register">
                                            <!--<div class="form-group">
                                                <input type="text" name="sponsor_id" value="<?php echo $sponsor_id;?>" <?php if($upline_position!=''){ echo "readonly";}?> class="form-control required" placeholder="Sponsor Username" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" onchange="getVals(this, 'sponsor_id');">
								<span id="check_sponsor"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="upline_id" value="<?php echo $upliner_id;?>" <?php if($upline_position!=''){ echo "readonly";}?> class="form-control required" placeholder="Placement Username" onblur="check_upliner1(this.value)" autocomplete="off" id="upliner_id"  onchange="getVals(this, 'upliner_id');">
								    <span id="check_upliner"></span>
                                            </div>-->
                                            <!--<div class="form-group">
                                                <?php if($upline_position!=''){ 
                        ?>
                        <input type="text" name="ref_leg_position" value="<?php echo $upline_position;?>" <?php if($upline_position!=''){ echo "readonly";}?> class="form-control required" placeholder="Placement Position">
                        <?php
                    }
                    else
                    {?>
                    
											<select class="form-control required" name="ref_leg_position" onchange="getVals(this, 'position');">
												<option value="">Position</option>
												<option value="Left" <?php if($upline_position=='Left'){ echo "selected";}?>>Left</option>
												<option value="Right" <?php if($upline_position=='Right'){ echo "selected";}?>>Right</option>
											</select>
					<?php
                    }
                    ?>
                                            </div>-->
                                            <!--<div class="form-group">
                                                <?php
                    $currency=currency();
                    ?>
											<select name="package" id="package" class="form-control" onchange="getVals(this, 'package');">
                         <?php
                         if($_GET['pkg']=='')
                         {
                             echo "<option value=''>Select Package</option>";
                         }
                                    $s=1;
                                    foreach($all_active_package as $key=>$val)
                                    {
                                        echo "<option value='".$val->id."' data-price='".$val->amount."'>".$val->title."(".$currency.$val->amount.")</option>";
                                    }
                                    ?>
                        
                     </select>
                     <span id="check_package"></span>
                                            </div>-->
                                             <!-- <div class="form-group">
                                                <label>Register As</label>
                                                <select name="account_type" class="form-control" required>
                                                    <option value="1">Experts</option>
                                                    <option value="2">Customer</option>
                                                </select>
                                            </div> -->
											<input type="hidden" value="2" name="account_type"/>
                                            <!-- <div class="form-group">
                                                <input type="text" name="username" required="" onblur="check_username(this.value)" id="username"  class="form-control required" placeholder="Username" onchange="getVals(this, 'username');">
								<span id="check_username"></span>
                                            </div> -->
											<div class="form-group">
                                                <input required="" type="text" id="first_name"  class="form-control required"  name="first_name" placeholder="Name">
                                                <span id="matchpassword"></span>
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" id="contact_no"  class="form-control required"  name="contact_no" placeholder="Mobile">
                                                <span id="matchpassword"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="email"   class="form-control required" placeholder="Email">
												<span id="check_username"></span>
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" id="password"   class="form-control required"  name="password" placeholder="Password">
                                            
											</div>
                                            <div class="form-group">
                                                <input required="" type="password" id="confirm_password"   class="form-control required"  name="confirm_password" onblur="matchPassword();" placeholder="Confirm password">
                                                <span id="matchpassword"></span>
                                            </div>
                                            <!--<div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <input type="text" required="" name="email" placeholder="Security code *">
                                                </div>
                                                <span class="security-code">
                                                    <b class="text-new">8</b>
                                                    <b class="text-hot">6</b>
                                                    <b class="text-sale">7</b>
                                                    <b class="text-best">5</b>
                                                </span>
                                            </div>-->
                                            <!--<div class="payment_option mb-50">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">I am a customer</label>
                                                </div>
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">I am a vendor</label>
                                                </div>
                                            </div>-->
                                            
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <!--<a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>-->
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-primary btn-block hover-up" name="login" value="login">Submit &amp; Register</button>
                                            </div>
                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="">
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="assets/imgs/theme/icons/logo-google.svg" alt="">
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="assets/imgs/theme/icons/logo-apple.svg" alt="">
                                        <span>Continue with Apple</span>
                                    </a>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
