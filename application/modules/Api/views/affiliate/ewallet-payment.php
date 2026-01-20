<body id="dark">
<?php $this->load->view("top-nav");?>
  <div class="container-fluid mtb15">
    <div class="row">
      <div class="col-md-12">
        <!-- TradingView Widget BEGIN -->
        
                  <div class="vh-100 d-flex justify-content-center">
                     <div class="form-access my-auto">
                     <?php 
                  if(!empty($this->session->flashdata('error_msg')))
                  {
                  ?>
               <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
                  $registration_info=$this->session->userdata('registration_info');
                  ?>
                        <form action="<?php echo site_url();?>front/registerUserViaEwallet" method="post" class="sky-form" style="width: 100%">
                                    <header>Pay via Sponsor Wallet</header>
                                    <h5 class="validation_msg" style="color:red;font-weight:bold;"></h5>
                                    <div class="form-group has-feedback">
                                        <input type="hidden" name="deposit_title" id="deposit_title" value='roi'>
                                       <!--<select name="deposit_title" id="deposit_title" class="form-control">
                                          <option value="">Select Income Type</option>
                                          <option value="psi">PSI Income</option>
                                          <option value="roi">ROI Income</option>
                                          <option value="staking">Staking Income</option>
                                       </select>-->
                                    </div>

                                    <div class="form-group has-feedback amount" >
                                       <input id="deposit_amount" name="deposit_amount" readony type="text" value="2000" class="form-control" placeholder="Enter Purchase Amount">
                                       <samp style="color:red;" class="col-md-12">*Minimum Amount <?php $currency=currency();echo $currency.'2000';?><br></samp>
                                       
                                       <span id="valid_deposit_amount" class="col-md-12" style="color:red;font-weight:bold"><br></span>
                                       <samp id="valid_per" class="col-md-12" style="color:red;"></samp>
                                    </div>
                                    <div class="form-group">
                                    <input type="text" readonly name="sponsor_user_name" id="sponsor_user_name" value="<?php echo $registration_info['sponsor_and_account_info']['ref_user_name'];?>" class="form-control" placeholder="Sponsor Id">
                                    </div>
                                    <div class="form-group">
                                    <input type="password" name="sponsor_transaction_password" id="sponsor_transaction_password" class="form-control" placeholder="Secuirity Password">
                                    </div>
                                    
                                    <footer>
                                        <button type="submit" name="btn" id="btns" value="submit" class="btn btn-primary">Pay Now</button>
                                    </footer>
                                 </form>
                                 </div>
    </div>
        <!-- TradingView Widget END -->
      </div>
    </div>
  </div>