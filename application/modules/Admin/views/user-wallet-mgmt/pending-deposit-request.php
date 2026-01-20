<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Wallet</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Admin">Home</a>
                        </li>
                        <li>Wallet</li>
                    </ul>
                </div>
   <div class="content">
      <?php 
      if(!empty($this->session->flashdata('flash_msg')))
      {
      ?>
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <!--<span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet-->
         <?php echo $this->session->flashdata('flash_msg');?>
      </div>
      <?php   
      }
      ?>
      <div class="row">
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">Pending Deposit Request</h5>
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
                     <th>Request Id</th>
                     <th>User Id</th>
                     <th>User Name</th>
                     <th>Amount Requested</th>
                     <th>Date </th>
                     <th>Proof of Payment</th>
                     <th>Remark</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total_deposit_request_pending_amount=0;
                  if(!empty($wallet_deposit_request) && count($wallet_deposit_request)>0)
                  {
                     $sno=0;
                     foreach($wallet_deposit_request as $request)
                     {
                     $sno++;
                     $total_deposit_request_pending_amount=$total_deposit_request_pending_amount+$request->request_amount;
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $request->deposit_id;?></td>
                     <td><?php echo $request->user_id;?></td>
                     <td><?php echo $request->username;?></td>
                     <td><?php echo currency()." ".$request->request_amount;?></td>
                     <td><?php echo date(date_formats(),strtotime($request->request_date));?></td>
                     <td><a href="<?php echo ci_site_url().'images/'.$request->file_proof;?>" target="_blank">View Proof</a></td>
                     <td><?php echo $request->title;?></td>
                     <td><span class="label label-warning">Pending</span></td>
                     <td class="text-center">
                        <ul class="icons-list">
                           <li class="dropdown">
                              <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-eye"></i>
                              </a>-->
                              <a onclick="return confirmApproval();" href="<?php echo ci_site_url().'Admin/UserWallet/approveDepositRequest/'.ID_encode($request->id);?>"><i class="fa fa-check" aria-hidden="true" style="color:#1cc30b;"></i></a>
                              &nbsp;&nbsp;&nbsp;<a onclick="return confirmCancelRequest();" href="<?php echo ci_site_url().'Admin/UserWallet/cancelWalletDepositRequest/'.ID_encode($request->id);?>">
                                  <i class="fa fa-times" aria-hidden="true" style="color:#b61200;"></i></a>
                              <!--<ul class="dropdown-menu dropdown-menu-right">
                                 <li>
                                 </li>
                                 <li></li>
                              </ul>-->
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <?php       
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
                  <h6 class="card-title">Total Deposit Request Pending Amount</h6>
               </div>
               <div class="card-body">
                  <?php echo currency()." ".$total_deposit_request_pending_amount;?>
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
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->

<script>
function confirmApproval()
{

   if(window.confirm('Are you sure, you want to approve deposit request'))
      return true;
   else 
      return false;
}
function confirmCancelRequest()
{

   if(window.confirm('Are you sure, you want to cancel deposit request'))
      return true;
   else 
      return false;
}
</script>