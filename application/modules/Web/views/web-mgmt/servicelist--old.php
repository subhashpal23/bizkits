<main class="main" style="transform: none;">
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            
                            <div class="breadcrumb">
                                <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Services <span></span> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30" style="transform: none;">
            <div class="row flex-row-reverse" style="transform: none;">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <!--<div class="totall-product">-->
                        <!--    <p>We found <strong class="text-brand"><?php echo getServiceProductsCount($val->parent_category_id);?></strong> items for you!</p>-->
                        <!--</div>-->
                        
                    </div>
                    <div class="product-list mb-50">
                        <!--single product-->
                        <?php
                        foreach($products as $key=>$val)
                        {
                        ?>
                        <div class="product-cart-wrap">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <div class="product-img-inner">
                                        <a href="<?php echo base_url();?>service/<?php echo $val->id;?>">
                                            <img class="default-img" src="<?php echo base_url();?>product_images/<?php echo $val->product_image;?>" alt="">
                                            <!--<img class="hover-img" src="<?php echo base_url();?>product_images/<?php echo $val->product_image;?>" alt="" />-->
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="<?php echo base_url();?>servicelist/<?php echo $val->parent_category_id;?>"><?php echo getServiceCategoryName($val->parent_category_id);?></a>
                                </div>
                                <h2><a href="<?php echo base_url();?>service/<?php echo $val->id;?>"><?php echo $val->title;?></a></h2>
                                
                                <!--<p class="mt-15 mb-15"><?php echo substr($val->description,0,20);?></p>-->
                                
                                <div class="mt-30">
                                    <a aria-label="Enquiry now" class="btn enquiry" data-bs-toggle="modal" data-serviceid="<?php echo $val->id;?>" data-service="<?php echo $val->title;?>" data-bs-target="#enquiryModal">Enquiry Now</a>
                                    
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!--product grid-->
                    <!--<div class="pagination-area mt-20 mb-20">-->
                    <!--    <nav aria-label="Page navigation example">-->
                    <!--        <ul class="pagination justify-content-start">-->
                    <!--            <li class="page-item">-->
                    <!--                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>-->
                    <!--            </li>-->
                    <!--            <li class="page-item"><a class="page-link" href="#">1</a></li>-->
                    <!--            <li class="page-item active"><a class="page-link" href="#">2</a></li>-->
                    <!--            <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                    <!--            <li class="page-item"><a class="page-link dot" href="#">...</a></li>-->
                    <!--            <li class="page-item"><a class="page-link" href="#">6</a></li>-->
                    <!--            <li class="page-item">-->
                    <!--                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>-->
                    <!--            </li>-->
                    <!--        </ul>-->
                    <!--    </nav>-->
                    <!--</div>-->
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    
                    <!-- Fillter By Price -->
                    
                    <!-- Product sidebar Widget -->
                    
                    
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><div class="sidebar-widget widget-category-2 mb-30">
                        <h5 class="section-title style-1 mb-30">Category</h5>
                        <ul>
                            <?php
                            $category=getServiceCategory();
                            foreach($category as $key=>$val)
                            {
                                
                            ?>
                            <li>
                                <a href="<?php echo base_url();?>servicelist/<?php echo $val->id;?>"> <img src="assets/imgs/theme/icons/category-1.svg" alt="" /><?php echo $val->category_name;?></a>
                                <span class="count"><?php echo getServiceProductsCount($val->id);?></span>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div></div></div>
            </div>
        </div>
    </main>
    <?php include('enquiry.php');?>