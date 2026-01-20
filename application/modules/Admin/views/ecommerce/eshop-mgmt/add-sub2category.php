
   
   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Level2 Sub Cateogry Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>Admin/Eshop/allSub2CategoryList">Level2 Category</a>
                        </li>
                        <li>Add Level2 Category</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
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
								<div class="card card-body">
									<div class="card-heading">
										<h5 class="card-title">Add New Sub Category</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
 echo form_open(site_url().$module_name."/Eshop/addNewSub2Category",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										
											<div class="card-body">
											
											    <div class="form-group">
													<label class="col-lg-3 control-label">Choose Category:</label>
													<div class="col-lg-9">
														<select class='form-control' name='parent_id' onchange="showcategory(this.value);">
														    <option value="">Select Category</option>
														<?php
														foreach($all_category as $cat)
														{
														?>
									                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>		
                                                        <?php														
														}
														?>
														</select>
													</div>
										        </div>
											    <div class="form-group">
													<label class="col-lg-3 control-label">Choose Sub Category:</label>
													<div class="col-lg-9">
														<select class='form-control' name='category_id' id='category_id'>
														
														</select>
													</div>
										        </div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Sub2 Category Name:</label>
													<div class="col-lg-9">
											            <input type="text" name="subcategory_name" required class="form-control" placeholder="Sub Category Name">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Service Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='active_status'>
														<option value='1'>Product</option>
														<option value='0'>Service</option>
														</select>
													</div>
										        </div>
    											  <div class="form-group">
                                                     <label class="col-lg-3 control-label">Image:</label>
                                                     <div class="col-lg-9">
                                                        <input name='product_image' type="file" class="file-input">
                                                     </div>
                                					 
                                                  </div>
												<div class="text-right">
													<button type="submit" name="btn" value="addNewcategory" class="btn btn-primarybtn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add <i class="icon-arrow-right14 position-right"></i></button>
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
	//CKEDITOR.replace( 'description');
	function showcategory(parent_id)
	{
	    var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?php echo base_url();?>Admin/Eshop/showSubCategory/"+parent_id, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText); // Handle response
                document.getElementById('category_id').innerHTML = xhr.responseText;
            }
        };
        xhr.send();

	}
	</script>