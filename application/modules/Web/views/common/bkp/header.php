<?php
$categorylist=getCategoryList();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dhanasvi Office Solutions</title>
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
</head>

<body>
    
    <!-- Quick view -->
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
                                <h3 class="title-detail"><a href="javascript:void(0)" class="text-heading">Seeds of Change Organic Quinoa, Brown</a></h3>
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
                                <li>Need help? Call Us: <strong class="text-brand"> +91-8433661506</strong></li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo ">
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>frontassets/imgs/theme/logo.png" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <select class="select-active">
                                    <option>All Categories</option>
									<?php
									foreach($categorylist as $k=>$cat)
									{
									    echo '<option value="'.$cat->id.'">'.$cat->category_name.'</option>';
									}
									?>
                                    <!--<option>Office Essentials</option>
                                    <option>Business Promotions</option>
                                    <option>Office Safety Solutions</option>
                                    <option>Office Support</option>
                                    <option>Quick Solutions</option>
                                    <option>Employee Engagement</option>
                                    <option>Legal Requirements</option>-->
                                    
                                </select>
                                <input type="text" placeholder="Search for items..." />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                                               
                               <?php
                                    $cart_item=$this->session->userdata('cart_reg');
                                    if($cart_item)
                                    {
                                        $count=count($cart_item);
                                    }
                                    ?>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="shop-cart.html">
                                        <img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-cart.svg" />
                                        <span class="pro-count blue"><?php echo ($count)?$count:0;?></span>
                                    </a>
                                    <a href="shop-cart.html"><span class="lable">Cart</span></a>
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
                                    <a href="<?php echo base_url();?>Affiliate">
                                        <img class="svgInject" alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-user.svg" />
                                    </a>
                                    <a href="<?php echo base_url();?>Affiliate"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url();?>Affiliate"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url();?>Affiliate"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <!--<li>
                                                <a href="<?php echo base_url();?>Affiliate"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                            </li>-->
                                            
                                            <!--<li>
                                                <a href="<?php echo base_url();?>Affiliate"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>-->
                                            <?php
                                            if($this->session->userdata('username'))
                                            {
                                            ?>
                                            <li>
                                                <a href="<?php echo base_url();?>Affiliate/Auth/logout"><i class="fi fi-rs-sign-out mr-10"></i>Sign Out</a>
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
        <div class="header-bottom header-bottom-bg-color sticky-bar" style="background-color:#ed821c; font-size:20px; color:#fff;">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>frontassets/imgs/theme/logo.png" alt="logo" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <!--<div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span class="et">Browse</span> All Categories
                                <i class="fi-rs-angle-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading" style="max-width:220px;">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)"> Office Essentials</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"> Business Promotion</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"> Office Safety Solutions</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"> Office Support</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"> Quick Solutions</a>
                                        </li>
										 <li>
                                            <a href="javascript:void(0)"> Employee Engagement</a>
                                        </li>
										 <li>
                                            <a href="javascript:void(0)"> Legal Requirements</a>
                                        </li>
										 <li>
                                            <a href="javascript:void(0)"> Other Services</a>
                                        </li>
										 
                                    </ul>
                            
                                </div>
                                
                                
                            </div>
                        </div>
						-->
						
						
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul> 
                                   <li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>about-us">About Us</a>
                                
                            </li>
                            <?php
									foreach($categorylist as $k=>$cat)
									{
									    //
									    $subcatlist=getSubCategoryList($cat->id);
									    $subcatlist_count=count($subcatlist);
									    ?>
									    <li>
                                        <a href="<?php echo base_url();?>Web/servicelist/<?php echo $cat->id;?>"><?php echo $cat->category_name;?> <i class="fi-rs-angle-down"></i></a>
                                        <?php
                                        if($subcatlist_count>0)
                                        {
                                        ?>
                                        <ul class="sub-menu">
                                            <?php
                                            foreach($subcatlist as $ksub=>$subcat)
                                            {
                                                $sub2catlist=getSub2CategoryList($cat->id,$subcat->id);
									            $sub2catlist_count=count($sub2catlist);
                                            ?>
                                                <!--<li><a href="javascript:void(0)">Digital Marketing</a></li>
                                                <li><a href="javascript:void(0)">Website Creation</a></li>
                                                <li><a href="javascript:void(0)">Logo Designing</a></li>-->
                                                <li>
													<a href="<?php echo base_url();?>Web/servicelist/<?php echo $cat->id;?>/<?php echo $subcat->id;?>"><?php echo $subcat->subcategory_name?><?php
                                                    if($sub2catlist_count>0)
                                                    {
                                                    ?> <i class="fi-rs-angle-right"></i> <?php }?></a>
													<?php
                                                    if($sub2catlist_count>0)
                                                    {
                                                    ?>
													<ul class="level-menu level-menu-modify">
													    <?php
													    //pr($sub2catlist);
													    foreach($sub2catlist as $keysub=>$subsubcat)
													    {
													    ?>
														<li><a href="<?php echo base_url();?>Web/servicelist/<?php echo $cat->id;?>/<?php echo $subcat->id;?>/<?php echo $subsubcat->id;?>"><?php echo $subsubcat->subcategory_name?></a></li>
														<?php
													    }
														?>
														<!--<li><a href="javascript:void(0)">Labels, T-Shirts, Mugs, <br>Letter Head, Stickers etc.</a></li>
														<li><a href="javascript:void(0)">Labels</a></li>-->
													</ul>
													<?php
                                                    }
													?>
												</li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                        }
                                        ?>
                                    </li>
									    <?php
									}
									?>
                                   <!--<li>
                                        <a href="javascript:void(0)">Office Essentials <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:void(0)">Stationary Supply</a></li>
                                            <li><a href="javascript:void(0)">Office Space Require</a></li>
                                            <li><a href="javascript:void(0)">Office Furniture & Chairs</a></li>
                                            <li><a href="javascript:void(0)">Fitouts & Interiors</a></li>
                                            <li><a href="javascript:void(0)">IT Support</a></li>
											<li><a href="javascript:void(0)">Business Process Solutions</a></li>
											<li><a href="javascript:void(0)">Software Support</a></li>
											<li><a href="javascript:void(0)">LAN Services</a></li>
                                           
                                        </ul>
                                    </li>
									
									  <li>
                                        <a href="javascript:void(0)">Business Promotion <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:void(0)">Digital Marketing</a></li>
                                                    <li><a href="javascript:void(0)">Website Creation</a></li>
                                                    <li><a href="javascript:void(0)">Logo Designing</a></li>
                                                    <li>
														<a href="#">Printing <i class="fi-rs-angle-right"></i></a>
														<ul class="level-menu level-menu-modify">
															<li><a href="javascript:void(0)">Vinle/Flex</a></li>
															<li><a href="javascript:void(0)">Labels, T-Shirts, Mugs, <br>Letter Head, Stickers etc.</a></li>
															<li><a href="javascript:void(0)">Labels</a></li>
														</ul>
													</li>
                                           
                                        </ul>
                                    </li>
									
									<li>
                                        <a href="javascript:void(0)">Office Safety Solutions <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:void(0)">CCTV Installation</a></li>
                                            <li><a href="javascript:void(0)">Digital Locking System</a></li>
                                            <li><a href="javascript:void(0)">Smart Access</a></li>
                                            <li><a href="javascript:void(0)">Visitor Management</a></li>
                                            <li><a href="javascript:void(0)">Energy Audit</a></li>
											<li><a href="javascript:void(0)">Cloud Services</a></li>
											
                                        </ul>
                                    </li>
									
									<li>
                                        <a href="javascript:void(0)">Office Support <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:void(0)">Repair Maintenance</a></li>
                                            <li><a href="javascript:void(0)">Cleaning Services</a></li>
                                            <li><a href="javascript:void(0)">Pest Control</a></li>
                                            <li><a href="javascript:void(0)">Tea & Snacks</a></li>
                                            <li><a href="javascript:void(0)">Courier Services</a></li>
											<li><a href="javascript:void(0)">Packing & Premise Relocation Services</a></li>
											<li><a href="javascript:void(0)">Office Beautification</a></li>
											
                                        </ul>
                                    </li>
									
									<li>
                                        <a href="javascript:void(0)">Quick Solutions <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:void(0)">Corporate Gifting</a></li>
                                            <li><a href="javascript:void(0)">Cake & Flowers For Boss & Employeess</a></li>
                                            <li><a href="javascript:void(0)">Customised Gifting Option</a></li>
                                            <li><a href="javascript:void(0)">Event Management</a></li>
                                            <li><a href="javascript:void(0)">Catering Services For Corporate Parties</a></li>
										
											
                                        </ul>
                                    </li>
									
									<li>
                                        <a href="javascript:void(0)">Employee Management <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:void(0)">Corporate Workshop</a></li>
                                            <li><a href="javascript:void(0)">Corporate Training Setup Including Location Setup</a></li>
                                            <li><a href="javascript:void(0)">Corporate Training Services</a></li>
                                           							
											
                                        </ul>
                                    </li>-->
									
									<!--<li>
                                        <a href="javascript:void(0)">Legal Requirements <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:void(0)">Tredmark</a></li>
                                            <li><a href="javascript:void(0)">Lisence Acquirment</a></li>
                                            <li><a href="javascript:void(0)">ROC Services</a></li>
											<li><a href="javascript:void(0)">ROC Services</a></li>
											<li><a href="javascript:void(0)">ISO Services</a></li>
											<li><a href="javascript:void(0)">Employee Insurance Services</a></li>
											<li><a href="javascript:void(0)">Workmen Compensation Services</a></li>
                                           							
											
                                        </ul>
                                    </li>-->
									
								<!--	<li>
                                        <a href="javascript:void(0)">Our Services <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
											<li><a href="javascript:void(0)">Courier Services</a></li>
                                             <li><a href="javascript:void(0)">Cleaning Services</a></li>
                                             <li><a href="javascript:void(0)">Pest Control</a></li>
											 <li><a href="javascript:void(0)">Packing & Premise Relocation Services</a></li>
											<li><a href="javascript:void(0)">Office Beautification</a></li>
											<li><a href="javascript:void(0)">R & M Services</a></li>
											
                                           							
											
                                        </ul>
                                    </li>-->
									
									
                                </ul>
                            </nav>
                        </div>
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
                            <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-heart.svg" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="javascript:void(0)"><img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-3.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="javascript:void(0)">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="javascript:void(0)"><img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/shop/thumbnail-4.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="javascript:void(0)">Macbook Pro 2024</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
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
                    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>frontassets/imgs/theme/logo.png" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>about-us">About Us</a>
                                
                            </li>
                            <?php
									foreach($categorylist as $k=>$cat)
									{
									    //
									    $subcatlist=getSubCategoryList($cat->id);
									    $subcatlist_count=count($subcatlist);
									    ?>
									    <li class="menu-item-has-children">
                                        <a href="<?php echo base_url();?>Web/servicelist/<?php echo $cat->id;?>"><?php echo $cat->category_name;?></a>
                                        <?php
                                        if($subcatlist_count>0)
                                        {
                                        ?>
                                        <ul class="dropdown">
                                            <?php
                                            foreach($subcatlist as $ksub=>$subcat)
                                            {
                                                $sub2catlist=getSub2CategoryList($cat->id,$subcat->id);
									            $sub2catlist_count=count($sub2catlist);
                                            ?>
                                                <!--<li><a href="javascript:void(0)">Digital Marketing</a></li>
                                                <li><a href="javascript:void(0)">Website Creation</a></li>
                                                <li><a href="javascript:void(0)">Logo Designing</a></li>-->
                                                <li>
													<a href="<?php echo base_url();?>Web/servicelist/<?php echo $cat->id;?>/<?php echo $subcat->id;?>"><?php echo $subcat->subcategory_name?><?php
                                                    if($sub2catlist_count>0)
                                                    {
                                                    ?> <i class="fi-rs-angle-right"></i> <?php }?></a>
													<?php
                                                    if($sub2catlist_count>0)
                                                    {
                                                    ?>
													<ul class="level-menu level-menu-modify">
													    <?php
													    //pr($sub2catlist);
													    foreach($sub2catlist as $keysub=>$subsubcat)
													    {
													    ?>
														<li><a href="<?php echo base_url();?>Web/servicelist/<?php echo $cat->id;?>/<?php echo $subcat->id;?>/<?php echo $subsubcat->id;?>"><?php echo $subsubcat->subcategory_name?></a></li>
														<?php
													    }
														?>
														<!--<li><a href="javascript:void(0)">Labels, T-Shirts, Mugs, <br>Letter Head, Stickers etc.</a></li>
														<li><a href="javascript:void(0)">Labels</a></li>-->
													</ul>
													<?php
                                                    }
													?>
												</li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                        }
                                        ?>
                                    </li>
									    <?php
									}
									?>
								
                            <!--<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Office Essentials</a>
                                <ul class="dropdown">
                                     <li><a href="javascript:void(0)">Stationary Supply</a></li>
                                            <li><a href="javascript:void(0)">Office Space Require</a></li>
                                            <li><a href="javascript:void(0)">Office Furniture & Chairs</a></li>
                                            <li><a href="javascript:void(0)">Fitouts & Interiors</a></li>
                                            <li><a href="javascript:void(0)">IT Support</a></li>
											<li><a href="javascript:void(0)">Business Process Solutions</a></li>
											<li><a href="javascript:void(0)">Software Support</a></li>
											<li><a href="javascript:void(0)">LAN Services</a></li>
                                </ul>
                            </li>
							
							<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Business Promotion</a>
                                <ul class="dropdown">
                                    <li><a href="javascript:void(0)">Digital Marketing</a></li>
                                                    <li><a href="javascript:void(0)">Website Creation</a></li>
                                                    <li><a href="javascript:void(0)">Logo Designing</a></li>
                                                    <li>
														<a href="#">Printing <i class="fi-rs-angle-right"></i></a>
														<ul class="level-menu level-menu-modify">
															<li><a href="javascript:void(0)">Vinle/Flex</a></li>
															<li><a href="javascript:void(0)">Labels, T-Shirts, Mugs, <br>Letter Head, Stickers etc.</a></li>
															<li><a href="javascript:void(0)">Labels</a></li>
														</ul>
													</li>
                                </ul>
                            </li>
							
							<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Office Safety Solution</a>
                                <ul class="dropdown">
                                             <li><a href="javascript:void(0)">CCTV Installation</a></li>
                                            <li><a href="javascript:void(0)">Digital Locking System</a></li>
                                            <li><a href="javascript:void(0)">Smart Access</a></li>
                                            <li><a href="javascript:void(0)">Visitor Management</a></li>
                                            <li><a href="javascript:void(0)">Energy Audit</a></li>
											<li><a href="javascript:void(0)">Cloud Services</a></li>
											
                                </ul>
                            </li>
							
							<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Office Support</a>
                                <ul class="dropdown">
                                            <li><a href="javascript:void(0)">Repair Maintenance</a></li>
                                            <li><a href="javascript:void(0)">Cleaning Services</a></li>
                                            <li><a href="javascript:void(0)">Pest Control</a></li>
                                            <li><a href="javascript:void(0)">Tea & Snacks</a></li>
                                            <li><a href="javascript:void(0)">Courier Services</a></li>
											<li><a href="javascript:void(0)">Packing & Premise Relocation Services</a></li>
											<li><a href="javascript:void(0)">Office Beautification</a></li>
											
                                </ul>
                            </li>
									
									
									
							
							<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Quick Solutions</a>
                                <ul class="dropdown">
                                       <li><a href="javascript:void(0)">Corporate Gifting</a></li>
                                            <li><a href="javascript:void(0)">Cake & Flowers For Boss & Employeess</a></li>
                                            <li><a href="javascript:void(0)">Customised Gifting Option</a></li>
                                            <li><a href="javascript:void(0)">Event Management</a></li>
                                            <li><a href="javascript:void(0)">Catering Services For Corporate Parties</a></li>
										
                                </ul>
                            </li>
							
							<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Employee Management </a>
                                <ul class="dropdown">
                                     <li><a href="javascript:void(0)">Corporate Workshop</a></li>
                                            <li><a href="javascript:void(0)">Corporate Training Setup Including Location Setup</a></li>
                                            <li><a href="javascript:void(0)">Corporate Training Services</a></li>
                                </ul>
                            </li>-->
							
							<!--<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Legal Requirements</a>
                                <ul class="dropdown">
                                       <li><a href="javascript:void(0)">Tredmark</a></li>
                                            <li><a href="javascript:void(0)">Lisence Acquirment</a></li>
                                            <li><a href="javascript:void(0)">ROC Services</a></li>
											<li><a href="javascript:void(0)">ROC Services</a></li>
											<li><a href="javascript:void(0)">ISO Services</a></li>
											<li><a href="javascript:void(0)">Employee Insurance Services</a></li>
											<li><a href="javascript:void(0)">Workmen Compensation Services</a></li>
                                </ul>
                            </li>-->
							
						
						<li class="menu-item-has-children">
                                <a href="<?php echo base_url();?>">Our Servicess</a>
                                <ul class="dropdown">
                                      <li><a href="javascript:void(0)">Courier Services</a></li>
                                             <li><a href="javascript:void(0)">Cleaning Services</a></li>
                                             <!--<li><a href="javascript:void(0)">Pest Control</a></li>-->
											 <li><a href="javascript:void(0)">Packing & Premise Relocation Services</a></li>
											<li><a href="javascript:void(0)">Office Beautification</a></li>
											<li><a href="javascript:void(0)">R & M Services</a></li>
                                </ul>
                            </li>
             
                       
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="javascript:void(0)"><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    
                    <div class="single-mobile-header-info">
                        <a href="javascript:void(0)"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
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
                <div class="site-copyright">Copyright 2024 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>
