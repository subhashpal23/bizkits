	<!-- footer -->
			<footer>
				<div class="top-footer">
					<div class="top-1">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">
									<div class="f-about">
									<div class="f-logo">
										
											
											<a target="_blank" href="#"><img src="<?php echo base_url();?>frontassets/images/inter.png" alt="s chand group"  class="dnd_covergia">
											</a>
										</div>
										<p>The Interschool Affiliate program is an online marketing program where you promote Interschool products to your friends, customers etc and get paid commissions for every successful purchase. <a href="#"><b>Sign Up</b></a></p>
									</div>
								</div>
								<div class="col-lg-4 col-xs-12 col-sm-6 col-md-4 pull-right">
									<div class="subscribe">
										<h3>Subscribe to our Newsletter</h3>
										<div class="s-form">
										<form  #usersEmail="ngForm">
	                    <input id="subscribeEmail" placeholder="Email"  type="email" required  class="form-control" name="subscribeEmail" />
	                    <div onclick="subscribeNow()" class="btn-effect m-t-30">
	                         <input type="button" class="submit-btn" value="Subscribe now"  name="">
	                    </div>
	                  </form>
										</div>
										<div class="social-media m-t-30">
											<ul class="list-inline">
												<li><a rel="nofollow" target="_blank" href="#"><img src="<?php echo base_url();?>frontassets/images/yt.png"></a></li>
												<li><a rel="nofollow" target="_blank" href="#"><img src="<?php echo base_url();?>frontassets/images/fb.png"></a></li>
												<li><a rel="nofollow" target="_blank" href="#"><img src="<?php echo base_url();?>frontassets/images/tw.png"></a></li>
												<li><a rel="nofollow" target="_blank" href="#"><img src="<?php echo base_url();?>frontassets/images/li.png"></a></li>
												<li><a rel="nofollow" target="_blank" href="#"><img src="<?php echo base_url();?>frontassets/images/in.png"></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<div class="bottom-footer">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
								<div class="cpy text-center">
									<p>Copyright © 2023 Interschool.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			<!-- Trigger the modal with a button -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>				
			
					
			
		
		
</footer>
			<!-- footer -->


		</div>
	
		<!-- web page -->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script defer src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.js'></script>
		<script defer src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
		<script defer src="<?php echo base_url();?>frontassets/js/jquery.fancybox.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script defer src="<?php echo base_url();?>frontassets/js/main.js"></script>
			<style>
a.headcfd {
    min-width: 100%;
}
a.headcfd h2 {
    background: white;
    color: #b13014;
    font-size: 25px;
    padding: 6px 18px;
}
		 .about-sec {background: #dfe0e2ad !important;}

		  .pdf_inqry{width:85%;margin:0 auto;    min-height: 500px;}

		 .pdf_inqry .details h5{font-size: 14px;font-weight: bold;line-height: 20px; text-align: justify;}

		 .about-sec-1 {background-color: transparent !important;}

		 .ck-window{width:37% !important;}

		 .ck-content{/*background:url('images/funtime/popup.jpg') no-repeat 100%;min-height: 472px;*/padding: 0;}
		 .ck-content img{width:100%;}
		 .ck-window .accordion{display:none;}

		 .ck-choise{display: block;background: #ef7f1b;}

		 .ck-choise .btn-refuse{display:none;}.ck-choise .btn-accept{background:transparent !important;}
		 .ck-choise .btn-accept{width: 100%;font-size: 14px;text-transform: none;padding: 0;} 
		 
		 @media screen 
    and (min-width : 240px) 
    and (max-width : 360px)
    {.ck-window{width:82% !important;top: 145px;}
      .ck-content {background-size: contain;}  
       
    }

@media screen 
    and (min-width : 361px) 
    and (max-width : 600px)
	{ .ck-window{width:82% !important;top: 145px;}
      .ck-content {background-size: contain;} }

@media screen 
    and (min-width : 551px) 
    and (max-width : 767px)
	{.ck-window{width:82% !important;top: 145px;}
      .ck-content {background-size: contain;}  }

		</style>

 	</body>
</html>
<script>
function checkusername(str)
{
    str=str.replace(/ /g,'');
    //alert(str);
    $("#username").val(str);
}

function check_sponsor(sponsor_id)
{
	 //var platform=$("#platform").val();
	 if(sponsor_id=='')
     {
		 
         $("#check_sponsor").children().remove();
         $("#check_sponsor").append('<div>Please enter referral ID!</div>').css({
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
         //$("#check_sponsor").append(loader_image);
         //var platform=$("#platform").val();
		 
		 $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isUserNameExists',
               data: {username:sponsor_id,requestType:'sponsor'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    //$("#overlay").fadeIn(300);
                  },
               success:function(res){
               	
                 $("#check_sponsor").children().remove();
                 if(res.exist!='1')
                 {
                  $("#check_sponsor").append('<div class="text-danger">Sorry Referral does not exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                  //$("#sponsor_id").focus();
                 }//end if
                 else 
                 {
                  $("#check_sponsor").append('<div class="text-success">'+res.username+' Exist</div>').css({
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
                    //$("#overlay").fadeOut(300);
                }

          });//end ajax
     }
}//end function

//$(document).ready(function(){alert("call")});
function check_user(upline_id)
{
    var platform=$("#platform").val();
	 if(upline_id=='')
     {
         $("#check_user").children().remove();
         $("#check_user").append('<div>Please enter upline ID!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
     }
	 else if(platform=='')
	 {
			$("#valid_platform").children().remove();
			$("#valid_platform").append('<div>Please select package first!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
		$("#upline_id").val(null);
		$("#platform").focus();		  
		return false;			  
	 }
     else 
     {
         //$("#check_sponsor").append(loader_image);
         var platform=$("#platform").val();
		 
		 $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isUserNameExists',
               data: {username:upline_id,requestType:'upline','pkg_id':platform},
               async:false,
               beforeSend: function () {
                    $("#overlay").fadeIn(300);
                  },
               success:function(res){
                 $("#check_user").children().remove();
                 if(res.exist!='1')
                 {
                  $("#check_user").append('<div class="text-danger">Sorry Upline does not exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                  //$("#sponsor_id").focus();
                 }//end if
                 else 
                 {
                  $("#check_user").append('<div class="text-success">'+res.username+' Exist</div>').css({
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
                    $("#overlay").fadeOut(300);
                }
          });//end ajax
     }
}
function check_username(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_assets/images/loader.gif" width="auto">';
     if(username=='')
     {
         $("#check_username").children().remove();
         $("#check_username").append('<div>Please enter login Id!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
                  //$("#sponsor_id").focus();
     }
     else 
     {
           //$("#check_username").append(loader_image);
           $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isUserNameExists',
               data: {username:username,requestType:'new_user'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    $("#overlay").fadeIn(300);
                  },
               success:function(res){
                 $("#check_username").children().remove();
                 if(res.exist=='1')
                 {
                  
                   $("#check_username").append('<div class="text-danger">Sorry '+username+' already exists!</div>').css({
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
                  $("#check_username").append('<div class="text-success">'+username+' available!</div>').css({
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
                    $("#overlay").fadeOut(300);
                } 
          });//end ajax
     }
}//end function

function check_idno(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_assets/images/loader.gif" width="auto">';
    var minLength = 10;
    var maxLength = 10;
    var charLength = username.length;
     if(username=='')
     {
         $("#check_idno").children().remove();
         $("#check_idno").html('<div>Please enter pan card!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
                  //$("#sponsor_id").focus();
     }
     else if(charLength < minLength){
        $('#check_idno').html('Length is short, minimum '+minLength+' required.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
    }else if(charLength > maxLength){
        $('#check_idno').html('Length is not valid, maximum '+maxLength+' allowed.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
        $('#idno').val(char.substring(0, maxLength));
    }
    
     else 
     {
           //$("#check_username").append(loader_image);
           $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/isIdNoExists',
               data: {username:username,requestType:'new_user'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    $("#overlay").fadeIn(300);
                  },
               success:function(res){
                 $("#check_idno").children().remove();
                 if(res.exist=='1')
                 {
                  
                   $("#check_idno").html('<div>Sorry '+username+' already exists!</div>').css({
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
                  $("#check_idno").html('<div>'+username+' available!</div>').css({
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
                   $("#overlay").fadeOut(300);
                } 
          });//end ajax
     }
}//end function

//check_aadharno
function check_aadharno(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_assets/images/loader.gif" width="auto">';
     // check username should be 12 length
    var minLength = 12;
    var maxLength = 12;
    var charLength = username.length;
    if(username=='')
     {
        $("#check_aadharno").children().remove();
        $("#check_aadharno").html('<div>Please enter Aadhar No!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
        //$("#sponsor_id").focus();
     }
     else if(charLength < minLength){
        $('#check_aadharno').html('Length is short, minimum '+minLength+' required.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
    }else if(charLength > maxLength){
        $('#check_aadharno').html('Length is not valid, maximum '+maxLength+' allowed.').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });
        $('#aadharno').val(char.substring(0, maxLength));
    }
     
     else 
     {
        //$("#check_username").append(loader_image);
       $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>front/isAadharNoExists',
           data: {username:username,requestType:'new_user'},
           async:false,
           beforeSend: function () {
                //$("#load").css("display", "block");
                $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
              },
           success:function(res){
             $("#check_aadharno").children().remove();
             if(res.exist=='1')
             {
               $("#check_aadharno").html('<div>Sorry '+username+' already exists!</div>').css({
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
              $("#check_aadharno").html('<div>'+username+' available!</div>').css({
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
//$(document).ready(function(){alert("call")});

function showpasserror(value)
{
    var password=$("#passwords").val();
          var confirm_password=$("#confirm_password").val();
          if(password!=confirm_password)
          {
               $("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold'});
          }
          else
          {
               $("#valid_confirm_password").text("");
          }
}
     
     
     ////
     $("#btn").click(function(){
          
          var password=$("#passwords").val();
          var confirm_password=$("#confirm_password").val();
          if(password!=confirm_password)
          {
               $("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold'});
               $("#confirm_password").focus();
               return false;
          }
          
          /*if(!$("#term_cond").is(':checked'))
          {
               $("#valid_term_cond").text("Accept Terms & Condition!").css({'color':'red','font-weight':'bold'});
               //$("#term_cond").focus();
               return false;
          }*/
          return true;
     });
     $("#platform").change(function(){
		if($(this).val()!='')
		{
			$("#valid_platform").children().remove();
		}
	});

</script>