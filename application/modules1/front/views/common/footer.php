<footer class="landing-footer-two">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img src="<?php echo base_url();?>front_assets/img/logo-light.svg" alt="">
          <p>Crypo is the most advanced UI kit for making the Blockchain platform. This kit comes with 4 different
            exchange page, market, wallet and many more</p>
          <ul class="social-icon">
            <li><a href="#"><i class="icon ion-logo-facebook"></i></a></li>
            <li><a href="#"><i class="icon ion-logo-twitter"></i></a></li>
            <li><a href="#"><i class="icon ion-logo-linkedin"></i></a></li>
            <li><a href="#"><i class="icon ion-logo-pinterest"></i></a></li>
            <li><a href="#"><i class="icon ion-logo-github"></i></a></li>
          </ul>
        </div>
        <div class="col-md-2">
          <h3>Company</h3>
          <ul>
            <li><a href="#">About</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Affiliates</a></li>
            <li><a href="#">Investors</a></li>
            <li><a href="#">Legal & privacy</a></li>
            <li><a href="#">Cookie policy</a></li>
          </ul>
        </div>
        <div class="col-md-2">
          <h3>Individuals</h3>
          <ul>
            <li><a href="#">Buy & sell</a></li>
            <li><a href="#">Earn free crypto</a></li>
            <li><a href="#">Wallet</a></li>
            <li><a href="#">Card</a></li>
            <li><a href="#">Payment methods</a></li>
            <li><a href="#">Account access</a></li>
          </ul>
        </div>
        <div class="col-md-2">
          <h3>Support</h3>
          <ul>
            <li><a href="#">Help center</a></li>
            <li><a href="#">Contact us</a></li>
            <li><a href="#">Create account</a></li>
            <li><a href="#">ID verification</a></li>
            <li><a href="#">Account information</a></li>
            <li><a href="#">Supported crypto</a></li>
          </ul>
        </div>
        <div class="col-md-2">
          <h3>Learn</h3>
          <ul>
            <li><a href="#">Browse crypto prices</a></li>
            <li><a href="#">Crypto basics</a></li>
            <li><a href="#">Tips & tutorials</a></li>
            <li><a href="#">Market updates</a></li>
            <li><a href="#">How to send crypto</a></li>
            <li><a href="#">What is a blockchain?</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>


  <script src="<?php echo base_url();?>front_assets/js/jquery-3.4.1.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/amcharts-core.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/amcharts.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/custom.js"></script>
</body>

</html>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/jquery.loading.block.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/loader.function.js"></script>
<!-----loader---->      
<script>
function check_sponsor(sponsor_id)
{
     var loader_image='<img class="loader_image" src="<?php echo site_url();?>admin_assets/images/loader.gif" width="auto">';
     if(sponsor_id=='')
     {
         jQuery("#check_sponsor").children().remove();
         jQuery("#check_sponsor").append('<div>Please enter sponsor username!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
     }
     else 
     {
         //jQuery("#check_sponsor").append(loader_image);
         jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>front/isUserNameExists',
               data: {username:sponsor_id,requestType:'sponsor'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    jQuery.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                  },
               success:function(res){
                 jQuery("#check_sponsor").children().remove();
                 if(res.exist!='1')
                 {
                  jQuery("#check_sponsor").append('<div>Sorry Sponsor does not exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                  //jQuery("#sponsor_id").focus();
                 }//end if
                 else 
                 {
                  jQuery("#check_sponsor").append('<div>'+res.username+' Exist</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
               complete: function () {
                    //$("#load").css("display", "none");
                    jQuery.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                }

          });//end ajax
     }
}//end function

//jQuery(document).ready(function(){alert("call")});
function check_username(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_assets/images/loader.gif" width="auto">';
     if(username=='')
     {
         jQuery("#check_username").children().remove();
         jQuery("#check_username").append('<div>Please enter username!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
                  //jQuery("#sponsor_id").focus();
     }
     else 
     {
           //jQuery("#check_username").append(loader_image);
           jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>front/isUserNameExists',
               data: {username:username,requestType:'new_user'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                  },
               success:function(res){
                 jQuery("#check_username").children().remove();
                 if(res.exist=='1')
                 {
                  
                   jQuery("#check_username").append('<div>Sorry '+username+' already exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }//end if
                 else 
                 {
                  jQuery("#check_username").append('<div>'+username+' available!</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
              complete: function () {
                    //$("#load").css("display", "none");
                    $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                } 
          });//end ajax
     }
}//end function
//jQuery(document).ready(function(){alert("call")});
jQuery(document).ready(function(){
     jQuery("#country").children().each(function(){
          if(jQuery(this).val()=='<?php echo $country;?>')
          {
            jQuery(this).attr('selected','true')
          }
     });
     /////////////////



 //////////check cond
	 jQuery("#con_no").click(function(){
		
	 if(jQuery('#con_no').is(':checked'))
	 {
	  
	 jQuery("#sponsor_id").val('company');	
	 jQuery("#sponsor_id").attr("disabled", "disabled");
	 jQuery("#check_sponsor").text(''); 
	 }
	 else
	 {
		  
		    jQuery("#sponsor_id").prop("disabled", false);	
			jQuery("#sponsor_id").val('');		
			jQuery("#check_sponsor").text('');   
			jQuery("sponsor_id").prop('required',true);	
	 }
	 });	 	 	 	 	 
     /////////////////






     jQuery("#confirm_password").blur(function(){

          var password=jQuery("#passwords").val();
          var confirm_password=jQuery(this).val();
          if(password!=confirm_password)
          {
               jQuery("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold','font-size': '13px'});
          }
          else
          {
               jQuery("#valid_confirm_password").text("");
          }

     });
     jQuery("#transaction_pwd1").blur(function(){
               var transaction_pwd=jQuery("#transaction_pwd").val();
               var confirm_transaction_pwd=jQuery(this).val();
               if(transaction_pwd!=confirm_transaction_pwd)
               {
                    jQuery("#valid_transaction_pwd1").text("Confirm Transaction password does not match!").css({'color':'red','font-weight':'bold','font-size': '13px'});
               }
               else
               {
                    jQuery("#valid_transaction_pwd1").text("");   
               }
     });
     ////
     jQuery("#btn").click(function(){
          var usernameExist=false;
          var username=jQuery("#username").val();
          jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>front/isUserNameExists',
               async:false,
               data: {username:username,requestType:'new_user'},
               success:function(res){
                 //jQuery("#check_username").children().remove();
                 if(res=='1')
                 {
                  usernameExist=true;
                 }//end if
               }//end success
          });//end ajax
          if(usernameExist)
          {
               //jQuery("#check_username").append("<div>Sorry username already available!</div>").css({'color':'red','font-weight':'bold'});
               jQuery("#username").focus();
               return false;
          }
          var password=jQuery("#passwords").val();
          var confirm_password=jQuery("#confirm_password").val();
          if(password!=confirm_password)
          {
               jQuery("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold','font-size': '13px'});
               jQuery("#confirm_password").focus();
               return false;
          }
          /*var transaction_pwd=jQuery("#transaction_pwd").val();
          var confirm_transaction_pwd=jQuery("#transaction_pwd1").val();
          if(transaction_pwd!=confirm_transaction_pwd)
          {
               jQuery("#valid_transaction_pwd1").text("Confirm Transaction password does not match!").css({'color':'red','font-weight':'bold'});
               jQuery("#transaction_pwd1").focus();
               return false;
          }*/
          if(!jQuery("#term_cond").is(':checked'))
          {
               jQuery("#valid_term_cond").text("Accept Terms & Condition!").css({'color':'red','font-weight':'bold','font-size': '13px'});
               //jQuery("#term_cond").focus();
               return false;
          }
          return true;
     });
     $("#chk").keyup(function(){
		$("#valid_captcha").text('');
		})
})
</script>
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
