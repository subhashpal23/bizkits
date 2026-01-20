  
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
				  
				  
				  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Select Product Sub Category <span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <select name='category_id' id="sub_category_id" class='form-control'>
                          <option value="">-Select Sub Category-</option>
						</select>
                     </div>
                  </div>-->
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Title <span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Product Main Image<span class="required-field">*</span>:</label>
                     <div class="col-lg-9 file-upload-wrapper">
                        <input name='product_image' type="file" class="file-upload-field" data-text="Select your file!">
                     </div>
					 
                  </div>
				  <div id="more_images">
				   
				  
				  </div>
				  <!--<div class="form-group">
                            <label for="inputAttachments">Sub Images</label>
                            <div class="file-upload-wrapper" data-text="Select your file!">
                                <input type="file" name="sub_img[]" id="inputAttachments"
                                class="file-upload-field"/>
                            </div>
                            <div id="fileUploadsContainer"></div>
                        </div>
                        <div class=" ticket-attachments-message text-muted mt-3">
                            Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx                        </div>

                        <button type="button" class="btn btn--dark add-more mt-2" ><i class="fa fa-plus"></i></button>
				  <div class="form-group">
				   <label class="col-lg-3 control-label"></label>
                     <div class="col-lg-9">
						<span><a id="add_more_image" href="#">Add Product Sub Images</a></span>
                     </div>
					 
                  </div>-->
				  
				  
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Old Price:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="old_price" class="form-control" placeholder="Product Old Price">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">New Price<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="new_price" class="form-control" placeholder="Product New Price">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">SKU<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="hidden"  name="qty" class="form-control" value='1000' placeholder="Product Quantity">
                        <input type="text"  name="sku" class="form-control"  placeholder="Product SKU">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Short Description<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <textarea id="editor1" name="description" class="col-lg-3 control-label"></textarea>
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Long Description:</label>
                     <div class="col-lg-9">
                        <textarea id="editor2" name="long_description" class="col-lg-3 control-label"></textarea>
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
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Featured:</label>
                     <div class="col-lg-9">
                        <select class='form-control' name='featured'>
                           <option value='0'>No</option>
                           <option value='1'>Yes</option>
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
                  </div>
                  <div class="form-group">
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
                  <div class="text-left">
                     <button type="submit" name="btn" value="addNewProduct" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add Product</button>
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
        // $this->load->view("common/footer-text");
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
</style>
