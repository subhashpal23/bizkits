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
      <div class="heading-elements">
                        <div class="heading-btn-group">
                         <a href="<?php echo ci_site_url();?>admin/CommissionReport/creditBinaryCommission/" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Credit Binary Bonus</a>
                        </div>
                  </div> 

    
<div class="content">
      <!-- Horizontal form options -->
      <div class="row">
         <div class="col-md-12">
            <!-- Basic layout-->
            <div class="card card-body">
         
            <div class="panel-heading">
               <h5 class="panel-title">Binary Bonus Report</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <?php 
                  if(!empty($this->session->flashdata('flash_msg')))
                  {
                  ?>
               <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('flash_msg');?>
               </div>
               <?php    
                  }
            ?>
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>User Id</th>
                     <th>User Name</th>
                     <th>Amount</th>
                     <th>Transaction Type</th>
                     <th>Remark</th>
                     <th>Date</th>
                     <!--<th>Status</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($binary_commission) && count($binary_commission)>0)
                  {
                     $total_no_of_binary_commission=count($binary_commission);
                     $total_binary_commission=0;
                     $sno=0;
                     foreach ($binary_commission as $commission) 
                     {
                        $sno++;
                        $total_binary_commission=$total_binary_commission+$commission->amount;
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $commission->user_id;?></td>
                     <td><?php echo $commission->username;?></td>
                     <td><?php echo currency()." ".$commission->amount;?></td>
                     <td>Credit</td>
                     <td>Binary Commission</td>
                     <td><?php echo date(date_formats(),strtotime($commission->create_date));?></td>
                     <!--<td>Paid</td>-->
                  </tr>
                  <?php       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      
      
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->