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
         <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo $order_data['total_order']; ?></h3>
                     <span class="text-uppercase">Total Order</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['pending_order']; ?></h3>
                     <span class="text-uppercase">Total Pending Order</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['confirmed_order']; ?></h3>
                     <span class="text-uppercase">Total Confirmed Order</span>
                  </div>
               </div>
            </div>
         </div>
		 <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['rejected_order']; ?></h3>
                     <span class="text-uppercase">Total Rejected Order</span>
                  </div>
               </div>
            </div>
         </div>
		 <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['delivered_order']; ?></h3>
                     <span class="text-uppercase">Total Delivered Order</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
	
    
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->