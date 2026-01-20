<!-- banner-area-start -->
    <div class="banner-area banner-res-large pt-30 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="<?php echo base_url()?>frontassets/img/banner/1.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Free shipping item</h4>
                            <p>For all orders over $500</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="<?php echo base_url()?>frontassets/img/banner/2.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Money back guarantee</h4>
                            <p>100% money back guarante</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="<?php echo base_url()?>frontassets/img/banner/3.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Cash on delivery</h4>
                            <p>Lorem ipsum dolor consecte</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="<?php echo base_url()?>frontassets/img/banner/4.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Help & Support</h4>
                            <p>Call us : + 0123.4567.89</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area-end -->
    <!-- slider-area-start -->
    <div class="slider-area">
        <div class="slider-active owl-carousel">
            <div class="single-slider pt-125 pb-130 bg-img" style="background-image:url(<?php echo base_url()?>frontassets/img/slider/1.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="slider-content slider-animated-1 text-center">
                                <h1>Huge Sale</h1>
                                <h2>koparion</h2>
                                <h3>Now starting at $99.00</h3>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider slider-h1-2 pt-215 pb-100 bg-img" style="background-image:url(<?php echo base_url()?>frontassets/img/slider/2.jpg);">
                <div class="container">
                    <div class="slider-content slider-content-2 slider-animated-1">
                        <h1>We can help get your</h1>
                        <h2>Books in Order</h2>
                        <h3>and Accessories</h3>
                        <a href="#">Contact Us Today!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->
    <!-- product-area-start -->
    <div class="product-area pt-95 xs-mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2>Top interesting</h2>
                        <p>Browse the collection of our best selling and top interresting products. <br /> ll definitely find what you are looking for..</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <!-- tab-menu-start -->
                    <div class="tab-menu mb-40 text-center">
                        <ul class="nav justify-content-center">
                            <?php
                            $s=0;
                            foreach($category as $cat)
                            {
                                ?>
                                <li><a <?php if(!$s){?>class="active" <?php }?> href="#cat<?php echo $cat->id;?>" data-bs-toggle="tab"><?php echo $cat->category_name;?> </a></li>
                                <?php
                                $s++;
                            }
                            ?>
                            <!--<li><a class="active" href="#Audiobooks" data-bs-toggle="tab">New Arrival </a></li>
                            <li><a href="#books" data-bs-toggle="tab">OnSale</a></li>
                            <li><a href="#bussiness" data-bs-toggle="tab">Featured Products</a></li>-->
                        </ul>
                    </div>
                    <!-- tab-menu-end -->
                </div>
            </div>
            <!-- tab-area-start -->
            <div class="tab-content">
                <?php
                $t=0;
                            foreach($category as $cat)
                            {
                                $product=$callfunc->getproducts($cat->id);
                                ?>
                <div class="tab-pane fade <?php if(!$t){?> show active <?php }?>" id="cat<?php echo $cat->id;?>">
                    <div class="tab-active owl-carousel">
                        <!-- single-product-start -->
                        <?php
                            foreach($product as $prd)
                            {
                        ?>
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="<?php echo base_url();?>product/<?php echo $prd->id;?>">
                                    <img src="<?php echo base_url()?>product_images/<?php echo $prd->product_image;?>" alt="book" class="primary" />
                                </a>
                                <div class="quick-view">
                                    <a class="action-view" href="<?php echo base_url();?>product/<?php echo $prd->id;?>" data-bs-target="#productModal" data-bs-toggle="modal" title="Quick View">
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </div>
                                <div class="product-flag">
                                    <ul>
                                        <li><span class="sale">new</span></li>
                                        <!--<li><span class="discount-percentage">-5%</span></li>-->
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details text-center">
                                <!--<div class="product-rating">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    </ul>
                                </div>-->
                                <h4><a href="<?php echo base_url();?>product/<?php echo $prd->id;?>"><?php echo $prd->title;?></a></h4>
                                <div class="product-price">
                                    <ul>
                                        <li>$<?php echo $prd->price1;?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-link">
                                <div class="product-button">
                                    <a href="<?php echo base_url();?>product/<?php echo $prd->id;?>" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li><a href="<?php echo base_url();?>product/<?php echo $prd->id;?>" title="Details"><i class="fa fa-external-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                    </div>
                </div>
                <?php
                $t++;
                            }
                ?>
                
            </div>
            <!-- tab-area-end -->
        </div>
    </div>
    <!-- product-area-end -->

