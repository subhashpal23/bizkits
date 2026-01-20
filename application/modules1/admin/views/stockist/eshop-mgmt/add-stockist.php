<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Stockist Management</span> - Add New Stockist</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Stockist Management</li>
							<li class="active">Add New Stockist</li>
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
										<h5 class="panel-title">Add New Stockist</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
 echo form_open(site_url().$module_name."/stockist/addNewStockist",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										
											<div class="panel-body">
											<div class="form-group">
													<label class="col-lg-3 control-label">GSTIN:</label>
													<div class="col-lg-9">
											<input type="text" name="gstin" required class="form-control" placeholder="GSTIN">
													</div>
												</div>
											<div class="form-group">
													<label class="col-lg-3 control-label">Name:</label>
													<div class="col-lg-9">
											<input type="text" name="name" required class="form-control" placeholder="Name">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Email:</label>
													<div class="col-lg-9">
											<input type="text" name="email" required class="form-control" placeholder="Email">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Mobile:</label>
													<div class="col-lg-9">
											<input type="text" name="mobile" required class="form-control" placeholder="Mobile">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Address:</label>
													<div class="col-lg-9">
											<textarea name="address" required class="form-control"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Active Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='status'>
														<option value='1'>Active</option>
														<option value='0'>Inctive</option>
														</select>
													</div>
										      </div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Username:</label>
													<div class="col-lg-9">
											<input type="text" name="username" required class="form-control" placeholder="Username">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Password:</label>
													<div class="col-lg-9">
											<input type="password" name="password" required class="form-control" placeholder="Password">
													</div>
												</div>
												
												<div class="text-right">
     <button type="submit" name="btn" value="addNewstockist" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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