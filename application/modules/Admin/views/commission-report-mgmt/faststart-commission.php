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
               <h5 class="card-title">Fast Start Report</h5>
               
            </div>
             <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th> User Id</th>
                     <th>User Name</th>
                     
                     <th>Amount</th>
                     <th>Status</th>
                     <th>Paid Date</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total_direct_income=0;
                  $total_direct_income1=0;
                  if(!empty($direct_referral_income) && count($direct_referral_income)>0)
                  {
                     $sno=$start+1;
                     foreach ($direct_referral_income as $income) 
                     {
                      if($income->status)
                      {
                        $total_direct_income=$total_direct_income+$income->amount;  
                      }
                      else
                      {
                          $total_direct_income1=$total_direct_income1+$income->amount; 
                      }
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo $income->user_id;?></td>
						<td><?php echo get_user_name($income->user_id);?></td>
						
                        <td><?php echo $income->amount.currency();?></td>
                        <td><span class="btn btn-<?php echo ($income->status)?'success':'warning';?>"><?php echo ($income->status)?'Paid':'Pending';?></span></td>
                        <td><?php echo date(date_formats(),strtotime($income->update_date));?></td>
                        <td><?php echo date(date_formats(),strtotime($income->add_date));?></td>
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
                  <h6 class="card-title">Total Fast Start Paid</h6>
               </div>
               <div class="card-body">
                  <?php 
                  echo currency()." ";
                  echo (!empty($total_direct_income))?$total_direct_income:0;
                  ?>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card card-body">
               <div class="card-heading">
                  <h6 class="card-title">Total Fast Start Pending</h6>
               </div>
               <div class="card-body">
                  <?php 
                  echo currency()." ";
                  echo (!empty($total_direct_income1))?$total_direct_income1:0;
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