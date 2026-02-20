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
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
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

    .home-4 .header-search form input,
    .home-5 .header-search form input {
        width: 100% !important;
    }

    .home-4 .header-search form a,
    .home-4 .header-mid-area .my-cart ul li span {
        background: #0346d9 none repeat scroll 0 0 !important;
    }

    .home-4 .menu-area ul li a::before,
    .home-4 .menu-area ul li::before,
    .home-4 .twitter-content .twitter-icon a {
        background: #0346d9 none repeat scroll 0 0 !important;
    }

    .home-4 .main-menu-area {
        background: #02205a none repeat scroll 0 0 !important;
    }

    .breadcrumbs-menu ul li a.active {
        color: #0346d9 !important;
    }

    .myaccount-tab-menu a:hover,
    .myaccount-tab-menu a.active {
        background-color: #02205a !important;
        border-color: #02205a !important;
    }

    .myaccount-content .welcome strong {
        color: #0346d9 !important;
    }

    /* Modern header/menu refresh */
    .bk-topbar {
        background: #0b1220;
        color: #cbd5e1;
        font-size: 13px;
        padding: 8px 0;
    }

    .bk-topbar a {
        color: #e2e8f0;
        text-decoration: none;
    }

    .bk-topbar a:hover {
        color: #fff;
    }

    .bk-header {
        background: #fff;
        border-bottom: 1px solid #eef2f7;
    }

    .bk-brand img {
        max-height: 48px;
        width: auto;
    }

    .bk-search {
        position: relative;
    }

    .bk-search input {
        height: 42px;
        border-radius: 999px;
        padding-right: 42px;
        border: 1px solid #02205a;
        box-shadow: none;
    }

    .bk-search button {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        height: 32px;
        width: 32px;
        border-radius: 50%;
        border: 0;
        background: #02205a !important;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .bk-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: flex-end;
    }

    .bk-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        color: #0f172a;
        background: #fff;
        text-decoration: none;
        line-height: 1;
        white-space: nowrap;
    }

    .bk-action-btn:hover {
        border-color: #cbd5e1;
    }

    .bk-cart-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 999px;
        background:#f9f9f9;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
    }

    .bk-navbar {
        background: #f9f9f9;
    }

    .bk-navbar .navbar-nav>li>a {
        color: rgba(255, 255, 255, 0.92) !important;
        font-weight: 600;
        padding: 14px 14px;
    }

    /* .bk-navbar .navbar-nav>li>a:hover,
    .bk-navbar .navbar-nav>li.active>a {
        color: #fff !important;
    } */

    .bk-navbar .navbar-toggle {
        border-color: rgba(255, 255, 255, 0.35);
        margin-top: 8px;
        margin-bottom: 8px;
    }

    .bk-navbar .navbar-collapse {
        border-color: rgba(255, 255, 255, 0.15);
    }

    .bk-navbar .bk-nav-cta {
        margin: 8px 0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
		border: 1px solid #02205a;
        border-radius: 999px;
        /* background: #02205a; */
        color: #02205a !important;
        text-decoration: none;
        font-weight: 600;
    }

    .bk-navbar .bk-nav-cta:hover {
        /* background: #02205a; */
    }

    /* Hide old theme menu blocks to avoid duplicate menus */
    .main-menu-area,
    .mobile-menu-area {
        display: none !important;
    }

    @media (max-width: 767px) {
        .bk-actions {
            justify-content: flex-start;
        }

        .bk-brand {
            display: flex;
            justify-content: center;
        }

        .bk-search {
            margin: 12px 0;
        }
    }

    /* One-row layout: logo + menu + search */
    .bk-navbar .navbar-collapse {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        height: auto !important;
        overflow: visible !important;
    }

    .bk-navbar .navbar-nav {
        float: none !important;
        margin: 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .bk-navbar .navbar-nav>li {
        float: none !important;
    }

    .bk-navbar .navbar-right {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bk-navbar .bk-nav-brand {
        display: inline-flex;
        align-items: center;
        margin-right: 16px;
    }

    .bk-navbar .bk-nav-brand img {
        max-height: 70px;
        width: auto;
    }

    .bk-navbar .bk-nav-search {
        min-width: 280px;
        max-width: 360px;
    }

    .bk-navbar .bk-nav-search .bk-search {
        margin: 0;
    }

    .bk-navbar .bk-nav-search .bk-search input {
        height: 38px;
    }

    @media (max-width: 991px) {
        .bk-navbar .navbar-collapse {
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px 0;
        }

        .bk-navbar .bk-nav-search {
            width: 100%;
            max-width: none;
        }
    }

    /* Keep menu strictly horizontal */
    .bk-navbar .navbar-nav {
        flex-wrap: nowrap !important;
        white-space: nowrap;
    }

    .bk-navbar .navbar-nav>li>a {
        display: inline-block;
    }

    /* If screen is small, allow horizontal scroll instead of wrapping/toggle */
    @media (max-width: 991px) {
        .bk-navbar .navbar-collapse {
            flex-wrap: nowrap !important;
        }

        .bk-navbar .navbar-nav {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .bk-navbar .navbar-nav::-webkit-scrollbar {
            height: 6px;
        }

        .bk-navbar .navbar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 10px;
        }

        .bk-navbar .bk-nav-search {
            min-width: 220px;
            max-width: 280px;
        }
    }

    /* Separate desktop/mobile headers */
    .bk-desktop-header {
        display: block;
    }

    .bk-mobile-header {
        display: none;
    }

    @media (max-width: 767px) {
        .bk-desktop-header {
            display: none !important;
        }

        .bk-mobile-header {
            display: block !important;
        }
    }

    /* Mobile header layout */
    .bk-mh-wrap {
        background: #02205a;
        padding: 10px 0;
    }

    .bk-mh-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bk-mh-logo img {
        max-height: 34px;
        width: auto;
    }

    .bk-mh-search {
        flex: 1;
        min-width: 0;
    }

    .bk-mh-search .bk-search input {
        height: 38px;
        background: #fff;
    }

    .bk-mh-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .bk-mh-actions a {
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 10px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 999px;
    }

    .bk-mh-menu {
        margin-top: 10px;
        display: flex;
        gap: 6px;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        white-space: nowrap;
        padding-bottom: 2px;
    }

    .bk-mh-menu a {
        display: inline-block;
        color: rgba(255, 255, 255, 0.92);
        text-decoration: none;
        font-weight: 600;
        padding: 10px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
    }

    .bk-mh-menu a.active,
    .bk-mh-menu a:hover {
        background: rgba(255, 255, 255, 0.16);
        color: #fff;
    }

    .bk-mh-menu::-webkit-scrollbar {
        height: 0;
    }

    /* Force mobile menu items to stay in one row (no column/wrap) */
    @media (max-width: 767px) {
        .bk-mh-menu {
            flex-wrap: nowrap !important;
            white-space: nowrap !important;
        }

        .bk-mh-menu a {
            flex: 0 0 auto;
            white-space: nowrap;
            padding: 9px 12px;
            font-size: 13px;
        }
    }

    /* Desktop: force one-row horizontal menu */
    @media (min-width: 768px) {
        .bk-navbar .navbar-collapse {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            flex-wrap: nowrap !important;
        }

        .bk-navbar .navbar-nav {
            display: flex !important;
            flex-direction: row !important;
            align-items: center;
            flex-wrap: nowrap !important;
            white-space: nowrap;
            width: auto !important;
            margin-left: auto !important; /* pushes menu to the right */
        }

        .bk-navbar .navbar-nav > li {
            display: inline-flex !important;
            float: none !important;
        }

        .bk-navbar .navbar-nav > li > a {
            display: inline-flex !important;
            align-items: center;
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .bk-navbar .navbar-right {
            display: flex !important;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            margin-left: auto !important;
            float: none !important;
        }

        .bk-navbar .bk-nav-search {
            width: 240px;
            max-width: 260px;
            min-width: 200px;
        }

        .bk-navbar .bk-nav-search .bk-search input {
            height: 36px;
        }

        /* Remove left auth spacing helper (auth is on right now) */
        .bk-navbar .bk-auth-left {
            margin-left: 0;
        }

        .bk-navbar .bk-right-menu {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .bk-navbar .bk-right-menu > li > a {
			text-decoration:none;
            padding-left: 10px;
            padding-right: 10px;
        }
    }

    /* Desktop mini-cart dropdown on hover (My Cart) */
    .bk-navbar .bk-mycart-wrap {
        position: relative;
    }

    .bk-navbar .bk-mycart-wrap .mini-cart-sub {
        position: absolute;
        right: 0;
        top: calc(100% + 10px);
        width: 320px;
        background: #fff;
        padding: 16px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.18);
        border-radius: 12px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(6px);
        transition: all .2s ease;
        z-index: 99999;
    }

    .bk-navbar .bk-mycart-wrap:hover .mini-cart-sub {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .bk-navbar .bk-mycart-wrap .cart-bottom a {
        border-radius: 10px;
    }

    .bk-navbar .bk-mycart-wrap .cart-totals h5,
    .bk-navbar .bk-mycart-wrap .cart-product .single-cart .cart-info h5 {
        font-family: inherit;
    }

    /* Desktop menu: blue text, hover/active pill blue bg + white text */
    .bk-navbar .bk-right-menu > li > a {
        color: #02205a !important; /* blue text */
        background: transparent;
        padding: 10px 14px !important;
        line-height: 1;
        transition: background-color .2s ease, color .2s ease;
		text-decoration:none;
    }

    .bk-navbar .bk-right-menu > li > a:hover {
        background: #02205a;
        color: #fff !important;
    }

    /* .bk-navbar .bk-right-menu > li.active > a,
    .bk-navbar .bk-right-menu > li.active > a:hover,
    .bk-navbar .bk-right-menu > li.active > a:focus {
        background: #02205a;
        color: #fff !important;
    } */

    /* Mini-cart action buttons */
    .bk-cart-actions{
        display:flex;
        gap:10px;
        margin-top:12px;
    }
    .bk-cart-actions .bk-cart-btn{
        flex:1;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        height:40px;
        padding:0 14px;
        border-radius:10px;
        font-weight:700;
        font-size:13px;
        letter-spacing:.2px;
        text-transform:uppercase;
        text-decoration:none !important;
        transition:all .2s ease;
    }
    .bk-cart-actions .bk-cart-btn-primary{
        background:#02205a;
        color:#fff;
        border:1px solid #02205a;
    }
    .bk-cart-actions .bk-cart-btn-primary:hover{
        background:;
        border-color:#0346d9;
        color:#fff;
    }
    .bk-cart-actions .bk-cart-btn-outline{
        background:#fff;
        color:#02205a;
        border:1px solid #cbd5e1;
    }
    .bk-cart-actions .bk-cart-btn-outline:hover{
        background:#f1f5f9;
        border-color:#94a3b8;
        color:#02205a;
    }

    @media (max-width: 480px){
        .bk-cart-actions{ flex-direction:column; }
        .bk-cart-actions .bk-cart-btn{ width:100%; }
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
        <!-- Mobile-only header -->
        <div class="bk-mobile-header">
            <div class="bk-mh-wrap">
                <div class="container">
                    <div class="bk-mh-top">
                        <a class="bk-mh-logo" href="<?php echo base_url();?>" aria-label="Bizkits Home">
                            <img src="<?php echo base_url();?>frontassets/img/logo/logo.png" alt="logo" />
                        </a>

                        <div class="bk-mh-search">
                            <form class="bk-search" action="<?php echo base_url(); ?>products" method="get">
                                <input type="text" name="q" class="form-control" placeholder="Search..." />
                                <button type="submit" aria-label="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div>

                        <div class="bk-mh-actions">
                            <?php
                                $cart_item=$this->session->userdata('cart_reg');
                                $count = 0;
                                if($cart_item) { $count=count($cart_item); }
                            ?>
                            <a href="<?php echo base_url();?>shopcart" aria-label="Cart">
                                <i class="bi bi-bag"></i>
                                <span class="bk-cart-count"><?php echo ($count)?$count:0;?></span>
                            </a>

                            <?php if ($this->session->userdata('user_id')) : ?>
                                <a href="<?= base_url('dashboard') ?>" aria-label="Dashboard"><i class="bi bi-person-check"></i></a>
                            <?php else : ?>
                                <a href="<?= base_url('login') ?>" aria-label="Login"><i class="bi bi-person"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <nav class="bk-mh-menu" aria-label="Mobile navigation">
                        <a class="active" href="<?php echo base_url();?>">Home</a>
                        <a href="<?php echo base_url();?>products">Product</a>
                        <a href="<?php echo base_url();?>about-us">About</a>
                        <a href="<?php echo base_url();?>contact-us">Contact</a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Desktop header (existing) -->
        <div class="bk-desktop-header">
            <!-- Top bar -->
            <div class="bk-topbar">
                <div class="container">
                    <div class="row" style="display:flex; align-items:center;">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                <span><i class="bi bi-envelope"></i> <a href="mailto:info@bizkits.org">info@bizkits.org</a></span>
                                <span><i class="bi bi-telephone"></i> <a href="tel:+8183466437348">+8183466437348</a></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 text-end">
                            <div style="display:flex; gap:14px; justify-content:flex-end; flex-wrap:wrap;">
                                <?php if ($this->session->userdata('user_id')) : ?>
                                    <a href="<?php echo base_url();?>dashboard"><i class="bi bi-person-circle"></i> My Account</a>
                                <?php else : ?>
                                    <a href="<?= base_url('login') ?>"><i class="bi bi-person-circle"></i> My Account</a>
                                <?php endif; ?>
                                <a href="<?php echo base_url();?>checkout"><i class="bi bi-credit-card"></i> Checkout</a>
                                <?php if (!$this->session->userdata('user_id')) : ?>
                                    <a href="<?= base_url('login') ?>"><i class="bi bi-box-arrow-in-right"></i> Sign in</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mid header (old search+logo row hidden because we use one-row navbar now) -->
            <div class="bk-header" style="display:none !important;">
                <div class="container" style="padding:18px 15px;">
                    <div class="row" style="display:flex; align-items:center;">
                        <div class="col-lg-4 col-md-5 col-12">
                            <form class="bk-search" action="<?php echo base_url(); ?>products" method="get">
                                <input type="text" name="q" class="form-control" placeholder="Search products..." />
                                <button type="submit" aria-label="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div>

                        <div class="col-lg-4 col-md-3 col-12 bk-brand">
                            <a href="<?php echo base_url();?>">
                                <img src="<?php echo base_url();?>frontassets/img/logo/logo.png" alt="logo" />
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="bk-actions">
                                <?php
                                    $cart_item=$this->session->userdata('cart_reg');
                                    $count = 0;
                                    if($cart_item) { $count=count($cart_item); }
                                ?>

                                <?php if ($this->session->userdata('user_id')) : ?>
                                    <a class="bk-action-btn" href="<?= base_url('dashboard') ?>"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
                                <?php else : ?>
                                    <a class="bk-action-btn" href="<?= base_url('login') ?>"><i class="bi bi-box-arrow-in-right"></i><span>Login</span></a>
                                <?php endif; ?>

                                <a class="bk-action-btn" href="<?php echo base_url();?>shopcart">
                                    <i class="bi bi-bag"></i>
                                    <span>Cart</span>
                                    <span class="bk-cart-count"><?php echo ($count)?$count:0;?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- One-row Navbar: Logo + Menu + Search + CTA -->
            <nav class="navbar navbar-default bk-navbar" role="navigation" style="margin-bottom:0; border:0; border-radius:0;">
                <div class="container">
                    <div class="navbar-collapse" id="bkMainNav" style="display:flex !important; height:auto !important; overflow:visible !important;">

                        <a class="bk-nav-brand" href="<?php echo base_url();?>" aria-label="Bizkits Home">
                            <img src="<?php echo base_url();?>frontassets/img/logo/logo.png" alt="logo" />
                        </a>

                        <div class="navbar-right" style="display:flex; align-items:center;">
                            <?php
                                $cart_item=$this->session->userdata('cart_reg');
                                $count = 0;
                                if($cart_item) { $count=count($cart_item); }
                            ?>

                            

                            <ul class="nav navbar-nav bk-right-menu" style="margin:0 8px;">
                                <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
                                <li><a href="<?php echo base_url();?>products">Product</a></li>
                                <li><a href="<?php echo base_url();?>about-us">About</a></li>
                                <li><a href="<?php echo base_url();?>contact-us">Contact</a></li>
								<li>
								<?php if ($this->session->userdata('user_id')) : ?>
                                	<a class="" href="<?= base_url('dashboard') ?>">Dashboard</a>
								<?php else : ?>
									<a class="" href="<?= base_url('login') ?>">Login</a>
								<?php endif; ?>
								</li>
                            </ul>
							
                            <div class="bk-mycart-wrap">
                                <a class="bk-nav-cta" href="<?php echo base_url();?>shopcart">
                                    <i class="bi bi-bag"></i> My Cart
                                    <span class="bk-cart-count" style="margin-left:6px;color:#02205a !important;"><?php echo ($count)?$count:0;?></span>
                                </a>

                                <!-- Hover dropdown (mini cart) -->
                                <div class="mini-cart-sub">
                                    <div class="cart-product">
                                        <?php
                                        $str='';
                                        $cart_total=0;
                                        $cart_total_discount=0;
                                        $currency=currency();
                                        if(!empty($cart_item))
                                        {
                                            foreach($cart_item as $item)
                                            {
                                                $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
                                                if(!$product_details) { continue; }

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
                                                else
                                                {
                                                    $price_new=$product_details['price1'];
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
                                                        <a href="javascript:void(0);"><img alt="" style="max-width:40% !important;" src="'.base_url().'product_images/'.$product_details['product_image'].'" /></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h5><a href="javascript:void(0);">'.$product_details['title'].'</a></h5>
                                                        <p>'.$item['qty'].' × '.$currency.$price_new.' '.$price.'</p>
                                                    </div>
                                                    <div class="cart-icon">
                                                        <a href="javascript:void(0);" onclick="removefromcartproducts('.$item['product_id'].')"><i class="fa fa-remove"></i></a>
                                                    </div>
                                                 </div>';
                                            }
                                        }

                                        echo ($str!='') ? $str : '<p style="margin:0; color:#666;">No Item In Cart.</p>';
                                        ?>
                                    </div>

                                    <div class="cart-totals">
                                        <h5>Total <span style="background: #ffffff none repeat scroll 0 0 !important;"><?php echo $currency.$cart_total;?></span></h5>
                                    </div>

                                    <div class="cart-bottom bk-cart-actions">
                                        <a class="view-cart bk-cart-btn bk-cart-btn-outline" href="<?php echo base_url();?>shopcart">View Cart</a>
                                        <a class="bk-cart-btn bk-cart-btn-primary" href="<?php echo base_url();?>checkout">Checkout</a>
                                    </div>
                                </div>
                            </div>

                            <div class="bk-nav-search">
                                <form class="bk-search" action="<?php echo base_url(); ?>products" method="get">
                                    <input type="text" name="q" class="form-control" placeholder="Search products..." />
                                    <button type="submit" aria-label="Search"><i class="bi bi-search"></i></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- header-area-end -->
