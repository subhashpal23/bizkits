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
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">Payout Cancelled</h5>
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
                     <th>Request Date</th>
                     <th>Amount</th>
                     <th>Status</th>
                     <th>Approval Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_cancelled_request) && count($all_cancelled_request)>0)
                  {
                     $sno=0;
                     foreach ($all_cancelled_request as $request) 
                     {
                        $sno++;   
                  ?>
                        <tr>
                           <td><?php echo $sno;?></td>
                           <td><?php echo $request->request_id;?></td>
                           <td><?php echo date(date_formats(),strtotime($request->request_date));?></td>
                           <td><?php echo $request->amount;?></td>
                           <td>Cancelled</td>
                           <td><?php echo date(date_formats(),strtotime($request->response_date));?></td>
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