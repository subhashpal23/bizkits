
   
   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
   <div class="content">
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="card card-body">
									<div class="card-heading">
										<h5 class="card-title">Edit Category</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url().$module_name."/Eshop/editCategory",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										<input type='hidden' value="<?php echo $category_data['id']; ?>" name='hidid' />
											<div class="card-body">
											
											
											
												<div class="form-group">
													<label class="col-lg-3 control-label">Category Name:</label>
													<div class="col-lg-9">
						<input type="text" name="category_name" value="<?php echo $category_data['category_name']; ?>" required class="form-control" placeholder="Category Name">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Service Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='active_status'>
														<option value='1' <?php if($category_data['active_status']==1){ echo "selected"; } ?> >Product</option>
														<!--<option value='0' <?php if($category_data['active_status']==0){ echo "selected"; } ?>>Service</option>-->
														</select>
													</div>
										      </div>
												
												<div class="text-right">
     <button type="submit" name="btn" value="updateNewcategory" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
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