
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
     
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="i3 Empire - Invite, Invest, Increase">
    <meta name="author" content="i3 Empir">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>frontassets/login/images/logo-icon.png">


<!--------font awesome linking------------->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontassets/login/font/css/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontassets/login/font/css/fontawesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontassets/login/font/css/solid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontassets/login/font/css/brands.css">

<title>i3 Empire | Registration</title>

    

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="<?php echo base_url();?>frontassets/login/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>frontassets/login/css/menu.css" rel="stylesheet">
    <link href="<?php echo base_url();?>frontassets/login/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>frontassets/login/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="<?php echo base_url();?>frontassets/login/css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="<?php echo base_url();?>frontassets/login/js/modernizr.js"></script>

</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	
	
	
	<!-- /menu -->
	
	<div class="container-fluid full-height">
		<div class="row row-height">
			<div class="col-lg-6 content-left">
				<div class="content-left-wrapper">
					<a href="#" id="logo"><img src="<?php echo base_url();?>frontassets/login/images/logo.png" alt="" width="49" height="35"></a>
					<div id="social">
						<ul>
							<li><a href="https://web.facebook.com/i3empire"><i class="fa-brands fa-facebook"></i></a></li>
							<li><a href="https://www.instagram.com/i3empire/"><i class="fa-brands fa-instagram"></i></a></li>
							<li><a href="https://www.youtube.com/@i3empire"><i class="fa-brands fa-youtube"></i></a></li>
							<li><a href="#0"><i class="fa-brands fa-telegram"></i></a></li>
						</ul>
					</div>
					<!-- /social -->
					<div>
						<figure><img src="<?php echo base_url();?>frontassets/login/images/register.png" alt="" class="img-fluid"></figure>
						<h2>Register Here</h2>
						<p>Kindly ensure that the details are accurately completed</p>
						<a href="<?php echo base_url();?>" class="btn_1 rounded" target="_parent">Back to Homepage</a>
				
					</div>
					<div class="copy">© 2024 i3 Empire LTD</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
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
					<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<!-- /top-wizard -->
						<form id="wrapped-1" method="POST" action="<?php echo base_url();?>Web/register">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
									<h3 class="main_question"><strong>1/4</strong>Please fill the details correctly</h3>

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
						</div>




            <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="firstname">Username</label>
                <input type="text" name="username" onblur="check_username(this.value)" id="username"  class="form-control required" placeholder="Username" onchange="getVals(this, 'username');">
								<span id="check_username"></span>	</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="firstname">Package Information</label>
                <div class="styled-select clearfix">
											<!--<select class="wide required" name="position" onchange="getVals(this, 'position');">
												<option value="">Select your Package</option>
												<option value="Signature">Signature (N10,000)</option>
												<option value="Lite">Lite (N20,000)</option>
                        <option value="Premiere">Premiere (N60,000)</option>
												<option value="Elite">Elite (N120,000)</option>
                        <option value="Ultimate">Ultimate (N240,000)</option>
												<option value="Empire">Empire (N48,000)</option>
											                           
											</select>-->
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



        

							
									
									<div class="form-group terms">
										<label class="container_check">Please accept our <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and conditions</a>
											<input type="checkbox" name="terms" value="Yes" class="required">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>2/4</strong>Plase provide your Personal Information</h3>

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
									<h3 class="main_question"><strong>3/4</strong>Plase provide your Bank Information</h3>

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
									<h3 class="main_question"><strong>3/3</strong>Choose Product</h3>
                  <div class="row">
                      <?php
                      foreach($all_products as $kry=>$val)
                      {
                        ?>
                        <div class="col-md-6">
								<div class="form-group">
                <label for="" style="color:#017d03;"><?php echo $val->title;?></label>
                <figure><img src="<?php echo base_url();?>product_images/<?php echo $val->product_image;?>" alt="" class="img-fluid"></figure>
                Quantity:<input type="number" id="qty_<?php echo $val->id;?>" value="1">
                <button type="button" name="process" class="submit" id="addcart_<?php echo $val->id;?>" onclick="addtocart('<?php echo $val->id;?>')">Add To Cart</button>
                <button type="button" name="process" class="submit nodispaly" style="display:none" id="removecart_<?php echo $val->id;?>" onclick="removefromcart('<?php echo $val->id;?>')">Remove</button>
									</div>
							</div>
                        <?php
                      }
                      ?>
							<!--<div class="col-md-6">
								<div class="form-group">
                <label for="" style="color:#017d03;">Product 1</label>
                <figure><img src="<?php echo base_url();?>frontassets/login/images/product/1-1.jpg" alt="" class="img-fluid"></figure>
                <input type="radio" name="product" value="product1"> Select
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="" style="color:#017d03;">Product 2</label>
                <figure><img src="<?php echo base_url();?>frontassets/login/images/product/2-2.jpg" alt="" class="img-fluid"></figure>
                <button type="submit" name="process" class="submit">Select</button>							
								</div>
							</div>

              <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="" style="color:#017d03;">Product 3</label>
                <figure><img src="<?php echo base_url();?>frontassets/login/images/product/3-3.jpg" alt="" class="img-fluid"></figure>
                
                <input type="radio" name="product" value="product3">	Select
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="" style="color:#017d03;">Product 4</label>
                <figure><img src="<?php echo base_url();?>frontassets/login/images/product/4-4.jpg" alt="" class="img-fluid"></figure>
                
					<input type="radio" name="product" value="product4">	Select								
								</div>
							</div>

						</div>-->
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
							    
								<button type="button" name="backward" class="backward">Prev</button>
								<button type="button" name="forward" class="forward">Next</button>
								<button type="submit" name="btn" id="createbtn" value="btn" class="submit">Creat Account</button>
							</div>
							<!-- /bottom-wizard -->
						</form>
					</div>
					<!-- /Wizard container -->
			</div>
			<!-- /content-right-->
		</div>
		<!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	
	<!-- /menu button -->
	
	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>These Terms and Conditions ("Terms") govern your registration with i3 Empire, its associated services, and the use ofits platform.
             By registering with i3 Empire, you agree to abide by these Terms. Please read them carefully. <br><br>

         <strong>1. Registration </strong> <br>

          1.1. To register with i3 Empire, you must provide accurate, current, and complete information about yourself and your
          company as prompted during the registration process. <br>

          1.2. You are responsible for maintaining the confidentiality of your account information and password. You agree to
          notify i3 Empire immediately of any unauthorized use of your account or any other breach of security.<br><br>

          <strong>2. Eligibility</strong> <br>

          2.1. By registering with i3 Empire, you confirm that you are at least 18 years old and have the legal capacity to enter into these Terms.<br><br>

          <strong>3. Company Description</strong> <br>

          3.1. i3 Empire operates as a platform that promotes health and wealth through its products, services, and community support.<br>

          3.2. Our commitment is to provide a platform where individuals can invest in their overall well-being, invite others to
          embark on this empowering journey, and witness a remarkable increase in both health and financial vitality. <br>

          3.3. i3 Empire focuses on sustainable practices and community support, aiming to create a movement towards a
          healthier and wealthier lifestyle.<br><br>

          <strong>4. User Responsibilities</strong> <br>

          4.1. You agree to use i3 Empire's platform and services in compliance with all applicable laws and regulations.<br>

          4.2. You agree not to engage in any activity that could harm, disable, overburden, or impair the proper functioning of i3 Empire's platform.<br>

          4.3. You are solely responsible for any content you post, share, or distribute on i3 Empire's platform. You agree not to post or transmit
          any unlawful, threatening, defamatory, obscene, or otherwise objectionable content.<br><br>
          By registering with i3 Empire, you acknowledge that you have read, understood, and agree to be bound by these Terms.</p>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<script language="javascript">
	print_country("country");
	//print_state('state',169);</script>
	<!-- COMMON SCRIPTS -->
	<script src="<?php echo base_url();?>frontassets/login/js/jquery-3.7.1.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/login/js/common_scripts.min.js"></script>
	<script src="<?php echo base_url();?>frontassets/login/js/velocity.min.js"></script>
	<script src="<?php echo base_url();?>frontassets/login/js/functions.js"></script>
	<script src="<?php echo base_url();?>frontassets/login/js/pw_strenght.js"></script>

	<!-- Wizard script -->
	<script src="<?php echo base_url();?>frontassets/login/js/registration_func.js"></script>

</body>
</html>
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
    <script>
    $("#createbtn").hide();
function checkusername(str)
{
    str=str.replace(/ /g,'');
    //alert(str);
    $("#username").val(str);
}

function check_sponsor(sponsor_id)
{
	 //var platform=$("#platform").val();
	 if(sponsor_id=='')
     {
		 
         $("#check_sponsor").children().remove();
         $("#check_sponsor").append('<div>Please enter referral ID!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
			  
     }
	 
     else 
     {
         //$("#check_sponsor").append(loader_image);
         //var platform=$("#platform").val();
		 
		 $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isUserNameExists',
               data: {username:sponsor_id,requestType:'sponsor'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    //$("#overlay").fadeIn(300);
                  },
               success:function(res){
               	
                 $("#check_sponsor").children().remove();
                 if(res.exist!='1')
                 {
                  $("#check_sponsor").append('<div class="text-danger">Sorry Referral does not exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                  //$("#sponsor_id").focus();
                 }//end if
                 else 
                 {
                  $("#check_sponsor").append('<div class="text-success">'+res.username+' Exist</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
               complete: function () {
                    //$("#load").css("display", "none");
                    //$("#overlay").fadeOut(300);
                }

          });//end ajax
     }
}//end function

//$(document).ready(function(){alert("call")});
function check_user(upline_id)
{
    var platform=$("#platform").val();
	 if(upline_id=='')
     {
         $("#check_user").children().remove();
         $("#check_user").append('<div>Please enter upline ID!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
     }
	 else if(platform=='')
	 {
			$("#valid_platform").children().remove();
			$("#valid_platform").append('<div>Please select package first!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
		$("#upline_id").val(null);
		$("#platform").focus();		  
		return false;			  
	 }
     else 
     {
         //$("#check_sponsor").append(loader_image);
         var platform=$("#platform").val();
		 
		 $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isUserNameExists',
               data: {username:upline_id,requestType:'upline','pkg_id':platform},
               async:false,
               beforeSend: function () {
                    $("#overlay").fadeIn(300);
                  },
               success:function(res){
                 $("#check_user").children().remove();
                 if(res.exist!='1')
                 {
                  $("#check_user").append('<div class="text-danger">Sorry Upline does not exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                  //$("#sponsor_id").focus();
                 }//end if
                 else 
                 {
                  $("#check_user").append('<div class="text-success">'+res.username+' Exist</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
               complete: function () {
                    $("#overlay").fadeOut(300);
                }
          });//end ajax
     }
}
function check_username(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_<?php echo base_url();?>frontassets/images/loader.gif" width="auto">';
     if(username=='')
     {
         $("#check_username").children().remove();
         $("#check_username").append('<div>Please enter login Id!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
                  //$("#sponsor_id").focus();
     }
     else 
     {
           //$("#check_username").append(loader_image);
           $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isUserNameExists',
               data: {username:username,requestType:'new_user'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    $("#overlay").fadeIn(300);
                  },
               success:function(res){
                 $("#check_username").children().remove();
                 if(res.exist=='1')
                 {
                  
                   $("#check_username").append('<div class="text-danger">Sorry '+username+' already exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }//end if
                 else 
                 {
                  $("#check_username").append('<div class="text-success">'+username+' available!</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
              complete: function () {
                    //$("#load").css("display", "none");
                    $("#overlay").fadeOut(300);
                } 
          });//end ajax
     }
}//end function

function check_idno(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_<?php echo base_url();?>frontassets/images/loader.gif" width="auto">';
    var minLength = 10;
    var maxLength = 10;
    var charLength = username.length;
     if(username=='')
     {
         $("#check_idno").children().remove();
         $("#check_idno").html('<div>Please enter pan card!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
                  //$("#sponsor_id").focus();
     }
     else if(charLength < minLength){
        $('#check_idno').html('Length is short, minimum '+minLength+' required.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
    }else if(charLength > maxLength){
        $('#check_idno').html('Length is not valid, maximum '+maxLength+' allowed.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
        $('#idno').val(char.substring(0, maxLength));
    }
    
     else 
     {
           //$("#check_username").append(loader_image);
           $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isIdNoExists',
               data: {username:username,requestType:'new_user'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    $("#overlay").fadeIn(300);
                  },
               success:function(res){
                 $("#check_idno").children().remove();
                 if(res.exist=='1')
                 {
                  
                   $("#check_idno").html('<div>Sorry '+username+' already exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }//end if
                 else 
                 {
                  $("#check_idno").html('<div>'+username+' available!</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
              complete: function () {
                    //$("#load").css("display", "none");
                   $("#overlay").fadeOut(300);
                } 
          });//end ajax
     }
}//end function

//check_aadharno
function check_aadharno(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_<?php echo base_url();?>frontassets/images/loader.gif" width="auto">';
     // check username should be 12 length
    var minLength = 12;
    var maxLength = 12;
    var charLength = username.length;
    if(username=='')
     {
        $("#check_aadharno").children().remove();
        $("#check_aadharno").html('<div>Please enter Aadhar No!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
        //$("#sponsor_id").focus();
     }
     else if(charLength < minLength){
        $('#check_aadharno').html('Length is short, minimum '+minLength+' required.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
    }else if(charLength > maxLength){
        $('#check_aadharno').html('Length is not valid, maximum '+maxLength+' allowed.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
        $('#aadharno').val(char.substring(0, maxLength));
    }
     
     else 
     {
        //$("#check_username").append(loader_image);
       $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>front/isAadharNoExists',
           data: {username:username,requestType:'new_user'},
           async:false,
           beforeSend: function () {
                //$("#load").css("display", "block");
                $.loader("on", '<?php echo site_url();?>admin_<?php echo base_url();?>frontassets/images/default.svg');
              },
           success:function(res){
             $("#check_aadharno").children().remove();
             if(res.exist=='1')
             {
               $("#check_aadharno").html('<div>Sorry '+username+' already exists!</div>').css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }//end if
             else 
             {
              $("#check_aadharno").html('<div>'+username+' available!</div>').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }
           },//end success
          complete: function () {
                //$("#load").css("display", "none");
                $.loader("off", '<?php echo site_url();?>admin_<?php echo base_url();?>frontassets/images/default.svg');
            } 
      });//end ajax
     }
}//end function
//$(document).ready(function(){alert("call")});

function showpasserror(value)
{
    var password=$("#passwords").val();
          var confirm_password=$("#confirm_password").val();
          if(password!=confirm_password)
          {
               $("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold'});
          }
          else
          {
               $("#valid_confirm_password").text("");
          }
}
     
     
     ////
     $("#btn").click(function(){
          
          var password=$("#passwords").val();
          var confirm_password=$("#confirm_password").val();
          if(password!=confirm_password)
          {
               $("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold'});
               $("#confirm_password").focus();
               return false;
          }
          
          if(!$("#term_cond").is(':checked'))
          {
               $("#valid_term_cond").text("Accept Terms & Condition!").css({'color':'red','font-weight':'bold'});
               //$("#term_cond").focus();
               return false;
          }
          return true;
     });
     $("#platform").change(function(){
		if($(this).val()!='')
		{
			$("#valid_platform").children().remove();
		}
	});

function myFunction(inco,icon) {
  var x = document.getElementById(inco);
  var i = document.getElementById(icon);
  if (x.type === "password") {
    x.type = "text";
    i.type = "text";
    
  } else {
    x.type = "password";
    i.type = "password";
    
  }
}

function checkPasswordMatch() {
    var password = $("#passwords").val();
    var confirmPassword = $("#confirm_password").val();
    if (password != confirmPassword)
    $("#valid_confirm_password").html("<font color='red'>Login Password Do Not Match!</font>");
    else
    $("#valid_confirm_password").html("<font color='green'>Passwords match.</font>");
    }
    
    function checkPasswordMatch1() {
    var password1 = $("#passwords1").val();
    var confirmPassword1 = $("#confirm_password1").val();
    if (password1 != confirmPassword1)
    $("#valid_confirm_password1").html("<font color='red'>Transaction Password Do Not Match!");
    else
    $("#valid_confirm_password1").html("<font color='green'>Passwords match.</font>");
    }
    
    function addtocart(id)
    {
        //alert(id);
        var pkg = $('#package option:selected').data('price');
        var qty = $('#qty_'+id).val();
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/Cart/addToCart/'+id+"/"+pkg+"/"+qty,
           data: {product_id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               
            console.log(res);
            var res1=JSON.parse(res);
            console.log(res1.total);
            if(parseInt(pkg)==parseInt(res1.total_cost))
            {
                $("#createbtn").show();
            }
            else
            {
                $("#createbtn").hide();
            }
             if(res1.total>=1)
             {
                 if(res1.reason=='')
                 {
                    $('#removecart_'+id).show();
                    $('#addcart_'+id).hide();
                    $('#qty_'+id).hide();
                 }
                 else
                 {
                    $('#removecart_'+id).hide();
                    $('#addcart_'+id).show();
                    $('#qty_'+id).show();
                 }
              $("#total_message").html(res1.msg).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html(res1.reason).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
               $("#total_cost").html("Total Amount:<?php echo currency();?>"+res1.total_cost).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_product").html("Total Products:"+res1.total).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }//end if
             else 
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                $("#total_product").html('').css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_cost").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              
              $("#total_message").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }
           },//end success
          complete: function () {
       
            } 
      });//end ajax
        
    }
    
    function removefromcart(id)
    {
        //alert(id);
        var pkg = $('#package option:selected').data('price');
        var qty = $('#qty_'+id).val();
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/Cart/removeItemFromCart/'+id+'/'+pkg+'/Removed',
           data: {product_id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
            console.log(res);
            var res1=JSON.parse(res);
            console.log(res1.total);
            if(parseInt(pkg)==parseInt(res1.total_cost))
            {
                $("#createbtn").show();
            }
            else
            {
                $("#createbtn").hide();
            }
             if(res1.total>=1)
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                 $("#total_message").html(res1.msg).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html(res1.reason).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
               $("#total_cost").html("Total Amount:<?php echo currency();?>"+res1.total_cost).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_product").html("Total Products:<?php echo currency();?>"+res1.total).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }//end if
             else 
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                $("#total_product").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_cost").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }
           },//end success
          complete: function () {
       
            } 
      });//end ajax
        
    }
    
    function showStockistStateWise(state_id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/showStockistStateWise/'+state_id,
           data: {state_id:state_id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            $("#stockist").html(res);
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
    function showStockist(id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/showStockist/'+id,
           data: {id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            $("#showstockistdetails").html(res);
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
</script>
<style>
    .nodispaly
    {
        display:none;
    }
    #matchpassword,#matchtpassword
    {
        color:red;
    }
</style>
<script>
function matchPassword() {  
  var pw1 = document.getElementById("password").value;  
  var pw2 = document.getElementById("confirm_password").value;  
  if(pw1 != pw2)  
  {   
    //alert("Passwords did not match");  
    document.getElementById("matchpassword").innerHTML='Passwords did not match';
    document.getElementById("password").value='';
  } else {  
    //alert("Password created successfully");  
  }  
}  
function matchPasswordTransaction() {  
  var pw1 = document.getElementById("tpasswords").value;  
  var pw2 = document.getElementById("confirm_tpassword").value;  
  if(pw1 != pw2)  
  {   
    //alert("Transaction Passwords did not match");  
    document.getElementById("tpasswords").value='';
    document.getElementById("matchtpassword").innerHTML='Passwords did not match';
  } else {  
    //alert("Password created successfully");  
  }  
}  
</script>