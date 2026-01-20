<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Account Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Payment Method</li>
                    </ul>
                </div>
					<div class="row">
         <?php 
         if(!empty($this->session->flashdata('flash_msg')))
         {
         ?>
         <div class="col-md-12">
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <?php echo $this->session->flashdata('flash_msg');?>
            </div>
         </div>
         <?php    
         }
         ?>
         <?php 
         if(!empty($this->session->flashdata('error_msg')))
         {
         ?>
         <div class="col-md-12">
            <div class="alert alert-warning alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <?php echo $this->session->flashdata('error_msg');?>
            </div>
         </div>
         <?php    
         }
         ?>
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="card card-flat border-top-success">
               <!-- Subscription form -->
               <div class="card card-flat">
                  <div class="card-heading">
                     <h6 class="card-title">Ewallet Payment </h6>
                  </div>
                  <?php 
                  $tran_password=(!empty($tran_password))?$tran_password:null;
                  echo form_open(ci_site_url()."Affiliate/Package/ewalletPayment",array('method'=>'post','class'=>'card-body' , 'enctype'=>'multipart/form-data'));
                  ?>
                  <!--<form class="card-body" action="#">-->
                     <div class="form-group has-feedback">
                        <input type="password" value="<?php echo set_value('tran_password',$tran_password);?>" name="tran_password" class="form-control" placeholder="Enter Transaction Password">
                        <span class='error'>
                           <?php 
                           echo form_error('tran_password');
                           ?>
                        </span>  
                     </div>
                     <div class="row">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 text-right">
                           <button type="submit" name="btn" value="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Pay Now</button>
                        </div>
                     </div>
                  <!--</form>-->
                  <?php echo form_close();?>
               </div>
               <!-- /subscription form -->
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
   span.error 
      {
          color: red;
          font-weight: bold;
      }
</style>   			