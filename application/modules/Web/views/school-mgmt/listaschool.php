<div class="web-banner">
            <div class="web-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                            <div class="heading-inner contact-us-banner text-center">
                                <h1>Sign Up</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner -->
        <div class="web-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-div">
						
						<div class="row m-0 flex-div-grid">	
					<div class="col-lg-4 col-xs-12 col-sm-4 col-md-4 p-0">
										<div class="c-left">
											<div class="relate-div">
												    <div class="contact-data m-b-30">
														<h2>List Your School On Portal</h2>
													</div>
													<div class="address-div">
														<ul class="list-unstyled">
															   <li>
															   	   Lorem Ipsum is simply dummy text of the printing and typesetting industry.
															   </li>
															   <li>
															   	   Lorem Ipsum is simply dummy text of the printing and typesetting industry.
															   </li>
															   <li>
															   	   Lorem Ipsum is simply dummy text of the printing and typesetting industry.
															   </li>
															   <li>
															   	   Lorem Ipsum is simply dummy text of the printing and typesetting industry.
															   </li>
															   <li>
															   	   Lorem Ipsum is simply dummy text of the printing and typesetting industry.
															   </li>
														</ul>
													</div>
											</div>
										</div>
									</div>	
						
						
						<div class="col-lg-8 col-xs-12 col-sm-8 col-md-8 p-0">
										<div class="c-right">
								
                            <div class="tabbing-data text-center text-uppercase">
                                <ul class="list-inline">
                                    <li class="active"><a href="signup.html">SignUp</a></li>
                                </ul>
                            </div>	
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
							<div class="b-tabbing">
                                <div class="tab-content">
                                    <div id="stories" class="tab-pane fade in active">
                                        <div class="gallery-sec">
                                            <div class="row" style="margin:0;">
											<div class="contact-data m-b-30">
												
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
												
											</div>
											<div class="step-form m-b-40">
											<!--id="school_contact"-->
											    <form name="registration" method="post" action="<?php echo site_url();?>listaschool" id="school_contact">
													<div class="row">
													    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="checkbox"  value="1" id="checksponsorexists" required="" onclick="add_sponsor(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                Do you have sponsor
															</div>
														</div>
														<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Sponsor Username" value="<?php echo $sponsor_id;?>" name="sponsor_id" required="" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" title="Sponsor name" value="">&nbsp;&nbsp;&nbsp;&nbsp;
                                       <span id="check_sponsor"></span>
															</div>
														</div>
														<!--<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
															<select name="platform" id="platform" required=""  class="form-control">
                                               <option value="">-Select Anyone Package-</option>
											 <?php
											  if(!empty($all_active_package) && count($all_active_package)>0)
											  {
												  foreach($all_active_package as $package)
												  {
											  ?>
											  <option value="<?php echo $package->id;?>" <?php echo !empty($package->id) && $_POST['platform'] == $package->id ? 'selected' : ''  ?>><?php echo $package->amount;?><?php echo currency();?>(<?php echo $package->title;?>)</option>
											  <?php
												  }
											  }
											  ?>
											  
                                          </select>
															</div>
														</div>-->
													</div>
													<div class="row">
													    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="text" class="form-control" name="username" value="<?php echo $username;?>" required="" id="username" onblur="check_username(this.value)" placeholder="Enter Username">&nbsp;&nbsp;&nbsp;&nbsp;  
                                       <span id="check_username"></span>
															</div>
														</div>
													    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="email" class="form-control" value="<?php echo $email;?>" name="email" placeholder="E-mail" required="">&nbsp;&nbsp;&nbsp;&nbsp;
															</div>
														</div>
														
													</div>
													<div class="row">
														
														<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="password" class="form-control" value="<?php echo $password;?>" name="password" required="" id="passwords" maxlength="12" title="Password" placeholder="Enter Password">&nbsp;&nbsp;&nbsp;&nbsp;
           
															</div>
														</div>
														
														<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
															<input type="password" class="form-control" value="<?php echo $password;?>" name="confirm_password" required="" title="Confirm Password" maxlength="12" id="confirm_password"  placeholder="Confirm Password">&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <span id="valid_confirm_password"></span>
															</div>
														</div>
													</div>
													
													<div class="row">
													    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="text" class="form-control" name="first_name" value="<?php echo $first_name;?>" placeholder="Please enter your name" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span id="valid_firstname"></span>
															</div>
														</div>
														<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="tel" class="form-control" name="contact_no" value="<?php echo $contact_no;?>" placeholder="Please enter your phone number" required="">&nbsp;&nbsp;&nbsp;&nbsp;
          <span id="valid_phone"></span>
															</div>
														</div>
													</div>
													<div class="row">
													    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="text" class="form-control" name="address" value="<?php echo $address_line1;?>" placeholder="Please enter school address" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span id="valid_address"></span>
															</div>
														</div>
														<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="tel" class="form-control" name="contact_person" value="<?php echo $contact_person;?>" placeholder="Please enter contact person" required="">&nbsp;&nbsp;&nbsp;&nbsp;
          <span id="valid_contact_person"></span>
															</div>
														</div>
													</div>
													<div class="row">
													    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="text" class="form-control" name="contact_person_email" value="<?php echo $contact_person_email;?>" placeholder="Contact person email" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span id="valid_address"></span>
															</div>
														</div>
														<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
															<div class="form-group">
																<input type="tel" class="form-control" name="contact_person_phone" value="<?php echo $contact_person_phone;?>" placeholder="Contact person phone" required="">&nbsp;&nbsp;&nbsp;&nbsp;
          <span id="valid_contact_person"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-12 col-xs-12 col-md-6 col-sm-6">
															<div class="theme-button text-uppercase">
															    
												<div class="btn-effect">
												    <button type="submit" class="btn-default-page dnd" name="btn" id="btn" value="SignUp">SignUp</button>
															</div>
														</div>
													</div>
												</form>

										</div>
											</div>
									</div>
						
                                     
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		</div>
		</div>
		<script>
		    function add_sponsor()
		    {
		        var checksponsorexists = document.getElementById('checksponsorexists');
                if (checksponsorexists.checked){
                    document.getElementById('sponsor_id').value='customer';
                }else{
                    document.getElementById('sponsor_id').value="";
                }
		    }
		</script>