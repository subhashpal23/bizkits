<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
   <!-- Content area -->
   <div class="content">
      <div class="row">
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">Income Report</h5>
               <div class="heading-elements">
                  <select name="report_type" id="report_type" class="form-control" onchange="showreport(this.value)">
                      <option value="">Select Report</option>
                      <?php
                      foreach($report_type as $key=>$val)
                      {
                          $sel='';
                          if($val->reason==$reason)
                          {
                              $sel="selected";
                          }
                          echo "<option value='".$val->reason."' ".$sel.">".$val->ttype."</option>";
                      }
                      ?>
                  </select>
               </div>
            </div>
             <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Receiver User Id</th>
                     <th>Receiver User Name</th>
                     
                     <th>Amount</th>
                     <th>Transaction Type</th>
                     <th>Summary</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total_direct_income=0;
                  if(!empty($direct_referral_income) && count($direct_referral_income)>0)
                  {
                     $sno=$start+1;
                     foreach ($direct_referral_income as $income) 
                     {
                      $total_direct_income=$total_direct_income+$income->credit_amt;  
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo $income->receiver_id;?></td>
						<td><?php echo get_user_name($income->receiver_id);?></td>
						
                        <td><?php echo $income->credit_amt.currency();?></td>
                        <td><span class="label label-success">Credit</span></td>
                        <td><?php echo $income->ttype;?></td>
                        <td><?php echo date(date_formats(),strtotime($income->create_date));?></td>
                     </tr>
                  <?php
                     $sno++;       
                     }//end foreach
                  }//end if
                  ?>

               </tbody>
            </table>
         </div>
         
</div>
<div class="pagination">
    <?php  echo $this->pagination->create_links(); ?>
      </div>
      
      <div class="row">
         <div class="col-md-6">
            <div class="card card-body">
               <div class="card-heading">
                  <h6 class="card-title">Total Daily Income</h6>
               </div>
               <div class="card-body">
                  <?php 
                  echo currency()." ";
                  echo (!empty($total_direct_income))?$total_direct_income:0;
                  ?>
               </div>
            </div>
         </div>
      </div>
      
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<script>
    function showreport(id)
    {
        window.location.href="<?php echo base_url();?>Admin/CommissionReport/allCommission/"+id+"/<?php echo $start?>";
    }
</script>