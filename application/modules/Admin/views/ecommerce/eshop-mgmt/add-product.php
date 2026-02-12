<div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>Admin Dashboard</h3>
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>">Home</a>
                    </li>
                    
                        <li>
                            <a href="<?php echo base_url();?>Admin/Eshop/allProductList">Products</a>
                        </li>
                        <li>Add Product</li>
                    
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
                  <h5 class="card-title">Add New Product</h5>
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
                  echo form_open(site_url().$module_name."/Eshop/addNewProduct",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
                  									?>
               <div class="card-body">
                  <input type='hidden' value="1" name='service_status' id="service_status" />
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Product Main Category <span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <select id="parent_category_id" name='parent_category_id' class='form-control'>
                           <option value="">-Select Category-</option>
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
                     <label class="col-lg-3 control-label">Product Name <span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text" name="title" class="form-control" placeholder="Product Name">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Image<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input name='product_image' type="file" class="file-input">
                     </div>
					 
                  </div>
				  <div id="more_images">
				   
				  
				  </div>
				  <!--<div class="form-group">
				   <label class="col-lg-3 control-label"></label>
                     <div class="col-lg-9">
						<span><a id="add_more_image" href="#">Add Product Sub Images</a></span>
                     </div>
					 
                  </div>-->
				  
				  
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Old Price:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="old_price" class="form-control" placeholder="Product Old Price">
                     </div>
                  </div>-->
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
                                <input type="text"  name="price1" class="form-control" placeholder="Price">
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">No Of Sessions<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="calls1" class="form-control" placeholder="No Of Sessions">
                             </div>
                          </div>
                           <div class="form-group">
                             <label class="col-lg-3 control-label">Description<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <textarea id="description" name="description" class="col-lg-3 control-label"></textarea>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">Upload file<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                 
                                <input name='userfile1' type="file" class="file-input" required>
                             </div>
        					 
                          </div>
                        <!-- Basic Image -->
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Basic Plan Image:</label>
                          <div class="col-lg-9">
                            <input type="file" name="basic_image" class="file-input">
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
                                    <input type="text"  name="price2" class="form-control" placeholder="Price">
                                 </div>
                              </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">No Of Sessions<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="calls2" class="form-control" placeholder="No Of Sessions">
                             </div>
                          </div>
                              <div class="form-group">
                                 <label class="col-lg-3 control-label">Description:</label>
                                 <div class="col-lg-9">
                                    <textarea id="description1" name="description2" class="col-lg-3 control-label"></textarea>
                                 </div>
                              </div>
                               <div class="form-group">
                                 <label class="col-lg-3 control-label">Upload file<span class="required-field">*</span>:</label>
                                 <div class="col-lg-9">
                                     
                                    <input name='userfile2' type="file" class="file-input" required>
                                 </div>
            					 
                              </div>                                
                          
                          
                            <!-- Economy Image -->
                            <div class="form-group">
                              <label class="col-lg-3 control-label">Pro Plan Image:</label>
                              <div class="col-lg-9">
                                <input type="file" name="economy_image" class="file-input">
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
                             <label class="col-lg-3 control-label">Price<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="price3" class="form-control" placeholder="Price">
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">No Of Session<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                <input type="text"  name="calls3" class="form-control" placeholder="No Of Sessions">
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="col-lg-3 control-label">Description:</label>
                             <div class="col-lg-9">
                                <textarea id="description1" name="long_description" class="col-lg-3 control-label"></textarea>
                             </div>
                          </div>
                           <div class="form-group">
                             <label class="col-lg-3 control-label">Upload file<span class="required-field">*</span>:</label>
                             <div class="col-lg-9">
                                 
                                <input name='userfile3' type="file" class="file-input" required>
                             </div>
        					 
                          </div>                          
                          
                               
                           <!-- Enterprise Image -->
                            <div class="form-group">
                              <label class="col-lg-3 control-label">Enterprise Plan Image:</label>
                              <div class="col-lg-9">
                                <input type="file" name="enterprise_image" class="file-input">
                              </div>
                            </div>
                          
                      </div>
                    </div>
                </div>                

				  


                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Discount Type:</label>-->
                  <!--   <div class="col-lg-9">-->
                  <!--      <select  name="discount)type" class="form-control">-->
                  <!--          <option value="per">Percentage</option>-->
                  <!--          <option value="flat">Flat</option>-->
                  <!--      </select>-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Discount:</label>-->
                  <!--   <div class="col-lg-9">-->
                  <!--      <input type="text"  name="discount" class="form-control" placeholder="Discount">-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Stock Quantity<span class="required-field">*</span>:</label>-->
                  <!--   <div class="col-lg-9">-->
                  <!--      <input type="text"  name="qty" class="form-control" placeholder="Product Quantity">-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--   <label class="col-lg-3 control-label">Tax %:</label>-->
                  <!--   <div class="col-lg-9">-->
                        <!--<input type="hidden" value="INCLUDED" name="tax" class="form-control" placeholder="Tax">-->
                  <!--      <input type="text" name="tax" class="form-control" value="0" placeholder="Tax %">-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">SKU<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="hidden"  name="qty" class="form-control" value='1000' placeholder="Product Quantity">
                        <input type="text"  name="sku" class="form-control"  placeholder="Product SKU">
                     </div>
                  </div>-->
                 
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Active Status:</label>
                     <div class="col-lg-9">
                        <select class='form-control' name='status'>
                           <option value='1'>Active</option>
                           <option value='0'>Inctive</option>
                        </select>
                     </div>
                  </div>
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Featured:</label>
                     <div class="col-lg-9">
                        <select class='form-control' name='featured'>
                           <option value='0'>No</option>
                           <option value='1' selected>Yes</option>
                        </select>
                     </div>
                  </div>-->
                  
				  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Direct Commission:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="direct_commission" class="form-control" placeholder="Direct Commission">
                     </div>
                  </div>-->
				  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Product Volume:</label>
                     <div class="col-lg-9">
                        <input type="text" name="guest_point" class="form-control" placeholder="Product Volume">
                     </div>
                  </div>-->
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Tax:</label>
                     <div class="col-lg-9">
                        <input type="hidden" value="INCLUDED"  name="tax" class="form-control" placeholder="Tax">
                        <input type="text" name="taxper" class="form-control" value="0" placeholder="Tax">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Shipment Charge:</label>
                     <div class="col-lg-9">
                        <input type="text" name="shipment_charge" class="form-control" placeholder="Shipment Charge">
                     </div>
                  </div>-->
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Discount:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="discount" class="form-control" placeholder="Discount">
                     </div>
                  </div>
                  
				  <div id="limited_level_div">
                     <div class="form-group">
                        <label class="col-lg-3 control-label">Level1:</label>
                        <div class="col-lg-9">
                           <input required type="text" name="level_commission[]" class="form-control" placeholder="Level 1 Commission">
                        </div>
                     </div>
                  </div>
				  <div class="form-group" id="add_more_group">
                     <label class="col-lg-3 control-label"></label>
                     <div class="col-lg-9"><a href="#" id="add_more_level">Add More Level Commission</a></div>
                  </div>
				  -->
                  <div class="text-right">
                     <button type="submit" name="btn" value="addNewProduct" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add <i class="icon-arrow-right14 position-right"></i></button>
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


  