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
            <div class="col-lg-12 col-sm-12">
            <!-- Daterange picker -->
            <!-- /daterange picker -->
            
         <?php 
                  if(!empty($this->session->flashdata('flash_msg')))
                  {
                  ?>
               <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('flash_msg');?>
               </div>
               <?php    
                  }
                  if(!empty($this->session->flashdata('error_msg')))
                  {
                  ?>
               <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
         
                  ?>
		 <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">Ewallet Payment</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <div class="card-body">
                
                <form action="<?php echo site_url();?>Affiliate/Eshop/ewalletPaymentConfirm/" method="post" enctype="multipart/form-data" class="form-horizontal">
                     <div class="form-group ">
                        <label class="col-sm-6 control-label" for="input-to-email">Enter Transaction Password : </label>
                        <div class="col-sm-6">
                           <input type="password" name="t_password" required value=""  class="form-control" placeholder="Enter Transaction Password">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-6 control-label" for="input-message"><span></span></label>
                        <div class="col-sm-6">
                           <button type="submit" name="ewallet_payment_btn" value="Submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Payment</button>
                        </div>
                     </div>
                  </form>
               								
            </div>
        
		
      </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
