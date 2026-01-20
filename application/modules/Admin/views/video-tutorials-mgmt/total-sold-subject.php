<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/gallery_library.js"></script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Video Tutorials Management</span> -Total sold subject</h4>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Video Tutorials Management</a></li>
            <li class="active">Total sold subject</li>
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
		<?php 
               if(!empty($this->session->flashdata('flash_msg')))
               {
               ?>
            <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <!--
                  <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
                  -->
               <?php 
                  echo $this->session->flashdata('flash_msg');
                  ?>
            </div>
            <?php    
               }
            ?>
      <!-- Media library -->
      <div class="panel panel-white">
         <div class="panel-heading">
            <h6 class="panel-title text-semibold">Total sold subject</h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
            
         <table class="table table-striped media-library table-lg">
            <thead>
               <tr>
                  <th>S.No</th>
				  <th>Teacher name</th>
				  <th>Subject Title</th>
				  <th>Subject Image</th>
				  <th>Subject Fees</th>
				  <th>Username</th>
				  <th>Payment Method</th>
				  <th>Transaction No</th>
				  <th>Purchased Date</th>
               </tr>
            </thead>
            <tbody>
               <?php 
			   $total_sold_subject=0;
               if(!empty($all_subject) && count($all_subject)>0)
               {
                  $sno=0;
                  foreach ($all_subject as $subject) 
                  {
                    $sno++; 
					$total_sold_subject=$total_sold_subject+$subject->subject_fees;
               ?>
               <tr>
                  <td><?php echo $sno;?></td>
				  <td><?php echo $subject->teacher_name;?></td>
				  <td><?php echo $subject->subject_name;?></td>
				  <td><img width="100" src="<?php echo base_url();?>images/<?php echo $subject->subject_image;?>"></td>
				  <td><?php echo $subject->subject_fees;?></td>
				  <td><?php echo $subject->username;?></td>
				  <td><span class="label label-success"><?php echo $subject->payment_method;?></span></td>
				  <td><?php echo $subject->transaction_no;?></td>
				  <td><?php echo date(date_formats(),strtotime($subject->purchase_date));?></td>
			  </tr>	  
               <?php
                  }
               }
               ?>
            </tbody>
         </table>
		 
      </div>
	  <div class="row">
	  <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Money Of Sold Subject </h6>
               </div>
               <div class="panel-body">
                  <?php echo currency()." ".$total_sold_subject;?>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total No. of Sold </h6>
               </div>
               <div class="panel-body">
                  <?php echo $sno;?>
               </div>
            </div>
         </div>
		 
      </div>
      <!-- /media library -->
      <!-- Footer -->
      <?php $this->load->view("common/footer-text");?>
      <!-- /footer -->
   </div>
   
   <!-- /content area -->
</div>
<!-- /main content -->
