<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Pin Management</span> - Approved E-Pin Request</h4>
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
            <li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">E-Pin Management</a></li>
            <li class="active">Approved E-Pin Request</li>
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
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Approved E-Pin Request</h5>
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
                     <th>No of Pin Requested</th>
                     <th>Request Date</th>
                     <th>Response Date</th>
                     <th>Package Of Pin</th>
                     <th>Amount</th>
                     <th>View Payment Proof</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $total_pin_amount=0;
                     if(!empty($all_approved_request) && count($all_approved_request)>0)
                     {
                        $sno=0;
                        foreach ($all_approved_request as $request) 
                        {
                           $sno++;
                           $total_pin_amount=$total_pin_amount+$request->epin_amount;
                     ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $request->request_id;?></td>
                     <td><?php echo $request->user_id;?></td>
                     <td><?php echo $request->username;?></td>
                     <td><?php echo $request->no_of_epin;?></td>
                     <td><?php echo date(date_formats(),strtotime($request->request_date));?></td>
                     <td><?php echo date(date_formats(),strtotime($request->response_date));?></td>
                     <td><?php echo $request->title;?></td>
                     <td><?php echo currency()." ".$request->epin_amount;?></td>
                     <td><a href="<?php echo ci_site_url();?>images/<?php echo $request->bank_wire_proof_image;?>" target="_blank">View Proof</a></td>
                     <td><span class="label label-success">Approved Request</span></td>
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
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Amount</h6>
               </div>
               <div class="panel-body">
                  <?php 
                     echo currency()." ".$total_pin_amount;
                     ?>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-flat border-left-xlg border-left-success">
               <div class="panel-heading">
                  <h6 class="panel-title"><span class="text-semibold">Graph </span> </h6>
               </div>
               <div class="panel-body">
                  Graph will be displayed here
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
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->