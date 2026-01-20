<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Category Management</span> - Edit Category</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Category Management</li>
							<li class="active">Edit Category</li>
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
										<h5 class="panel-title">Edit Category</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url().$module_name."/eshop/editCategory",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										<input type='hidden' value="<?php echo $category_data['id']; ?>" name='hidid' />
											<div class="panel-body">
											
											
											
												<div class="form-group">
													<label class="col-lg-3 control-label">Category Name:</label>
													<div class="col-lg-9">
						<input type="text" name="category_name" value="<?php echo $category_data['category_name']; ?>" required class="form-control" placeholder="Category Name">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Active Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='active_status'>
														<option value='1' <?php if($category_data['active_status']==1){ echo "selected"; } ?> >Active</option>
														<option value='0' <?php if($category_data['active_status']==0){ echo "selected"; } ?>>Inctive</option>
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