<footer>
			<div class="footer-top-area black-bg pt-40 pb-10">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4">
							<div class="footer-section mb-30">
								<a href="index.html"><img src="img/logo/2.png" alt="" /></a>
								<p>There are many variations of passaes of Ipsum, but the majority have sueratio inome fornjected humour</p>
								<div class="social-icon">
									<a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
									<a target="_blank" href="https://twitter.com/?lang=en"><i class="fa fa-rss"></i></a>
									<a target="_blank" href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a>
									<a target="_blank" href="https://twitter.com/?lang=en"><i class="fa fa-google-plus"></i></a>
									<a target="_blank" href="https://twitter.com/?lang=en"><i class="fa fa-pinterest"></i></a>
									<a target="_blank" href="https://twitter.com/?lang=en"><i class="fa fa-instagram"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-2">
							<div class="single-footer mb-30">
								<h5>Link</h5>
								<ul class="footer-menu">
									<li><a href="#">Courses</a></li>
									<li><a href="#">Events</a></li>
									<li><a href="#">Gallery</a></li>
									<li><a href="#">About</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-3">
							<div class="single-footer mb-30">
								<h5>Support</h5>
								<ul class="footer-menu">
									<li><a href="#">Documentation</a></li>
									<li><a href="#">Forums</a></li>
									<li><a href="#">Language Packs</a></li>
									<li><a href="#">Release Status</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-3">
							<div class="single-footer mb-30">
								<h5>Our Compus</h5>
								<ul class="footer-menu">
									<li><a href="#">About</a></li>
									<li><a href="#">News</a></li>
									<li><a href="#">Contact</a></li>
									<li><a href="#">Become a Teacher</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom-area default-bg ptb-20">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="copyright">
								<p>&copy; Univ <?php echo date('Y');?> Made With <i class="fa fa-heart"></i> by <a href="#" target="_blank" rel="noopener">test</a></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="footer-icon floatright">
								<a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
								<a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
								<a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a>
								<a href="https://plus.google.com"><i class="fa fa-google-plus"></i></a>
								<a href="https://youtube.com/"><i class="fa fa-youtube-square"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
<!-- all js here -->
        <script src="<?php echo base_url();?>webassets/js/vendor/jquery.min.js"></script>
        <script src="<?php echo base_url();?>webassets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>webassets/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url();?>webassets/js/jquery.counterup.min.js"></script>
		<script src="<?php echo base_url();?>webassets/js/waypoints.min.js"></script>
		<script src="<?php echo base_url();?>webassets/js/wow.min.js"></script>
		<script src="<?php echo base_url();?>webassets/js/jquery.mb.YTPlayer.min.js"></script>
		<script src="<?php echo base_url();?>webassets/js/jquery.meanmenu.js"></script>
        <script src="<?php echo base_url();?>webassets/js/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo base_url();?>webassets/js/plugins.js"></script>
        <script src="<?php echo base_url();?>webassets/js/main.js"></script>
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
          
          if(!$("#term_cond").is(':checked'))
          {
               $("#valid_term_cond").text("Accept Terms & Condition!").css({'color':'red','font-weight':'bold'});
               //$("#term_cond").focus();
               return false;
          }
          return true;
     });
     $("#platform").change(function(){
		if($(this).val()!='')
		{
			$("#valid_platform").children().remove();
		}
	});

</script>