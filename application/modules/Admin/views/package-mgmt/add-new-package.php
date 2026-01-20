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
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="card card- body">
									<div class="card-heading">
										<h5 class="card-title">Add New Package</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(ci_site_url()."Admin/Package/addNewPackage",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
											<div class="card-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Title:</label>
													<div class="col-lg-9">
														<input type="text" name="title" class="form-control" placeholder="Title">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Package Cost<?php echo " (".currency().")";?>:</label>
													<div class="col-lg-9">
														<input type="text" name="amount" class="form-control" placeholder="Package Amount">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Knowledge Points:</label>
													<div class="col-lg-9">
														<input type="text" name="knowledge_points" class="form-control" placeholder="Knowledge Points">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Daily Binary Cycle:</label>
													<div class="col-lg-9">
														<input type="text" name="daily_binary_cycle" class="form-control" placeholder="Daily Binary Cycle">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Package Image:</label>
													<div class="col-lg-9">
														<input name='pkg_image' type="file" class="file-input">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Description:</label>
													<div class="col-lg-9">
														<textarea id="description" name="description" class="col-lg-3 control-label"></textarea>
													</div>
												</div>
												<div class="text-right">
													<button type="submit" name="btn" value="addNewPackage" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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