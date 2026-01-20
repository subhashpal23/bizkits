        <footer class="footer-wrapper footer-layout2">
            <!--<div class="container z-index-common">
                <div class="newsletter-wrap">
                    <div class="newsletter-content">
                        <div class="email-icon">
                            <img src="<?php echo base_url();?>frontassets/images/email_1.svg" alt="Icon">
                        </div>
                        <h4 class="newsletter-title">Sign Up to Get Updates & News About Us.</h4>
                    </div>
                    <form action="subscribe-mail.php" method="POST" class="newsletter-form">
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Email Address" required="">
                        </div>
                        <button type="submit" class="th-btn style3">Subscribe</button>
                    </form>
                </div>
            </div>-->
            <div class="widget-area">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-6 col-xl-auto">
                            <div class="widget footer-widget">
                                <div class="th-widget-about">
                                    <div class="about-logo">
                                        <a href="index.php">
                                            <img src="<?php echo base_url();?>frontassets/images/logo.png" alt="Frutin">
                                        </a>
                                    </div>
                                    <p class="about-text">Dream Buider africa is an enterprise development company.</p>
                                    <div class="th-social">
                                    <a href="https://web.facebook.com/i3empire">
                                    <i class="fab fa-facebook-f"></i>
                                     </a>
                                    <a href="https://www.instagram.com/i3empire/">
                                    <i class="fab fa-instagram"></i>
                                     </a>
                                     <a href="https://youtube.com/@i3empire">
                                       <i class="fab fa-youtube"></i>
                                     </a>
                                   <a href="#">
                                  <i class="fa-brands fa-telegram"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-auto">
                            <div class="widget widget_nav_menu footer-widget">
                                <h3 class="widget_title">
                                    <img src="<?php echo base_url();?>frontassets/images/title_icon.svg" alt="Icon">Categories
                                </h3>
                                <div class="menu-all-pages-container">
                                    <ul class="menu">
                                        <li>
                                            <a href="commission-structure.php">Compensation Plan</a>
                                        </li>
                                        <li>
                                            <a href="products.php">Our Products</a>
                                        </li>
                                        <li>
                                            <a href="#">Client Support</a>
                                        </li>
                                        <li>
                                            <a href="#">Privacy & Policy</a>
                                        </li>
                                        <li>
                                            <a href="#">Term of Use</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-auto">
                            <div class="widget widget_nav_menu footer-widget">
                                <h3 class="widget_title">
                                    <img src="<?php echo base_url();?>frontassets/images/title_icon.svg" alt="Icon">Quick Links
                                </h3>
                                <div class="menu-all-pages-container">
                                    <ul class="menu">
                                        <li>
                                            <a href="#">Sign in</a>
                                        </li>
                                        <li>
                                            <a href="about.php">About US</a>
                                        </li>
                                        <li>
                                            <a href="#">Help & FAQs</a>
                                        </li>
                                        <li>
                                            <a href="blog.php">Blog</a>
                                        </li>
                                        <li>
                                            <a href="contact.php">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-auto">
                            <div class="widget footer-widget">
                                <h3 class="widget_title">
                                    <img src="<?php echo base_url();?>frontassets/images/title_icon.svg" alt="Icon">Contact Us
                                </h3>
                                <div class="th-widget-contact">
                                    <div class="info-box">
                                        <div class="info-box_icon">
                                            <i class="fas fa-location-dot"></i>
                                        </div>
                                        <p class="info-box_text">1, Anisere Street, Business Complex, Anisere Bus Stop, Governor Road, Ikotun Lagos State, Nigeria.</p>
                                    </div>
                                    
                                    <div class="info-box">
                                        <div class="info-box_icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <p class="info-box_text">
                                            <a href="mailto:contact@i3empire.com" class="info-box_link">contact@xyz.com</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-wrap" data-bg-src="<?php echo base_url();?>frontassets/images/copyright_bg_1.png">
                <div class="container">
                    <div class="row gy-2 align-items-center">
                        <div class="col-md-6">
                            <p class="copyright-text">
                                Copyright <i class="fa-solid fa-copyright"></i>
                                2024 <a href="https://i3empire.com/">Dream Buider</a>
                                . All Rights Reserved.
                            </p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </footer>

                    <div class="scroll-top">
            <svg class="progress-circle svg-content" width="1%" height="1%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
            </svg>
        </div>
        <script src="<?php echo base_url();?>frontassets/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo base_url();?>frontassets/js/app.min.js"></script>
        <script src="<?php echo base_url();?>frontassets/js/main.js"></script>
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
     //var loader_image='<img src="<?php echo site_url();?>front_<?php echo base_url();?>frontassets/images/loader.gif" width="auto">';
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
     //var loader_image='<img src="<?php echo site_url();?>front_<?php echo base_url();?>frontassets/images/loader.gif" width="auto">';
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
     //var loader_image='<img src="<?php echo site_url();?>front_<?php echo base_url();?>frontassets/images/loader.gif" width="auto">';
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
                $.loader("on", '<?php echo site_url();?>admin_<?php echo base_url();?>frontassets/images/default.svg');
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
                $.loader("off", '<?php echo site_url();?>admin_<?php echo base_url();?>frontassets/images/default.svg');
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

function myFunction(inco,icon) {
  var x = document.getElementById(inco);
  var i = document.getElementById(icon);
  if (x.type === "password") {
    x.type = "text";
    i.type = "text";
    
  } else {
    x.type = "password";
    i.type = "password";
    
  }
}

function checkPasswordMatch() {
    var password = $("#passwords").val();
    var confirmPassword = $("#confirm_password").val();
    if (password != confirmPassword)
    $("#valid_confirm_password").html("<font color='red'>Login Password Do Not Match!</font>");
    else
    $("#valid_confirm_password").html("<font color='green'>Passwords match.</font>");
    }
    
    function checkPasswordMatch1() {
    var password1 = $("#passwords1").val();
    var confirmPassword1 = $("#confirm_password1").val();
    if (password1 != confirmPassword1)
    $("#valid_confirm_password1").html("<font color='red'>Transaction Password Do Not Match!");
    else
    $("#valid_confirm_password1").html("<font color='green'>Passwords match.</font>");
    }
    
    
    function addtocart(id)
    {
        //alert(id);
        var pkg = $('#package option:selected').data('price');
        var qty = $('#qty_'+id).val();
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/Cart/addToCart/'+id+"/"+pkg+"/"+qty,
           data: {product_id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               
            console.log(res);
            var res1=JSON.parse(res);
            console.log(res1.total);
            if(parseInt(pkg)==parseInt(res1.total_cost))
            {
                $("#createbtn").show();
            }
            else
            {
                $("#createbtn").hide();
            }
             if(res1.total>=1)
             {
                 if(res1.reason=='')
                 {
                    $('#removecart_'+id).show();
                    $('#addcart_'+id).hide();
                    $('#qty_'+id).hide();
                 }
                 else
                 {
                    $('#removecart_'+id).hide();
                    $('#addcart_'+id).show();
                    $('#qty_'+id).show();
                 }
              $("#total_message").html(res1.msg).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html(res1.reason).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
               $("#total_cost").html("Total Amount:<?php echo currency();?>"+res1.total_cost).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_product").html("Total Products:"+res1.total).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }//end if
             else 
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                $("#total_product").html('').css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_cost").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              
              $("#total_message").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html('').css({
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
       
            } 
      });//end ajax
        
    }
    
    function removefromcart(id)
    {
        //alert(id);
        var pkg = $('#package option:selected').data('price');
        var qty = $('#qty_'+id).val();
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/Cart/removeItemFromCart/'+id+'/'+pkg+'/Removed',
           data: {product_id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
            console.log(res);
            var res1=JSON.parse(res);
            console.log(res1.total);
            if(parseInt(pkg)==parseInt(res1.total_cost))
            {
                $("#createbtn").show();
            }
            else
            {
                $("#createbtn").hide();
            }
             if(res1.total>=1)
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                 $("#total_message").html(res1.msg).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html(res1.reason).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
               $("#total_cost").html("Total Amount:<?php echo currency();?>"+res1.total_cost).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_product").html("Total Products:<?php echo currency();?>"+res1.total).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }//end if
             else 
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                $("#total_product").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_cost").html('').css({
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
       
            } 
      });//end ajax
        
    }


    function showStockistStateWise(state_id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/showStockistStateWise/'+state_id,
           data: {state_id:state_id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            $("#stockist").html(res);
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
    
    function showStockist(id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/showStockist/'+id,
           data: {id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            $("#showstockistdetails").html(res);
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
</script>
