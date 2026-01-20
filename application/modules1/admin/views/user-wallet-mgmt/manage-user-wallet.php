<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User E-Wallet</span> - Manage User Wallet</h4>
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
            <li><a href="#">User Ewallet</a></li>
            <li class="active">Manage User Wallet</li>
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
         <!--<span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet-->
         <?php echo $this->session->flashdata('flash_msg');?>
      </div>
      <?php   
         }
         ?>
      <!--
         <div class="alert alert-warning alert-styled-right">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Warning!</span> Oh! Transaction Password is Wrong
         </div>
         -->
      <div class="panel panel-flat col-md-5">
         <div class="panel-heading">
            <h5 class="panel-title">Add Fund in User Wallet</h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <form action="<?php echo ci_site_url();?>admin/UserWallet/addFundToUserWallet" method="post">
                  <div class="">
                     <div class="form-group">
                        <label class="display-block">Select User</label>
                        <select name="username" id="username" class="select-menu-color">
                           <optgroup label="Receiver Id OR Username">
                            <option value="">-Select User-</option>
                              <?php 
                                 if(!empty($all_active_members) && count($all_active_members)>0)
                                 {
                                   foreach($all_active_members as $member)
                                   {
                                 ?>
                              <option value="<?php echo $member->user_id;?>"><?php echo $member->username;?></option>
                              <?php
                                 }
                                 }
                                 ?>
                           </optgroup>
                        </select>
                        <span style="color:red;font-weight:bold" class="valid_username"></span>
                     </div>
                     <div class="form-group">
                        <input type="text" disabled name="available_amount" id="available_amount" class="form-control" placeholder="Available Amount In UserWallet">
                     </div>
                     <div class="form-group">
                        <input type="number" min="0" value="0" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                        <span style="color:red;font-weight:bold" class="valid_amount"></span>
                     </div>
                     <div class="form-group">
                        <i>Available Amount Will be In AdminWallet</i>
                        <input type="number" name="admin_wallet_amount" id="admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>" disabled class="form-control" placeholder="Available Amount Will be In AdminWallet">
                        <input type="hidden" disabled id="current_admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>">
                     </div>
                     <div class="form-group">
                        <input type="text" name="desciption" id="desciption" class="form-control" placeholder="Enter Description">
                     </div>
                     <div class="form-group">
                        <input type="password" name="transaction_password" id="transaction_password" class="form-control" placeholder="Enter Transaction Password">
                        <span class="valid_transaction_password" style="color:red;font-weight:bold"></span>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="btn" value="add" id="addFundBtn" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Add Fund</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-2"></div>
      <div class="panel panel-flat col-md-5">
         <div class="panel-heading">
            <h5 class="panel-title">Deduct Fund from User Wallet</h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <form action="<?php echo ci_site_url();?>admin/UserWallet/deductFundFromUserWallet" method="post">
                  <div class="">
                      <div class="form-group">
                        <label class="display-block">Select User</label>
                        <select name="username" id="d_username" class="select-menu-color">
                           <optgroup label="Receiver Id OR Username">
                              <option value="">-Select User-</option>
                              <?php 
                                 if(!empty($all_active_members) && count($all_active_members)>0)
                                 {
                                   foreach($all_active_members as $member)
                                   {
                                 ?>
                              <option value="<?php echo $member->user_id;?>"><?php echo $member->username;?></option>
                              <?php
                                    }
                                 }
                                 ?>
                           </optgroup>
                        </select>
                        <span style="color:red;font-weight:bold" class="d_valid_username"></span>
                     </div>                     
                     <div class="form-group">
                        <input type="text" disabled name="available_amount" id="d_available_amount" class="form-control" placeholder="Available Amount In UserWallet">
                        <input type="hidden" disabled id="d_current_user_wallet_amount">
                     </div>
                     <div class="form-group">
                        <input type="number" min="0" value="0" name="amount" id="d_amount" class="form-control" placeholder="Enter Amount">
                        <span style="color:red;font-weight:bold" class="d_valid_amount"></span>
                     </div>
                     <div class="form-group">
                        <i>Amount Will be In AdminWallet</i>
                        <input type="number" name="admin_wallet_amount" id="d_admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>" disabled class="form-control" placeholder="Available Amount Will be In AdminWallet">
                        <input type="hidden" disabled id="d_current_admin_wallet_amount" value="<?php echo $admin_wallet_amount;?>">
                     </div>
                     <div class="form-group">
                        <input type="text" name="desciption" id="d_desciption" class="form-control" placeholder="Enter Description">
                     </div>
                     <div class="form-group">
                        <input type="password" name="transaction_password" id="d_transaction_password" class="form-control" placeholder="Enter Transaction Password">
                        <span class="d_valid_transaction_password" style="color:red;font-weight:bold"></span>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="btn" value="add" id="deductFundBtn" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Deduct Fund</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
   //code for add fund
   $(document).ready(function(){
         $("#username").change(function(){
            var username=$(this).val();
            $.ajax({
                  url: "<?php echo ci_site_url();?>admin/UserWallet/getUserEwalletBalance/"+username,
                  method: "GET",
                  success:function(res){
                         if(res.user=='1')
                         {
                           $("#available_amount").val(res.balance);
                         }
                         else 
                         {
                           $(".valid_username").text('Sorry username does not exists');
                           $("#available_amount").val(0);
                         }
   
                  }
            });
         }); //end change
         $("#amount").bind('keyup change blur',function(){
            var amount=$(this).val();
            var username=$("#username").val();
            var admin_wallet_amount=parseInt($("#current_admin_wallet_amount").val());
            if(username=="<?php echo COMP_USERNAME;?>" || username=="<?php echo COMP_USER_ID;?>" )
            {
              if(!isNaN(amount) && amount!='')
              {
               admin_wallet_amount=parseInt(amount)+admin_wallet_amount;
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
              else if(amount=='')
              {
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
            }
            else 
            {
              if(!isNaN(amount) && amount!='')
              {
               admin_wallet_amount=admin_wallet_amount-parseInt(amount);
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
              else if(amount=='')
              {
               $("#admin_wallet_amount").val(admin_wallet_amount);
              }
           }
         }) 
   ///////////////////////////////
        $("#username").change(function(){
          if($(this).val().length>0)
          {
            $(".valid_username").text('');
          }
        });
        $("#amount").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".valid_amount").text('');
          }
        });
        $("#transaction_password").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".valid_transaction_password").text('');
          }
        });
   
   /////////////////////////
        $("#addFundBtn").click(function(){
         if($("#username").val()=="")
         {
           $(".valid_username").text('Please select username');
           return false;
         }
         if($("#amount").val()==0)
         {
           $(".valid_amount").text('Please enter amount');
           return false;
         }
         if($("#transaction_password").val()=="")
         {
           $(".valid_transaction_password").text('Please enter transaction password');
           return false;
         }
         if($("#transaction_password").val()!='<?php echo $transaction_password;?>')
         {
           $(".valid_transaction_password").text('Please enter valid transaction password');
           return false;
         }
        });//end btn click here
   });//end ready
   
   /////////////////////////////////
   
   $(document).ready(function(){
         $("#d_username").change(function(){
            var username=$(this).val();
            $.ajax({
                  url: "<?php echo ci_site_url();?>admin/UserWallet/getUserEwalletBalance/"+username,
                  method: "GET",
                  success:function(res){
                         if(res.user=='1')
                         {
                           $("#d_available_amount").val(res.balance);
                           $("#d_current_user_wallet_amount").val(res.balance);
                         }
                         else 
                         {
                           $(".d_valid_username").text('Sorry username does not exists');
                           $("#d_available_amount").val(0);
                         }
   
                  }
            });
         }); //end change
         $("#d_amount").bind('keyup change blur',function(){
            var amount=$(this).val();
            var username=$("#d_username").val();
            var admin_wallet_amount=parseInt($("#d_current_admin_wallet_amount").val());
            var user_wallet_amount=parseInt($("#d_current_user_wallet_amount").val());
            
            /////////////
            if(!isNaN(amount) && amount!='')
             {
               admin_wallet_amount=parseInt(amount)+admin_wallet_amount;
               $("#d_admin_wallet_amount").val(admin_wallet_amount);
             }
             else if(amount=='')
             {
               $("#d_admin_wallet_amount").val(admin_wallet_amount);
             }
             //////////////
             if(!isNaN(amount) && amount!='')
             {
               user_wallet_amount=user_wallet_amount-parseInt(amount);
               $("#d_available_amount").val(user_wallet_amount);
             }
             else if(amount=='')
             {
               $("#d_available_amount").val(user_wallet_amount);
             }
         }) 
   ///////////////////////////////
        $("#d_username").change(function(){
          if($(this).val().length>0)
          {
            $(".d_valid_username").text('');
          }
        });
        $("#d_amount").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".d_valid_amount").text('');
          }
        });
        $("#d_transaction_password").keyup(function(){
          if($(this).val().length>0 && $(this).val()>0)
          {
            $(".d_valid_transaction_password").text('');
          }
        });
       /////////////////////////
        $("#deductFundBtn").click(function(){
         if($("#d_username").val()=="")
         {
           $(".d_valid_username").text('Please select username');
           return false;
         }
         if($("#d_amount").val()==0)
         {
           $(".d_valid_amount").text('Please enter amount');
           return false;
         }
         if($("#d_transaction_password").val()=="")
         {
           $(".d_valid_transaction_password").text('Please enter transaction password');
           return false;
         }
         if($("#d_transaction_password").val()!='<?php echo $transaction_password;?>')
         {
           $(".d_valid_transaction_password").text('Please enter valid transaction password');
           return false;
         }
        });//end btn click here
   
   });//end ready
</script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/form_select2.js"></script>