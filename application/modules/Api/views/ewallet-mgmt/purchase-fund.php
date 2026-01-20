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
            
               <!-- Subscription form -->
               <div class="card card-body">
                  <div class="card-heading">
                     <h6 class="card-title">Purchase Wallet Fund </h6>
                  </div>
                  <?php 
                  echo form_open(ci_site_url()."Affiliate/Ewallet/purchaseFund",array('method'=>'post','class'=>'card-body', 'enctype'=>'multipart/form-data'));
                  ?>
                     <!--<div class="card">
                        <div class="card-heading">
                           <h6 class="card-title">Wallet Amount</h6>
                        </div>
                        <div class="card-body">
                           <input id="wallet_amount" disabled type="text" value="<?php echo $current_balance;?>" class="form-control">
                        </div>
                        <div id="show_amount_div">
                        </div>
                     </div>-->
                     <div class="form-group has-feedback">
                        <input id="wallet_amount" disabled type="hidden" value="<?php echo $current_balance;?>" class="form-control">
                        Wallet Balance: <?php echo currency().''.$current_balance;?>
                        <div id="show_amount_div">
                        </div>
                     </div>
                     <div class="form-group has-feedback">
                        <input id="deposit_amount" name="deposit_amount" type="text"  class="form-control" placeholder="Enter Purchase Amount">
                        <span id="valid_deposit_amount" style="color:red;font-weight:bold"></span>
                     </div>
                     <!--<div class="form-group has-feedback">
                        <input name="deposit_title" type="text"  class="form-control" placeholder="Enter Title">
                     </div>-->
                     <!--<div class="form-group has-feedback">
                        <img src="<?php echo base_url();?>images/qrcode.jpg" style="width:50%">
                     </div>-->
                     <div class="form-group has-feedback">
                        <input id="deposit_proof" name='deposit_proof' type="file" class="file-styled"><br>
                           <span class="help-block no-margin-bottom">Accepted formats: gif, png, jpg</span>
                           <span id="valid_deposit_proof" style="color:red;font-weight:bold"></span>
                     </div>
                     <!--<div class="card card-flat">
                        <div class="card-heading">
                           <h6 class="card-title">Upload Proof Of Payment</h6>
                        </div>
                        <div class="card-body">
                           <input id="deposit_proof" name='deposit_proof' type="file" class="file-styled">
                           <span class="help-block no-margin-bottom">Accepted formats: gif, png, jpg</span>
                           <span id="valid_deposit_proof" style="color:red;font-weight:bold"></span>
                        </div>
                     </div>-->
                     <div class="row">
                        <!--<div class="col-xs-6">
                           <div class="checkbox disabled">
                              <label>
                              <input type="checkbox" class="styled" checked="checked" disabled="disabled">
                              Accept terms
                              </label>
                           </div>
                        </div>-->
                        <div class="col-xs-6 text-right">
                           <button id="submit_btn" type="submit" name="btn" value='submit' class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add Fund</button>
                        </div>
                     </div>
                  <?php echo form_close();?>
               </div>
               <!-- /subscription form -->
            
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
