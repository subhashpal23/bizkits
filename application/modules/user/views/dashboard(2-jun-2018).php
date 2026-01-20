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
         <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
         <li class="active">Dashboard</li>
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
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-blue-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-body">
               <h6 class="no-margin text-semibold">MY Total Commission</h6>
               <span class="text-muted"><?php echo currency()." ".$total_commission;?></span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
         <div class="progress progress-micro bg-blue mb-10">
            <div class="progress-bar bg-white" style="width: 100%">
               <span class="sr-only">67% Complete</span>
            </div>
         </div>
         <?php 
         if($enabled_commission['direct_commission'])
         {
         ?>
         Direct Commission&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo currency()." ".$total_direct_commission;?><br>
         <?php     
         }
         if($enabled_commission['unilevel_commission'])
         {
         ?>
         Unilevel Commission&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo currency()." ".$total_unilevel_commission;?><br>
         <?php   
         }
         if($enabled_commission['binary_commission'])
         {
         ?>
         Binary Commission&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo currency()." ".$total_binary_commission;?><br>
         <?php   
         }
         if($enabled_commission['matching_commission'])
         {
         ?>
         Matching Commission&nbsp;:&nbsp;<?php echo currency()." ".$total_matching_commission;?><br>
         <?php    
         }
         ?>
      </div>
   </div>
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-blue-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-body">
               <h6 class="no-margin text-semibold">Sign Up Bonus</h6>
               <span class="text-muted"><?php echo currency()." ".$signup_bonus;?></span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
         <div class="progress progress-micro bg-blue mb-10">
            <div class="progress-bar bg-white" style="width: 100%">
               <span class="sr-only">67% Complete</span>
            </div>
         </div>
         
      </div>
   </div>
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-success-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-left media-middle">
               <i class="icon-users4 icon-2x"></i>
            </div>
            <div class="media-body">
               <h6 class="no-margin text-semibold">My Team Member</h6>
               <span class="text-muted"><?php echo $total_team_member;?></span>
            </div>
         </div>
         <div class="progress progress-micro mb-10 bg-success">
            <div class="progress-bar bg-white" style="width: 100%">
               <span class="sr-only">100% Complete</span>
            </div>
         </div>
         <span class="pull-right">Direct Member : <?php echo $total_direct_member;?></span>
         Team Member : <?php echo $total_team_member;?>
      </div>
   </div>
   
</div>
<!-- /inside tabs -->
<!--Wallet Balance -->
<div class="row">
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-danger-400 has-bg-image">
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
<!--Wallet Balance -->
<!--my profile -->
<div class="row">
   <div class="col-sm-6 col-lg-6">
      <!-- User details (with sample pattern) -->
      <div class="content-group">
         <div class="panel-body bg-blue border-radius-top text-center" style="background-image: url(images/bg.png); background-size: contain;">
            <div class="content-group-sm">
               <h5 class="text-semibold no-margin-bottom">
                  My Profile
               </h5>
               <h5 class="text-semibold no-margin-bottom">
                  <?php echo $user_details->username ;?>
               </h5>
               <span class="display-block">My User Id : <?php echo $user_details->user_id;?></span>
            </div>
            <a href="#" class="display-inline-block content-group-sm">
            <img src="<?php echo base_url();?>images/face6.jpg" class="img-circle img-responsive" alt="" style="width: 120px; height: 120px;">
            </a>
            <ul class="list-inline no-margin-bottom">
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-phone"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-bubbles4"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-envelop4"></i></a></li>
            </ul>
         </div>

         <div class="panel panel-body no-border-top no-border-radius-top">
            <div class="form-group mt-5">
               <label class="text-semibold">Full name:</label>
               <span class="pull-right-sm"><?php echo $user_details->username;?></span>
            </div>
            <div class="form-group">
               <label class="text-semibold">Phone number:</label>
               <span class="pull-right-sm"><?php echo $user_details->contact_no;?></span>
            </div>
            <div class="form-group no-margin-bottom">
               <label class="text-semibold">Personal Email:</label>
               <span class="pull-right-sm"><a href="#"><?php echo $user_details->email;?></a></span>
            </div>
         </div>
      </div>
      <!-- /user details (with sample pattern) -->
   </div>
   <div class="col-sm-6 col-lg-6">
      <!-- User details (with sample pattern) -->
      <div class="content-group">
         <div class="panel-body bg-blue border-radius-top text-center" style="background-image: url(images/bg.png); background-size: contain;">
            <div class="content-group-sm">
               <h5 class="text-semibold no-margin-bottom">
                  My Sponsor Detail
               </h5>
               <h5 class="text-semibold no-margin-bottom">
                  <?php echo (!empty($sponsor_details->username))?$sponsor_details->username:'none';?>
               </h5>
               <span class="display-block">Sponsor User Id : <?php echo (!empty($sponsor_details->user_id))?$sponsor_details->user_id:'none';?></span>
            </div>
            <a href="#" class="display-inline-block content-group-sm">
            <img src="<?php echo base_url();?>images/face6.jpg" class="img-circle img-responsive" alt="" style="width: 120px; height: 120px;">
            </a>
            <ul class="list-inline no-margin-bottom">
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-phone"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-bubbles4"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-envelop4"></i></a></li>
            </ul>
         </div>
         <div class="panel panel-body no-border-top no-border-radius-top">
            <div class="form-group mt-5">
               <label class="text-semibold">Full name:</label>
               <span class="pull-right-sm"><?php echo (!empty($sponsor_details->username))?$sponsor_details->username:'none';?></span>
            </div>
            <div class="form-group">
               <label class="text-semibold">Phone number:</label>
               <span class="pull-right-sm"><?php echo (!empty($sponsor_details->contact_no))?$sponsor_details->contact_no:'none';?></span>
            </div>
            <div class="form-group no-margin-bottom">
               <label class="text-semibold">Personal Email:</label>
               <span class="pull-right-sm"><a href="#"><?php echo (!empty($sponsor_details->email))? $sponsor_details->email:'none';?></a></span>
            </div>
         </div>
      </div>
      <!-- /user details (with sample pattern) -->
   </div>
</div>
<!--My profile-->
<!-- Graph-->
<div class="row">
   <div class="col-md-6 col-sm-6">
      <div class="panel panel-warning">
         <div class="panel-heading">
            <h6 class="panel-title">Joining Graph<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
            Default panel using <code>.panel-default</code> class
         </div>
      </div>
   </div>
   <div class="col-md-6 col-sm-6">
      <div class="panel panel-success">
         <div class="panel-heading">
            <h6 class="panel-title">Earning Graph<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
            Success panel using <code>.panel-success</code> class
         </div>
      </div>
   </div>
</div>
<!--Graph-->
<!-- Recent Joining-->
<div class="row">
   <div class="col-md-6 col-sm-6">
      <div class="panel panel-success">
         <div class="panel-heading">
            <h6 class="panel-title">Recent Joining<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
            <div class="panel panel-body">
               <div class="media">
                  <div class="media-left">
                     <a href="images/3.png">
                     <img src="images/face2.jpg" style="width: 70px; height: 70px;" class="img-circle img-md" alt="">
                     </a>
                  </div>
                  <div class="media-body">
                     <h6 class="media-heading">Nathan Jacobson</h6>
                     <p class="text-muted">Lead UX designer</p>
                     <ul class="icons-list">
                        <li><a href="#" data-popup="tooltip" data-container="body" title="" data-original-title="Google Drive"><i class="icon-google-drive"></i></a></li>
                        <li><a href="#" data-popup="tooltip" data-container="body" title="" data-original-title="Twitter"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" data-popup="tooltip" data-container="body" title="" data-original-title="Github"><i class="icon-github"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-sm-6">
      <div class="panel panel-success">
         <div class="panel-heading">
            <h6 class="panel-title">Recent News<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
            Success panel using <code>.panel-success</code> class
         </div>
      </div>
   </div>
</div>
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