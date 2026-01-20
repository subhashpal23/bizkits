<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Video Tutorials Management</span> - Edit Video</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Video Tutorials Management</li>
							<li class="active">Edit Video</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					 <?php 
					   if(!empty($this->session->flashdata('flash_msg')))
					   {
					   ?>
						<div class="col-md-12">
						   <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
							  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
							  <?php echo $this->session->flashdata('flash_msg');?>
						   </div>
						</div>
					  <?php   
					   }
					   ?>
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Edit Video</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(ci_site_url()."admin/admin_video_tutorials/editVideo/".ID_encode($id),array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Title:</label>
													<div class="col-lg-9">
														<input required="" value="<?php echo $video->title;?>" type="text" name="title" class="form-control" placeholder="Title">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Select Video Categroy:</label>
													<div class="col-lg-9">
													<select required="" name="video_categories_id" class="select">
													<option value="">Select Video Categroy</option>
													
													<?php 
													if(!empty($all_video_category) && count($all_video_category)>0)
													{
														foreach($all_video_category as $category)
														{
															if($category->id==$video->video_categories_id)
															{
													?>
													<option selected value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
													<?php 
															}
															else 
															{
													?>
													<option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
													<?php 	
															}
														}
													}
													?>
                           
												</select>
												</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Video Path:</label>
													<div class="col-lg-9">
														<input required="" value="<?php echo $video->video_path;?>" type="text" name="video_path" class="form-control" placeholder="Enter Video Path">
													</div>
												</div>
												<?php 
												$all_status=array('Unapproved','Approved');
												?>
												<div class="form-group">
													<label class="col-lg-3 control-label">Select Approve Status:</label>
													<div class="col-lg-9">
													<select required="" name="approve_status" class="select">
													<option value="">Select Approve Status</option>
													
													<?php 
													foreach($all_status as $key=>$val)
													{
														if($key==$video->assign_status)
														{
													?>
													<option selected value="<?php echo $key;?>"><?php echo $val;?></option>
													<?php 
														}
														else 
														{
													?>
													<option value="<?php echo $key;?>"><?php echo $val;?></option>
													<?php 
														}
													}
													?>
													
													
													
                           
												</select>
												</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Description:</label>
													<div class="col-lg-9">
														<textarea id="video_desc" name="video_desc" class="col-lg-3 control-label"><?php echo $video->video_desc;?></textarea>
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
	                  $this->load->view("common/footer-text");
	                  ?>
                     <!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
	<script>
	CKEDITOR.replace('video_desc');
	</script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/form_select2.js"></script>