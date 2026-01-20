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
               <h5 class="card-title">Rank Achiver Report</h5>
               <div class="col-md-12">
                  <div class="form-group">
                      <form action="<?php echo base_url();?>Admin/CommissionReport/rankAchieverReport">
                          <select name="rank_id" class="form-control" onchange="getrank(this.value)">
                              <option value="">Select Rank</option>
                              <?php
                              foreach($rank_list as $key=>$val)
                              {
                                  ?>
                                  <option value="<?php echo $val->id;?>"><?php echo $val->rank_name;?></option>
                                  <?php
                              }
                              ?>
                          </select>
                      </form>
                  </div>
               </div>
            </div>
            <script>
                function getrank(rank_id)
                {
                    window.location.href="<?php echo base_url();?>Admin/CommissionReport/rankAchieverReport/"+rank_id;
                }
            </script>
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>User Name</th>
                     <th>User Id</th>
                     <th>Name</th>
                     <th>Phone No</th>
                     <th>Rank Name</th>
                     <th>Date of Achivement</th>
                     <th>Rank Amount</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($rank_achiever_report) && count($rank_achiever_report)>0)
                  {
                     $sno=0;
                     foreach($rank_achiever_report as $rank)
                     {
                         $sno++;
                         $label_class=(!empty($rank->status=='1'))?'label-success':'label-danger';
                         $label=(!empty($rank->status=='1'))?'Active':'Inactive';
                         $udetail=get_user_details($rank->user_id);
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo get_user_name($rank->user_id);?></td>
                     <td><?php echo $rank->user_id;?></td>
                     <td><?php echo $udetail->first_name.' '.$udetail->last_name;?></td>
                     <td><?php echo $udetail->contact_no;?></td>
                     <td><?php echo $rank->rank_name;?></td>
                     <td><?php echo $rank->bonus_date;?></td>
                     <td><?php echo currency();echo (!empty($rank->bonus))?$rank->bonus:'0';?></td>
                     <td><span class="label <?php echo $label_class;?>"><?php echo $label;?></span></td>
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