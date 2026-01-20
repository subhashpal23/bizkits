<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Manage User Wallet</li>
                    </ul>
                </div>
   <!-- Content area -->
   <div class="content">
      <?php 
         if(!empty($this->session->flashdata('flash_msg')))
         {
         ?>
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <!--<span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet-->
         <?php echo $this->session->flashdata('flash_msg');?>
      </div>
      <?php   
         }
         ?>
      <!--
         <div class="alert alert-warning alert-styled-right">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Warning!</span> Oh! Transaction Password is Wrong
         </div>
         -->
    <div class="col-md-6" style="float:left">
      <div class="card card-body" >
         <div class="card-heading">
            <h5 class="card-title">Add Fund in User Wallet</h5>
         </div>
         
            <div class="row">
               <form action="<?php echo ci_site_url();?>Admin/UserWallet/addFundToUserWallet" method="post">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label class="display-block">Select User</label>
                        <select name="username" id="usernamewallet" class="form-control">
                           <optgroup label="Receiver Id OR Username">
                            <option value="">-Select User-</option>
                              <?php 
                                 if(!empty($all_active_members) && count($all_active_members)>0)
                                 {
                                   foreach($all_active_members as $member)
                                   {
                                 ?>
                              <option value="<?php echo $member->user_id;?>"><?php echo $member->username;?></option>
                              <?php
                                 }
                                 }
                                 ?>
                           </optgroup>
                        </select>
                        <span style="color:red;font-weight:bold" class="valid_username"></span>
                     </div>
                     <div class="form-group">
                        <input type="text" disabled name="available_amount" id="available_amount" class="form-control" placeholder="Available Amount In UserWallet">
                     </div>
                     <div class="form-group">
                        <input type="number" min="0" value="0" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                        <span style="color:red;font-weight:bold" class="valid_amount"></span>
                     </div>
                     <div class="form-group">
                        <i>Available Amount Will be In AdminWallet</i>
                        <input type="number" name="admin_wallet_amount" id="admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>" disabled class="form-control" placeholder="Available Amount Will be In AdminWallet">
                        <input type="hidden" disabled id="current_admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>">
                     </div>
                     <div class="form-group">
                        <input type="text" name="desciption" id="desciption" class="form-control" placeholder="Enter Description">
                     </div>
                     <div class="form-group">
                        <input type="password" name="transaction_password" id="transaction_password" class="form-control" placeholder="Enter Transaction Password">
                        <span class="valid_transaction_password" style="color:red;font-weight:bold"></span>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="btn" value="add" id="addFundBtn" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"><i class="icon-cog3 position-left"></i> Add Fund</button>
                     </div>
                  </div>
               </form>
            </div>
         
      </div>
    </div>  
    <div class="col-md-6" style="float:right">
      <div class="card card-body">
         <div class="card-heading">
            <h5 class="card-title">Deduct Fund from User Wallet</h5>
         </div>
        
            <div class="row">
               <form action="<?php echo ci_site_url();?>Admin/UserWallet/deductFundFromUserWallet" method="post">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label class="display-block">Select User</label>
                        <select name="username" id="d_username" class="form-control">
                           <optgroup label="Receiver Id OR Username">
                              <option value="">-Select User-</option>
                              <?php 
                                 if(!empty($all_active_members) && count($all_active_members)>0)
                                 {
                                   foreach($all_active_members as $member)
                                   {
                                 ?>
                              <option value="<?php echo $member->user_id;?>"><?php echo $member->username;?></option>
                              <?php
                                    }
                                 }
                                 ?>
                           </optgroup>
                        </select>
                        <span style="color:red;font-weight:bold" class="d_valid_username"></span>
                     </div>                     
                     <div class="form-group">
                        <input type="text" disabled name="available_amount" id="d_available_amount" class="form-control" placeholder="Available Amount In UserWallet">
                        <input type="hidden" disabled id="d_current_user_wallet_amount">
                     </div>
                     <div class="form-group">
                        <input type="number" min="0" value="0" name="amount" id="d_amount" class="form-control" placeholder="Enter Amount">
                        <span style="color:red;font-weight:bold" class="d_valid_amount"></span>
                     </div>
                     <div class="form-group">
                        <i>Amount Will be In AdminWallet</i>
                        <input type="number" name="admin_wallet_amount" id="d_admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>" disabled class="form-control" placeholder="Available Amount Will be In AdminWallet">
                        <input type="hidden" disabled id="d_current_admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>">
                     </div>
                     <div class="form-group">
                        <input type="text" name="desciption" id="d_desciption" class="form-control" placeholder="Enter Description">
                     </div>
                     <div class="form-group">
                        <input type="password" name="transaction_password" id="d_transaction_password" class="form-control" placeholder="Enter Transaction Password">
                        <span class="d_valid_transaction_password" style="color:red;font-weight:bold"></span>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="btn" value="add" id="deductFundBtn" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"><i class="icon-cog3 position-left"></i> Deduct Fund</button>
                     </div>
                  </div>
               </form>
            </div>
         
      </div>
    </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
