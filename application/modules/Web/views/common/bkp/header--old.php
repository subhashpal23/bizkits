<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dhansavi Files</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>frontassets/imgs/theme/logo.png" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>frontassets/css/main.css?v=6.1" />
    <link rel="stylesheet" href="<?php echo base_url();?>frontassets/sass/base/_typography.scss" />
</head>

<body>
    <!-- Modal -->
    <!--<div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="deal" style="background-image: url('<?php echo base_url();?>frontassets/imgs/banner/popup-1.png')">
                        <div class="deal-top">
                            <h6 class="mb-10 text-brand-2">Deal of the Day</h6>
                        </div>
                        <div class="deal-content detail-info">
                            <h4 class="product-title"><a href="javascript:void(0);" class="text-heading">Organic fruit for your family's health</a></h4>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand">$38</span>
                                    <span>
                                        <span class="save-price font-md color3 ml-15">26% Off</span>
                                        <span class="old-price font-md ml-15">$52</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="deal-bottom">
                            <p class="mb-20">Hurry Up! Offer End In:</p>
                            <div class="deals-countdown pl-5" data-countdown="2025/03/25 00:00:00">
                                <span class="countdown-section"><span class="countdown-amount hover-up">03</span><span class="countdown-period"> days </span></span><span class="countdown-section"><span class="countdown-amount hover-up">02</span><span class="countdown-period"> hours </span></span><span class="countdown-section"><span class="countdown-amount hover-up">43</span><span class="countdown-period"> mins </span></span><span class="countdown-section"><span class="countdown-amount hover-up">29</span><span class="countdown-period"> sec </span></span>
                            </div>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 rates)</span>
                                </div>
                            </div>
                            <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Quick view -->
    <?php
    $segments = $this->uri->segment(1);
    if($this->uri->segment(1)!='product'){

    ?>
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="<?php echo base_url();?>frontassets/imgs/shop/product-16-2.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="<?php echo base_url();?>frontassets/imgs/shop/product-16-1.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="<?php echo base_url();?>frontassets/imgs/shop/product-16-3.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="<?php echo base_url();?>frontassets/imgs/shop/product-16-4.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="<?php echo base_url();?>frontassets/imgs/shop/product-16-5.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="<?php echo base_url();?>frontassets/imgs/shop/product-16-6.jpg" alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="<?php echo base_url();?>frontassets/imgs/shop/product-16-7.jpg" alt="product image" />
                                    </figure>
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <div><img src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-3.jpg" alt="product image" /></div>
                                    <div><img src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-4.jpg" alt="product image" /></div>
                                    <div><img src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-5.jpg" alt="product image" /></div>
                                    <div><img src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-6.jpg" alt="product image" /></div>
                                    <div><img src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-7.jpg" alt="product image" /></div>
                                    <div><img src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-8.jpg" alt="product image" /></div>
                                    <div><img src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-9.jpg" alt="product image" /></div>
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span class="stock-status out-stock"> Sale Off </span>
                                <h3 class="title-detail"><a href="javascript:void(0);" class="text-heading">Seeds of Change Organic Quinoa, Brown</a></h3>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">$38</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">26% Off</span>
                                            <span class="old-price font-md ml-15">$52</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul>
                                        <li class="mb-5">Vendor: <span class="text-brand">Nest</span></li>
                                        <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2024</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <header class="header-area header-style-1 header-height-2">
        <div class="mobile-promotion">
            <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
        </div>
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="<?php echo base_url();?>about-us">About Us</a></li>
                                <li><a href="<?php echo base_url();?>Affiliate">My Account</a></li>
                                <!--<li><a href="<?php echo base_url();?>wishlist">Wishlist</a></li>-->
                                <!--<li><a href="<?php echo base_url();?>">Order Tracking</a></li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>100% Secure delivery without contacting the courier</li>
                                    <li>Supper Value Deals - Save more with coupons</li>
                                    <li>Trendy 25silver jewelry, save up 35% off today</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand">+91-8433661506</strong></li>
                                <!--<li>
                                    <a class="language-dropdown-active" href="#">English <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li>
                                            <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/flag-fr.png" alt="" />Français</a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/flag-dt.png" alt="" />Deutsch</a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/flag-ru.png" alt="" />Pусский</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="language-dropdown-active" href="#">USD <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li>
                                            <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/flag-fr.png" alt="" />INR</a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/flag-dt.png" alt="" />MBP</a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/flag-ru.png" alt="" />EU</a>
                                        </li>
                                    </ul>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>frontassets/imgs/theme/logo.png" alt="logo" style="width:150px !important;min-width:150px !important;" /></a>
                    </div>
                    <?php
                    $category=getCategory();
                    ?>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="<?php echo base_url();?>shop" method="get">
                                <select name="category_id" class="select-active">
                                    <option value="">All Categories</option>
                                    <?php
                                    foreach ($category as $key => $val) {
                                        // Check if the current category_id matches the submitted value
                                        $selected = ($val->id == $this->input->get('category_id')) ? 'selected' : '';
                                        echo '<option value="' . $val->id . '" ' . $selected . '>' . $val->category_name . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="text" placeholder="Search for items..." name="search" 
                                       value="<?php echo htmlspecialchars($this->input->get('search')); ?>" />
                            </form>

                            
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <!--<div class="search-location">
                                    <form action="#">
                                        <select class="select-active">
                                            <option>Your Location</option>
                                            <option>Alabama</option>
                                            <option>Alaska</option>
                                            <option>Arizona</option>
                                            <option>Delaware</option>
                                            <option>Florida</option>
                                            <option>Georgia</option>
                                            <option>Hawaii</option>
                                            <option>Indiana</option>
                                            <option>Maryland</option>
                                            <option>Nevada</option>
                                            <option>New Jersey</option>
                                            <option>New Mexico</option>
                                            <option>New York</option>
                                        </select>
                                    </form>
                                </div>-->
                                <!--<div class="header-action-icon-2">
                                    <a href="shop-compare.html">
                                        <img class="svgInject" alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-compare.svg" />
                                        <span class="pro-count blue">3</span>
                                    </a>
                                    <a href="shop-compare.html"><span class="lable ml-0">Compare</span></a>
                                </div>-->
                                <!--<div class="header-action-icon-2">
                                    <a href="shop-wishlist.html">
                                        <img class="svgInject" alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-heart.svg" />
                                        <span class="pro-count blue">6</span>
                                    </a>
                                    <a href="shop-wishlist.html"><span class="lable">Wishlist</span></a>
                                </div>-->
                                <div class="header-action-icon-2">
                                    <?php
                                    $cart_item=$this->session->userdata('cart_reg');
                                    if($cart_item)
                                    {
                                        $count=count($cart_item);
                                    }
                                    ?>
                                    <a class="mini-cart-icon" href="javascript:void(0);">
                                        <img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-cart.svg" />
                                        
                                        <span class="pro-count blue carttotal"><?php echo $count;?></span>
                                        
                                    </a>
                                    <a href="javascript:void(0);"><span class="lable">Cart</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2" >
                                        <ul class="cartplist">
                                            <?php
                                            
                                            //pr($cart_item);
                                    	    // $str="<ul>";
                                    	    $str='';
                                    	    $cart_total=0;
                                    	    $currency=currency();
                                    	    foreach($cart_item as $item)
                                    		{
                                    		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
                                    		 $cart_total=$cart_total+($item['qty']*$product_details['new_price']);
                                    		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 
                                    		 $str.='<li>
                                                <div class="shopping-cart-img">
                                                    <a href="javascript:void(0);"><img alt="Nest" style="max-width:40% !important;" src="'.base_url().'product_images/'.$product_details["product_image"].'" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="javascript:void(0);"><?php echo $product_details["title"];?></a></h4>
                                                    <h4><span>'.$item["qty"].' × '.$currency.$product_details["new_price"].'</span></h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="javscript:void(0);" onclick="removefromcartproducts('.$item['product_id'].')"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                             </li>';
                                    		 
                                    		}
                                    		echo $str;
                                            ?>
                                            
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span class="totalcost product-price"><?php echo $currency.$cart_total;?></span></h4>
                                            </div>
                                            <div class="shopping-cart-total">
                                                <h4>Discount <span class="totaldiscount product-price"><?php echo $currency.$cart_total_discount;?></span></h4>
                                            </div>
                                            <div class="shopping-cart-total">
                                                <h4>Grand Total <span class="gtotalcost product-price"><?php echo $currency.($cart_total-$cart_total_discount);?></span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="<?php echo base_url();?>shopcart" class="outline">View cart</a>
                                                <a href="<?php echo base_url();?>checkout">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-action-icon-2">
                                    <a href="javascript:void(0);">
                                        <img class="svgInject" alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-user.svg" />
                                    </a>
                                    <a href="javascript:void(0);"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url();?>Affiliate"><i class="fi fi-rs-user mr-10"></i>My Profile</a>
                                            </li>
                                            <!--<li>
                                                <a href="javascript:void(0);"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                            </li>
                                            <li>
                                                <a href="shop-wishlist.html"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>-->
                                            <?php
                                            if($this->session->userdata('username'))
                                            {
                                            ?>
                                            <li>
                                                <a href="<?php echo base_url();?>Affiliate/Auth/logout"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                            </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>frontassets/imgs/theme/logo.png" alt="logo" style="width:150px !important;min-width:150px !important;" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span class="et">Browse</span> All Categories
                                <i class="fi-rs-angle-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <?php
                                    foreach($category as $key=>$val)
                                    {
                                        
                                    ?>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url();?>productlist/<?php echo $val->id;?>"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-1.svg" alt="" /><?php echo $val->category_name;?></a>
                                        </li>
                                        <!--<li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-2.svg" alt="" />Clothing & beauty</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-3.svg" alt="" />Pet Foods & Toy</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-4.svg" alt="" />Baking material</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-5.svg" alt="" />Fresh Fruit</a>
                                        </li>-->
                                    </ul>
                                    <?php
                                    }
                                    ?>
                                    <!--<ul class="end">
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-6.svg" alt="" />Wines & Drinks</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-7.svg" alt="" />Fresh Seafood</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-8.svg" alt="" />Fast food</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-9.svg" alt="" />Vegetables</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/category-10.svg" alt="" />Bread and Juice</a>
                                        </li>
                                    </ul>-->
                                </div>
                                <!--<div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-1.svg" alt="" />Milks and Dairies</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-2.svg" alt="" />Clothing & beauty</a>
                                            </li>
                                        </ul>
                                        <ul class="end">
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-3.svg" alt="" />Wines & Drinks</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-4.svg" alt="" />Fresh Seafood</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>-->
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <!--<li class="hot-deals"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-hot.svg" alt="hot deals" /><a href="shop-grid-right.html">Deals</a></li>-->
                                    <li>
                                        <a class="active" href="<?php echo base_url();?>">Home </a>
                                        <!--<ul class="sub-menu">
                                            <li><a href="<?php echo base_url();?>">Home 1</a></li>
                                            <li><a href="index-2.html">Home 2</a></li>
                                            <li><a href="index-3.html">Home 3</a></li>
                                            <li><a href="index-4.html">Home 4</a></li>
                                            <li><a href="index-5.html">Home 5</a></li>
                                            <li><a href="index-6.html">Home 6</a></li>
                                        </ul>-->
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>about-us">About</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>shop">Shop <!--<i class="fi-rs-angle-down"></i>--></a>
                                        <!--<ul class="sub-menu">
                                            <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                            <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                            <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                            <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                            <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                            <li>
                                                <a href="#">Single Product <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="javascript:void(0);">Product – Right Sidebar</a></li>
                                                    <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                                    <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                                    <li><a href="shop-product-vendor.html">Product – Vendor Info</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="shop-filter.html">Shop – Filter</a></li>
                                            <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                            <li><a href="javascript:void(0);">Shop – Cart</a></li>
                                            <li><a href="javascript:void(0);">Shop – Checkout</a></li>
                                            <li><a href="shop-compare.html">Shop – Compare</a></li>
                                            <li>
                                                <a href="#">Shop Invoice<i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                                    <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                                    <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                                    <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                                    <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                                    <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                                </ul>
                                            </li>
                                        </ul>-->
                                    </li>
                                    <!--<li>
                                        <a href="#">Vendors <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="vendors-grid.html">Vendors Grid</a></li>
                                            <li><a href="vendors-list.html">Vendors List</a></li>
                                            <li><a href="vendor-details-1.html">Vendor Details 01</a></li>
                                            <li><a href="vendor-details-2.html">Vendor Details 02</a></li>
                                            <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                            <li><a href="vendor-guide.html">Vendor Guide</a></li>
                                        </ul>
                                    </li>
                                    <li class="position-static">
                                        <a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Fruit & Vegetables</a>
                                                <ul>
                                                    <li><a href="javascript:void(0);">Meat & Poultry</a></li>
                                                    <li><a href="javascript:void(0);">Fresh Vegetables</a></li>
                                                    <li><a href="javascript:void(0);">Herbs & Seasonings</a></li>
                                                    <li><a href="javascript:void(0);">Cuts & Sprouts</a></li>
                                                    <li><a href="javascript:void(0);">Exotic Fruits & Veggies</a></li>
                                                    <li><a href="javascript:void(0);">Packaged Produce</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Breakfast & Dairy</a>
                                                <ul>
                                                    <li><a href="javascript:void(0);">Milk & Flavoured Milk</a></li>
                                                    <li><a href="javascript:void(0);">Butter and Margarine</a></li>
                                                    <li><a href="javascript:void(0);">Eggs Substitutes</a></li>
                                                    <li><a href="javascript:void(0);">Marmalades</a></li>
                                                    <li><a href="javascript:void(0);">Sour Cream</a></li>
                                                    <li><a href="javascript:void(0);">Cheese</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Meat & Seafood</a>
                                                <ul>
                                                    <li><a href="javascript:void(0);">Breakfast Sausage</a></li>
                                                    <li><a href="javascript:void(0);">Dinner Sausage</a></li>
                                                    <li><a href="javascript:void(0);">Chicken</a></li>
                                                    <li><a href="javascript:void(0);">Sliced Deli Meat</a></li>
                                                    <li><a href="javascript:void(0);">Wild Caught Fillets</a></li>
                                                    <li><a href="javascript:void(0);">Crab and Shellfish</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="javascript:void(0);"><img src="<?php echo base_url();?>frontassets/imgs/banner/banner-menu.png" alt="Nest" /></a>
                                                    <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>
                                                            Don't miss<br />
                                                            Trending
                                                        </h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="javascript:void(0);">Shop now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>25%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                            <li><a href="blog-category-list.html">Blog Category List</a></li>
                                            <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                            <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                            <li>
                                                <a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu level-menu-modify">
                                                    <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                                    <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                                    <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="page-about.html">About Us</a></li>
                                            <li><a href="page-contact.html">Contact</a></li>
                                            <li><a href="javascript:void(0);">My Account</a></li>
                                            <li><a href="javascript:void(0);">Login</a></li>
                                            <li><a href="page-register.html">Register</a></li>
                                            <li><a href="page-forgot-password.html">Forgot password</a></li>
                                            <li><a href="page-reset-password.html">Reset password</a></li>
                                            <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                            <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                            <li><a href="page-terms.html">Terms of Service</a></li>
                                            <li><a href="page-404.html">404 Page</a></li>
                                        </ul>
                                    </li>-->
                                    <li>
                                        <a href="<?php echo base_url();?>services">Services</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>contact-us">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-flex">
                        <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-headphone.svg" alt="hotline" />
                        <p>+91-8433661506<span>24/7 Support Center</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <!--<div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-heart.svg" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>-->
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white carttotal"><?php echo $count;?></span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul class="cartplist">
                                            <?php
                                            
                                            //pr($cart_item);
	    // $str="<ul>";
	    $str='';
	    $cart_total=0;
	    $currency=currency();
	    foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $cart_total=$cart_total+($item['qty']*$product_details['new_price']);
		 
		 $str.='<li>
            <div class="shopping-cart-img">
                <a href="javascript:void(0);"><img alt="Nest" style="max-width:40% !important;" src="'.base_url().'product_images/'.$product_details["product_image"].'" /></a>
            </div>
            <div class="shopping-cart-title">
                <h4><a href="javascript:void(0);"><?php echo $product_details["title"];?></a></h4>
                <h4><span>'.$item["qty"].' × </span></h4>
            </div>
            <div class="shopping-cart-delete">
                <a href="javscript:void(0);" onclick="removefromcartproducts('.$item['product_id'].')"><i class="fi-rs-cross-small"></i></a>
            </div>
         </li>';
		 
		}
		echo $str;
        ?>
                                            
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span class="totalcost product-price"><?php echo $currency.$cart_total;?></span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="<?php echo base_url();?>shopcart" class="outline">View cart</a>
                                                <a href="<?php echo base_url();?>checkout">Checkout</a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>frontassets/imgs/theme/logo.png" alt="logo" style="width:50px !important;min-width:50px !important;" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <!--<div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>-->
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Home</a>
                                
                            </li>
                            <li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>about-us">About Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>shop">Shop</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>services">Services</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>contact-us">Contact Us</a>
                            </li>
                            <!--<li class="menu-item-has-children">
                                <a href="shop-grid-right.html">shop</a>
                                <ul class="dropdown">
                                    <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                    <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                    <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                    <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                    <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product</a>
                                        <ul class="dropdown">
                                            <li><a href="javascript:void(0);">Product – Right Sidebar</a></li>
                                            <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                            <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                            <li><a href="shop-product-vendor.html">Product – Vendor Infor</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop-filter.html">Shop – Filter</a></li>
                                    <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                    <li><a href="javascript:void(0);">Shop – Cart</a></li>
                                    <li><a href="javascript:void(0);">Shop – Checkout</a></li>
                                    <li><a href="shop-compare.html">Shop – Compare</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Invoice</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                            <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                            <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                            <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                            <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                            <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>-->
                            <!--<li class="menu-item-has-children">
                                <a href="#">Vendors</a>
                                <ul class="dropdown">
                                    <li><a href="vendors-grid.html">Vendors Grid</a></li>
                                    <li><a href="vendors-list.html">Vendors List</a></li>
                                    <li><a href="vendor-details-1.html">Vendor Details 01</a></li>
                                    <li><a href="vendor-details-2.html">Vendor Details 02</a></li>
                                    <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                    <li><a href="vendor-guide.html">Vendor Guide</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Mega menu</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children">
                                        <a href="#">Women's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="javascript:void(0);">Dresses</a></li>
                                            <li><a href="javascript:void(0);">Blouses & Shirts</a></li>
                                            <li><a href="javascript:void(0);">Hoodies & Sweatshirts</a></li>
                                            <li><a href="javascript:void(0);">Women's Sets</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Men's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="javascript:void(0);">Jackets</a></li>
                                            <li><a href="javascript:void(0);">Casual Faux Leather</a></li>
                                            <li><a href="javascript:void(0);">Genuine Leather</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Technology</a>
                                        <ul class="dropdown">
                                            <li><a href="javascript:void(0);">Gaming Laptops</a></li>
                                            <li><a href="javascript:void(0);">Ultraslim Laptops</a></li>
                                            <li><a href="javascript:void(0);">Tablets</a></li>
                                            <li><a href="javascript:void(0);">Laptop Accessories</a></li>
                                            <li><a href="javascript:void(0);">Tablet Accessories</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="blog-category-fullwidth.html">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                    <li><a href="blog-category-list.html">Blog Category List</a></li>
                                    <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product Layout</a>
                                        <ul class="dropdown">
                                            <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                            <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                            <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-contact.html">Contact</a></li>
                                    <li><a href="javascript:void(0);">My Account</a></li>
                                    <li><a href="javascript:void(0);">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-forgot-password.html">Forgot password</a></li>
                                    <li><a href="page-reset-password.html">Reset password</a></li>
                                    <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                    <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="page-terms.html">Terms of Service</a></li>
                                    <li><a href="page-404.html">404 Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li>-->
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <!--<div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                    </div>-->
                    <div class="single-mobile-header-info">
                        <a href="<?php echo base_url();?>Affiliate"><i class="fi-rs-user"></i>My Account </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>+91 8433661506 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                    <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                    <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                    <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                    <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2025 © Dhanasvi Office Print-Pakaging . All rights reserved. Powered by HIGHFLYERS INFOTECH.</div>
            </div>
        </div>
    </div>
    <!--End header-->