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
										<h5 class="card-title">Edit Pacakge</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										//pr($package);
										echo form_open(ci_site_url()."Admin/Package/editPackage/".ID_encode($package->id),array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										
										$knowledge_points=(!empty($package->knowledge_points))?$package->knowledge_points:0;

										$daily_binary_cycle=(!empty($package->daily_binary_cycle))?$package->daily_binary_cycle:0;
										
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<input type="hidden" name="id" value="<?php echo ID_encode($package->id);?>">
											<div class="card-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Title:</label>
													<div class="col-lg-9">
														<input type="text" name="title" value="<?php echo $package->title;?>" class="form-control" placeholder="Title">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Package Cost (<?php echo currency();?>):</label>
													<div class="col-lg-9">
														<input type="text" name="amount" value="<?php echo $package->amount;?>" class="form-control" placeholder="Amount">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Knowledge Points:</label>
													<div class="col-lg-9">
														<input type="text" name="knowledge_points" value="<?php echo $knowledge_points;?>" class="form-control" placeholder="Knowledge Points">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Daily Binary Cycle:</label>
													<div class="col-lg-9">
														<input value="<?php echo $daily_binary_cycle;?>" type="text" name="daily_binary_cycle" class="form-control" placeholder="Daily Binary Cycle">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
														<img width="30%" src="<?php echo ci_site_url();?>images/<?php echo $package->pkg_image; ?>">
													</div>
												</div>
												

												<div class="form-group">
													<label class="col-lg-3 control-label">Package Image:</label>
													<div class="col-lg-9">
														<input name='pkg_image' type="file" class="file-input">
														<input type="hidden" name="old_pkg_img" value="<?php if(!empty($package->pkg_image))echo $package->pkg_image;?>">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Description:</label>
													<div class="col-lg-9">
														<textarea id="description" name="description" class="col-lg-3 control-label"><?php echo $package->description;?></textarea>
													</div>
												</div>
												<div class="text-right">
													<button type="submit" name="btn" value="editPackage" class="btn btn-primary">Update<i class="icon-arrow-right14 position-right"></i></button>
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
    <script>
	CKEDITOR.replace( 'description');
	</script>			