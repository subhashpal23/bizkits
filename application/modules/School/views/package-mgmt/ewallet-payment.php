<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Package Management</span> - Ewallet Payment</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo ci_site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Package Management</li>
							<li class="active">Purchase Package</li>
							<li class="#">Ewallet Payment</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
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
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="panel panel-flat border-top-success">
               <!-- Subscription form -->
               <div class="panel panel-flat">
                  <div class="panel-heading">
                     <h6 class="panel-title">Ewallet Payment </h6>
                  </div>
                  <?php 
                  $tran_password=(!empty($tran_password))?$tran_password:null;
                  echo form_open(ci_site_url()."user/package/ewalletPayment",array('method'=>'post','class'=>'panel-body' , 'enctype'=>'multipart/form-data'));
                  ?>
                  <!--<form class="panel-body" action="#">-->
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
                           <button type="submit" name="btn" value="submit" class="btn btn-info">Submit</button>
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
	                  $this->load->view("common/footer-text");
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