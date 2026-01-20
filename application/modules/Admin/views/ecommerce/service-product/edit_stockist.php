<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Stockist Management</span> - Edit Stockist</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Stockist Management</li>
							<li class="active">Edit Stockist</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Edit Stockist</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url().$module_name."/stockist/editStockist",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										<input type='hidden' value="<?php echo $category_data['id']; ?>" name='hidid' />
											<div class="panel-body">
											
											<div class="form-group">
													<label class="col-lg-3 control-label">Name:</label>
													<div class="col-lg-9">
											<input type="text" name="name" required class="form-control" value="<?php echo $category_data['name']; ?>" placeholder="Name">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Email:</label>
													<div class="col-lg-9">
											<input type="text" name="email" required class="form-control" value="<?php echo $category_data['email']; ?>" placeholder="Email">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Mobile:</label>
													<div class="col-lg-9">
											<input type="text" name="mobile" required class="form-control" value="<?php echo $category_data['mobile']; ?>" placeholder="Mobile">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Address:</label>
													<div class="col-lg-9">
											<textarea name="address" required class="form-control"><?php echo $category_data['address']; ?></textarea>
													</div>
												</div>
											
												<div class="form-group">
													<label class="col-lg-3 control-label">Password:</label>
													<div class="col-lg-9">
						<input type="password" name="password" value="<?php echo $category_data['password']; ?>" required class="form-control">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Active Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='status'>
														<option value='1' <?php if($category_data['status']==1){ echo "selected"; } ?> >Active</option>
														<option value='0' <?php if($category_data['status']==0){ echo "selected"; } ?>>Inctive</option>
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
	                  $this->load->view("common/footer-text");
	                  ?>
                     <!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
	<script>
	CKEDITOR.replace( 'description');
	</script>