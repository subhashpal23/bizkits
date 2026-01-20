<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Investment Management</span> - <?php echo $title;?></h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               
            </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li>Investment Management</li>
            <li class='active'><?php echo $title;?></li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Horizontal form options -->
      <div class="row">
         <?php 
         if(!empty($this->session->flashdata('flash_msg')))
         {
         ?>
         <div class="col-md-12">
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <?php echo $this->session->flashdata('flash_msg');?>
            </div>
         </div>
         <?php    
         }
         ?>
         <?php 
         if(!empty($this->session->flashdata('error_msg')))
         {
         ?>
         <div class="col-md-12">
            <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <?php echo $this->session->flashdata('error_msg');?>
            </div>
         </div>
         <?php    
         }
         ?>
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="panel panel-flat border-top-success">
               <!-- Subscription form -->
               <div class="panel panel-flat">
                  <div class="panel-heading">
                     <h6 class="panel-title">Invest Fund </h6>
                  </div>
                  <?php 
                  //echo $invest_count;
                  if($invest_count>0)
                  {
                      ?>
                      <div class="form-group has-feedback">
                        <samp style="color:red;" class="col-md-12">You have invested in <?php echo $invest_info->title.' income of amount '.currency().$invest_info->amount.' on '.date(date_formats(),strtotime($invest_info->request_date));;?></samp>
                     </div>
                      <?php
                  }
                  else
                  {
                  echo form_open(ci_site_url()."user/investment/purchaseFund",array('method'=>'post' ,'id'=>'invest_form','class'=>'panel-body', 'enctype'=>'multipart/form-data'));
                  ?>
                     <div class="form-group has-feedback">
                        <select name="deposit_title" id="deposit_title" class="form-control">
                            <option value="">Select Income Type</option>
                            <option value="psi">PSI Income</option>
                            <option value="roi">ROI Income</option>
                            <option value="staking">Staking Income</option>
                        </select>
                     </div>

                     <div class="form-group has-feedback amount" style="display:none">
                        <input id="deposit_amount" name="deposit_amount" type="text" value="<?php echo $current_balance;?>" readonly class="form-control" placeholder="Enter Purchase Amount">
                        <samp style="color:red;" class="col-md-12">*Minimum Amount <?php $currency=currency();echo $currency.'200';?></samp>
                        
                        <span id="valid_deposit_amount" class="col-md-12" style="color:red;font-weight:bold"></span>
                        <samp id="valid_per" class="col-md-12" style="color:red;"></samp>
                     </div>
                     
                     <div class="form-group has-feedback amount" style="display:none">
                        <input id="tran_password" name="tran_password" type="password" placeholder="Password"  class="form-control">
                        <samp style="color:red;" class="col-md-12">Enter password for payment from wallet</samp>
                        <span id="valid_password" class="col-md-12" style="color:red;font-weight:bold"></span>
                        
                     </div>
                     <div class="row">
                        <div class="col-xs-6 text-right">
                           <button id="submit_btn" type="submit" name="btn" value='submit' class="btn btn-info" style="display:none;">Invest Fund</button>
                        </div>
                     </div>
                  <?php echo form_close();
                  }?>
               </div>
               <!-- /subscription form -->
            </div>
            <!-- /basic layout -->
         </div>
      </div>
      <!-- /vertical form options -->
      <!-- Footer -->
      <?php 
         $this->load->view('common/footer-text');
      ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<script>
$(document).ready(function(){
   $("#deposit_amount").keyup(function()
   {
        var deposit_amount=parseInt($(this).val());
        var deposit_title=$("#deposit_title").val();
        var tran_password=$("#tran_password").val();
        var per='';
        if(isNaN($(this).val()))
        {
            $("#valid_deposit_amount").text("Please enter valid invest amount!").css('display','');
            $("#valid_per").text(null).css('display','none');
            return false;
        }
        
        else
        {
            $("#valid_password").text(null).css('display','none');
            if(deposit_amount<200)
            {
                $("#valid_deposit_amount").text("Please enter minimum 200USD!").css('display','');
                $("#valid_per").text(null).css('display','none');
                return false;
            }
            else if(deposit_amount>=200 && deposit_amount<10000)
            {
                if(deposit_title=='psi')
                {
                    per='0.20';
                }
                else if(deposit_title=='roi')
                {
                    per='0.40';
                }
                else if(deposit_title=='staking')
                {
                    per='0.55';
                }
                
            }
            else if(deposit_amount>=10000)
            {
                if(deposit_title=='psi')
                {
                    per='0.25';
                }
                else if(deposit_title=='roi')
                {
                    per='0.50';
                }
                else if(deposit_title=='staking')
                {
                    per='0.60';
                }
            }
            else
            {
                $("#valid_per").text(null).css('display','none');
            }
            $("#valid_per").text("Daily Trading Income:"+per+"% Upto 200%").css('display','');
        }
        $("#valid_deposit_amount").text(null).css('display','none');
   });//end keyUp
   $("#deposit_title").change(function(){
       var deposit_title=$(this).val();
       var tran_password=$("#tran_password").val();
       
       if(deposit_title!='')
        {
            $(".amount").show();
            $("#submit_btn").show();
        }
        
        else
        {
            $(".amount").hide();
            $("#submit_btn").hide();
            return false;
        }
        var deposit_amount=parseInt($("#deposit_amount").val());
        if($("#deposit_amount").val()=='' || $("#deposit_amount").val()==null)
        {
            $("#valid_deposit_amount").text("Please enter deposit amount!").css('display','');
            return false;
        }
        
        if(isNaN($("#deposit_amount").val()))
        {
            $("#valid_deposit_amount").text("Please enter valid invest amount!").css('display','');
            $("#valid_per").text(null).css('display','none');
            return false;
        }
        if(deposit_amount<200)
            {
                $("#valid_deposit_amount").text("Please enter minimum 200USD!").css('display','');
                return false;
            }
            else if(deposit_amount>=200 && deposit_amount<10000)
            {
                if(deposit_title=='psi')
                {
                    per='0.20';
                }
                else if(deposit_title=='roi')
                {
                    per='0.40';
                }
                else if(deposit_title=='staking')
                {
                    per='0.55';
                }
                
            }
            else if(deposit_amount>=10000)
            {
                if(deposit_title=='psi')
                {
                    per='0.25';
                }
                else if(deposit_title=='roi')
                {
                    per='0.50';
                }
                else if(deposit_title=='staking')
                {
                    per='0.60';
                }
            }
            else
            {
                $("#valid_per").text(null).css('display','none');
            }
            $("#valid_per").text("Daily Trading Income:"+per+"% Upto 200%").css('display','');
        return true;
   });//end submit btn click here
   $("#submit_btn").click(function(){
        var deposit_amount=parseInt($("#deposit_amount").val());
        var deposit_title=$("#deposit_title").val();
        var tran_password=$("#tran_password").val();
        if($("#deposit_amount").val()=='' || $("#deposit_amount").val()==null)
        {
            $("#valid_deposit_amount").text("Please enter deposit amount!").css('display','');
            return false;
        }
        else if(tran_password=='')
        {
            $("#valid_password").text("Please enter valid password!").css('display','');
            return false;
        }
        if(confirm("Are you sure want to invest in "+deposit_title))
        {
            return true;
        }
        return false;
   });//end submit btn click here
});//end ready
</script>            