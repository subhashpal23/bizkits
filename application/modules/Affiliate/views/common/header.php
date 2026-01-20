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
    <title>Ecommerce| Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>frontassets/images/logo-default.png">
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
                    <a href="<?php echo base_url();?>">
                        <img src="<?php echo base_url();?>/frontassets/images/logo.png" alt="logo" style="width:50px">
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
                                <span>Customer Panel</span>
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
                                    <li><a href="<?php echo base_url();?>Affiliate/Account/viewProfile"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="<?php echo base_url();?>Affiliate/Auth/logout"><i class="flaticon-turn-off"></i>Log Out</a></li>
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
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>/frontassets/images/logo.png" alt="logo" style="width:50px"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item ">
                            <a href="<?php echo base_url();?>Affiliate" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Account</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/Account/viewProfile" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Profile</a>
                                </li>
                               <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/Account/changePassword" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Change Password</a>
                                </li>
                                <!--<li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/Package/myActivePackage" class="nav-link"><i class="fas fa-angle-right"></i>
                                    <span>My Package</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/Package/upgradePackage" class="nav-link"><i class="fas fa-angle-right"></i>
                                    <span>Upgrade Package</span></a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item"><a href="<?php echo site_url();?>" target="_blank" class="nav-link"><i class="flaticon-classmates"></i>
                        <span>Shop Here</span></a></li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Eshop Management</span></a>
                            <ul class="nav sub-group-menu">
                                
                                <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allCategoryList" class="nav-link"><i class="fas fa-angle-right"></i> My Customer</a></li>
                				<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/AllSales" class="nav-link"><i class="fas fa-angle-right"></i>My Sales</a></li>
                				
                			</ul>
                       </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>My Orders</span></a>
                            <ul class="nav sub-group-menu">
                                <!--<li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/Eshop_Orders/bvList" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        PV List</a>
                                </li>-->
                                <?php
                                if(checkStockist($this->session->userdata('username')))
                                {
                                ?>
                                <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allStockistOrders" class="nav-link"><i class="fas fa-angle-right"></i> Stockist Orders</a></li>
                				<?php
                				}
                				?>
                                <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allOrders/quote" class="nav-link"><i class="fas fa-angle-right"></i> All Quates</a></li>
                				<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allOrders/bill" class="nav-link"><i class="fas fa-angle-right"></i> All Billed Order</a></li>
                				<!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allConfirmedOrder" class="nav-link"><i class="fas fa-angle-right"></i> All Confirmed Orders</a></li>
                				-->
                				<!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allRejectedOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Shipped Orders</a></li>
                				<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allDeliveredOrders" class="nav-link"><i class="fas fa-angle-right"></i> All Delivered Orders</a></li>-->
                			</ul>
                       </li>
                       <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="fas fa-angle-right"></i><span>My Stocks</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allStocks" class="nav-link"><i class="fas fa-angle-right"></i>My Stocks</a></li>
                                <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allStockHistory" class="nav-link"><i class="fas fa-angle-right"></i>My Stocks History</a></li>
                                <!--<li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allStocks" class="nav-link"><i class="fas fa-angle-right"></i> Monthly Stocks</a></li>
                                <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allStockReport" class="nav-link"><i class="fas fa-angle-right"></i>Monthly Report</a></li>-->
                            </ul>    
                       </li>
                       
                       <?php
                                if(checkStockist($this->session->userdata('username')))
                                {
                                    ?>
                                    <li class="nav-item sidebar-nav-item">
                                        <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>My Stocks</span></a>
                                        <ul class="nav sub-group-menu">
                                           
                                            <?php
                                            if(checkStockist($this->session->userdata('username')))
                                            {
                                            ?>
                                            <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allStocks" class="nav-link"><i class="fas fa-angle-right"></i>Monthly Stocks</a></li>
                                            <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop_Orders/allStockHistory" class="nav-link"><i class="fas fa-angle-right"></i> Stocks History</a></li>
                            				<?php
                            				}
                            				?>
                                        </ul>    
                                   </li>
                                    <?php
                                }
                                ?>
                        <!--<li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Team</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/TeamReport/binaryMemberList" class="nav-link"><i class="fas fa-angle-right"></i>Binary
                                        Team</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/TeamReport/directReferralMemberList" class="nav-link"><i class="fas fa-angle-right"></i>
                                    Referral Member</a></li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Network</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/MyGenealogy/myTeamTree" class="nav-link"><i class="fas fa-angle-right"></i>Binary Tree</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/MyGenealogy/directReferralTree" class="nav-link"><i class="fas fa-angle-right"></i>Referral Tree
                                    </a></li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Commissions</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/directReferralCommissionList" class="nav-link"><i class="fas fa-angle-right"></i>Referal Bonus</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/binaryCommissionList" class="nav-link"><i class="fas fa-angle-right"></i>Matching Bonus</a>
                                </li>
                                 <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/fastStartCommissionList" class="nav-link"><i class="fas fa-angle-right"></i>Fast Start Bonus</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/directMatchingCommissionList" class="nav-link"><i class="fas fa-angle-right"></i>Direct Matching Bonus</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/selfComissionList" class="nav-link"><i class="fas fa-angle-right"></i>Repurchase Bonus</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/unilvelComissionList" class="nav-link"><i class="fas fa-angle-right"></i>Unilevel Bonus</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/rankComissionList" class="nav-link"><i class="fas fa-angle-right"></i>Rank Bonus</a>
                                </li>
                               <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/pvList/unused" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        PV List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/IncomeReport/fspvList" class="nav-link"><i class="fas fa-angle-right"></i>Fast Start
                                        PV List</a>
                                </li>
                                <?php
                                if(checkStockist($this->session->userdata('username')))
                                {
                                ?>
                                <li class="nav-item"><a href="<?php echo site_url();?>/Affiliate/IncomeReport/stockistComissionList" class="nav-link"><i class="fas fa-angle-right"></i> Stockist Bonus</a></li>
                				<?php
                				}
                				?>
                            </ul>
                        </li>-->
                        <!--<li class="nav-item sidebar-nav-item">
                          <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i> <span>My Ewallet</span></a>
                          <ul class="nav sub-group-menu">
                            <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Ewallet/viewEwalletBalance" class="nav-link"><i class="fas fa-angle-right"></i>My Wallet Balance</a></li>
                            <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Ewallet/viewEwalletStatement" class="nav-link"><i class="fas fa-angle-right"></i>Wallet History</a></li>
                            <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Ewallet/viewTwalletStatement" class="nav-link"><i class="fas fa-angle-right"></i>Transaction Wallet History</a></li>
                            
                            <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Ewallet/purchaseFund" class="nav-link"><i class="fas fa-angle-right"></i>Add Fund</a></li>
                            <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Ewallet/depositWalletAmountRequestList" class="nav-link"><i class="fas fa-angle-right"></i>Fund Request</a></li>
                            <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Ewallet/ewalletFundTransfer" class="nav-link"><i class="fas fa-angle-right"></i>Wallet Fund Transfer</a></li>
                          </ul>
                        </li>-->
                        
                        <!--<li  class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i> <span>Payout Management</span></a>
                  <ul class="nav sub-group-menu">
                    <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Payout/withdrawlMyFund" class="nav-link"><i class="fas fa-angle-right"></i>Withdraw My Fund</a></li>
                    <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Payout/completedPayoutRequestList" class="nav-link"><i class="fas fa-angle-right"></i>Completed Request</a></li>
                    <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Payout/pendingPayoutRequestList" class="nav-link"><i class="fas fa-angle-right"></i>Pending Request</a></li>
                    <li class="nav-item"><a href="<?php echo ci_site_url();?>Affiliate/Payout/cancelledPayoutRequestList" class="nav-link"><i class="fas fa-angle-right"></i>Cancelled Request</a></li>
                  </ul> 
        </li>-->
                        <!--<li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Marketing Tools</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/MarketingTools/viewReferralLinks" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Referal Link</a>
                                </li>
                               <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/MarketingTools/viewAllImages" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Images</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ci_site_url();?>Affiliate/MarketingTools/viewAllVideo" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Videos</a>
                                </li>
                                
                            </ul>
                        </li>-->
                        
                       <!--<li  class="nav-item sidebar-nav-item">
                          <a href="#" class="nav-link"><i
                                            class="flaticon-multiple-users-silhouette"></i><span>Study Material</span></a>
                          <ul class="nav sub-group-menu">
        				    <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/" class="nav-link"><i
                                                    class="fas fa-angle-right"></i> <span>Eshop Dashboard</span></a></li>
                            <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allCategoryList" class="nav-link"><i
                                                    class="fas fa-angle-right"></i> <span>Category</span></a></li>
                            <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allSubCategoryList" class="nav-link"><i
                                                    class="fas fa-angle-right"></i> <span>Sub Category</span></a></li>
                            <li class="nav-item"><a href="<?php echo site_url().$moduleName;?>/Eshop/allProductList" class="nav-link"><i
                                                    class="fas fa-angle-right"></i> <span>Add Products</span></a></li>
        					 
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
               </li>-->
                        
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <style>
                .nav-bar-header-one{
                        background: linear-gradient(to right, #0a8894, #013845);
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