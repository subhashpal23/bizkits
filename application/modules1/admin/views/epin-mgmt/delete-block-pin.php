<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Pin Management</span> - Delete/Block E-Pin</h4>
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
            <li class="active">Delete/Block E-Pin</li>
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
               <h5 class="panel-title">Delete/Block E-Pin</h5>
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
            <div class="col-md-12">
               <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <!--<span class="text-semibold">Well done!</span> Epin is blocked successfully-->
                  <?php echo $this->session->flashdata('flash_msg');?>
               </div>
            </div>
            <?php   
               }
               ?>
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>E-Pin No</th>
                     <th>Username</th>
                     <th>Package Of Pin</th>
                     <th>Amount</th>
                     <th>Epin Status</th>
                     <th>Member Status</th>
                     <th>Assigned Date</th>
                     <th>Blocked Date</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $total_pin_amount=0;
                     if(!empty($all_blocked_epin) && count($all_blocked_epin)>0)
                     {
                        $sno=0;
                        foreach ($all_blocked_epin as $epin) 
                        {
                           $sno++;
                           $total_pin_amount=$total_pin_amount+$epin->pkg_amount;
                           $member_status=($epin->active_status=='1')?'Active':'Inactive';
                           $member_status_class=($epin->active_status=='1')?'label-success':'label-danger';
                     ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $epin->epin_code;?></td>
                     <td><?php echo $epin->username;?></td>
                     <td><?php echo $epin->title;?></td>
                     <td><?php echo currency()." ".$epin->pkg_amount;?></td>
                     <td><span class="label label-danger">Blocked</span></td>
                     <td><span class="label <?php echo $member_status_class;?>"><?php echo $member_status;?></span></td>
                     <td><?php echo date(date_formats(),strtotime($epin->create_date));?></td>
                     <td><?php echo date(date_formats(),strtotime($epin->blocked_date));?></td>
                     <td class="text-center">
                        <ul class="icons-list">
                           <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="icon-menu9"></i>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-right">
                                 <li><a href="<?php echo ci_site_url();?>admin/epin/deleteEpin/<?php echo ID_encode($epin->id);?>"><i class="icon-thumbs-up2"></i>Delete Pin</a></li>
                                 <li><a href="<?php echo ci_site_url();?>admin/epin/unBlockEpin/<?php echo ID_encode($epin->id);?>"><i class="icon-file-excel"></i> Unblock E-Pin</a></li>
                              </ul>
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
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Block Epin Amount</h6>
               </div>
               <div class="panel-body">
                  <?php echo currency()." ".$total_pin_amount;?>
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