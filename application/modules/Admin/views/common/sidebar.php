<?php 
   $moduleName=$this->router->fetch_module();
   $controllerName=$this->router->fetch_class();
   $actionName=$this->router->fetch_method();
   $admin=getProfileInfo();
?>
<div class="sidebar sidebar-main">
   <div class="sidebar-content">
      <!-- User menu -->
      <div class="sidebar-user">
         <div class="category-content">
            <div class="media">
               <a href="#" class="media-left"><img src="https://via.placeholder.com/100" class="img-circle img-sm" alt=""></a>
               <div class="media-body">
                  <span class="media-heading text-semibold"><?php echo $admin->username;?></span>
                  <div class="text-size-mini text-muted">
                     <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /user menu -->
      <nav ui-nav class="navi clearfix">
            <ul class="nav menu-navigation">
            <ul class="navigation navigation-main navigation-accordion">
               <!-- Main -->
               <!-- Main -->
               <li class="navigation-header"><span></span> <i class="icon-menu" title="Main pages"></i></li>
               <li <?php echo ($controllerName=="admin")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
               <li class="navigation-divider"></li>
               <!--<li <?php echo ($controllerName=="setting" && $actionName=='currencySetting')?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/setting/currencySetting"><i class="icon-coins"></i> <span>Currency Setting</span></a></li>
               <li <?php echo ($controllerName=="setting" && $actionName=='userIdSetting')?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/setting/userIdSetting"><i class="icon-wrench3"></i> <span>User Id Setting</span></a></li>
               <li <?php echo ($controllerName=="setting" && $actionName=='paymentModeSetting')?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/setting/paymentModeSetting"><i class="icon-portfolio"></i> <span>Payment Mode Setting</span></a></li>
-->
               <!--<li <?php echo ($controllerName=="setting" && $actionName=='secondryEwalletSetting')?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/setting/secondryEwalletSetting"><i class="icon-portfolio"></i> <span>Investment Ewallet Management</span></a></li>
-->

               <li <?php echo ($controllerName=="setting" && $actionName=='dateFormatManagement')?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/setting/dateFormatManagement"><i class="icon-clipboard5"></i> <span>Date Format Setting</span></a></li>
               
			   
			   <!--<li <?php echo ($controllerName=="setting" && $actionName=='knowledgePointValueSetting')?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/setting/knowledgePointValueSetting"><i class="icon-wrench3"></i> <span>Manage Binary Cycle Vs Knowledge Points</span></a></li>
			   
			   
			   <li <?php echo ($controllerName=="setting" && $actionName=='nairaValueSetting')?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/setting/nairaValueSetting"><i class="icon-wrench3"></i> <span>Manage Naira value VS binary cycle</span></a></li>
			   -->
			   
			   <!--<li class="navigation-divider"></li>
			   <li <?php echo ($controllerName=="tax")?'class=active':'';?>>
                        <a href="#"><i class="icon-price-tag"></i> Tax Management</a>
                        <ul>
                           <li <?php echo ($actionName=="allOrdersTax")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/tax/allOrdersTax"><i class="icon-inbox"></i> All Tax</a></li>
                           
                        </ul>
                     </li> 
               <li class="navigation-divider"></li>
               <li <?php echo ($controllerName=="stockist")?'class=active':'';?>>
                        <a href="#"><i class="icon-price-tag"></i> Stockist Management</a>
                        <ul>
                           <li <?php echo ($actionName=="allStockist")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/stockist/allStockist"><i class="icon-inbox"></i> All Stockist</a></li>
                           <li <?php echo ($actionName=="addNewStockist")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/stockist/addNewStockist"><i class="icon-inbox"></i> Add New Stockist</a></li>
						   
                            <li <?php echo ($actionName=="allStockistOrders")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_orders/allStockistOrders"><i class="icon-inbox"></i> All Orders</a></li>
						  
                        </ul>
                     </li> 
			   <li <?php echo ($controllerName=="eshop" || $controllerName=="orders")?'class=active':'';?>>
                  <a href="#"><i class="icon-stats-bars"></i> <span>Eshop</span></a>
                  <ul>
				  <li <?php echo ($controllerName=="eshop" && $actionName=="index")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop/"><i class="icon-home4"></i> <span>Eshop Dashboard</span></a></li>
                     
					 <li <?php echo ($controllerName=="eshop")?'class=active':'';?>>
                        <a href="#"><i class="icon-price-tag"></i> Store Management</a>
                        <ul>
                           <li <?php echo ($actionName=="addNewCategory")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop/addNewCategory"><i class="icon-inbox"></i> Add New Categories</a></li>
                           <li <?php echo ($actionName=="allCategoryList")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop/allCategoryList"><i class="icon-inbox"></i>View All Categories</a></li>
						   <li <?php echo ($actionName=="addNewSubCategory")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop/addNewSubCategory"><i class="icon-inbox"></i>Add Sub Categories</a></li>
						   <li <?php echo ($actionName=="allSubCategoryList")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop/allSubCategoryList"><i class="icon-inbox"></i>View Sub Categories</a></li>
						   
                           <li <?php echo ($actionName=="allProductList")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop/allProductList"><i class="icon-inbox"></i>View All Products</a></li>
                          <li <?php echo ($actionName=="allProductStock")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop/allProductStock"><i class="icon-inbox"></i>View All Stocks</a></li>
                          
                        </ul>
                     </li>
					
					 <li <?php echo ($controllerName=="orders")?'class=active':'';?>>
                        <a href="#"><i class="icon-price-tag"></i> Order Management</a>
                        <ul>
                           <li <?php echo ($actionName=="allOrders")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_orders/allOrders"><i class="icon-inbox"></i> All Orders</a></li>
						   <li <?php echo ($actionName=="allOrdersCommission")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_orders/allOrdersCommission"><i class="icon-inbox"></i>Commission</a></li>
						   <li <?php echo ($actionName=="allPendingOrders")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_orders/allPendingOrders"><i class="icon-inbox"></i> All Pending Orders</a></li>
						   <li <?php echo ($actionName=="allConfirmedOrder")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_orders/allConfirmedOrder"><i class="icon-inbox"></i> All Confirm Orders</a></li>
						   <li <?php echo ($actionName=="allDeliveredOrders")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_orders/allDeliveredOrders"><i class="icon-inbox"></i> All Delivered Orders</a></li>
						   <li <?php echo ($actionName=="allRejectedOrders")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_orders/allRejectedOrders"><i class="icon-inbox"></i> All Rejected Orders</a></li>
						</ul>
                     </li>
					 <li <?php echo ($controllerName=="eshop_adv")?'class=active':'';?>>
                        <a href="#"><i class="icon-price-tag"></i> Eshop Advertisement</a>
                        <ul>
                           <li <?php echo ($actionName=="sliderImageList")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_adv/sliderImageList"><i class="icon-inbox"></i> All Slider Image</a></li>
						   
						    <li <?php echo ($actionName=="sliderSideImageList")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_adv/sliderSideImageList"><i class="icon-inbox"></i> Slider Right Side Image</a></li>
							
							  
						    <li <?php echo ($actionName=="bannerImageList")?'class=active':'';?>><a href="<?php echo site_url().$moduleName;?>/eshop_adv/bannerImageList"><i class="icon-inbox"></i> Banner Images</a></li>
						   
                          
                        </ul>
                     </li>
					 
                     
                  </ul>
               </li>
              
               <li <?php echo ($controllerName=="package")?'class=active':'';?>>
                  <a href="#"><i class="icon-puzzle4"></i> <span>Package Management</span></a>
                  <ul>
                     
					 <li <?php //echo ($actionName=="addNewPackage")?'class=active':'';?>><a href="<?php //echo ci_site_url();?>admin/package/addNewPackage"><i class="icon-file-plus2"></i> Add Package</a></li>
                     
					 <li <?php echo ($actionName=="allPackages")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/package/allPackages"><i class="icon-file-text3"></i> All/Edit Package</a></li>
                  </ul>
               </li>
               
			   <li <?php echo ($controllerName=="rank")?'class=active':'';?>>
                  <a href="#"><i class="icon-crown"></i> <span>Rank Management</span></a>
                  <ul>
                     <li <?php echo ($actionName=="addNewRank")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/rank/addNewRank"><i class="icon-file-check2"></i> Add Rank</a></li>
                     <li <?php echo ($actionName=="allRanks")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/rank/allRanks"><i class="icon-file-eye2"></i> All Ranks</a></li>
                  </ul>
               </li>
			   -->
               <li class="navigation-divider"></li>
               <li <?php echo ($controllerName=="MyGenealogy")?'class=active':'';?>>
                  <a href="#"><i class="icon-tree6"></i> <span>Genealogy</span></a>
                  <ul>
                     <li <?php echo ($actionName=="directReferralTree")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MyGenealogy/directReferralTree"><i class="icon-tree5"></i> Direct Referral Tree </a></li>
                     
                     <li <?php echo ($actionName=="genealogyTree")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MyGenealogy/myTeamTree"><i class="icon-tree7"></i> Team Tree </a></li>
                  </ul>
               </li>
               <li <?php echo ($controllerName=="member")?'class=active':'';?>>
                  <a href="#"><i class="icon-people"></i> <span>Member Management</span></a>
                  <ul>
                     <li <?php echo ($actionName=="viewAllMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/member/viewAllMember"><i class="icon-collaboration"></i> View All Member</a></li>
                     <li <?php echo ($actionName=="activeMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/member/activeMember"><i class="icon-user-check"></i> Active Member</a></li>
                     <li <?php echo ($actionName=="inactiveMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/member/inactiveMember"><i class="icon-user-cancel"></i> Inactive Member</a></li>
                     <li <?php echo ($actionName=="blockUnblockMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/member/blockUnblockMember"><i class="icon-user-block"></i> Block/Unblock Member</a></li>
                     <li class="navigation-divider"></li>
                     <li <?php echo ($actionName=="passwordTracker")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/member/passwordTracker"><i class="icon-lock"></i> Password Tracker</a></li>
                  </ul>
               </li>
               <!---Report Management section start from here-->
               <li <?php echo ($controllerName=="PayoutReport" || $controllerName=="CommissionReport")?'class=active':'';?>>
                  <a href="#"><i class="icon-stats-bars"></i> <span>Report Management</span></a>
                  <ul>
                     <li <?php echo ($controllerName=="PayoutReport")?'class=active':'';?>>
                        <a href="#"><i class="icon-price-tag"></i> Payout Report</a>
                        <ul>
                           <li <?php echo ($actionName=="activePayout")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/PayoutReport/activePayout"><i class="icon-inbox"></i> Active Payout</a></li>
                           <li <?php echo ($actionName=="payoutCompleted")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/PayoutReport/payoutCompleted"><i class="icon-task"></i> Payout Completed</a></li>
                           <li <?php echo ($actionName=="payoutCancelled")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/PayoutReport/payoutCancelled"><i class="icon-close2"></i> Payout Cancelled</a></li>
                           <li <?php echo ($actionName=="payoutGraph")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/PayoutReport/payoutGraph"><i class="icon-graph"></i> Payout Graph</a></li>
                        </ul>
                     </li>
                     <li <?php echo ($controllerName=="CommissionReport")?'class=active':'';?>>
                        <a href="#"><i class="icon-coins"></i> Commission Report</a>
                        <ul>
                           <li <?php echo ($actionName=="dailyCommission")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/dailyCommission"><i class="icon-user-plus"></i> Daily Income Report</a></li>
                           <li <?php echo ($actionName=="unilevelCommission")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/unilevelCommission"><i class="icon-users4"></i> Level Income Report</a></li>
                           <li <?php echo ($actionName=="binaryCommission")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/binaryCommission"><i class="icon-users4"></i> Binary Income Report</a></li>
                           <!--
						   <li <?php echo ($actionName=="matchingCommission")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/matchingCommission"><i class="icon-users4"></i> Matching Commission</a></li>
                           -->
						   <!--
						   <li <?php echo ($actionName=="rankBonus")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/rankBonus"><i class="icon-users4"></i> Rank Bonus</a></li>
						   -->
                        </ul>
                     </li>
               <li <?php echo ($controllerName=="investment")?'class=active':'';?>>
                  <a href="#"><i class="icon-wallet"></i> <span>My Investment</span></a>
                  <ul>
                    <!--<li <?php echo ($actionName=="viewInvestBalance" && $controllerName=="investment")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/investment/viewInvestBalance"><i class="icon-coins"></i>My Invest Balance</a></li>
                    <li <?php echo ($actionName=="purchaseFund" && $controllerName=="investment")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/investment/purchaseFund"><i class="icon-loop"></i>Investment</a></li>
                     -->
                    <li <?php echo ($actionName=="purchaseList" && $controllerName=="investment")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/investment/purchaseList"><i class="icon-loop"></i>Investment History</a></li>
                  </ul>
               </li>
                     <!--
					 <li <?php echo ($actionName=="rankAchieverReport")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/rankAchieverReport"><i class="icon-medal-first"></i> Rank Achiever Report</a></li>
                     -->
					 <li <?php echo ($actionName=="topEarnerReport")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/topEarnerReport"><i class="icon-trophy3"></i> Top Earner Report</a></li>
                     <li <?php echo ($actionName=="topRecruiterReport")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/CommissionReport/topRecruiterReport"><i class="icon-trophy4"></i> Top Recruiter Report</a></li>
                  </ul>
               </li>
			   <li <?php echo ($controllerName=="financial_report")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/financial_report"><i class="icon-file-spreadsheet2"></i> <span>Financial Report</span></a></li>
			   
			   <li <?php echo ($controllerName=="rank_award")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/rank_award"><i class="icon-star-full2"></i> <span>Rank & Award</span></a></li>
               <!---Report Management section end over here-->
               <li <?php echo ($controllerName=="AdminWallet" || $controllerName=="UserWallet")?'class=active':'';?>>
                  <a href="#"><i class="icon-wallet"></i> <span>E-Wallet Management</span></a>
                  <ul>
                     <li <?php echo ($controllerName=="AdminWallet")?'class=active':'';?>>
                        <a href="#"><i class="icon-user-tie"></i> Admin Wallet</a>
                        <ul>
                           <li <?php echo ($actionName=="viewAminWalletReport")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/AdminWallet/viewAminWalletReport"><i class="icon-inbox"></i>Wallet Report</a></li>

                           <li <?php echo ($actionName=="viewEwalletBalance" && $controllerName=="AdminWallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/AdminWallet/viewEwalletBalance"><i class="icon-coins"></i>My Wallet Balance</a></li>
                           
                           <li <?php echo ($actionName=="viewAminWalletGraph")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/AdminWallet/viewAminWalletGraph"><i class="icon-graph"></i>Wallet Graph</a></li>
                        </ul>
                     </li>
                     <li <?php echo ($controllerName=="UserWallet")?'class=active':'';?>>
                        <a href="#"><i class="icon-vcard"></i> User Wallet</a>
                        <ul>
                           <li <?php echo ($actionName=="userWalletBalance")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/UserWallet/userWalletBalance"><i class="icon-coins"></i>User Wallet Balance</a></li>
                           <li <?php echo ($actionName=="manageUserWallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/UserWallet/manageUserWallet"><i class="icon-database"></i> Manage User Wallet</a></li>
                           <li <?php echo ($actionName=="pendingDepositRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/UserWallet/pendingDepositRequestList"><i class="icon-warning22"></i> Pending Deposit Request</a></li>
                           <li <?php echo ($actionName=="approvedDepositRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/UserWallet/approvedDepositRequestList"><i class="icon-database-check"></i> Approved Deposit Request</a></li>
                           <li <?php echo ($actionName=="cancelledDepositRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/UserWallet/cancelledDepositRequestList"><i class="icon-database-remove"></i> Cancelled Deposit Request</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <?php 
                 if(is_active_secondry_ewallet())
                 {
                 ?>
                 <li <?php echo ($controllerName=="secondry_ewallet")?'class=active':'';?>>
                           <a href="#"><i class="icon-wallet"></i> <span>My Investment Ewallet</span></a>
                           <ul>
                             <li <?php echo ($actionName=="viewEwalletBalance" && $controllerName=="secondry_ewallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/secondry_ewallet/viewEwalletBalance"><i class="icon-coins"></i>My Investment Balance</a></li>
                             
                             <li <?php echo ($actionName=="viewEwalletStatement" && $controllerName=="secondry_ewallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/secondry_ewallet/viewEwalletStatement"><i class="icon-calculator"></i>Investment Wallet Statement</a></li>
                             
                           </ul>
                 </li>
                 <?php   
                 }
               ?>
               <?php 
               if(isBankWireEnables())
                 {
               ?>
                 <!--Bank wire member report-->
                 <li <?php echo ($controllerName=="BankWireMemberReport")?'class=active':'';?>>
                           <a href="#"><i class="icon-collaboration"></i><span>Bank Wire Member Report</span></a>
                           <ul>
                             <li <?php echo ($actionName=="bankWireDetail")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/BankWireMemberReport/bankWireDetail"><i class="icon-user-tie"></i>Bank Wire Detail</a></li>

                             <li <?php echo ($actionName=="pendingMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/BankWireMemberReport/pendingMember"><i class="icon-user-tie"></i>Pending Member</a></li>
                             
                             <li <?php echo ($actionName=="approvedMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/BankWireMemberReport/approvedMember"><i class="icon-users4"></i>Approved Member</a></li>

                             <li <?php echo ($actionName=="cancelledMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/BankWireMemberReport/cancelledMember"><i class="icon-users4"></i>Cancelled Member</a></li>
                            
                           </ul>
                 </li>
                 <?php  
                 }
                 ?>
               <?php 
                  if(isEpinEnabled())
                  {
                  ?>
               <li <?php echo ($controllerName=="Epin")?'class=active':'';?>>
                  <a href="#"><i class="icon-power-cord"></i> <span>E-Pin Management</span></a>
                  <ul>
                     <li <?php echo ($actionName=="pendingEpinRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/pendingEpinRequestList"><i class="icon-clipboard2"></i> Pin Request </a></li>
                     <li <?php echo ($actionName=="createNewPin")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/createNewPin"><i class="icon-switch"></i> Create New Pin </a></li>
                     <li <?php echo ($actionName=="approvedEpinRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/approvedEpinRequestList"><i class="icon-clipboard2"></i>Confirm Pin Request</a></li>
                     <li <?php echo ($actionName=="cancelledEpinRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/cancelledEpinRequestList"><i class="icon-clipboard2"></i>Cancelled Pin Request</a></li>
                     <li <?php echo ($actionName=="activePinList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/activePinList"><i class="icon-database-check"></i>Active Pin</a></li>
                     <li <?php echo ($actionName=="usedPinList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/usedPinList"><i class="icon-database-time2"></i>Used Pin</a></li>
                     <li <?php echo ($actionName=="deleteBlockEpinList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/deleteBlockEpinList"><i class="icon-database-remove"></i> Delete/Block Pin </a></li>
                     <li <?php echo ($actionName=="transferEpin")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/transferEpin"><i class="icon-loop"></i> Transfer Pin </a></li>
                     <li <?php echo ($actionName=="transferredPinList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/epin/transferredPinList"><i class="icon-database-arrow"></i>Pin Transfer Report</a></li>
                     <!--
                        <li><a href="#"><i class="icon-clipboard2"></i> Pin Request </a></li>
                        <li><a href="#"><i class="icon-switch"></i> Create New Pin </a></li>
                        <li><a href="#"><i class="icon-database-check"></i> Active Pin </a></li>
                        <li><a href="#"><i class="icon-database-time2"></i> Used Pin </a></li>
                        <li><a href="#"><i class="icon-database-remove"></i> Delete/Block Pin </a></li>
                        <li><a href="#"><i class="icon-loop"></i> Transfer Pin </a></li>
                        <li><a href="#"><i class="icon-database-arrow"></i> Pin Transfer Report </a></li>
                        -->
                  </ul>
               </li>
               <?php   
                  }
                  ?>
               <li class="navigation-divider"></li>
               <li <?php echo ($controllerName=="SupportTicket")?'class=active':'';?>>
                  <a href="#"><i class="icon-question4"></i> <span>Support Ticket</span></a>
                  <ul>
                     <li <?php echo ($actionName=="openTicket")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/SupportTicket/openTicket"><i class="icon-enter3"></i> Open Ticket </a></li>
                     <li <?php echo ($actionName=="closedTicket")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/SupportTicket/closedTicket"><i class="icon-cancel-square2"></i> Closed Ticket </a></li>
                  </ul>
               </li>
               <!--<li <?php echo ($controllerName=="MessagePanel")?'class=active':'';?>>
                  <a href="#"><i class="icon-envelop"></i> <span>Message Panel</span></a>
                  <ul>
                     <li <?php echo ($actionName=="inbox")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MessagePanel/inbox"><i class="icon-envelop3"></i> Inbox </a></li>
                     <li <?php echo ($actionName=="composeMessage")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MessagePanel/composeMessage"><i class="icon-compose"></i> Compose Message </a></li>
                     <li <?php echo ($actionName=="sentMessage")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MessagePanel/sentMessage"><i class="icon-task"></i> Sent Message </a></li>
                  </ul>
               </li>
               <li <?php echo ($controllerName=="MarketingTools")?'class=active':'';?>>
                  <a href="#"><i class="icon-power-cord"></i> <span>Marketing Tools</span></a>
                  <ul>
                     <li <?php echo ($actionName=="viewReferralLinks")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MarketingTools/viewReferralLinks"><i class="icon-collaboration"></i> Referral Link </a></li>
                     <li <?php echo ($actionName=="viewSocialMediaLinks")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MarketingTools/viewSocialMediaLinks"><i class="icon-share3"></i> Social Media Links </a></li>
                     
                     <li <?php echo ($controllerName=="MarketingTools" && ($actionName=="viewImageList" || $actionName=="viewAllImages" || $actionName=="viewVideoList" || $actionName=="viewAllVideo"))?'class=active':'';?>>
                       
                        <a href="#"><i class="icon-video-camera"></i> Files & Videos</a>
                        
                        <ul>
                           <li <?php echo ($actionName=="viewImageList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MarketingTools/viewImageList"><i class="icon-image3"></i>Image List</a></li>

                           <li <?php echo ($actionName=="viewAllImages")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MarketingTools/viewAllImages"><i class="icon-image4"></i>View All Images</a></li>
                           
                           <li <?php echo ($actionName=="viewVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MarketingTools/viewVideoList"><i class="icon-play"></i>Video List</a></li>
                           
                           <li <?php echo ($actionName=="viewAllVideo")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/MarketingTools/viewAllVideo"><i class="icon-clapboard-play"></i>View All Video</a></li>
                        
                        </ul>
                     </li>
                  </ul>
               </li>
			   <li <?php echo ($controllerName=="teacher")?'class=active':'';?>>
                  <a href="#"><i class="icon-user"></i> <span>Manage Teacher</span></a>
                  <ul>
                     <li <?php echo ($controllerName=="teacher" && $actionName=="viewAllTeacher")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher/viewAllTeacher"><i class="icon-user"></i>View All Teacher</a></li>
					 
					 <li <?php echo ($actionName=="viewAllActiveTeacher")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher/viewAllActiveTeacher"><i class="icon-user-check"></i>View All Active Teacher</a></li>
					 
					 <li <?php echo ($actionName=="viewAllInActiveTeacher")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher/viewAllInActiveTeacher"><i class="icon-user-block"></i>View All Inactive Teacher</a></li>
                  </ul>
               </li>
			    <li <?php echo ($controllerName=="admin_video_tutorials")?'class=active':'';?>>
                  <a href="#"><i class="icon-video-camera2"></i> <span>Admin Video Tutorials</span></a>
                  <ul>
                    
					  <li <?php echo ($controllerName=="admin_video_tutorials" && $actionName=="addNewVideo")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/admin_video_tutorials/addNewVideo"><i class="icon-plus-circle2"></i>Add New Video</a></li>
					 
					 
					 <li <?php echo ($controllerName=="admin_video_tutorials" && $actionName=="viewAllVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/admin_video_tutorials/viewAllVideoList"><i class=" icon-video-camera"></i>View All Video</a></li>
					 
					 <li <?php echo ($controllerName=="admin_video_tutorials" && $actionName=="viewAllApprovedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/admin_video_tutorials/viewAllApprovedVideoList"><i class="icon-user"></i>View All Approved Video</a></li>
					 
					 <li <?php echo ($controllerName=="admin_video_tutorials" && $actionName=="viewAllUnapprovedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/admin_video_tutorials/viewAllUnapprovedVideoList"><i class="icon-user-block"></i>View All Unapproved Video</a></li>
					 
					 
					  
					  <li <?php echo ($controllerName=="admin_video_tutorials" && $actionName=="viewAllAssignedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/admin_video_tutorials/viewAllAssignedVideoList"><i class="icon-user-check"></i>View All Assigned Video</a></li>
					  
					  <li <?php echo ($controllerName=="admin_video_tutorials" && $actionName=="viewAllUnassignedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/admin_video_tutorials/viewAllUnassignedVideoList"><i class="icon-user-block"></i>View All Unassigned Video</a></li>
					  
                  </ul>
               </li>
			   <li <?php echo ($controllerName=="teacher_video_tutorials")?'class=active':'';?>>
                  <a href="#"><i class="icon-video-camera2"></i> <span>Teacher Video Tutorials</span></a>
                  <ul>
					 
					 <li <?php echo ($controllerName=="teacher_video_tutorials" && $actionName=="viewAllVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher_video_tutorials/viewAllVideoList"><i class=" icon-video-camera"></i>View All Video</a></li>
					 
					 <li <?php echo ($controllerName=="teacher_video_tutorials" && $actionName=="viewAllApprovedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher_video_tutorials/viewAllApprovedVideoList"><i class="icon-user"></i>View All Approved Video</a></li>
					 
					 <li <?php echo ($controllerName=="teacher_video_tutorials" && $actionName=="viewAllUnapprovedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher_video_tutorials/viewAllUnapprovedVideoList"><i class="icon-user-block"></i>View All Unapproved Video</a></li>
					 
					 
					  <li <?php echo ($controllerName=="teacher_video_tutorials" && $actionName=="viewAllAssignedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher_video_tutorials/viewAllAssignedVideoList"><i class="icon-user-check"></i>View All Assigned Video</a></li>
					  
					  <li <?php echo ($controllerName=="teacher_video_tutorials" && $actionName=="viewAllUnassignedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/teacher_video_tutorials/viewAllUnassignedVideoList"><i class="icon-user-block"></i>View All Unassigned Video</a></li>
					  
                  </ul>
               </li>
			   
			   <li <?php echo ($controllerName=="video_tutorials")?'class=active':'';?>>
                  <a href="#"><i class="icon-user"></i> <span>View Video Tutorials</span></a>
                  <ul>
                     <li <?php echo ($controllerName=="video_tutorials" && $actionName=="viewAllTeacher")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/video_tutorials/viewAllTeacher"><i class="icon-user"></i>View All Teacher</a></li>
					 
					 <li <?php echo ($actionName=="viewAllVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/video_tutorials/viewAllVideoList"><i class="icon-user"></i>View All Video</a></li>
					 
					 <li <?php echo ($actionName=="viewAllApprovedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/video_tutorials/viewAllApprovedVideoList"><i class="icon-user-check"></i>View All Approved Video</a></li>
					 
					 <li <?php echo ($actionName=="viewAllUnapprovedVideoList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/video_tutorials/viewAllUnapprovedVideoList"><i class="icon-user-block"></i>View All Unapproved Video</a></li>
					 
					 <li <?php echo ($actionName=="totalSoldSubject")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/video_tutorials/totalSoldSubject"><i class="icon-book"></i>Total Sold Subject</a></li>
                  </ul>
               </li>
			   -->
			   
               <li <?php echo ($controllerName=="policy")?'class=active':'';?>>
                  <a href="#"><i class="icon-file-eye2"></i> <span>Policy Section</span></a>
                  <ul>
                     <li <?php echo ($actionName=="editPrivacyPolicy")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/policy/editPrivacyPolicy"><i class="icon-book2"></i> Privacy Policies </a></li>
                     <li <?php echo ($actionName=="editTermsCondition")?'class=active':'';?>><a href="<?php echo ci_site_url();?>admin/policy/editTermsCondition"><i class="icon-book"></i> Terms and Conditions </a></li>
                  </ul>
               </li>
              
             
			</ul>
         </ul>
      <!-- /main navigation -->
	  </nav>
   </div>
</div>
<style>
/*.navbar-inverse {
    background-color: #34393d !important;
    border-color: #34393d !important;
}
.sidebar {
    background-color: #34393d;
}
.navigation>li.active>a, .navigation>li.active>a:hover, .navigation>li.active>a:focus {
    background-color: #f01618;
    color: #fff;
}*/
</style>