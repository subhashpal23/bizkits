<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/app.js"></script>
	<!-- /theme JS files -->
</head>
<body>
	<!-- Main navbar -->
	<!-- /main navbar -->
	<!-- Page container -->
	<div class="page-container login-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					<form action="<?php echo ci_site_url();?>user/auth/login" method="post">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
								<?php 
			                        echo $this->session->flashdata('res');
			                    ?>
							</div>
							<div class="form-group has-feedback has-feedback-left">
								  <input type="text" name="username" class="form-control" placeholder="Username" required="" />
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<!--<a href="<?php echo ci_site_url();?>user/auth/forgotPassword/">Forgot password?</a>-->
								<a href="#">Forgot password?</a>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted">
						&copy; <?php echo date("Y") ?>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
