<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Income Report Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Income Report</li>
                    </ul>
                </div>
      <!-- /daterange picker -->
      <div class="row">
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">Binary Income Report</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Transaction No</th>
                     <th>Amount</th>
					 <th>Daily Capping</th>
					 <th>Carry Left</th>
					 <th>Carry Right</th>
					 <th>Total Pair</th>
                     <th>Transaction Type</th>
					 
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total_binary_income=0;
                  if(!empty($binary_income) && count($binary_income)>0)
                  {
                     $sno=1;
                     foreach ($binary_income as $income) 
                     {
                      $total_binary_income=$total_binary_income+$income->credit_amt;  
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo $income->transaction_no;?></td>
                        <td><?php echo $income->credit_amt.currency();?></td>
						<td><?php echo $income->daily_capping;?></td>
						<td><?php echo $income->carry_pv_left;?></td>
						<td><?php echo $income->carry_pv_right;?></td>
						<td><?php echo $income->total_pair;?></td>
                        <td><?php echo $income->ttype;?></td>
						
                        <td><?php echo date(date_formats(),strtotime($income->create_date));?></td>
                     </tr>
                  <?php
                     $sno++;       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-body">
               <div class="card-heading">
                  <h6 class="card-title">Total Binary Income</h6>
               </div>
               <div class="">
                  <?php echo currency()." ".$total_binary_income;?>
               </div>
            </div>
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