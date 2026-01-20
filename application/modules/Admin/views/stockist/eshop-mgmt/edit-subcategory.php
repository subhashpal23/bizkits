<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Category Management</span> - Edit Sub Category</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Category Management</li>
							<li class="active">Edit Sub Category</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
					 <?php 
                  if(!empty($this->session->flashdata('error_msg')))
                  {
                  ?>
               <div class="alert alert-warning alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
                  ?>
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Edit Sub Category</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
											echo form_open(site_url().$module_name."/eshop/editSubCategory",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										<input type='hidden' value="<?php echo $subcategory_data['id']; ?>" name='hidid' />
											<div class="panel-body">
											
											<div class="form-group">
													<label class="col-lg-3 control-label">Choose Category:</label>
													<div class="col-lg-9">
														<select class='form-control' name='parent_id'>
														<?php
														foreach($all_category as $cat)
														{
														?>
									<option value="<?php echo $cat['id']; ?>" <?php if($subcategory_data['parent_id']==$cat['id']){ echo "selected"; } ?>><?php echo $cat['category_name']; ?></option>		
                                                        <?php														
														}
														?>
														</select>
													</div>
										      </div>
											
												<div class="form-group">
													<label class="col-lg-3 control-label">Category Name:</label>
													<div class="col-lg-9">
						<input type="text" name="category_name" value="<?php echo $subcategory_data['subcategory_name']; ?>" required class="form-control" placeholder="Category Name">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Active Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='active_status'>
														<option value='1' <?php if($subcategory_data['active_status']==1){ echo "selected"; } ?> >Active</option>
														<option value='0' <?php if($subcategory_data['active_status']==0){ echo "selected"; } ?>>Inctive</option>
														</select>
													</div>
										      </div>
											  
											 <?php 
											 $display_on_home_option=array(
											 '0'=>'No',
											 '1'=>'Yes'
											 );
											 $display_home_position=(!empty($subcategory_data['display_home_position']))?$subcategory_data['display_home_position']:0;
											 ?>
											 <div class="form-group">
													<label class="col-lg-3 control-label">Is Display On Home Page:</label>
													<div class="col-lg-9">
														<select class='form-control' name='is_display_on_home'>
														<?php 
														
														foreach($display_on_home_option as $option_index=>$option_name)
														{
														  $selected=($subcategory_data['is_display_on_home']==$option_index)?'selected':null;
														?>
														     <option <?php echo $selected;?> value='<?php echo $option_index;?>'><?php echo $option_name;?></option>
														<?php
														}//end foreach
														?>
														</select>
													</div>
										      </div>
											  <div class="form-group">
													<label class="col-lg-3 control-label">Display Home Page Position:</label>
													<div class="col-lg-9">
														<input value="<?php echo $display_home_position;?>" type="text" name="display_home_position" class="form-control" placeholder="Display Home Page Position">
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