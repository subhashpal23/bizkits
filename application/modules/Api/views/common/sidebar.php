<?php 
$moduleName=$this->router->fetch_module();
$controllerName=$this->router->fetch_class();
$actionName=$this->router->fetch_method();
?>
 <aside id="aside" class="app-aside sidebar sidebar-main">
      <div class="aside-wrap">
        <div class="navi-wrap">
                    <!-- user profile -->
          
          <!-- / user profile-->
                              <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav menu-navigation">
        
        <ul class="navigation navigation-main navigation-accordion">

                <!-- Main -->
				<li <?php echo ($controllerName=="user")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
				<!--profile management-->
				<li <?php echo ($controllerName=="account")?'class=active':'';?>>
                  <a href="#"><i class="icon-profile"></i><span>My Account</span></a>
                  <ul>
                    <li <?php echo ($actionName=="viewProfile")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/account/viewProfile"><i class="icon-user-tie"></i>My Profile</a></li>
					          <li <?php echo ($actionName=="changePassword")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/account/changePassword"><i class=" icon-user-lock"></i>Change Password</a></li>
                    <!--<li <?php echo ($actionName=="changeTranscationPassword")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/account/changeTranscationPassword"><i class=" icon-file-locked2"></i>Change Transaction Password</a></li>
                 --> </ul>
        </li>
		<!--<li <?php echo ($controllerName=="set_leg_position")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/set_leg_position"><i class="icon-wrench3"></i> <span>Set Leg Position</span></a></li>
        --><!--My Package-->
        
       
        <!--My Genealogy-->
        <li <?php echo ($controllerName=="MyGenealogy")?'class=active':'';?>>
                  <a href="#"><i class="icon-tree6"></i><span>My Genealogy</span></a>
                  <ul>
                    <!--<li <?php echo ($actionName=="myTeamTree")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/MyGenealogy/myTeamTree"><i class="icon-tree6"></i>My Team Tree</a></li>
                    --><li <?php echo ($actionName=="directReferralTree")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/MyGenealogy/directReferralTree"><i class="icon-tree5"></i>Direct Referral Tree</a></li>
                    <!--<li <?php //echo ($actionName=="tabularTree")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/MyGenealogy/tabularTree"><i class="icon-list2"></i>Tabular Tree</a></li>
                  -->
                  </ul>
       </li>
        <!--My Income Report-->
        <li <?php echo ($controllerName=="IncomeReport")?'class=active':'';?>>
                  <a href="#"><i class="icon-coins"></i><span>My Income Report</span></a>
                  <ul>
                    <!--<li <?php echo ($actionName=="directReferralCommissionList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/IncomeReport/directReferralCommissionList"><i class="icon-wallet"></i>Direct Referral Bonus</a></li>-->
                    <!--<li <?php echo ($actionName=="levelCommissionList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/IncomeReport/levelCommissionList"><i class="icon-arrow-down7"></i>Level Bonus</a></li>
                    <li <?php echo ($actionName=="binaryCommissionList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/IncomeReport/binaryCommissionList"><i class="icon-cash2"></i>Binary Income</a></li>
                    --><li <?php echo ($actionName=="dailyIncomeList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/IncomeReport/dailyIncomeList"><i class="icon-cash2"></i>Daily Trading Income</a></li>
                    <!--
					<li <?php echo ($actionName=="matchingCommissionList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/IncomeReport/matchingCommissionList"><i class="icon-cash3"></i>Matching Income</a></li>
                    
					<li <?php echo ($actionName=="rankBonusList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/IncomeReport/rankBonusList"><i class="icon-cash4"></i>Rank Bonus Income</a></li>
					-->
                  </ul>
       </li>
	   <!--<li <?php echo ($controllerName=="rank_award")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/rank_award"><i class="icon-star-full2"></i> <span>Rank & Award</span></a></li>
	   -->
	    <!--<li <?php echo ($controllerName=="rank_kw_report")?'class=active':'';?>>
                  <a href="#"><i class="icon-collaboration"></i><span>My BV Report</span></a>
                  <ul>
                    
					
					<li <?php echo ($actionName=="selfKwList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/rank_kw_report/selfKwList"><i class="icon-user-tie"></i>Self BV Report</a></li>
                    
                    <li <?php echo ($actionName=="leftKwList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/rank_kw_report/leftKwList"><i class="icon-users4"></i>Left BV Report</a></li>
					
					<li <?php echo ($actionName=="rightKwList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/rank_kw_report/rightKwList"><i class="icon-users4"></i>Right BV Report</a></li>
                   
                  </ul>
       </li>-->
        <!--My Team Report-->
        <li <?php echo ($controllerName=="TeamReport")?'class=active':'';?>>
                  <a href="#"><i class="icon-collaboration"></i><span>My Team Report</span></a>
                  <ul>
                    <li <?php echo ($actionName=="directReferralMemberList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/TeamReport/directReferralMemberList"><i class="icon-user-tie"></i>Direct Referral Member</a></li>
                    <!--
                    <li <?php echo ($actionName=="teamMemberList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/TeamReport/teamMemberList"><i class="icon-users4"></i>Team Member</a></li>
                   -->
                  </ul>
       </li>
        <?php
      if(isBankWireEnables())
      {
      ?>
        <!--Bank wire member report-->
        <li <?php echo ($controllerName=="BankWireMemberReport")?'class=active':'';?>>
                  <a href="#"><i class="icon-collaboration"></i><span>Bank Wire Member Report</span></a>
                  <ul>
                    <li <?php echo ($actionName=="pendingMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/BankWireMemberReport/pendingMember"><i class="icon-user-tie"></i>Pending Member</a></li>
                    
                    <li <?php echo ($actionName=="approvedMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/BankWireMemberReport/approvedMember"><i class="icon-users4"></i>Approved Member</a></li>

                    <li <?php echo ($actionName=="approvedMember")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/BankWireMemberReport/cancelledMember"><i class="icon-users4"></i>Cancelled Member</a></li>
                   
                  </ul>
       </li>
        <?php  
        }
        ?>
        <!--Ewallet Management-->
        <li <?php echo ($controllerName=="ewallet")?'class=active':'';?>>
                  <a href="#"><i class="icon-wallet"></i> <span>My Ewallet</span></a>
                  <ul>
                    <li <?php echo ($actionName=="viewEwalletBalance" && $controllerName=="ewallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/ewallet/viewEwalletBalance"><i class="icon-coins"></i>My Wallet Balance</a></li>
                    <li <?php echo ($actionName=="viewEwalletStatement" && $controllerName=="ewallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/ewallet/viewEwalletStatement"><i class="icon-coins"></i>Wallet History</a></li>
                    <li <?php echo ($actionName=="purchaseFund" && $controllerName=="ewallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/ewallet/purchaseFund"><i class="icon-loop"></i>Add Fund</a></li>
                    <li <?php echo ($actionName=="depositWalletAmountRequestList" && $controllerName=="ewallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/ewallet/depositWalletAmountRequestList"><i class="icon-loop"></i>Fund Request</a></li>
                    
                    <!--<li <?php echo ($actionName=="ewalletFundTransfer" && $controllerName=="ewallet")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/ewallet/ewalletFundTransfer"><i class="icon-loop"></i>Wallet Fund Transfer</a></li>-->
                  </ul>
        </li>
        <li <?php echo ($controllerName=="investment")?'class=active':'';?>>
                  <a href="#"><i class="icon-wallet"></i> <span>My Investment</span></a>
                  <ul>
                    <li <?php echo ($actionName=="viewInvestBalance" && $controllerName=="investment")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/investment/viewInvestBalance"><i class="icon-coins"></i>My Invest Balance</a></li>
                    <li <?php echo ($actionName=="purchaseFund" && $controllerName=="investment")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/investment/purchaseFund"><i class="icon-loop"></i>Investment</a></li>
                    <li <?php echo ($actionName=="purchaseList" && $controllerName=="investment")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/investment/purchaseList"><i class="icon-loop"></i>Investment History</a></li>

                  </ul>
        </li>
        <!--Secondry Ewallet Management-->
        
        <!--E-Pin-->
        <?php 
        if(isEpinEnabled())
        {
        ?>
        <li <?php echo ($controllerName=="Epin")?'class=active':'';?>>
                  <a href="#"><i class="icon-power-cord"></i> <span>E-Pin</span></a>
                  <ul>
                    <li <?php echo ($actionName=="pendingEpinRequest")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/epin/pendingEpinRequest"><i class="icon-warning22"></i>Pending Pin Request</a></li>
                    <li <?php echo ($actionName=="approvedEpinRequest")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/epin/approvedEpinRequest"><i class="icon-folder-check"></i>Approved Pin Request</a></li>
                    <li <?php echo ($actionName=="cancelledEpinRequest")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/epin/cancelledEpinRequest"><i class="icon-cancel-circle2"></i>Cancelled Pin Request</a></li>
                    <li <?php echo ($actionName=="freshPinList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/epin/freshPinList"><i class="icon-clipboard2"></i>My Fresh Pin</a></li>
                    <li <?php echo ($actionName=="usedPinList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/epin/usedPinList"><i class="icon-switch"></i>My Used Pin</a></li>
                    <li <?php echo ($actionName=="transferredPinList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/epin/transferredPinList"><i class="icon-loop"></i>Transferred Pin</a></li>
                  </ul>
        </li>
        <?php   
        }
        ?>
        <!--Payout Management-->
        <li <?php echo ($controllerName=="payout")?'class=active':'';?>>
                  <a href="#"><i class="icon-shuffle"></i> <span>Payout Management</span></a>
                  <ul>
                    <li <?php echo ($actionName=="withdrawlMyFund")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/payout/withdrawlMyFund"><i class="icon-loop3"></i>Withdraw My Fund</a></li>
                    <li <?php echo ($actionName=="completedPayoutRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/payout/completedPayoutRequestList"><i class="icon-folder-check"></i>Completed Request</a></li>
                    <li <?php echo ($actionName=="pendingPayoutRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/payout/pendingPayoutRequestList"><i class="icon-warning22"></i>Pending Request</a></li>
                    <li <?php echo ($actionName=="cancelledPayoutRequestList")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/payout/cancelledPayoutRequestList"><i class="icon-cancel-circle2"></i>Cancelled Request</a></li>
                  </ul> 
        </li>
		
		
        <!--Payout Management-->
        <li <?php echo ($controllerName=="SupportTicket")?'class=active':'';?>>
                  <a href="#"><i class="icon-question4"></i> <span>Support Ticket</span></a>
                  <ul>
                    <li <?php echo ($actionName=="openTicket")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/SupportTicket/openTicket"><i class="icon-enter3"></i> Open Ticket </a></li>
                    <li <?php echo ($actionName=="closedTicket")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/SupportTicket/closedTicket"><i class="icon-cancel-square2"></i> Closed Ticket </a></li>

                  </ul> 
        </li>
        <!--Payout Management-->

        <!--<li <?php echo ($controllerName=="MessagePanel")?'class=active':'';?>>
                  <a href="#"><i class="icon-envelop"></i> <span>Message Panel</span></a>
                  <ul>
                    <li <?php echo ($actionName=="inbox")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/MessagePanel/inbox"><i class="icon-envelop3"></i> Inbox </a></li>
                    <li <?php echo ($actionName=="composeMessage")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/MessagePanel/composeMessage"><i class="icon-compose"></i> Compose Message </a></li>
                    <li <?php echo ($actionName=="sentMessage")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/MessagePanel/sentMessage"><i class="icon-task"></i> Sent Message </a></li>
                  </ul> 
        </li>-->

        <!------Policy Section---->
        <!--<li <?php echo ($controllerName=="policy")?'class=active':'';?>>
                  <a href="#"><i class="icon-file-eye2"></i> <span>Policy Section</span></a>
                  <ul>
                    <li <?php echo ($actionName=="privacyPolicy")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/policy/privacyPolicy"><i class="icon-book2"></i>Privacy Policies</a></li>
                    <li <?php echo ($actionName=="termsCondition")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/policy/termsCondition"><i class="icon-book"></i>Terms and Conditions</a></li>
                  </ul> 
        </li>-->
        <!------Marketin tools Section---->
       

        <!--
        <li <?php echo ($controllerName=="register")?'class=active':'';?>><a href="<?php echo ci_site_url();?>user/register/registerNewMember"><i class="icon-user-plus"></i> <span>Register New Member</span></a>
        </li>
        -->
	  </ul>
  </div>
</div>
</aside>
<style>
/*.navbar-inverse {
    background-color: #34393d !important;
    border-color: #34393d !important;
}
.sidebar {
    background-color: #34393d !important;
}
.navigation>li.active>a, .navigation>li.active>a:hover, 

.navigation>li.active>a:focus {
    background-color: #f01618 !important;
    color: #fff !important;
}
.bg-black {
    color: #087d0a !important;
    background-color: #66bb6a;
}*/
</style>