		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- user-login-area-start -->
		<div class="user-login-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="login-title text-center mb-30">
							<h2>Login</h2>
							<p>Login Here</p>
						</div>
					</div>
					<div class="offset-lg-3 col-lg-6 col-md-12 col-12">
						<div class="login-form">
						    <?php echo $this->session->flashdata('res');?>
						    <form action="<?php echo base_url();?>Web/login" method="POST">
							<div class="single-login">
								<label>Username<span>*</span></label>
								<input type="text" required="" name="username" id="username" />
							</div>
							<div class="single-login">
								<label>Passwords <span>*</span></label>
								<input required="" type="password" name="password" placeholder="Your password *">
							</div>
							<div class="single-login single-login-2">
								<!--<a href="#">login</a>-->
								
								<button type="submit" class="btn btn-primary btn-block hover-up" name="login" value="btn">Log in</button>
							<!--	<input id="rememberme" type="checkbox" name="rememberme" value="forever">
								<span>Remember me</span>-->
							</div>
							<a href="#">Lost your password?</a> Don't have an account? <a href="<?php echo base_url();?>join-us">Create Account</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user-login-area-end -->