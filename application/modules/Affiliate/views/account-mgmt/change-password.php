<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Account Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Change Password</li>
                    </ul>
                </div>
					<div class="row">
						<div class="card col-md-12">
							<!-- Basic layout-->
							    <?php echo $this->session->flashdata('flash_msg');?>
								<div class="card-body">
									<div class="card-heading">
										<h5 class="card-title"><?php echo $title;?></h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										//echo validation_errors();
										$old_password=(!empty($old_password))?$old_password:'';
										$new_password=(!empty($new_password))?$new_password:'';
										$confirm_password=(!empty($confirm_password))?$confirm_password:'';

										echo form_open(ci_site_url()."Affiliate/Account/".$action_url,array('method'=>'post','class'=>'form-horizontal' , 'enctype'=>'multipart/form-data'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="card-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Old Password:</label>
													<div class="col-lg-9">
														<input value="<?php echo set_value('old_password',$old_password);?>" id="old_password" type="password" name="old_password" class="form-control" placeholder="Old Password">
														<span id="valid_old_password" style="color:red;font-weight:bold;display:none"></span>

														<?php echo form_error('old_password','<span id="valid_old_password" style="color:red;font-weight:bold;">', '</span>');?>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Enter New Password:</label>
													<div class="col-lg-9">
														<input value="<?php echo set_value('new_password',$new_password);?>"  id="new_password" type="password" name="new_password" class="form-control" placeholder="New Password">
														<span id="valid_new_password" style="color:red;font-weight:bold;display:none"></span>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Confirm Password:</label>
													<div class="col-lg-9">
														<input value="<?php echo set_value('confirm_password',$confirm_password);?>" id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
														<span id="valid_confirm_password" style="color:red;font-weight:bold;display:none"></span>
													</div>
												</div>

												<input type="hidden" name="action" value="<?php echo $action;?>">
												<input type="hidden" name="user_id" value="<?php echo ID_encode($user->user_id);?>">
												<div class="text-left">
													<button id="submitBtn" type="submit" name="btn" value="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
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
