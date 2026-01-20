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

<title>Dreambuilders | Login</title>

    

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
						<figure><img src="images/register.png" alt="" class="img-fluid"></figure>
						<h2>Login Here</h2>
						<p>Kindly input your login details correctly</p>
						<a href="<?php echo base_url();?>" class="btn_1 rounded" target="_parent">Back to Homepage</a>
				
					</div>
					<div class="copy">© 2024 i3 Empire LTD</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
					<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<!-- /top-wizard -->
						<form id="wrapped123" method="POST" action="<?php echo base_url();?>Web/login">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="login-logo">
                                    <center>
                                    <img src="<?php echo base_url();?>frontassets/login/images/logo-2.png"></a> <br><br><br>
                                    </center>
                               
                                                           
               
								<div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username"  class="form-control required" placeholder="Username" onchange="getVals(this, 'Username');">
									</div>
							        </div>


					        
     
								<div class="form-group">
                                <label for="">Password</label>
                                <input class="form-control required" type="password" id="password1" name="password" placeholder="Password" onchange="getVals(this, 'password');">
									</div>

                            
                                <label><a href="#">Forgot Password? </a></label>   <label><a href="<?php echo base_url();?>Web/register">Register Here </a></label> 
						
                                 <div id="bottom-wizard">
								<button type="submit" class="submit" name="login" value="login">Login</button>
							    </div>

                            			
						</div>


						</div>
								</div>
								<!-- /step-->
							</div>
							<!-- /middle-wizard -->
							
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
	
	
				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
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