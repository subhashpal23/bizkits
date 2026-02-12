    <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Product Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>Admin/Eshop/allProductList">Products</a>
                        </li>
                        <li>Edit Product</li>
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
                  <input type='hidden' value="1" name='service_status' id="service_status" />
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Product Main Category<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <select id="parent_category_id" name='parent_category_id' class='form-control'>
                            <option value="">-Select Category-</option>
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
				  
				  
			
                  
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Product Name<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text" value="<?php echo $product_data['title']; ?>" name="title" class="form-control" placeholder="Product Name">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Image<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <img width='150' src="<?php echo base_url(); ?>product_images/<?php echo $product_data['product_image']; ?>" /><br><br>
                        <input name='product_image' type="file" class="file-input">
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
					 <!---------------->
                     <div class="col-md-3">
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
					  <input id="old_img_<?php echo $total_product;?>" type="hidden" name="old_sub_images[]" value="<?php echo $img;?>">
					 <!------------------>
                  
				<?php 
								if($total_product==count($sub_images))
								 break;
							 }
							 echo '</div>';
						    
						 }
					 
					 }
				  ?>
				  

                  <div id="more_images">
				  </div>
                

                
                <!-- BASIC PLAN -->
                <div class="accordion-item" style="background-color: #329aa3;">
                    <h2 class="accordion-header" id="headingBasic">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBasic" aria-expanded="true" aria-controls="collapseBasic">
                        Basic Plan
                        </button>
                    </h2>
                    <div id="collapseBasic" class="accordion-collapse collapse show" aria-labelledby="headingBasic" data-bs-parent="#priceAccordion">
                    <div class="accordion-body">
                    
                        <div class="form-group">
                            <label class="col-lg-3 control-label">(Basic) Price<span class="required-field">*</span>:</label>
                            <div class="col-lg-9">
                                <input type="text"  name="price1"  value="<?php echo $product_data['price1']; ?>" class="form-control" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group">
                             <label class="col-lg-3 control-label">No Of Sessions<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="calls1" value="<?php echo $product_data['calls1']; ?>" class="form-control" placeholder="No Of Sessions">
                             </div>
                          </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Description<span class="required-field">*</span>:</label>
                            <div class="col-lg-9">
                                <textarea id="description" name="description" class="col-lg-3 control-label"><?php echo $product_data['description']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Upload file<span class="required-field">*</span>:</label>
                            <div class="col-lg-9">
                                <?php $zip1_url = site_url().'uploads/'.$product_data['zip1']; 
                                if($product_data['zip1']){
                                ?>
                                
                                <a href="<?= $zip1_url ?>" download>Download </a><br>
                                <?php } ?>
                                <input type="hidden"  name="zip1"  value="<?php echo $product_data['zip1']; ?>" class="form-control" placeholder=""> 
                                <input name='userfile1' type="file" class="file-input">
                            </div>
                        
                        </div>
                        <!-- Basic Image -->
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Basic Plan Image:</label>
                          <div class="col-lg-9">
                            <?php if($product_data['basic_image']) { ?>
                              <img src="<?= base_url('product_images/'.$product_data['basic_image']); ?>" width="120"><br><br>
                            <?php } ?>
                            <input type="file" name="basic_image" class="file-input">
                            <input type="hidden" name="hidden_basic_image" value="<?= $product_data['basic_image']; ?>">
                          </div>
                        </div>

                    
                    </div>
                    </div>
                </div>
                <div class="accordion-item" style="background-color: #f69024;">
                    <h2 class="accordion-header" id="headingEconomy">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEconomy" aria-expanded="false" aria-controls="collapseEconomy">
                        Pro Plan
                      </button>
                    </h2>
                    <div id="collapseEconomy" class="accordion-collapse collapse" aria-labelledby="headingEconomy" data-bs-parent="#priceAccordion">
                        <div class="accordion-body">
                          <div class="form-group">
                             <label class="col-lg-3 control-label">(Pro) Price<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="price2"  value="<?php echo $product_data['price2']; ?>"  class="form-control" placeholder="Price">
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">No Of Sessions<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="calls2" value="<?php echo $product_data['calls2']; ?>" class="form-control" placeholder="No Of Sessions">
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">Description:</label>
                             <div class="col-lg-9">
                                <textarea id="description1" name="long_description" class="col-lg-3 control-label"><?php echo $product_data['long_description']; ?></textarea>
                             </div>
                          </div>       
                          
                          <div class="form-group">
                             <label class="col-lg-3 control-label">Upload file<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                 <?php $zip3_url = site_url().'uploads/'.$product_data['zip2']; 
                                 if($product_data['zip2']){
                                 ?>
                                 
                                 <a href="<?= $zip2_url ?>" download>Download </a><br>
                                 <?php } ?>
                                 <input type="hidden"  name="zip2"  value="<?php echo $product_data['zip2']; ?>" class="form-control" placeholder=""> 
                                <input name='userfile2' type="file" class="file-input">
                             </div>
                          </div> 
                            <!-- Economy Image -->
                            <div class="form-group">
                              <label class="col-lg-3 control-label">Pro Plan Image:</label>
                              <div class="col-lg-9">
                                <?php if($product_data['economy_image']) { ?>
                                  <img src="<?= base_url('product_images/'.$product_data['economy_image']); ?>" width="120"><br><br>
                                <?php } ?>
                                <input type="file" name="economy_image" class="file-input">
                                <input type="hidden" name="hidden_economy_image" value="<?= $product_data['economy_image']; ?>">
                              </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="background-color: #0f4671;">
                    <h2 class="accordion-header" id="headingEnterprise">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEnterprise" aria-expanded="false" aria-controls="collapseEnterprise">
                        Enterprise Plan
                      </button>
                    </h2>
                    <div id="collapseEnterprise" class="accordion-collapse collapse" aria-labelledby="headingEnterprise" data-bs-parent="#priceAccordion">
                      <div class="accordion-body">
                          <div class="form-group">
                             <label class="col-lg-3 control-label">(Enterprices) Price<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="price3"  value="<?php echo $product_data['price3']; ?>"  class="form-control" placeholder="Price">
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">No Of Sessions<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="calls3" value="<?php echo $product_data['calls3']; ?>" class="form-control" placeholder="No Of Sessions">
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">Description:</label>
                             <div class="col-lg-9">
                                <textarea id="description1" name="description2" class="col-lg-3 control-label"><?php echo $product_data['description2']; ?></textarea>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">Upload file<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                 <?php $zip2_url = site_url().'uploads/'.$product_data['zip3']; 
                                 if($product_data['zip3']){
                                 ?>
                                 
                                 <a href="<?= $zip3_url ?>" download>Download </a><br>
                                 <?php } ?>
                                 <input type="hidden"  name="zip3"  value="<?php echo $product_data['zip3']; ?>" class="form-control" placeholder=""> 
                                <input name='userfile3' type="file" class="file-input">
                             </div>
                          </div>      
                           <!-- Enterprise Image -->
                            <div class="form-group">
                              <label class="col-lg-3 control-label">Enterprise Plan Image:</label>
                              <div class="col-lg-9">
                                <?php if($product_data['enterprise_image']) { ?>
                                  <img src="<?= base_url('product_images/'.$product_data['enterprise_image']); ?>" width="120"><br><br>
                                <?php } ?>
                                <input type="file" name="enterprise_image" class="file-input">
                                <input type="hidden" name="hidden_enterprise_image" value="<?= $product_data['enterprise_image']; ?>">
                              </div>
                            </div>
                          
                      </div>
                    </div>
                </div>
                      <!-- ECONOMY PLAN -->
                
                    
              
                  
                  
                  
                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Discount Type:</label>-->
                  <!--   <div class="col-lg-9">-->
                  <!--      <select  name="discount)type" class="form-control">-->
                  <!--          <option value="per" <?php if($product_data['discount']=='per'){ echo "selected";} ?>>Percentage</option>-->
                  <!--          <option value="flat" <?php if($product_data['discount']=='flash'){ echo "selected";} ?>>Flat</option>-->
                  <!--      </select>-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Discount:</label>-->
                  <!--   <div class="col-lg-9">-->
                  <!--      <input type="text"  name="discount" class="form-control" value="<?php echo $product_data['discount']; ?>" placeholder="Discount">-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Stock Quantity<span class="required-field">*</span>:</label>-->
                  <!--   <div class="col-lg-9">-->
                  <!--      <input type="text"  name="qty" value="<?php echo $product_data['qty']; ?>"  class="form-control" placeholder="Product Quantity">-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">SKU<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="sku" class="form-control" value="<?php echo $product_data['sku']; ?>" placeholder="Product SKU">
                     </div>
                  </div>-->
                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Tax %:</label>-->
                  <!--   <div class="col-lg-9">-->
                  <!--      <input type="text" name="tax" class="form-control" value="<?php echo $product_data['tax']; ?>" placeholder="Tax %">-->
                  <!--   </div>-->
                  <!--</div>-->
                
                  

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
                  </div>-->
                  
                  <!--<div class="form-group">
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
				  $all_level_commission=get_product_level_commission($product_data['id']);
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
                  <div class="text-right">
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
      <?php
         //$this->load->view("common/footer-text");
         ?>
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
.accordion-item {
    border: 1px solid #000;
    padding: 20px;
    margin: 20px;
    border-radius: 12px;
}
.accordion-item h2 {
    text-align: center;
    
    
    border-bottom: none;
}
.accordion-collapse{
    
    padding: 20px;
    background-color: #e7e7e7;
    border-radius: 12px;
    margin-top: 15px;
}
button.accordion-button {
    border-radius: 25px;
    padding: 9px 20px;
    cursor: pointer;
}
</style>
<script>
   //CKEDITOR.replace( 'description');
   //CKEDITOR.replace( 'description1');

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
