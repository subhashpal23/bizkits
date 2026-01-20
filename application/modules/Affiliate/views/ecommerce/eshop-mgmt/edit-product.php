  
<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Eshop</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Eshop</li>
                    </ul>
                </div>
      <div class="row">
         <div class="col-md-12">
            <!-- Basic layout-->
            <div class="card card-flat">
               <div class="card-heading">
                  <h5 class="card-title">Edit Product</h5>
                  <div class="heading-elements">
                     <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                     </ul>
                  </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
               </div>
               <?php 
                  echo form_open(site_url().$module_name."/Eshop/editProduct",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
                  									?>
               <div class="card-body">
                  <input type='hidden' value="<?php echo $product_data['id']; ?>" name='hidid' />					
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Product Main Category<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <select id="parent_category_id" name='parent_category_id' class='form-control'>
                           <?php
						   if(!empty($all_category) && count($all_category)>0)
						   {
                              foreach($all_category as $cat)
                              {
								  if($cat['id']==$product_data['parent_category_id'])
								  {
							?>
							 <option selected value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>
							<?php 
								  }
								  else 
								  {
							 ?>
							  <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>
							 <?php 
								  }
                              }
						   }  
                           ?>
                        </select>
                     </div>
                  </div>
				  
				  
				  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Select Product Sub Category<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <select name='category_id' id="sub_category_id" class='form-control'>
                          <option value="">-Select Sub Category-</option>
						  <?php 
						  if(!empty($sub_category) && count($sub_category)>0)
						  {
							  foreach($sub_category as $sub_cat)
							  {
								if($product_data['category_id']==$sub_cat->id)
								{
						 ?>
						         <option selected value="<?php echo $sub_cat->id;?>"><?php echo $sub_cat->subcategory_name;?></option>
						 <?php 
								}
								else 
								{
						?>
								<option value="<?php echo $sub_cat->id;?>"><?php echo $sub_cat->subcategory_name;?></option>
						<?php 
								}
									
							  }
						  }
						  ?>
						</select>
                     </div>
                  </div>-->
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Title<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text" value="<?php echo $product_data['title']; ?>" name="title" class="form-control" placeholder="Title">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Product Main Image<span class="required-field">*</span>:</label>
                     <div class="col-lg-9 file-upload-wrapper"  data-text="Select your file!">
                        <img width='150' src="<?php echo base_url(); ?>product_images/<?php echo $product_data['product_image']; ?>" /><br><br>
                        <input name='product_image' type="file" class="file-upload-field">
                        <input name='hidden_image' value="<?php echo $product_data['product_image']; ?>" type="hidden">
                     </div>
                  </div>
				  <?php 
				     //pr($sub_images);
					 if(!empty($sub_images) && count($sub_images)>0)
					 {
						 $total_row=ceil(count($sub_images)/3);
						 $total_product=0;
						
						 for($i=1;$i<=$total_row;$i++)
						 {
						  echo '<div class="form-group">';
						  echo '<label class="col-lg-3 control-label"></label>';
							 for($j=1;$j<=3;$j++)
							 {
								 $total_product++;
								 list($k,$v)=each($sub_images);
								 $img=$v['sub_img']; 
				   ?>
					 
                     <!--<div class="col-md-3">
					  <div class="card card-flat">
								<div class="card-heading">
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a img_name="old_img_<?php echo $total_product;?>" class="remove_old_image"  data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>
								<div class="card-body">
									<div class="thumbnail">
										<a href="assets/images/placeholder.jpg" data-popup="lightbox">
											<img src="<?php echo base_url();?>product_images/<?php echo $img;?>" alt="">
										</a>
									</div>
								</div>
							</div>
					  </div>	
					  <input id="old_img_<?php echo $total_product;?>" type="hidden" name="old_sub_images[]" value="<?php echo $img;?>">-->
					
                  
				<?php 
								if($total_product==count($sub_images))
								 break;
							 }
							 echo '</div>';
						    
						 }
					 
					 }
				  ?>
				  

                  <!--<div id="more_images">
				  </div>
                  <div class="form-group">
                            <label for="inputAttachments">Sub Images</label>
                            <div class="file-upload-wrapper" data-text="Select your file!">
                                <input type="file" name="sub_img[]" id="inputAttachments"
                                class="file-upload-field"/>
                            </div>
                            <div id="fileUploadsContainer"></div>
                        </div>
                        <div class=" ticket-attachments-message text-muted mt-3">
                            Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx                        </div>

                        <button type="button" class="btn btn--dark add-more mt-2" ><i class="fa fa-plus"></i></button>-->
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Old Price:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="old_price" value="<?php echo $product_data['old_price']; ?>" class="form-control" placeholder="Product Old Price">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">New Price<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="new_price" value="<?php echo $product_data['new_price']; ?>" class="form-control" placeholder="Product New Price">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">SKU<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="sku" class="form-control" value="<?php echo $product_data['sku']; ?>" placeholder="Product SKU">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Short Description<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <textarea id="editor1" name="description" class="col-lg-3 control-label"><?php echo $product_data['description']; ?></textarea>
                     </div>
                  </div>
                  
                   <div class="form-group">
                     <label class="col-lg-3 control-label">Long Description:</label>
                     <div class="col-lg-9">
                        <textarea id="editor2" name="long_description" class="col-lg-3 control-label"><?php echo $product_data['long_description']; ?></textarea>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-lg-3 control-label">Active Status:</label>
                     <div class="col-lg-9">
                        <select class='form-control' name='status'>
                           <option <?php if($product_data['status']==1){ echo "selected"; } ?> value='1'>Active</option>
                           <option <?php if($product_data['status']==0){ echo "selected"; } ?> value='0'>Inctive</option>
                        </select>
                     </div>
                  </div>
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Featured:</label>
                     <div class="col-lg-9">
                        <select class='form-control' name='featured'>
                           <option <?php if($product_data['featured']==1){ echo "selected"; } ?> value='1'>Yes</option>
                           <option <?php if($product_data['featured']==0){ echo "selected"; } ?> value='0'>No</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Tax:</label>
                     <div class="col-lg-9">
                         <input type="hidden"  name="tax" value="<?php echo $product_data['tax'];?>" class="form-control" placeholder="Tax">
                        <input type="text"  name="taxper" value="<?php echo $product_data['taxper'];?>" class="form-control" placeholder="Tax">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Shipment Charge:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="shipment_charge" value="<?php echo $product_data['shipment_charge'];?>" class="form-control" placeholder="Shipment Charge">
                     </div>
                  </div>-->
				  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Direct Commission:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="direct_commission" value="<?php echo $product_data['direct_commission'];?>" class="form-control" placeholder="Direct Commission">
                     </div>
                  </div>-->
				  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Product Volume:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="guest_point" value="<?php echo $product_data['guest_point'];?>" class="form-control" placeholder="Product Volume">
                     </div>
                  </div>-->
				  <!-- <div id="limited_level_div">
				  <?php 
				  //$all_level_commission=get_product_level_commission($product_data['id']);
				  $level=0;
				  
				  //echo count($all_level_commission);
				  foreach($all_level_commission as $commission)
				  {
				  $level++;	
				  if($level==1)
				  {
				  ?>
				  <div class="form-group">
                        <label class="col-lg-3 control-label">Level<?php echo $level;?>:</label>
                        <div class="col-lg-9">
                           <input required type="text" name="level_commission[]" value="<?php echo $commission->commission;?>" class="form-control" placeholder="Level <?php echo $level;?> Commission">
                        </div>
                     </div>
                  <?php 				  
				  }
				  else 
				   {
				  ?>
				    <div class="form-group level_group" id="level_<?php echo $level; ?>">
                        <label class="col-lg-3 control-label level_label">Level<?php echo $level;?>:</label>
                        <div class="col-lg-9">
                           <input required type="text" name="level_commission[]" value="<?php echo $commission->commission;?>" class="form-control level_input" placeholder="Level <?php echo $level;?> Commission">
						   
						   <a href="#" class="remove_level_click" onclick="return remove_level('<?php echo $level;?>')">Remove</a>
                        </div>
                    </div>
				  <?php 
					}//end if-else 
				  }//end foreach
				  ?>
				  </div>
				  
				  <div class="form-group" id="add_more_group">
                     <label class="col-lg-3 control-label"></label>
                     <div class="col-lg-9"><a href="#" id="add_more_level">Add More Level Commission</a></div>
                  </div>
                  -->
                  <div class="text-left">
                     <button type="submit" name="btn" value="updateproduct" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update<i class="icon-arrow-right14 position-right"></i></button>
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
<style>
.required-field
{
	color:red;font-weight:bold;font-size:16px
}
.thumbnail {
    /* -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05); */
    /* box-shadow: 0 1px 1px rgba(0,0,0,.05); */
    border: none;
}
</style>