<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Payout</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Payout</li>
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
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="card border-top-success">
               <!-- Subscription form -->
               <div class="card card-body">
                  <div class="card-heading">
                     <h6 class="card-title">Withdraw My Fund </h6>
                  </div>
                  <?php 
                  $request_title=(!empty($request_title))?$request_title:null;
                  $request_amount=(!empty($request_amount))?$request_amount:null;
                  $tran_password=(!empty($tran_password))?$tran_password:null;
                  echo form_open(site_url()."Affiliate/Payout/withdrawlMyFund",array('method'=>'post','class'=>'card-body'));
                  ?>
                  <!--<form class="card-body" action="#">-->
                    
                        <div class="form-group has-feedback">
                           <h6 class="card-title">Wallet Amount</h6>
                        
                           <input id="wallet_amount" disabled type="text" value="<?php echo $current_balance;?>" disabled type="text" value="<?php echo $current_balance;?>" class="form-control">
                         <div id="rem_amount_div">
                        </div>
                        </div>
                       
                     
                     <!-- <div class="form-group has-feedback">
                        <input name="request_title" value="<?php echo set_value('request_title',$request_title);?>"  type="text" class="form-control" placeholder="Enter Title">
                     </div> -->
                     <div class="form-group has-feedback">
                        <input name="request_amount" type="number" id="request_amount" value="<?php echo set_value('request_amount',$request_amount);?>" class="form-control" placeholder="Enter Amount to Withdraw">
                        <span style="color:red;display:none" id="valid_request_amount">
                        <?php 
                        echo form_error('amount');
                        ?>
                        </span>
                     </div>

                     <div class="form-group has-feedback">
                        <input type="password" value="<?php echo set_value('tran_password',$tran_password);?>" name="tran_password" class="form-control" placeholder="Enter Secuirity Password">
                        <span style="color:red;font-weight:bold" class='error'>
                        <?php 
                           echo form_error('tran_password');
                        ?>
                        </span>  
                     </div>
                     <div class="row">
                        
                        <div class="col-xs-6 text-right">
                           <?php 
						   /* if(is_active_withdrwal_button($user_id))
						   { */
						   ?>
						   <button id="submit_btn_withdraw" type="submit" name="btn" value="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Withdraw My Fund</button>
						   <?php 
						   /* } */
						   ?>
                        </div>
                     </div>
                  <!--</form>-->
                  <?php echo form_close();?>
               </div>
               <!-- /subscription form -->
            </div>
            <!-- /basic layout -->
         </div>
         <div class="col-md-6">
            <div class="card card-body bg-danger-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo currency()." ".$current_balance;?></h3>
                     <span class="text-uppercase text-size-mini">My Wallet Balance</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-wallet icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
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
