<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Fees</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Student">Home</a>
                        </li>
                        <li>Fees</li>
                    </ul>
                </div>
        
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="card height-auto">
                    <div class="card-body">
                  <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Fees</h3>
                            </div>
                            
                        </div>
                  <form action="<?php echo ci_site_url();?>Student/Fees/makePayment" method="post" enctype="multipart/form-data">
                     
                     <div class="form-group has-feedback">
                        <input name="fees_amount"  type="text" class="form-control pin_amount" placeholder="Fees Amount">
                     </div>
                     <div class="form-group">
                        <select id="select_payment_method" name="select_payment_method" data-placeholder="Select Payment Method" class="select2">
                           <option value="">-Select Payment Method-</option>
                           <option value="cash">Cash</option>
                           <option value="ewallet">Ewallet Method</option>
                           <option value="bank_wire">Bank Wire Method</option>
                           <option value="fullterwave">Flutterwave</option>
                        </select>
                        <span style="color:red;display:none;font-weight:bold" id="valid_select_payment_method">Please select payment method!</span>
                     </div>
                     <div class="form-group">
                         <label>Fees Date</label>
                                    <input type="text" name="fee_date" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                                        data-position='bottom right'>
                                    <i class="far fa-calendar-alt"></i>
                     </div>
                     
                     <div class="form-group">
                           <button type="submit" name='btn' id="btn" value='submit' class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Make Payment</button>
                     </div>
                  </form>
               </div>
               <!-- /subscription form -->
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