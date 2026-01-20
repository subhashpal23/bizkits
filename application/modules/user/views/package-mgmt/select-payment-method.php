<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Package Management</span> - Select Payment Method</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo ci_site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Package Management</li>
							<li class="active">Purchase Package</li>
							<li class="#">Select Payment Method</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
						  <div class="col-md-3">
								  <a onclick="return ewalletPaymentConfirm();" href="<?php echo ci_site_url();?>user/package/ewalletPayment">
								  <img src="<?php echo base_url();?>/front_assets/images/ewallet.png"/>
								  </a>
						   </div>
						   <div class="col-md-3">
                              
							  <form action="<?php echo ci_site_url();?>user/package/payStackPayment" method="POST" >  
								<script src="https://js.paystack.co/v1/inline.js"     data-key="pk_test_16d3d228a772ba8ad4e7be6e03f392ead1c3580a"  data-email="<?php echo $email;?>"    
								
								data-amount="<?php echo $diff_amount*100;?>"    
								
								data-ref="<?php echo "P".rand(0000000,9999999); ?>">  
								</script>
							</form> 
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
.paystack-trigger-btn {
	border-radius: 15px;
}
</style>			