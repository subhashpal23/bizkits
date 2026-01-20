<div class="body-wrapper">
            <div class="bodywrapper__inner">

                <div class="row align-items-center mb-30 justify-content-between">
    <div class="col-lg-6 col-sm-6">
        <h6 class="page-title">Category</h6>
    </div>
    <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3 right-part">
            
    </div>
</div>
<div class="row mb-none-30">
        <div class="col-xl-12 col-lg-12 col-sm-12 mb-30">
				<?php echo $this->session->flashdata('flash_msg');?>
							<!-- Basic layout-->
								<div class="card card-flat">
									<div class="card-heading">
										<h5 class="card-title">Add New Category</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
 echo form_open(site_url().$module_name."/eshop/addNewCategory",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										
											<div class="card-body">
											
											
												<div class="form-group">
													<label class="col-lg-3 control-label">Category Name:</label>
													<div class="col-lg-9">
											<input type="text" name="category_name" required class="form-control" placeholder="Category Name">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Active Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='active_status'>
														<option value='1'>Active</option>
														<option value='0'>Inctive</option>
														</select>
													</div>
										      </div>
												
												<div class="text-right">
     <button type="submit" name="btn" value="addNewcategory" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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
	                  
                     <!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
