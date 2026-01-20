<!DOCTYPE html>
<html lang="en">
  <?php echo $this->load->view('common/header-script');?>
   <body>
      <?php 
      $admin=getProfileInfo();
      //pr($admin);
      ?>
      <!-- Main navbar -->
     <div class="navbar navbar-inverse">
         <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo ci_site_url();?>admin"><?php echo $admin->panel_title;?></a>
            <ul class="nav navbar-nav visible-xs-block">
               <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
               <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
         </div>
         <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
               <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
               <li class="dropdown">
                 
                  <div class="dropdown-menu dropdown-content">
                     <div class="dropdown-content-heading">
                        New Member
                        <ul class="icons-list">
                           <li><a href="#"><i class="icon-sync"></i></a></li>
                        </ul>
                     </div>
                     <ul class="media-list dropdown-content-body width-350">
                        <li class="media">
                           <div class="media-left">
                              <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-user-check"></i></a>
                           </div>
                           <div class="media-body">
                              User Name
                              <div class="media-annotation">4 minutes ago</div>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-left">
                              <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-user-check"></i></a>
                           </div>
                           <div class="media-body">
                              User Name
                              <div class="media-annotation">36 minutes ago</div>
                           </div>
                        </li>
                        
                       
                       
                     </ul>
                     <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="View All Registered Member"><i class="icon-menu display-block"></i></a>
                     </div>
                  </div>
               </li>
            </ul>
            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>
            <ul class="nav navbar-nav navbar-right">
               
              
               <li class="dropdown dropdown-user">
                  <a class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>images/<?php echo $admin->image;?>" alt="">
                  <span><?php echo $admin->username;?></span>
                  <i class="caret"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right">
                     <li><a href="<?php echo ci_site_url();?>admin/account/profileManagement"><i class="icon-user-plus"></i> My profile</a></li>
                     <li><a href="<?php echo ci_site_url();?>admin/AdminWallet/viewEwalletBalance"><i class="icon-coins"></i> My Wallet balance</a></li>
                     
                     <li class="divider"></li>
                     <li><a href="<?php echo ci_site_url();?>admin/account/changePassword"><i class="icon-loop"></i> Change Password</a></li>
                     <li><a href="<?php echo ci_site_url();?>admin/auth/logout"><i class="icon-switch2"></i> Logout</a></li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
      <!-- /main navbar -->
      <!-- Page container -->
      <div class="page-container">
         <!-- Page content -->
         <div class="page-content">
            <!-- Main sidebar -->
            <?php 
            $this->load->view('common/sidebar');
            ?>
            <!-- /main sidebar -->
      