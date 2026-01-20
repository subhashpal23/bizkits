<div id="content" class="site-content ">
  <div class="container">
 
  <div class="row">
                           <div class="heading-panel">
                              <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                                 <!-- Main Title -->
                                  <h1>  Choose Payment Method</h1>
                                 <!-- Short Description -->
                                 <!--<p class="heading-text">Eu delicata rationibus usu. Vix te putant utroque, ludus fabellas duo eu, his dico ut debet consectetuer.</p>-->
                              </div>
                           </div>
                           <div class="col-md-12" style="box-shadow: 0px 0px 0px 0px;" >
                              <!-- Ads Archive 6 -->
                              <div class="col-md-12 col-xs-12 col-sm-12">
                                 <div class="row">
                                    <div class="posts-masonry">														
                                       <?php										//pr($registration_info);										?>														
                  
                  <!--<div class="col-md-3">
                                       <a onclick="return ewalletPaymentConfirm();" href="<?php echo site_url();?>ewallet-payment"><img src="<?php echo base_url();?>frontassets/images/ewallet.png"/></a>
                                     </div>-->
                 
                 
               <!--<div class="col-md-3">
                    
                                       <a onclick="return epinPaymentConfirm();" href="<?php echo site_url();?>epin-payment"><img src="<?php echo base_url();?>frontassets/epin-payment.png"/></a>
                                     </div>-->
                 
                  <div class="col-md-3">
                                       <a onclick="return bankWirePaymentConfirm();" href="<?php echo site_url();?>bank-wire-payment"><img src="<?php echo base_url();?>frontassets/images/bank-transfer.png" style="width:100%"/></a>
                                     </div>
                  
				<?php  
				     
			      $amount=$registration_info['sponsor_and_account_info']['pkg_amount']*100;
				  $amount=$amount*364.5;
				  ?>       
				  <!--<div class="col-md-3">				
				  <form action="<?php echo site_url();?>front/paystackPayment/" method="POST" >  
				  <script 
				  src="https://js.paystack.co/v1/inline.js" 
				  data-key="<?php echo $TEST_PUBLIC_KEY; ?>" 
				  data-email="<?php echo $registration_info['sponsor_and_account_info']['email']; ?>" 
				  data-amount="<?php echo $amount; ?>"  
				  data-ref="<?php echo "PS".rand(000000000,999999999); ?>"> 
				  </script>
				  </form> 
				  </div>   -->           
				  					  
                   
                                  
                  
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
  </div>
  </div>