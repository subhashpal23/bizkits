<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
        <!-- TradingView Widget BEGIN -->
        
                
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
                        <form action="<?php echo site_url();?>Web/registerUserViaEwallet" method="post" class="sky-form" style="width: 100%">
                                    <header>Pay via Sponsor Wallet</header>
                                    <h5 class="validation_msg" style="color:red;font-weight:bold;"></h5>
                                    

                                    <div class="form-group has-feedback amount" >
                                       <samp style="color:red;" class="col-md-12">*Package Amount <?php $currency=currency();echo $currency;?><?php echo $registration_info['sponsor_and_account_info']['pkg_amount'];?><br></samp>
                                       
                                       
                                    </div>
                                    <div class="form-group">
                                    <input type="text" readonly name="sponsor_user_name" id="sponsor_user_name" value="<?php echo $registration_info['sponsor_and_account_info']['ref_user_name'];?>" class="form-control" placeholder="Sponsor Id">
                                    </div>
                                    <div class="form-group">
                                    <input type="password" name="sponsor_transaction_password" id="sponsor_transaction_password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="theme-button text-uppercase">
                                        <div class="btn-effect">
                                            <button type="submit" name="btn" id="btns" value="submit"  class="btn btn-heading btn-block hover-up">Pay Now</button>
                                        </div>
                                    </div>
                                    
                                 </form>
                                 </div>
                </div>
            </div>
        </div>
    </main>