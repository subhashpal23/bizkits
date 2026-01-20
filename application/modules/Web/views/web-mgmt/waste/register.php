
<script type= "text/javascript" src = "<?php echo base_url();?>frontassets/js/countries.js"></script>
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
     
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url();?>frontassets/images/bg.jpg">
            <div class="container">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title" style="color:#fff;">Register</h1>
                    <ul class="breadcumb-menu">
                        <li>
                            <a href="<?php echo base_url();?>" style="color:#fff;">Home</a>
                        </li>
                        <li style="color:#fff;">Register</li>
                    </ul>
                </div>
            </div>
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
					<div class="space-bottom">
            <div class="container">
						<!-- /top-wizard -->
						<form id="wrapped-1" method="POST" action="<?php echo base_url();?>Web/register">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
									<h3 class="main_question"><!--<strong>1/4</strong>-->Please fill the details correctly</h3>

                  <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                                <label for="firstname">Sponsor Username</label>
                                <input type="text" name="sponsor_id" value="<?php echo $sponsor_id;?>" <?php if($upline_position!=''){ echo "readonly";}?> class="form-control required" placeholder="Sponsor Username" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" onchange="getVals(this, 'sponsor_id');">
								<span id="check_sponsor"></span>
									</div>
							</div>
    
                            <div class="col-md-6">
								<div class="form-group">
                                    <label for="firstname">Placement Username</label>
                                    <input type="text" name="upline_id" value="<?php echo $upliner_id;?>" <?php if($upline_position!=''){ echo "readonly";}?> class="form-control required" placeholder="Placement Username" onblur="check_upliner1(this.value)" autocomplete="off" id="upliner_id"  onchange="getVals(this, 'upliner_id');">
								    <span id="check_upliner"></span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
                <label for="firstname">Position</label>
                <div class="styled-select clearfix">
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
										</div>
														
								</div>
							</div>
								<div class="col-md-6">
								<div class="form-group">
                <label for="firstname">Package Information</label>
                <div class="styled-select clearfix">
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
										</div>
														
								</div>
							</div>
						</div>




            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="firstname">Username</label>
                <input type="text" name="username" onblur="check_username(this.value)" id="username"  class="form-control required" placeholder="Username" onchange="getVals(this, 'username');">
								<span id="check_username"></span>	</div>
							</div>


						
						</div>



            
            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Password</label>
                <input class="form-control required" type="password" id="password" name="password" placeholder="Password" onchange="getVals(this, 'password');">
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">Confirm Password</label>
                <input class="form-control required" type="password" id="confirm_password" name="confirm_password" onblur="matchPassword();" placeholder="Confirm Password">
								<span id="matchpassword"></span>						
								</div>
							</div>
						</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question">Plase provide your Personal Information</h3>

                  <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Transaction Password</label>
                <input class="form-control required" type="password" id="tpasswords" name="tpassword" placeholder="Password" onchange="getVals(this, 'password');">
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">Confirm Password</label>
                <input class="form-control required" type="password" id="confirm_tpassword" name="confirm_t_code"  onblur="matchPasswordTransaction();" placeholder="Confirm Password">
							<span id="matchtpassword"></span>							
								</div>
							</div>
						</div>


            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="first_name" class="form-control required" placeholder="First Name" onchange="getVals(this, 'first_name');">
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="last_name" class="form-control required" placeholder="Last Name" onchange="getVals(this, 'first_name');">
														
								</div>
							</div>
						</div>

            
            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Email Address</label>
                <input type="email" name="email" class="form-control required" placeholder="Your Email" onchange="getVals(this, 'email');">
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">Phone Number</label>
                <input type="text" name="contact_no" class="form-control required" placeholder="Phone Number" onchange="getVals(this, 'first_name');">
														
								</div>
							</div>
						</div>


            
            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Country</label>
                <div class="styled-select clearfix">
											<select class="form-control" id="country" name ="country" onchange="print_state('state',this.selectedIndex);" >
												<option value="">Select your Country</option>
                                                
											                           
											</select>
										</div>
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">State</label>
                <div class="styled-select clearfix">
											<select class="form-control" name ="state" id ="state" onchange="showStockistStateWise(this.value);">
												<option value="">Select your State</option>
                                                
											</select>
										</div>
														
								</div>
							</div>
						</div>

            
            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Choose City</label>
                <div class="styled-select clearfix">
											<!--<select class="wide required" name="city" onchange="getVals(this, 'city');">
												<option value="">Select your City</option>
                        <option value="City">Select your City</option>
											
											                           
											</select>-->
											<input type="tel"  name="city" value="<?php echo $city;?>"  value="Abia" placeholder="Please enter your city" required="" class="form-control">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="valid_city"></span>
										</div>
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">Choose Stockist</label>
                <div class="styled-select clearfix">
                    
											<select class="form-control required" name="stockist" id="stockist" onchange="showStockist(this.value);">
												<option value="">Select your Stockist</option>
                        
											<?php
											foreach($all_stockist as $key=>$val)
											{
											    echo "<option value='".$val->user_id."'>".$val->username."</option>";
											}
											?>
											                           
											</select>
										</div>
														
								</div>
							</div>
							<div class="row">
							    <div class="card card-body" >
							        <div class="" id="showstockistdetails"></div>
							        
							    </div>
							</div>
						</div>

            	<!-- /step-->
									<div class="form-group">
								
									</div>
									<div class="form-group">
										
									</div>
									<div class="form-group">
									
									</div>
									
								</div>
								<div class="step">
									<h3 class="main_question"><!--<strong>3/4</strong>-->Plase provide your Bank Information</h3>

                  <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Bank Name</label>
                <select class="form-control required" id="bank_name" name="bank_name" >
                    <option value="">
                        Select Bank Name
                    </option>
                    <?php
                    foreach($all_bank as $key=>$val)
                    {
                        echo "<option value='".$val->id."'>".$val->name."</option>";
                    }
                    ?>
                </select>
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">Account Holder Name</label>
                <input class="form-control required" type="text" id="account_holder_name" name="account_holder_name" placeholder="Account Holder Name">
														
								</div>
							</div>
						</div>


            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Account Number</label>
                <input type="text" name="account_no" class="form-control required" placeholder="Account Number" >
									</div>
							</div>


						</div>
            	<!-- /step-->
									<div class="form-group">
								
									</div>
									<div class="form-group">
										
									</div>
									<div class="form-group">
									
									</div>
									
								</div>
								<!-- /step-->
								<div class="submit step">
									<h3 class="main_question"><!--<strong>3/3</strong>-->Choose Product</h3>
                  <div class="row">
                      <?php
                      foreach($all_products as $kry=>$val)
                      {
                        ?>
                        <div class="col-md-3">
								<div class="form-group">
                <label for="" style="color:#017d03;"><?php echo $val->title;?></label>
                <figure><img src="<?php echo base_url();?>product_images/<?php echo $val->product_image;?>" alt="" class="img-fluid" style="width:50%"></figure>
                Quantity:<input type="number" id="qty_<?php echo $val->id;?>" value="1">
                <button type="button" name="process" class="btn btn-primary" id="addcart_<?php echo $val->id;?>" onclick="addtocart('<?php echo $val->id;?>')">Add To Cart</button>
                <button type="button" name="process" class="submit nodispaly" style="display:none" id="removecart_<?php echo $val->id;?>" onclick="removefromcart('<?php echo $val->id;?>')">Remove</button>
									</div>
							</div>
                        <?php
                      }
                      ?>
							
								</div>
								<div class="row">
							    <div class="card card-body" >
							        <div class="" id="total_reason"></div>
							        <div class="" id="total_msg"></div>
							        <div class="" id="total_cost"></div>
							        <div class="" id="total_product"></div>
							    </div>
							</div>
								<!-- /step-->
							</div>
							
							<!-- /middle-wizard -->
							<div id="bottom-wizard">
							    
								<!--<button type="button" name="backward" class="backward">Prev</button>
								<button type="button" name="forward" class="forward">Next</button>-->
								<button type="submit" name="btn" id="createbtn" value="btn" class="th-btn style4">Creat Account</button>
							</div>
							<!-- /bottom-wizard -->
						</form>
					</div>
        </div>
        </div>
	<script language="javascript">
	print_country("country");
	//print_state('state',169);</script>