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
         <?php echo $this->session->flashdata('flash_msg');?>
         <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Fees</h3>
                            </div>
                            <a href="<?php echo site_url();?>Student/Fees/makePayment" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Pay Fees</a>
                            <!--<div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>-->
                        </div>
                        <div class="table-responsive">
            <table class="table table--light style--two">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Fees</th>
                     <th>Order ID</th>
                     <th>Fees Date</th>
                     <th>Payment Date</th>
                     <th>Payment Method</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $currency=currency();
                  if(!empty($all_fees) && count($all_fees)>0)
                  {
                     $sno=0;
                     foreach($all_fees as $epin)
                     {
                     $sno++;   
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $currency.$epin->fee_amount;?></td>
                     <td><?php echo $epin->order_id;?></td>
                     <td><?php echo date(date_formats(),strtotime($epin->fee_date));?></td>
                     <td><?php echo date(date_formats(),strtotime($epin->payment_date));?></td>
                     <td><?php echo $epin->payment_method;?></td>
                     <td><?php echo ($epin->status?'Paid':'Pending');?></td>
                  </tr>
                  <?php       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Pickadate picker -->
      <!-- /pickadate picker -->
      <!-- Pickatime picker -->
      <!-- /pickadate picker -->
      <!-- Anytime picker -->
      <!-- /anytime picker -->
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