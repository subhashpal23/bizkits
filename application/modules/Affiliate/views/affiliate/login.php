<!-- breadcrumb-banner-area -->
		<div class="breadcrumb-banner-area bg-img-2 bg-opacity-2 ptb-100">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumb-text">
							<div class="breadcrumb-menu">
								<ul>
									<li><a href="<?php echo base_url();?>">home</a></li>
									<li><span>login</span></li>
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
					<div class="col-md-12">
						<div class="single-signup">
							<form id="login-form" action="<?php echo base_url();?>login" method="post">
								<h1>Site Login</h1>
								<samp><?php echo $this->session->flashdata('res');?></samp>
								<label>Username</label>
								<input type="text" name="username" required placeholder="Username" />
								<label>Password</label>
								<input type="password" name="password" required placeholder="Password" />
								<!--<a class="lost" href="#">Lost your password?</a>-->
								<button type="submit" value="login" name="login" class="login">login</button>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- signup-area-end -->