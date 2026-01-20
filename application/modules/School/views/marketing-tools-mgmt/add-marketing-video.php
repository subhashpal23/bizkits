<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Marketing Tools</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Marketing Tools</li>
                    </ul>
                </div>
      <!-- Horizontal form options -->
      <?php 
         if(!empty($this->session->flashdata('flash_msg')))
         {
         ?>
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <!--
            <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
            -->
         <?php 
            echo $this->session->flashdata('flash_msg');
            ?>
      </div>
      <?php    
         }
         ?>
      <div class="row">
         <div class="col-md-12">
            <!-- Basic layout-->
            <div class="card card-flat">
               <div class="card-heading">
                  <h5 class="card-title">Add Marketing Video</h5>
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
                  echo form_open(ci_site_url()."School/MarketingTools/addMarketingVideo",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
                  ?>
               <div class="card-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Title:</label>
                     <div class="col-lg-9">
                        <input type="text" name="title" id="title" class="form-control">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Description:</label>
                     <div class="col-lg-9">
                        <textarea id="description" name="description" class="col-lg-3 control-label"></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Video Path:</label>
                     <div class="col-lg-9">
                        <input type="text" name="video_path" id="video_path" class="form-control">
                     </div>
                  </div>
                  <div class="text-left">
                     <button type="submit" name="btn" value="addNewPackage" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add <i class="icon-arrow-right14 position-right"></i></button>
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
   CKEDITOR.replace('description');
</script>