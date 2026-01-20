<!-- Main content -->
<div class="content-wrapper">
<!-- Page header -->
<div class="page-header">
   <div class="page-header-content">
      <div class="page-title">
         <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
      </div>
   </div>
   <div class="breadcrumb-line">
      <ul class="breadcrumb">
         <li><a href="<?php echo base_url();?>"><i class="icon-home2 position-left"></i> Home</a></li>
         <li class="active">Dashboard</li>
         <li><a href="<?php echo base_url();?>user/auth/logout"><i class="icon-user position-left"></i> Logout</a></li>
      </ul>
   </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
<!-- Main charts -->
<div class="row">
</div>
<!-- /main charts -->
<!-- Dashboard content -->
<div class="row">

                    <ul> <li>&nbsp;&nbsp;
			<input type="text" style="width:65%" value="<?php echo $referral_link;?>" class="form-control btn btn-primary" id="ref">
			&nbsp;
			<a href="javascript:void();" id="copyy" onclick="myFunction()" class="btn btn-success">Copy Referral Link</a></li></ul>
			    </div>
<div class="row">
   
   <div class="col-sm-4 col-md-4">
      <div class="panel panel-body bg-info-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$ewallet_balance;?></h3>
               <span class="text-uppercase text-size-mini">My Wallet Balance</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-wallet icon-3x opacity-75"></i>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-4 col-md-4">
      <div class="panel panel-body bg-info-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$daily_income_amount;?></h3>
               <span class="text-uppercase text-size-mini">My Investment(<?php echo $daily_income_name;?>)</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-wallet icon-3x opacity-75"></i>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-4 col-md-4">
      <div class="panel panel-body bg-warning-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$level_commission;?></h3>
               <span class="text-uppercase text-size-mini">My Daily Trading Income</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
    <!--<div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-primary-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$gross_commission;?></h3>
               <span class="text-uppercase text-size-mini">My Gross Bonus</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>-->
</div>
<div class="row">
   
   
   <!--<div class="col-sm-4 col-md-4">
      <div class="panel panel-body bg-warning-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo $rank_name;?></h3>
               <span class="text-uppercase text-size-mini">My Rank</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-pulse2 icon-2x icon-3x opacity-75"></i>
            </div>
         </div>
      </div>
   </div>-->
   
   
</div>

<div class="row">
   
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-success-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-left media-middle">
               <i class="icon-users4 icon-2x"></i>
            </div>
            <div class="media-body">
               <h6 class="no-margin text-semibold">My Team Member</h6>
               <span class="text-muted"><?php echo $total_direct_member;?></span>
            </div>
         </div>
         
         
      </div>
   </div>
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-warning-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-left media-middle">
               <i class="icon-pointer icon-3x opacity-75"></i>
            </div>
            <div class="media-body text-right">
               <h3 class="no-margin"><?php echo currency()." ".$payout_in_process;?></h3>
               <span class="text-uppercase text-size-mini">Payout in Process</span>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-pink-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-left media-middle">
               <i class="icon-enter6 icon-3x opacity-75"></i>
            </div>
            <div class="media-body text-right">
               <h3 class="no-margin"><?php echo currency()." ".$payout_success;?></h3>
               <span class="text-uppercase text-size-mini">Payout Success</span>
            </div>
         </div>
      </div>
   </div>
   
</div>
<!--<div class="row">
    <h3 class="box-title">Daily Trading Income History(<?php echo ucfirst($daily_income_name).' Income';?>)</h3>
    <?php
    $daily_income_upto;
    $daily_income_per;
    $daily_income_amount;
    $count=floor($daily_income_upto/$daily_income_per);
    $daily_roi=($daily_income_amount*$daily_income_per)/100;
    ?>
     <table class="table table-sm table-striped table-hover">
                        <thead>
                        <tr>
                           <th>Sr.No</th>
                           <th>Amount</th>
                           <th>Daily Trading Income</th>
                           <th>%</th>
                           <th>Date</th>
                           <th>Status</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                           <?php 
                                $array=array('Pending','Paid');
                                $array1=array('red','green');
                              $sno=1;
                              for($i=1;$i<=$count;$i++)
                              {
                                //
                                $request_date1=date('Y-m-d', strtotime($request_date. ' + '.$i.' days'));
                                $status=$callfunc->getROIStatus($deposit_id,$request_date1);
                                $bg=$array1[$status];
                                $statusname=$array[$status];
                               ?>
                               <tr style="color:<?php echo $bg;?>">
                                  <td><?php echo $sno;?></td>
                                  <td><?php echo $daily_income_amount;?></td>
                                  <td><?php echo $daily_roi;?></td>
                                  <td><?php echo $daily_income_per;?></td>
                                  <td><?php echo date(date_formats(),strtotime($request_date1));?></td>
                                  <td><?php echo $statusname;?></td>
                               </tr>                           
                               <?php       
                                  $sno++;
                              }//end foreach here!
                           
                           ?>
                        </tbody>
                     </table>
</div>-->
<!-- /inside tabs -->
<!--Wallet Balance -->

<!--Wallet Balance -->
<!--my profile -->

<!--My profile-->
<!-- Graph-->

<!--Graph-->
<!-- Recent Joining-->

<!--Recent Joining-->
<!-- /main charts -->
<!-- Dashboard content -->
<!-- /dashboard content -->          <!-- /dashboard content -->
<!-- Footer -->
<?php
  $this->load->view("common/footer-text");
?>
<!-- /footer -->
</div>
<!-- /content area -->
</div>
<style>
/*.panel {
    background-color: #f01618;
    border-color: #ef5350;
    color: #fff;
}*/
</style>
<script>

function myFunction() 
{
  /* Get the text field */
  var copyText = document.getElementById("ref");

 
  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Your Referral Link is copied");
}
$(document).ready(function(){
    $("#ref").click(function()
	{
        var url=$(this).val();
		window.open(url,'_blank');
    });
});

</script>