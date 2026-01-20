<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/dashboard.js"></script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="home.html"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Dashboard</li>
         </ul>
         <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="icon-gear position-left"></i>
               Settings
               <span class="caret"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> This Week Registered</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> This Month Registered</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> This Year Registered</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> View All Member</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Main charts -->
      <div class="row">
         <div class="col-sm-3 col-md-3">
            <div class="panel panel-body bg-danger-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo $member_registered_today;?></h3>
                     <span class="text-uppercase text-size-mini">Member Registered Today</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-3 col-md-3">
            <div class="panel panel-body bg-warning-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $this_week_registered_member;?></h3>
                     <span class="text-uppercase text-size-mini">Member Registered This Week</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-pink-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $this_month_registered_member;?></h3>
                     <span class="text-uppercase text-size-mini">Member Registered This Month</span>
                  </div>
               </div>
            </div>
         </div>
		 <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-warning-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $total_registered_member;?></h3>
                     <span class="text-uppercase text-size-mini">Total Registered Member</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Inside tabs -->
      <div class="row">
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body bg-danger-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo currency()." ".$total_invest_amount;?></h3>
                     <span class="text-uppercase text-size-mini">Total Investment</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class=" icon-task icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body bg-warning-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo currency()." ".$total_company_profit;?></h3>
                     <span class="text-uppercase text-size-mini">Total Company Profit</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
 <div class="row">
   <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-danger-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$total_company_daily_income;?></h3>
               <span class="text-uppercase text-size-mini">Company Daily Income</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
    <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-success-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$total_company_level_commission;?></h3>
               <span class="text-uppercase text-size-mini">Company Level Income</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-info-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$total_company_binary_commission;?></h3>
               <span class="text-uppercase text-size-mini">Company Binary Bonus</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
    
    <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-warning-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$company_gross_commission;?></h3>
               <span class="text-uppercase text-size-mini">Company Gross Bonus</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-danger-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$total_all_member_daily_income;?></h3>
               <span class="text-uppercase text-size-mini">All Member Daily Income</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
    <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-info-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$total_all_member_level_commission;?></h3>
               <span class="text-uppercase text-size-mini">All Member Level Income</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>

   <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-warning-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$total_all_member_binary_commission;?></h3>
               <span class="text-uppercase text-size-mini">All Member Binary Income</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
    
    <div class="col-sm-3 col-md-3">
      <div class="panel panel-body bg-success-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$all_user_gross_commission;?></h3>
               <span class="text-uppercase text-size-mini">All Member Gross Income</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
</div>
	  <div class="row">
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body bg-blue-400 has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Payout Request</h6>
                     <span class="text-muted"><?php echo $total_payout_request;?> Requests</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-coins icon-2x"></i>
                  </div>
               </div>
               <div class="progress progress-micro bg-blue mb-10">
                  <div class="progress-bar bg-white" style="width: 100%">
                     <span class="sr-only"><?php echo $total_payout_request_completion_rate;?>% Complete</span>
                  </div>
               </div>
               <?php echo currency()." ".$total_payout_request_amount;?>
            </div>
         </div>
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body bg-success-400 has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-check icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Success Payout</h6>
                     <span class="text-muted"><?php echo $total_completed_payout_request;?></span>
                  </div>
               </div>
               <div class="progress progress-micro mb-10 bg-success">
                  <div class="progress-bar bg-white" style="width: 100%">
                     <span class="sr-only"><?php echo $total_payout_request_completion_rate;?>% Complete</span>
                  </div>
               </div>
               <?php echo currency()." ".$total_completed_payout_request_amount;?>
            </div>
         </div>
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body bg-indigo-400 has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-notice icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Pending Payout</h6>
                     <span class="text-muted"><?php echo $total_pending_payout_request;?></span>
                  </div>
               </div>
               <div class="progress progress-micro mb-10 bg-indigo">
                  <div class="progress-bar bg-white" style="width: 100%">
                     <span class="sr-only"><?php echo $total_payout_request_pending_rate;?>% Pending</span>
                  </div>
               </div>
               <span class="pull-right"> </span>
               <?php echo currency()." ".$total_pending_payout_request_amount;?>
            </div>
         </div>
      </div>
      <!-- /inside tabs -->
      <!--Wallet Balance -->
      
      <!--Wallet Balance -->
      <div class="row">
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body bg-blue-400 has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Open Ticket</h6>
                     <span class="text-muted"><?php echo $total_open_ticket;?> Requests</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class=" icon-arrow-down-right32 icon-2x"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body bg-success-400 has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-check icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Closed Ticket</h6>
                     <span class="text-muted"><?php echo $total_closed_ticket;?></span>
                  </div>
               </div>
            </div>
         </div>
         <!--
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body bg-indigo-400 has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-notice icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Pending Ticket</h6>
                     <span class="text-muted">5</span>
                  </div>
               </div>
            </div>
         </div>
         -->
      </div>
      <!-- Graph-->
     
      <!--Graph-->
      <!-- /main charts -->
      <!-- Dashboard content -->
      <!-- /dashboard content -->
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<style>
/*.panel {
    background-color: #f01618;
    border-color: #ef5350;
    color: #fff;
}*/
</style>