<!-- footer-area-start -->
	<footer>
		<!-- footer-top-start -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="footer-top-menu bb-2">
							<nav>
								<ul>
									<li><a href="<?php echo base_url();?>">home</a></li>
									<li><a href="<?php echo base_url();?>about-us">About Us</a></li>
									<li><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>
									<li><a href="<?php echo base_url();?>products">Products</a></li>
									
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer-top-start -->
		<!-- footer-mid-start -->
		<!--<div class="footer-mid ptb-50">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-12">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-12">
								<div class="single-footer br-2 xs-mb">
									<div class="footer-title mb-20">
										<h3>Products</h3>
									</div>
									<div class="footer-mid-menu">
										<ul>
											<li><a href="about.html">About us</a></li>
											<li><a href="#">Prices drop </a></li>
											<li><a href="#">New products</a></li>
											<li><a href="#">Best sales</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="single-footer br-2 xs-mb">
									<div class="footer-title mb-20">
										<h3>Our company</h3>
									</div>
									<div class="footer-mid-menu">
										<ul>
											<li><a href="contact.html">Contact us</a></li>
											<li><a href="#">Sitemap</a></li>
											<li><a href="#">Stores</a></li>
											<li><a href="register.html">My account </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<div class="single-footer br-2 xs-mb">
									<div class="footer-title mb-20">
										<h3>Your account</h3>
									</div>
									<div class="footer-mid-menu">
										<ul>
											<li><a href="contact.html">Addresses</a></li>
											<li><a href="#">Credit slips </a></li>
											<li><a href="#"> Orders</a></li>
											<li><a href="#">Personal info</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="single-footer mrg-sm">
							<div class="footer-title mb-20">
								<h3>STORE INFORMATION</h3>
							</div>
							<div class="footer-contact">
								<p class="adress">
									<span>My Company</span>
									Your address goes here.
								</p>
								<p><span>Call us now:</span> 0123456789</p>
								<p><span>Email:</span> demo@example.com</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<!-- footer-mid-end -->
		<!-- footer-bottom-start -->
		<div class="footer-bottom">
			<div class="container">
				<div class="row bt-2">
					<div class="col-lg-6 col-md-6 col-12">
						<div class="copy-right-area">
							<p>&copy; 2025 <strong> Bizkits </strong> </p>
						</div>
					</div>
					<!--<div class="col-lg-6 col-md-6 col-12">
						<div class="payment-img text-end">
							<a href="#"><img src="<?php echo base_url();?>frontassets/img/1.png" alt="payment" /></a>
						</div>
					</div>-->
				</div>
			</div>
		</div>
		<!-- footer-bottom-end -->
	</footer>
	<!-- footer-area-end -->


	<!-- all js here -->
	<!-- jquery latest version -->
	<script src="<?php echo base_url();?>frontassets/js/vendor/jquery-1.12.4.min.js"></script>
	
	
	<!-- bootstrap js -->
	<script src="<?php echo base_url();?>frontassets/js/bootstrap.min.js"></script>
	<!-- owl.carousel js -->
	<script src="<?php echo base_url();?>frontassets/js/owl.carousel.min.js"></script>
	<!-- meanmenu js -->
	<script src="<?php echo base_url();?>frontassets/js/jquery.meanmenu.js"></script>
	<!-- wow js -->
	<script src="<?php echo base_url();?>frontassets/js/wow.min.js"></script>
	<!-- jquery.parallax-1.1.3.js -->
	<script src="<?php echo base_url();?>frontassets/js/jquery.parallax-1.1.3.js"></script>
	<!-- jquery.countdown.min.js -->
	<script src="<?php echo base_url();?>frontassets/js/jquery.countdown.min.js"></script>
	<!-- jquery.flexslider.js -->
	<script src="<?php echo base_url();?>frontassets/js/jquery.flexslider.js"></script>
	<!-- chosen.jquery.min.js -->
	<script src="<?php echo base_url();?>frontassets/js/chosen.jquery.min.js"></script>
	<!-- jquery.counterup.min.js -->
	<script src="<?php echo base_url();?>frontassets/js/jquery.counterup.min.js"></script>
	<!-- waypoints.min.js -->
	<script src="<?php echo base_url();?>frontassets/js/waypoints.min.js"></script>
	<!-- plugins js -->
	<script src="<?php echo base_url();?>frontassets/js/plugins.js"></script>
	<!-- main js -->
	<script src="<?php echo base_url();?>frontassets/js/main.js"></script>
</body>

</html>

<script>
        /*document.addEventListener('click', function(event) {
            const form = document.querySelector('form');
            const searchResults = document.getElementById('search_query');
            
            // Check if the click is outside the form
            if (!form.contains(event.target)) {
                searchResults.value = ''; 
                liveSearch();
            }
        });
        
       function clearSearch() {
            
            //const searchInput = document.getElementById('search_query');
            liveSearch();
           // searchInput.value = ''; // Clear search text
        }*/
       /*$(document).ready(function () {
            window.liveSearch = function () { // Define globally
                let query = $("#search_query").val();
                let category = $("#category").val();
        
                if (query.length < 2) {
                    $("#search_results").hide();
                    return;
                }
        
                $.ajax({
                    url: "<?= base_url('Web/fetch_products') ?>",
                    method: "POST",
                    data: { query: query, category: category },
                    success: function (data) {
                        $("#search_results").html(data).show();
                    }
                });
            };
        });*/
        var ALERT_TITLE = "Message!";
        var ALERT_BUTTON_TEXT = "Ok";
        
        function createCustomAlert(txt) {
        	d = document;
        
        	if(d.getElementById("modalContainer")) return;
        
        	mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
        	mObj.id = "modalContainer";
        	mObj.style.height = d.documentElement.scrollHeight + "px";
        	
        	alertObj = mObj.appendChild(d.createElement("div"));
        	alertObj.id = "alertBox";
        	if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
        	alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
        	alertObj.style.visiblity="visible";
        
        	h1 = alertObj.appendChild(d.createElement("h1"));
        	h1.appendChild(d.createTextNode(ALERT_TITLE));
        
        	msg = alertObj.appendChild(d.createElement("p"));
        	//msg.appendChild(d.createTextNode(txt));
        	msg.innerHTML = txt;
        
        	btn = alertObj.appendChild(d.createElement("a"));
        	btn.id = "closeBtn";
        	btn.class= 'add';
        	btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
        	btn.href = "#";
        	btn.focus();
        	btn.onclick = function() { removeCustomAlert();return false; }
        
        	alertObj.style.display = "block";
        	
        }
        function removeCustomAlert() {
        	document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
        }        
        function addcartproducts(id) {
          // Get the quantity value from the input field
            var qty = $('.qty-val').val();
            var price = $('input[name="price"]:checked').val();
            
            if (isNaN(qty) || qty < 1) {
                alert("Quantity must be at least 1.");
                return;
            }
    
        
            // Perform AJAX request
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url();?>Web/Cart/addToCartProducts/' + id + "/" + qty+"/"+price,
                data: { product_id: id, requestType: 'addCart' },
                async: false,
                beforeSend: function () {
                    // Optional: Add a loader or disable the button
                },
                success: function (res) {
                    console.log(res);
                    var res1 = JSON.parse(res);
                    $('.carttotal').html(res1.total);
                    $('.totalcost').html(res1.total_cost);
                    loadcartitems();
                    alert("Product added successfully.");
                    $("#scrollUp").click();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                complete: function () {
                    // Optional: Remove loader or enable the button
                }
            });
        }
       function addcartproductspackage(id,package) {
          // Get the quantity value from the input field
            var qty = 1;
            var price = package;
            
            if (isNaN(qty) || qty < 1) {
                alert("Quantity must be at least 1.");
                return;
            }
    
        
            // Perform AJAX request
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url();?>Web/Cart/addToCartProducts/' + id + "/" + qty+"/"+price,
                data: { product_id: id, requestType: 'addCart' },
                async: false,
                beforeSend: function () {
                    // Optional: Add a loader or disable the button
                },
                success: function (res) {
                    console.log(res);
                    var res1 = JSON.parse(res);
                    $('.carttotal').html(res1.total);
                    $('.totalcost').html(res1.total_cost);
                    loadcartitems();
                    alert("Product added successfully.");
                    $("#scrollUp").click();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                complete: function () {
                    // Optional: Remove loader or enable the button
                }
            });
        }
       function loadcartitems()
        {
            //alert(id);
            var qty = 1;
            $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/Cart/loadCartItems',
               data: {requestType:'addCart'},
               async:false,
               beforeSend: function () {
                    
                  },
               success:function(res){
                console.log(res);
                //alert(res);
                 
                 $('.cartplist').html(res);
                 
               },//end success
              complete: function () {
           
                } 
          });//end ajax
            
        }
        function removefromcartproducts(id)
        {
            //alert(id);
            $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/Cart/removeItemFromCartProducts/'+id+'/'+'/Removed',
               data: {product_id:id,requestType:'addCart'},
               async:false,
               beforeSend: function () {
                    
                  },
               success:function(res){
                console.log(res);
                var res1=JSON.parse(res);
                $('.carttotal').html(res1.total);
                $('.totalcost').html(res1.total_cost);
                 loadcartitems();
                 alert("Product removed successfully.");
                 $("#scrollUp").click();
                 setTimeout(function() {
                    location.reload();
                }, 2000);
               },//end success
              complete: function () {
           
                } 
          });//end ajax
            
        } 
        function updatecartpackage(id)
        {
            //alert(id);
            var price = $('#package_'+id).val();
            $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/Cart/updateQtyProductsPackage/'+id+'/'+price,
               data: {product_id:id,price:price,requestType:'addCart'},
               async:false,
               beforeSend: function () {
                    
                  },
               success:function(res){
                console.log(res);
                var res1=JSON.parse(res);
                $('.carttotal').html(res1.total);
                $('.totalcost').html(res1.total_cost);
                $('.totaldiscount').html(res1.total_discount);
                $('.gtotalcost').html(res1.grand_total_cost);
                 loadcartitems();
                 loadcartpage();
                 alert("Package upgrade updated successfully.");
                 $("#scrollUp").click();
                 setTimeout(function() {
                    location.reload();
                }, 2000);
               },//end success
              complete: function () {
           
                } 
          });//end ajax
            
        }
        function updatecart(id)
        {
            //alert(id);
            var qty = $('#quantity_'+id).val();
            $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/Cart/updateQtyProducts/'+id+'/'+qty,
               data: {product_id:id,qty:qty,requestType:'addCart'},
               async:false,
               beforeSend: function () {
                    
                  },
               success:function(res){
                console.log(res);
                var res1=JSON.parse(res);
                $('.carttotal').html(res1.total);
                $('.totalcost').html(res1.total_cost);
                $('.totaldiscount').html(res1.total_discount);
                $('.gtotalcost').html(res1.grand_total_cost);
                 loadcartitems();
                 loadcartpage();
                 alert("Cart updated successfully.");
                 $("#scrollUp").click();
                 setTimeout(function() {
                    location.reload();
                }, 2000);
               },//end success
              complete: function () {
           
                } 
          });//end ajax
            
        }
        function loadcartpage()
        {
            //alert(id);
            var qty = 1;
            $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/Cart/loadCartPage',
               data: {requestType:'addCart'},
               async:false,
               beforeSend: function () {
                    
                  },
               success:function(res){
                console.log(res);
                //alert(res);
                 
                 $('#shocartpage').html(res);
                 
               },//end success
              complete: function () {
           
                } 
          });//end ajax
            
        }    
        function removefromcartproduct(id)
        {
            //alert(id);
            $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/Cart/removeItemFromCartProducts/'+id+'/'+'/Removed',
               data: {product_id:id,requestType:'addCart'},
               async:false,
               beforeSend: function () {
                    
                  },
               success:function(res){
                console.log(res);
                var res1=JSON.parse(res);
                $('.carttotal').html(res1.total);
                $('.totalcost').html(res1.total_cost);
                $('.totaldiscount').html(res1.total_discount);
                $('.gtotalcost').html(res1.grand_total_cost);
                 loadcartitems();
                 loadcartpage();
                 alert("Product removed successfully.");
                 $("#scrollUp").click();
                  setTimeout(function() {
                    location.reload();
                }, 2000);
               },//end success
              complete: function () {
           
                } 
          });//end ajax
            
        }      
        function clearCartItems()
        {
            $.ajax({
               type:'POST',
               url:'<?php echo site_url();?>Web/Cart/clearCart',
               data: {requestType:'addCart'},
               async:false,
               beforeSend: function () {
                    
                  },
               success:function(res){
                 alert("All Product removed successfully.");
                 $("#scrollUp").click();
                  setTimeout(function() {
                    location.reload();
                }, 2000);
               },//end success
              complete: function () {
           
                } 
          });//end ajax
            
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
        }


    </script>