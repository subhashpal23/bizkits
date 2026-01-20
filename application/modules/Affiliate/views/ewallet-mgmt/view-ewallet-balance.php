<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Wallet</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Wallet</li>
                    </ul>
                </div>
      <div class="row">
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="card card-body bg-danger-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo currency()." ".$ewallet_balance;?></h3>
                     <span class="text-uppercase text-size-mini">My Wallet Balance</span>
                  </div>
                  
                  <div class="media-right media-middle">
                     <i class="icon-wallet icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
            <!-- /basic layout -->
         </div>
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="card card-body bg-danger-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo currency()." ".$twallet_balance;?></h3>
                     <span class="text-uppercase text-size-mini">My Transaction Balance</span>
                  </div>
                  
                  <div class="media-right media-middle">
                     <i class="icon-wallet icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
            <!-- /basic layout -->
         </div>
         
         
      </div>
      <!-- /vertical form options -->
      <!-- Footer -->
      <?php 
      //$this->load->view('common/footer-text');
      ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<script>
   function deleteConfirm()
   {
   
   	if(window.confirm("Are you sure, you want to delete"))
       return true;
     else 
       return false;
   }
</script>