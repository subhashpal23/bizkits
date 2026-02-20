
<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Bizkits</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>frontassets/img/logo/logo.png">

	<!-- all css here -->
	<!-- bootstrap v3.3.6 css -->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
	<!-- animate css -->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/animate.css">
	<!-- meanmenu css -->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/meanmenu.min.css">
	<!-- owl.carousel css -->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/owl.carousel.css">
	<!-- font-awesome css -->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/font-awesome.min.css">
	<!-- flexslider.css-->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/flexslider.css">
	<!-- chosen.min.css-->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/chosen.min.css">
	<!-- style css -->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/responsive.css">
	<!-- modernizr css -->
	<script src="<?php echo base_url();?>frontassets/js/vendor/modernizr-2.8.3.min.js"></script>
	<script>
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <style>
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      transition: transform 0.2s ease-in-out;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .icon-box {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      font-size: 1.8rem;
    }
    .home-4 .header-search form input, .home-5 .header-search form input {
    width: 100% !important;
}
.home-4 .header-search form a, .home-4 .header-mid-area .my-cart ul li span {
    background: #0346d9 none repeat scroll 0 0 !important;
}
.home-4 .menu-area ul li a::before, .home-4 .menu-area ul li::before, .home-4 .twitter-content .twitter-icon a {
    background: #0346d9 none repeat scroll 0 0 !important;
}
.home-4 .main-menu-area {
    background: #02205a none repeat scroll 0 0 !important;
}
.breadcrumbs-menu ul li a.active {
    color: #0346d9 !important;
}
.myaccount-tab-menu a:hover, .myaccount-tab-menu a.active {
    background-color: #02205a !important;
    border-color: #02205a !important;
}
.myaccount-content .welcome strong {
    color: #0346d9  !important;
}
  </style>
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

</head>

<body class="home-4">
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<!-- Add your site or application content here -->
	<!-- header-area-start -->
	<header>
		<!-- header-top-area-start -->
		<div class="header-top-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">
						<div class="language-area">
							<ul>
								<li><!--<img src="<?php echo base_url();?>frontassets/img/flag/1.jpg" alt="flag" /><a href="#">English<i class="fa fa-angle-down"></i></a>
									<div class="header-sub">
										<ul>
											<li><a href="#"><img src="<?php echo base_url();?>frontassets/img/flag/2.jpg" alt="flag" />france</a></li>
											<li><a href="#"><img src="<?php echo base_url();?>frontassets/img/flag/3.jpg" alt="flag" />croatia</a></li>
										</ul>
									</div>-->
									info@bizkits.org
								</li>
								<li><!--<a href="#">USD $<i class="fa fa-angle-down"></i></a>
									<div class="header-sub dolor">
										<ul>
											<li><a href="#">EUR €</a></li>
											<li><a href="#">USD $</a></li>
										</ul>
									</div>-->
									+8183466437348
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="account-area text-end">
							<ul>
								<?php if ($this->session->userdata('user_id')) : ?>
								<li><a href="<?php echo base_url();?>dashboard">My Account</a></li>
								<?php else : ?>
									<li><a href="<?= base_url('login') ?>">My Account</a></li>
								<?php endif; ?>
								<li><a href="<?php echo base_url();?>checkout">Checkout</a></li>
								<!-- <li><a href="<?php echo base_url();?>login">Sign in</a></li> -->
								<?php if ($this->session->userdata('user_id')) : ?>
									<!-- <a href="<?= base_url('dashboard') ?>">Dashboard</a> -->
								<?php else : ?>
									<li><a href="<?= base_url('login') ?>">Sign in</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- header-top-area-end -->
		<!-- header-mid-area-start -->
		<div class="header-mid-area ptb-40">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-5 col-12">
						<div class="header-search">
							<form action="#">
								<input type="text" placeholder="Search entire store here..." />
								<a href="#"><i class="fa fa-search"></i></a>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-4 col-12">
						<div class="logo-area text-center logo-xs-mrg">
							<a href="index.html"><img src="<?php echo base_url();?>frontassets/img/logo/logo.png" style="width:24%" alt="logo" /></a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-12">
						<div class="my-cart">
						    <?php
                                    $cart_item=$this->session->userdata('cart_reg');
                                    if($cart_item)
                                    {
                                        $count=count($cart_item);
                                    }
                                    ?>
							<ul>
								<li><a href="<?php echo base_url();?>shopcart"><i class="fa fa-shopping-cart"></i>My Cart</a>
									<span><?php echo ($count)?$count:0;?></span>
									<div class="mini-cart-sub">
									    
										<div class="cart-product">
										    <?php
                                            
                                            //pr($cart_item);
                                    	    // $str="<ul>";
                                    	    $str='';
                                    	    $cart_total=0;
                                    	    $currency=currency();
                                    	    foreach($cart_item as $item)
                                    		{
                                    		    $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
                                    		 
                                    		    $price=$item['package'];
                                    		    if($price=='Basic')
                                    			{
                                    			    $price_new=$product_details['price1'];
                                    			}
                                    			else if($price=='Economy')
                                    			{
                                    			    $price_new=$product_details['price2'];
                                    			}
                                    			else if($price=='Enterprise')
                                    			{
                                    			    $price_new=$product_details['price3'];
                                    			}
                                    			
                                        		$cart_total=$cart_total+($item['qty']*$price_new);
                                        		if($product_details['discount_type']=='per')
                                        		{
                                        		    $discount=((int)$price_new*(int)$product_details['discount'])/100;
                                        		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                        		}
                                        		else
                                        		{
                                        		    $discount=$product_details['discount'];
                                        		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                        		}
                                        		 
                                        		$str.='<div class="single-cart">
                                                    <div class="cart-img">
                                                        <a href="javascript:void(0);"><img alt="Nest" style="max-width:40% !important;" src="'.base_url().'product_images/'.$product_details["product_image"].'" /></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h5><a href="javascript:void(0);"><?php echo $product_details["title"];?></a></h5>
                                                        <p>'.$item["qty"].' × '.$currency.$price_new.$price.'</p>
                                                    </div>
                                                    <div class="cart-icon">
                                                        <a href="javscript:void(0);" onclick="removefromcartproducts('.$item['product_id'].')"><i class="fa fa-remove"></i></a>
                                                    </div>
                                                 </div>';
                                    		 
                                    		}
                                    		echo $str;
                                            ?>
											<!--<div class="single-cart">
												<div class="cart-img">
													<a href="#"><img src="<?php echo base_url();?>frontassets/img/product/1.jpg" alt="book" /></a>
												</div>
												<div class="cart-info">
													<h5><a href="#">Joust Duffle Bag</a></h5>
													<p>1 x £60.00</p>
												</div>
												<div class="cart-icon">
													<a href="#"><i class="fa fa-remove"></i></a>
												</div>
											</div>
											<div class="single-cart">
												<div class="cart-img">
													<a href="#"><img src="img/product/3.jpg" alt="book" /></a>
												</div>
												<div class="cart-info">
													<h5><a href="#">Chaz Kangeroo Hoodie</a></h5>
													<p>1 x £52.00</p>
												</div>
												<div class="cart-icon">
													<a href="#"><i class="fa fa-remove"></i></a>
												</div>
											</div>-->
										</div>
										<div class="cart-totals">
											<h5>Total <span style="background: #ffffff none repeat scroll 0 0 !important;"><?php echo $currency.$cart_total;?></span></h5>
										</div>
										<div class="cart-bottom">
											<a class="view-cart" href="<?php echo base_url();?>shopcart">view cart</a>
											<a href="<?php echo base_url();?>checkout">Check out</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- header-mid-area-end -->
		<!-- main-menu-area-start -->
		<div class="main-menu-area d-md-none d-none d-lg-block sticky-header-1" id="header-sticky">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="menu-area">
							<nav>
								<ul>
									<li class="active"><a href="<?php echo base_url();?>">Home<!--<i class="fa fa-angle-down"></i>--></a>
										<!--<div class="sub-menu">
											<ul>
												<li><a href="index.html">Home-1</a></li>
												<li><a href="index-2.html">Home-2</a></li>
												<li><a href="index-3.html">Home-3</a></li>
												<li><a href="index-4.html">Home-4</a></li>
												<li><a href="index-5.html">Home-5</a></li>
												<li><a href="index-6.html">Home-6</a></li>
												<li><a href="index-7.html">Home-7</a></li>
											</ul>
										</div>-->
									</li>
									<li><a href="<?php echo base_url();?>products">Products<!--<i class="fa fa-angle-down"></i>--></a>
										<!--<div class="mega-menu">
											<span>
												<a href="#" class="title"></a>
												<a href="shop.html">Tops & Tees</a>
												<a href="shop.html">Polo Short Sleeve</a>
												<a href="shop.html">Graphic T-Shirts</a>
												<a href="shop.html">Jackets & Coats</a>
												<a href="shop.html">Fashion Jackets</a>
											</span>
											
										</div>-->
									</li>
									<li><a href="<?php echo base_url();?>about-us">About Us</a></li>
									<li><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>
									<!--<li><a href="product-details.html">Products<i class="fa fa-angle-down"></i></a>
										<div class="mega-menu">
											<span>
												<a href="#" class="title">Jackets</a>
												<a href="shop.html">Tops & Tees</a>
												<a href="shop.html">Polo Short Sleeve</a>
												<a href="shop.html">Graphic T-Shirts</a>
												<a href="shop.html">Jackets & Coats</a>
												<a href="shop.html">Fashion Jackets</a>
											</span>
											<span>
												<a href="#" class="title">weaters</a>
												<a href="shop.html">Crochet</a>
												<a href="shop.html">Sleeveless</a>
												<a href="shop.html">Stripes</a>
												<a href="shop.html">Sweaters</a>
												<a href="shop.html">hoodies</a>
											</span>
											<span>
												<a href="#" class="title">Bottoms</a>
												<a href="shop.html">Heeled sandals</a>
												<a href="shop.html">Polo Short Sleeve</a>
												<a href="shop.html">Flat sandals</a>
												<a href="shop.html">Short Sleeve</a>
												<a href="shop.html">Long Sleeve</a>
											</span>
											<span>
												<a href="#" class="title">Jeans Pants</a>
												<a href="shop.html">Polo Short Sleeve</a>
												<a href="shop.html">Sleeveless</a>
												<a href="shop.html">Graphic T-Shirts</a>
												<a href="shop.html">Hoodies</a>
												<a href="shop.html">Jackets</a>
											</span>
										</div>
									</li>
									<li><a href="product-details.html">Audio books<i class="fa fa-angle-down"></i></a>
										<div class="mega-menu">
											<span>
												<a href="#" class="title">Shirts</a>
												<a href="shop.html">Tops & Tees</a>
												<a href="shop.html">Sweaters </a>
												<a href="shop.html">Hoodies</a>
												<a href="shop.html">Jackets & Coats</a>
											</span>
											<span>
												<a href="#" class="title">Tops & Tees</a>
												<a href="shop.html">Long Sleeve </a>
												<a href="shop.html">Short Sleeve</a>
												<a href="shop.html">Polo Short Sleeve</a>
												<a href="shop.html">Sleeveless</a>
											</span>
											<span>
												<a href="#" class="title">Jackets</a>
												<a href="shop.html">Sweaters</a>
												<a href="shop.html">Hoodies</a>
												<a href="shop.html">Wedges</a>
												<a href="shop.html">Vests</a>
											</span>
											<span>
												<a href="#" class="title">Jeans Pants</a>
												<a href="shop.html">Polo Short Sleeve</a>
												<a href="shop.html">Sleeveless</a>
												<a href="shop.html">Graphic T-Shirts</a>
												<a href="shop.html">Hoodies</a>
											</span>
										</div>
									</li>
									<li><a href="product-details.html">children’s books<i class="fa fa-angle-down"></i></a>
										<div class="mega-menu mega-menu-2">
											<span>
												<a href="#" class="title">Tops</a>
												<a href="shop.html">Shirts</a>
												<a href="shop.html">Florals</a>
												<a href="shop.html">Crochet</a>
												<a href="shop.html">Stripes</a>
											</span>
											<span>
												<a href="#" class="title">Bottoms</a>
												<a href="shop.html">Shorts</a>
												<a href="shop.html">Dresses</a>
												<a href="shop.html">Trousers</a>
												<a href="shop.html">Jeans</a>
											</span>
											<span>
												<a href="#" class="title">Shoes</a>
												<a href="shop.html">Heeled sandals</a>
												<a href="shop.html">Flat sandals</a>
												<a href="shop.html">Wedges</a>
												<a href="shop.html">Ankle boots</a>
											</span>
										</div>
									</li>
									<li><a href="#">blog<i class="fa fa-angle-down"></i></a>
										<div class="sub-menu sub-menu-2">
											<ul>
												<li><a href="blog.html">blog</a></li>
												<li><a href="blog-details.html">blog-details</a></li>
											</ul>
										</div>
									</li>
									<li><a href="#">pages<i class="fa fa-angle-down"></i></a>
										<div class="sub-menu sub-menu-2">
											<ul>
												<li><a href="shop.html">shop</a></li>
												<li><a href="shop-list.html">shop list view</a></li>
												<li><a href="product-details.html">product-details</a></li>
												<li><a href="product-details-affiliate.html">product-affiliate</a></li>
												<li><a href="blog.html">blog</a></li>
												<li><a href="blog-details.html">blog-details</a></li>
												<li><a href="contact.html">contact</a></li>
												<li><a href="about.html">about</a></li>
												<li><a href="login.html">login</a></li>
												<li><a href="register.html">register</a></li>
												<li><a href="my-account.html">my-account</a></li>
												<li><a href="cart.html">cart</a></li>
												<li><a href="compare.html">compare</a></li>
												<li><a href="checkout.html">checkout</a></li>
												<li><a href="wishlist.html">wishlist</a></li>
												<li><a href="404.html">404 Page</a></li>
											</ul>
										</div>
									</li>-->
								</ul>
							</nav>
						</div>
						<div class="safe-area">
							<?php if ($this->session->userdata('user_id')) : ?>
								<a href="<?= base_url('dashboard') ?>">Dashboard</a>
							<?php else : ?>
								<a href="<?= base_url('login') ?>">Login</a>
							<?php endif; ?>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- main-menu-area-end -->
		<!-- mobile-menu-area-start -->
		<div class="mobile-menu-area d-lg-none d-block fix">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="mobile-menu">
							<nav id="mobile-menu-active">
								<ul id="nav">
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="<?php echo base_url();?>products">Products</a></li>
									<li><a href="<?php echo base_url();?>about-us">About Us</a></li>
									<li><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>
									<?php if ($this->session->userdata('user_id')) : ?>
										<li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
									<?php else : ?>
										<li><a href="<?= base_url('login') ?>">Login</a></li>
									<?php endif; ?>									
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- mobile-menu-area-end -->
	</header>
	<!-- header-area-end -->
