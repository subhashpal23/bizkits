<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Admin">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
   <div class="content">
				<?php echo $this->session->flashdata('flash_msg');?>
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="card card-body">
									<div class="card-heading">
										<h5 class="card-title"><?php echo $username;?></h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										//pr($all_packages);
										echo form_open(ci_site_url()."Admin/Member/resetTPassword",array('method'=>'post','class'=>'form-horizontal'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="card-body">
											    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Password:</label>
													<div class="col-lg-9">
														 <input type="password" name="password" required id="password" title="Password" class="form-control" placeholder="Enter Password">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Confrim Password:</label>
													<div class="col-lg-9">
														 <input type="password" name="c_pass" required id="c_pass" title="Password" class="form-control" placeholder="Enter Password">
														 <span id="valid_cpass" style="color:red;font-weight:bold"></span>
													</div>
												</div>
												
												<div class="text-right">
													<button type="submit" name="btn" id="passwordbtn" value="reset_password" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add <i class="icon-arrow-right14 position-right"></i></button>
												</div>
											</div>
										<!--</form>-->
										<?php echo form_close();?>
								</div>
								<!-- /basic layout -->
						</div>
					</div>
					<!-- /vertical form options -->
					<!-- Footer -->
	                  <?php
	                  //$this->load->view("common/footer-text");
	                  ?>
                     <!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
		