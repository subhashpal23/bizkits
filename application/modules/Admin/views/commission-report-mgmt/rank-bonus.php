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
               <h5 class="card-title">Rank Bonus</h5>
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
                     <th>User Id</th>
                     <th>User Name</th>
                     <th>Update Rank</th>
                     <th>Bonus Amount</th>
                     <th>Transaction Type</th>
                     <th>Remark</th>
                     <th>Date</th>
                     <!--<th>Status</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  //pr($rank_bonus);
                  if(!empty($rank_bonus) && count($rank_bonus)>0)
                  {
                     $total_no_of_rank_bonus=count($rank_bonus);
                     $total_rank_bonus=0;
                     $sno=0;
                     foreach ($rank_bonus as $bonus) 
                     {
                        $sno++;
                        $total_rank_bonus=$total_rank_bonus+$bonus->amount;
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $bonus->user_id;?></td>
                     <td><?php echo $bonus->username;?></td>
                     <td>Update Rank</td>
                     <td><?php echo currency()." ".$bonus->amount;?></td>
                     <td>Credit</td>
                     <td><?php echo $bonus->description;?></td>
                     <td><?php echo date(date_formats(),strtotime($bonus->create_date));?></td>
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
      
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->