<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Dashboard Notice</li>
                    </ul>
                </div>
   <!-- Content area -->
   <div class="content">
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
            <div class="card card-body">
               <div class="card-heading">
                  <h5 class="card-title">Dashboard Notice</h5>
                  <!--<div class="heading-elements">
                     <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                     </ul>
                  </div>-->
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
               </div>
               <?php 
                  $privacy_policy=(!empty($privacy_policy))?$privacy_policy:null;
                  echo form_open(ci_site_url()."Admin/Policy/editDashboardNotice",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
               ?>
               <div class="card-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Notice:</label>
                     <div class="col-lg-9">
                        <textarea id="description" name="privacy_policy" class="col-lg-3 control-label"><?php echo $privacy_policy->confidential_value;?></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">OR Notice Image:</label>
                     <div class="col-lg-9">
                        <input type="file" name="profile_pic">
                        <input type="hidden" name="profile_pic_old" value="<?php echo $privacy_policy->image;?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Status:</label>
                     <div class="col-lg-9">
                        <select name="status" class="form-control">
                            <option value="">Enable/Disable</option>
                            <option value="1" <?php if($privacy_policy->status==1){ echo "selected";}?>>Enable</option>
                            <option value="2" <?php if($privacy_policy->status==2){ echo "selected";}?>>Disable</option>
                        </select>
                     </div>
                  </div>
                  <div class="text-right">
                     <button type="submit" name="btn" value="addNewPackage" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add <i class="icon-arrow-right14 position-right"></i></button>
                  </div>
               </div>
               <!--</form>-->
               <?php echo form_close();?>
               
               
               <?php 
                  $privacy_policy1=(!empty($privacy_policy1))?$privacy_policy1:null;
                  echo form_open(ci_site_url()."Admin/Policy/editDashboardNotice1",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
               ?>
               <div class="card-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Notice:</label>
                     <div class="col-lg-9">
                        <textarea id="description1" name="privacy_policy" class="col-lg-3 control-label"><?php echo $privacy_policy1->confidential_value;?></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">OR Notice Image:</label>
                     <div class="col-lg-9">
                        <input type="file" name="profile_pic">
                        <input type="hidden" name="profile_pic_old" value="<?php echo $privacy_policy1->image;?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Status:</label>
                     <div class="col-lg-9">
                        <select name="status" class="form-control">
                            <option value="">Enable/Disable</option>
                            <option value="1" <?php if($privacy_policy1->status==1){ echo "selected";}?>>Enable</option>
                            <option value="2" <?php if($privacy_policy1->status==2){ echo "selected";}?>>Disable</option>
                        </select>
                     </div>
                  </div>
                  <div class="text-right">
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
  // CKEDITOR.replace('privacy_policy');
</script>
