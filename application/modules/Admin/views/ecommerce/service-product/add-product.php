

   
   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Service Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Service</li>
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
                  <h5 class="card-title">Add New Service</h5>
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
                  echo form_open(site_url().$module_name."/ServiceProduct/addNewProduct",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
                  									?>
               <div class="card-body">
                  <input type='hidden' value="0" name='service_status' id="service_status" />
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Main Category <span class="required-field">*</span>:</label>
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
                     <label class="col-lg-3 control-label">Select Sub Category <span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <select name='category_id' id="sub_category_id" class='form-control'>
                          <option value="">-Select Sub Category-</option>
						</select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Sub child Category <span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <select name='2category_id' id="2category_id" class='form-control'>
                          <option value="">-Select Sub Category-</option>
						</select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Title <span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Product Main Image<span class="required-field">*</span>:</label>
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
				  
				  
                  <div class="form-group" style="display:none;">
                     <label class="col-lg-3 control-label">Old Price:</label>
                     <div class="col-lg-9">
                        <input type="text"  name="old_price" class="form-control" placeholder="Product Old Price">
                     </div>
                  </div>
                  <div class="form-group" style="display:none;">
                     <label class="col-lg-3 control-label">New Price<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text" value="1" name="new_price" class="form-control" placeholder="Product New Price">
                     </div>
                  </div>
                  <div class="form-group" style="display:none;">
                     <label class="col-lg-3 control-label">Quantity<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="text"  value="1" name="qty" class="form-control" placeholder="Product Quantity">
                     </div>
                  </div>
                  <div class="form-group" style="display:none;">
                     <label class="col-lg-3 control-label">SKU<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <input type="hidden"  name="qty" class="form-control" value='1000' placeholder="Product Quantity">
                        <input type="text"  value="1" name="sku" class="form-control"  placeholder="Product SKU">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Description<span class="required-field">*</span>:</label>
                     <div class="col-lg-9">
                        <textarea id="description" name="description" class="col-lg-3 control-label"></textarea>
                     </div>
                  </div>
				  <div class="form-group" style="display:none;">
                     <label class="col-lg-3 control-label">Long Description:</label>
                     <div class="col-lg-9">
                        <textarea id="description1" name="long_description" class="col-lg-3 control-label"></textarea>
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
                  <div class="form-group" style="display:none;">
                     <label class="col-lg-3 control-label">Featured:</label>
                     <div class="col-lg-9">
                        <select class='form-control' name='featured'>
                           <option selected value='0'>No</option>
                           <option value='1' selected>Yes</option>
                        </select>
                     </div>
                  </div>
				  
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
</style>
<script>
   //CKEDITOR.replace( 'description');
   //CKEDITOR.replace( 'description1');

</script>
