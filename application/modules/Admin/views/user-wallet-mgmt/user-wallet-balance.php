<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>User Wallet</li>
                    </ul>
                </div>
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">User Wallet Balance</h5>
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
                     <th>Transaction Wallet</th>
                     <th>Wallet Balance</th>
                     <th>Registration Date</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_user_wallet_balance) && count($all_user_wallet_balance)>0)
                  {
                     $sno=0;
                     foreach($all_user_wallet_balance as $wallet)
                     {
                     $sno++;
                     $label_class=(!empty($wallet->active_status=='1'))?'label-success':'label-danger';
                     $label=(!empty($wallet->active_status=='1'))?'Active':'Inactive';
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $wallet->username;?></td>
                     <td><?php echo $wallet->user_id;?></td>
                     <td><?php echo $wallet->pbalance." ".currency();?></td>
                     <td><?php echo $wallet->balance." ".currency();?></td>
                     <td><?php echo date(date_formats(),strtotime($wallet->registration_date));?></td>
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