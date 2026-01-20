<?php 
$moduleName=$this->router->fetch_module();
$controllerName=$this->router->fetch_class();
$actionName=$this->router->fetch_method();
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>School| Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/flaticon.css">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datepicker.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/style.css">
    <!-- Modernize js -->
    <script src="<?php echo base_url();?>assets/js/modernizr-3.6.0.min.js"></script>
</head>
<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
       <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <a href="index.html">
                        <img src="<?php echo base_url();?>assets/img/logo.png" alt="logo" style="width:150px;">
                    </a>
                </div>
                 <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
               <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title"><?php echo $this->session->userdata('username');?></h5>
                                <span>School</span>
                            </div>
                            <div class="admin-img">
                                <img src="<?php echo base_url();?>assets/img/figure/admin.jpg" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title"><?php echo $this->session->userdata('username');?></h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="<?php echo base_url();?>School/Auth/logout"><i class="flaticon-turn-off"></i>Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    
                   
                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
               <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="<?php echo base_url();?>School"><img src="<?php echo base_url();?>assets/img/logo1.png" alt="logo"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item ">
                            <a href="<?php echo base_url();?>School" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
                            
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-dashboard"></i><span>Upload Documents</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>School/allDocuments" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        Documents</a>
                                </li>
                                <!--<li class="nav-item">
                                    <a href="<?php echo base_url();?>School/Students/addStudent" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Upload</a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Students</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>School/Students/allStudents" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        Students</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>School/Students/addStudent" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Add Student</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Marketing Tools</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>School/MarketingTools/viewReferralLinks" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Referal Link</a>
                                </li>
                               <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>School/MarketingTools/viewAllImages" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Images</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>School/MarketingTools/viewAllVideo" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Videos</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li  class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Study Material</span></a>
                  <ul class="nav sub-group-menu">
				    <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/" class="nav-link"><i
                                            class="fas fa-angle-right"></i> <span>Eshop Dashboard</span></a></li>
                    <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allCategoryList" class="nav-link"><i
                                            class="fas fa-angle-right"></i> <span>Category</span></a></li>
                    <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allSubCategoryList" class="nav-link"><i
                                            class="fas fa-angle-right"></i> <span>Sub Category</span></a></li>-->
                    
					 
					<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allProductList" class="nav-link"><i
                                            class="fas fa-angle-right"></i> <span>Products</span></a></li>
					 
                  </ul>
               </li>
               <li  class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Order Management</span></a>
                  <ul class="nav sub-group-menu">
				    <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allOrders" class="nav-link"><i
                                            class="fas fa-angle-right"></i> <span>All Order</span></a></li>
                    
                    
					 
					
					 
                  </ul>
               </li>
               
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Advertisement</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>school" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        Teachers</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>school" class="nav-link"><i
                                            class="fas fa-angle-right"></i>All Advertisement</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>school" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                        New</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->