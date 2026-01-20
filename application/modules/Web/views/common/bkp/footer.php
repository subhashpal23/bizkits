<style>
    .main-menu.main-menu-padding-1 > nav > ul > li {
    padding: 0 9px !important;
}
</style>
<footer class="main">
        <?php
        if($_SERVER['PATH_INFO']!='/about-us'){
        ?>
        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="<?php echo base_url();?>frontassets/imgs/banner/banner.jpg" alt="newsletter" />
                    </div>
                </div>
            </div>
        </section>
        <section class="featured section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="banner-icon">
                                <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-1.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Best prices & offers</h3>
                                <p>Orders $50 or more</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <div class="banner-icon">
                                <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-2.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Free delivery</h3>
                                <p>24/7 amazing services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            <div class="banner-icon">
                                <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-3.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Great daily deal</h3>
                                <p>When you sign up</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                            <div class="banner-icon">
                                <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-4.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Wide assortment</h3>
                                <p>Mega Discounts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                            <div class="banner-icon">
                                <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-5.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Easy returns</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                            <div class="banner-icon">
                                <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-6.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Safe delivery</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        ?>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="logo mb-30">
                                <a href="index.html" class="mb-15"><img src="<?php echo base_url();?>frontassets/imgs/theme/logo.png" alt="logo" style="min-width: 50px !important;" /></a>
                               
                            </div>
                            <ul class="contact-infor" >
                                <li><img src="<?php echo base_url();?>frontassets/imgs/location.png" alt="" /><span>B-427, Balaji Bhavan, Plot No.42A, Sector-11 CBD Belapur, Navi Mumbai-400614</span></li>
                                <li><img src="<?php echo base_url();?>frontassets/imgs/call.png" alt="" /><span>+91-8433661506</span></li>
                                <li><img src="<?php echo base_url();?>frontassets/imgs/email.png" alt="" /><span>dhanasvioffice6@gmail.com</span></li>
                             
                            </ul>
                        </div>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <h4 class=" widget-title">Company</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Support Center</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <h4 class="widget-title">Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help Ticket</a></li>
                            <li><a href="#">Shipping Details</a></li>
                            <li><a href="#">Compare products</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <h4 class="widget-title">Corporate</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Become a Vendor</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                            <li><a href="#">Farm Business</a></li>
                            <li><a href="#">Farm Careers</a></li>
                            <li><a href="#">Our Suppliers</a></li>
                            <li><a href="#">Accessibility</a></li>
                            <li><a href="#">Promotions</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <h4 class="widget-title">Popular</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Milk & Flavoured Milk</a></li>
                            <li><a href="#">Butter and Margarine</a></li>
                            <li><a href="#">Eggs Substitutes</a></li>
                            <li><a href="#">Marmalades</a></li>
                            <li><a href="#">Sour Cream and Dips</a></li>
                            <li><a href="#">Tea & Kombucha</a></li>
                            <li><a href="#">Cheese</a></li>
                        </ul>
                    </div>
                   
                </div>
        </section>
        <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom" style="border-top: 2px solid #ed821c;"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0"> &copy; 2025, Copyright by Dhanasvi Office Solutions. All Right Reserved. <!-- <strong class="text-brand">Nest</strong> - HTML Ecommerce Template <br />All rights reserved --></p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                   
                    <div class="hotline d-lg-inline-flex">
                        <img src="<?php echo base_url();?>frontassets/imgs/theme/icons/phone-call.svg" alt="hotline" />
                        <p>1900 - 8888<span>24/7 Support Center</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Follow Us</h6>
                        <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                        <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                        <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                        <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                        <a href="#"><img src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                    </div>
                    <!-- <p class="font-sm">Up to 15% discount on your first subscribe</p> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    
    <!-- Vendor JS-->
    <script src="<?php echo base_url();?>frontassets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/slick.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/waypoints.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/wow.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/magnific-popup.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/select2.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/counterup.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/jquery.countdown.min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/images-loaded.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/isotope.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/scrollup.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/jquery.vticker-min.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="<?php echo base_url();?>frontassets/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="<?php echo base_url();?>frontassets/js/main.js?v=6.0"></script>
    <script src="<?php echo base_url();?>frontassets/js/shop.js?v=6.0"></script>
</body>

</html>