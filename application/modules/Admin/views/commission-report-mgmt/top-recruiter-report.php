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
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">Top Recruiter Report</h5>
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
                     <th>User Name</th>
                     <th>User Id</th>
                     <th>Total Direct Member</th>
                     <th>Team Member</th>
                     <th>Date</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($top_recruiter_report) && count($top_recruiter_report)>0)
                  {
                     $sno=0;
                     foreach ($top_recruiter_report as $report) 
                     {
                     $sno++;
                     $label_class=(!empty($report['active_status']=='1'))?'label-success':'label-danger';
                     $label=(!empty($report['active_status']=='1'))?'Active':'Inactive';
                     $ttm=$callfunc->get_total_team_members($report['user_id']);
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo get_user_name($report['user_id']);?></td>
                     <td><?php echo $report['user_id'];?></td>
                     <td><?php echo $report['total_direct_member'];?></td>
                     <td><?php echo $ttm;?></td>
                     <td><?php echo $report['create_date'];?></td>
                     
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