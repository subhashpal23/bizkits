<?php
$moduleName='Admin';
$admin=getProfileInfo();
//echo $_SERVER['REQUEST_URI'];
if($admin->type=='sub_admin' && ($_SERVER['REQUEST_URI']=='/Admin' || $_SERVER['REQUEST_URI']=='/Admin/'))
{
    header("Location:".base_url()."Admin/Eshop_orders/allOrders"); 
}

?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bizkits| Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>frontassets/images/logo.png">
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
                    <a href="<?php echo base_url();?>Admin">
                        <img src="<?php echo base_url();?>frontassets/images/logo.png" alt="logo" style="width:150px;">
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
                                <span>Admin</span>
                            </div>
                            <div class="ad,in-img">
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
                                    <li><a href="<?php echo base_url();?>Admin/Auth/logout"><i class="flaticon-turn-off"></i>Log Out</a></li>
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
                        <a href="<?php echo base_url();?>Admin"><img src="<?php echo base_url();?>frontassets/images/logo.png" alt="logo"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <?php
                        if($admin->type!='sub_admin')
                        {
                        ?>
                        <li class="nav-item ">
                            <a href="<?php echo base_url();?>Admin" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
                            
                        </li>
                        <!--<li class="nav-item sidebar-nav-item">
                           <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Bank Wire Member Report</span></a>
                            <ul class="nav sub-group-menu">
                             <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/BankWireMemberReport/bankWireDetail" class="nav-link"><i class="fas fa-angle-right"></i>Bank Wire Detail</a></li>

                             <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/BankWireMemberReport/pendingMember" class="nav-link"><i class="fas fa-angle-right"></i>Pending Member</a></li>
                             
                             <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/BankWireMemberReport/approvedMember" class="nav-link"><i class="fas fa-angle-right"></i>Approved Member</a></li>

                             <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/BankWireMemberReport/cancelledMember" class="nav-link"><i class="fas fa-angle-right"></i>Cancelled Member</a></li>
                            
                           </ul>
                 </li>-->
                    <!--<li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span> Stockist Management</span></a>
                        <ul class="nav sub-group-menu">
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Stockist/allStockist" class="nav-link"><i class="fas fa-angle-right"></i> All Stockist</a></li>
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Stockist/addNewStockist" class="nav-link"><i class="fas fa-angle-right"></i> Add New Stockist</a></li>
                          <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allStockistOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Orders</a></li>
                        </ul>
                     </li>-->
                     <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Products Management</span></a>
                        <ul class="nav sub-group-menu">
                           <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/addNewCategory" class="nav-link"><i class="fas fa-angle-right"></i> Add New Categories</a></li>
                           -->
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allCategoryList" class="nav-link"><i class="fas fa-angle-right"></i>Categories</a></li>
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/addNewSubCategory" class="nav-link"><i class="fas fa-angle-right"></i>Add Sub Categories</a></li>
						   -->
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allSubCategoryList" class="nav-link"><i class="fas fa-angle-right"></i>Sub Categories</a></li>-->
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allSub2CategoryList" class="nav-link"><i class="fas fa-angle-right"></i>Level2 Sub Categories</a></li>-->
						   
                           <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/allProductList" class="nav-link"><i class="fas fa-angle-right"></i>Services</a></li>-->
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allProductList" class="nav-link"><i class="fas fa-angle-right"></i>Products</a></li>
                           <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/allProductList" class="nav-link"><i class="fas fa-angle-right"></i>Servic</a></li>
                           -->
                           <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/assignProductList" class="nav-link"><i class="fas fa-angle-right"></i>Assign Products</a></li>-->
                          <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allProductStock" class="nav-link"><i class="fas fa-angle-right"></i>View All Stocks</a></li>
                          -->
                        </ul>
                     </li>
                      <!--<li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Service Management</span></a>
                        <ul class="nav sub-group-menu">
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/addNewCategory" class="nav-link"><i class="fas fa-angle-right"></i> Add New Categories</a></li>
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/allCategoryList" class="nav-link"><i class="fas fa-angle-right"></i>View All Categories</a></li>
						   <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/addNewSubCategory" class="nav-link"><i class="fas fa-angle-right"></i>Add Sub Categories</a></li>
						   <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/allSubCategoryList" class="nav-link"><i class="fas fa-angle-right"></i>View Sub Categories</a></li>
						   
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/allProductList" class="nav-link"><i class="fas fa-angle-right"></i>View All Products</a></li>
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/ServiceProduct/enquirylist" class="nav-link"><i class="fas fa-angle-right"></i>Enquiry Lists</a></li>
                          
                        </ul>
                     </li>-->
                     
			 <!--  <li class="nav-item sidebar-nav-item">-->
    <!--              <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Eshop</span></a>-->
    <!--              <ul class="nav sub-group-menu">-->
				 
				<!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/ourStore" class="nav-link"><i class="fas fa-angle-right"></i>-->
    <!--                    Transfer Goods To Client</a></li>-->
    <!--                    <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/ourStoreRetopup" class="nav-link"><i class="fas fa-angle-right"></i>-->
    <!--                    Re-Topup</a></li>-->
                        
                        <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/ourStoreReturn" class="nav-link"><i class="fas fa-angle-right"></i>
                        Retun Goods</a></li>-->
                    <!--<li class="nav-item">
				      <a href="<?php echo site_url().$moduleName;?>/Eshop/StockistDashboard"  class="nav-link"><i class="fas fa-angle-right"></i> <span>E-Shop Dashboard</span></a>
				</li> -->
					 
					
					 
					 <!--<li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Eshop Advertisement</span></a>
                        <ul>
                           <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/eshop_adv/sliderImageList" class="nav-link"><i class="fas fa-angle-right"></i> All Slider Image</a></li>
						   
						    <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/eshop_adv/sliderSideImageList" class="nav-link"><i class="fas fa-angle-right"></i> Slider Right Side Image</a></li>
							
							  
						    <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/eshop_adv/bannerImageList" class="nav-link"><i class="fas fa-angle-right"></i> Banner Images</a></li>
						   
                          
                        </ul>
                     </li>-->
					 
                     
               <!--   </ul>-->
               <!--</li>-->
              
                       
               <?php
                        }
               ?>
               <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-angle-right"></i><span> Order Management</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Orders</a></li>
                           
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allReturnOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Returned</a></li>-->
         <!--                  <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/monthlyBill" class="nav-link"><i class="fas fa-angle-right"></i>-->
         <!--               Monthly Bill</a></li>-->
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allOrdersCommission" class="nav-link"><i class="fas fa-angle-right"></i>Commission</a></li>
						   -->
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allPendingOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Quotes</a></li>-->
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allConfirmedOrder" class="nav-link"><i class="fas fa-angle-right"></i> All Confirm Quotes</a></li>-->
						   <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allDeliveredOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Delivered Orders</a></li>
						   <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_orders/allRejectedOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Rejected Orders</a></li>-->
						</ul>
                     </li>
                     <?php
                     if($admin->type!='sub_admin')
                     {
                     ?>
               <!--<li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>User Wallet</span></a>
                        <ul class="nav sub-group-menu">
                           <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/UserWallet/userWalletBalance" class="nav-link"><i class="fas fa-angle-right"></i>User Wallet Balance</a></li>
                           <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/UserWallet/manageUserWallet" class="nav-link"><i class="fas fa-angle-right"></i> Manage User Wallet</a></li>
                           <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/UserWallet/pendingDepositRequestList" class="nav-link"><i class="fas fa-angle-right"></i> Pending Deposit Request</a></li>
                           <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/UserWallet/approvedDepositRequestList" class="nav-link"><i class="fas fa-angle-right"></i> Approved Deposit Request</a></li>
                           <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/UserWallet/cancelledDepositRequestList" class="nav-link"><i class="fas fa-angle-right"></i> Cancelled Deposit Request</a></li>
                        </ul>
                     </li>-->
                     
                <!--<li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Report Management</span></a>
                  <ul class="nav sub-group-menu">
                    <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/PayoutReport/activePayout" class="nav-link"><i class="fas fa-angle-right"></i> Active Payout</a></li>
                    <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/PayoutReport/rankPayout" class="nav-link"><i class="fas fa-angle-right"></i> Rank Payout</a></li>
                    
                   <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/CommissionReport/allCommission" class="nav-link"><i class="fas fa-angle-right"></i>Commission Reports</a></li>
                   
                   <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/CommissionReport/faststartCommission" class="nav-link"><i class="fas fa-angle-right"></i>Fast Start Reports</a></li>
                   
				   <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/CommissionReport/rankAchieverReport" class="nav-link"><i class="fas fa-angle-right"></i>Rank Achiever Report</a></li>
				   
                   <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/CommissionReport/topEarnerReport" class="nav-link"><i class="fas fa-angle-right"></i> Top Earner Report</a></li>
                   <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/CommissionReport/topRecruiterReport" class="nav-link"><i class="fas fa-angle-right"></i> Top Recruiter Report</a></li>
                  </ul>
               </li>-->
			   <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Expert Management</span></a>
                  <ul class="nav sub-group-menu">
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Expert/viewAllMember" class="nav-link"><i class="fas fa-angle-right"></i>All Experts</a></li>
                     
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Expert/blockUnblockMember" class="nav-link"><i class="fas fa-angle-right"></i>Block/Unblock Expert</a></li>
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Expert/passwordTracker" class="nav-link"><i class="fas fa-angle-right"></i>Expert Password</a></li>
                     
                  </ul>
               </li>
                <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Customer Management</span></a>
                  <ul class="nav sub-group-menu">
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Member/viewAllMember" class="nav-link"><i class="fas fa-angle-right"></i> My Customers</a></li>
                     
                     <!--<li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Member/activeMember" class="nav-link"><i class="fas fa-angle-right"></i> Active Member</a></li>
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Member/inactiveMember" class="nav-link"><i class="fas fa-angle-right"></i> Inactive Member</a></li>
                     -->
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Member/blockUnblockMember" class="nav-link"><i class="fas fa-angle-right"></i>Block/Unblock Customer</a></li>
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Member/passwordTracker" class="nav-link"><i class="fas fa-angle-right"></i>Customer Password</a></li>
                     
                  </ul>
               </li>
			   <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Company Details</span></a>
                  <ul class="nav sub-group-menu">
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/company" class="nav-link"><i class="fas fa-angle-right"></i>Company Profile</a></li>
                  </ul>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Message Panel</span></a>
                  <ul class="nav sub-group-menu">
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/MessagePanel/composeMessage" class="nav-link"><i class="fas fa-angle-right"></i>Compose Message</a></li>
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/MessagePanel/inbox" class="nav-link"><i class="fas fa-angle-right"></i>Inbox</a></li>
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/MessagePanel/sentMessage" class="nav-link"><i class="fas fa-angle-right"></i>Sent Message</a></li>
                  </ul>
               </li>
               
			   <!-- <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Google Meet</span></a>
                  <ul class="nav sub-group-menu">
                     <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/googlemeet" class="nav-link"><i class="fas fa-angle-right"></i>Meet Create</a></li>
                  </ul>
               </li> -->
               <!--<li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>Package Management</span></a>
                  <ul class="nav sub-group-menu">
                     
					 <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Package/addNewPackage"  class="nav-link"><i class="fas fa-angle-right"></i> Add Package</a></li>
                     
					 <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Package/allPackages" class="nav-link"><i class="fas fa-angle-right"></i> All/Edit Package</a></li>
                  </ul>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="fas fa-angle-right"></i> <span>CMS</span></a>
                  <ul class="nav sub-group-menu">
                     
					 <li class="nav-item"><a href="<?php echo ci_site_url();?>Admin/Policy/editDashboardNotice"  class="nav-link"><i class="fas fa-angle-right"></i> Dashboard Popup</a></li>
					 
                     
                  </ul>
               </li>-->
               <?php
                     }
               ?>
                       
                        
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <style>
               /* .nav-bar-header-one {
    background: linear-gradient(to right, #252626, #252626) !important;
                }
                .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item > .nav-link i:before {
    color: #252626 !important;
                }
                .sidebar-color {
    background-color: #3ead3c !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item > .nav-link span {
    color: #fefeff !important;
}

.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item .sub-group-menu {
    background-color: #128c10 !important;
}

.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item .sub-group-menu > .nav-item .nav-link {
    color: #fefeff !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item .sub-group-menu > .nav-item .nav-link:hover {
    background-color: #064105 !important;
}
.header-main-menu .navbar-nav .header-Admin .dropdown-menu .item-header {
    text-align: center;
    background-color: #064105;
}*/
            </style>
            <style>
                .nav-bar-header-one{
                        background: linear-gradient(to right, #f0f1f3, #013845);
                    background-color: rgba(var(--p7), 1) !important;
    border-bottom: 1px solid rgba(var(--p6), 0.16) !important;
                }
                .sidebar-color {
    background-color: #ffffff !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item > .nav-link i:before
{
 color: #840127 !important;   
}
.breadcrumbs-area ul li {
    color: #840127 !important;  
}
.bg-light {
        background-color: #1e232c !important; 
}
.header-main-menu .navbar-nav .header-admin .dropdown-menu .item-header {
    background-color: #1e232c  !important;
}
.header-main-menu .navbar-nav .header-admin .navbar-nav-link .admin-title .item-title {
    color: #fff !important;
}
.header-main-menu .navbar-nav .header-admin .dropdown-menu .item-header:after {
    border-bottom: 10px solid #ffa001  !important;
}
.btn-gradient-yellow {
    background-color: #890224  !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item .sub-group-menu {
   background-color: #f0f1f370  !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item .sub-group-menu > .nav-item .nav-link:hover {
    background-color: #f0f1f3 !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu .nav-item.active .nav-link:after {
    color: #840127 !important;
}
.header-main-menu .navbar-nav .header-admin .dropdown-menu .item-header:after {
    border-bottom: 10px solid #bce70c !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item > .nav-link span {
    color: #1e232c !important;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item .sub-group-menu > .nav-item .nav-link {
    color: #1e232c;
}
.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item .sub-group-menu > .nav-item .nav-link:hover {
    color: #840127;
}
            </style>
            <style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}
.pagination strong {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}
</style>
