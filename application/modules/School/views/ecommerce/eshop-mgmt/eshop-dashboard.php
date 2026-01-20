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
<div class="row mb-none-30">
        
				<?php echo $this->session->flashdata('flash_msg');?>
         <!--<div class="col-sm-6 col-md-3">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo $order_data['total_order']; ?></h3>
                     <span class="text-uppercase">Total Order</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>-->
         <div class="col-sm-6 col-md-3">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['pending_order']; ?></h3>
                     <span class="text-uppercase">Total Pending Order</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['confirmed_order']; ?></h3>
                     <span class="text-uppercase">Total Confirmed Order</span>
                  </div>
               </div>
            </div>
         </div>
		 <div class="col-sm-6 col-md-3">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['rejected_order']; ?></h3>
                     <span class="text-uppercase">Total Rejected Order</span>
                  </div>
               </div>
            </div>
         </div>
		 
      
        
			
		 <div class="col-sm-6 col-md-3">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['delivered_order']; ?></h3>
                     <span class="text-uppercase">Total Delivered Order</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
    
    
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->