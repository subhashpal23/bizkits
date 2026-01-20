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
               <h5 class="card-title">Active Payout</h5>
             </div>
             <form class="new-added-form" action="<?php echo ci_site_url();?>Admin/Member/updatePersonalInformation/<?php echo ID_encode($user_id);?>" method='post' enctype='multipart/form-data'>
                               <div class="row">
                                <div class="col-xl-3 form-group">
                                    <select name='payout' id='payout' class="form-control">
                                        <option value="">Select Payout</option>
                                        <?php
                                        foreach($all_payout as $key=>$val)
                                        {
                                            if($payout_id==$val->id)
                                            {
                                                $sel="selected";
                                            }
                                            else
                                            {
                                                $sel="";
                                            }
                                            echo "<option value='".$val->id."' ".$sel.">".$val->payout_date."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-3 form-group">
                                    <button type="button" id="search" onclick="pageopen('search')" class="btn btn-primary">Search</button>
                                    <button type="button" id="export" onclick="pageopen('export')"  class="btn btn-info">Export</button>
                                </div>
                               
                                <div class="col-xl-3 form-group">
                                    <a href="<?php echo base_url();?>Admin/PayoutReport/createNewPayout">Make New Payout Today</a>
                                </div>
                                <div class="col-xl-3 form-group">
                                    <a href="<?php echo base_url();?>Admin/PayoutReport/processCsv">Get new person update bank details</a>
                                </div>
                            </div>
             </form>
          </div>
      </div>
      <div class="row">
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title">Active Payout</h5>
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
                     <th>Request Id</th>
                     <th>Member Name</th>
                     <th>User Id</th>
                     <th>Request Date</th>
                     <th>Response Date</th>
                     <th>Amount</th>
                     <th>Status</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_active_payout) && count($all_active_payout)>0)
                  {
                     $sno=0;
                     $total_payout_amount=0;
                     $total_no_of_active_payout=count($all_active_payout);
                     foreach($all_active_payout as $payout)
                     {
                        $sno++;
                        $total_payout_amount=$total_payout_amount+$payout->request_amount;
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $payout->request_id;?></td>
                     <td><?php echo $payout->username;?></td>
                     <td><?php echo $payout->user_id;?></td>
                     <td><?php echo date(date_formats(),strtotime($payout->request_date));?></td>
                     <td><?php echo date(date_formats(),strtotime($payout->response_date));?></td>
                     <td><?php echo currency()."".$payout->request_amount;?></td>
                     <td><span class="label label-danger">Released</span></td>
                     
                  </tr>
                  <?php       
                     }//end foreach
                  }//end if
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="card card-body bg-green-400 has-bg-image">
            <div class="media no-margin-top content-group">
               <div class="media-body">
                  <h6 class="no-margin text-semibold">Payout Request</h6>
                  <span class="text-muted"><?php echo (!empty($total_no_of_active_payout))?$total_no_of_active_payout:0;?> Requests</span>
               </div>
               <div class="media-right media-middle">
                  <i class="icon-coins icon-2x"></i>
               </div>
            </div>
            
            <?php 
            echo currency()." ";
            echo (!empty($total_payout_amount))?$total_payout_amount:0;
            ?>
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
function pageopen(type)
{
    var payout=document.getElementById('payout').value;
    if(type=='search')
    {
        window.location.href='<?php echo base_url();?>Admin/PayoutReport/activePayout/'+payout;   
    }
    if(type=='export')
    {
        window.location.href='<?php echo base_url();?>Admin/PayoutReport/exportPayout/'+payout;   
    }
}//end function
function cancelPayoutConfirm()
{
   if(window.confirm('Are you sure, you want to cancel the payout'))
   {
      return true;
   }
   else 
   {
      return false;
   }
}//end function
function releasePayoutConfirm()
{
   if(window.confirm('Are you sure, you want to release the payout'))
   {
      return true;
   }
   else 
   {
      return false;
   }
}
</script>