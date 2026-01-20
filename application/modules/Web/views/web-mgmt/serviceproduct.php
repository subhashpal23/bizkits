<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url();?>servicelist/<?php echo $products->parent_category_id;?>"><?php echo getServiceCategoryName($products->parent_category_id);?></a> <span></span><?php echo $products->title;?>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider slick-initialized slick-slider">
                                        <div class="slick-list draggable"><div class="slick-track">
                                            <figure class="border-radius-10 slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1"">
                                            <img src="<?php echo base_url();?>product_images/<?php echo $products->product_image;?>" alt="><?php echo $products->title;?>">
                                        </figure>
                                        </div></div>
                                        
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <!--<span class="stock-status out-stock"> Sale Off </span>-->
                                    <h2 class="title-detail"><?php echo $products->title;?></h2>
                                    
                                    <div class="short-desc mb-30">
                                        <p class="font-lg"><?php echo $products->description;?></p>
                                    </div>
                                    <div class="mt-30">
                                        
                                        <!-- Enquiry Button -->
                                        <a aria-label="Enquiry now" class="btn enquiry" data-bs-toggle="modal" data-serviceid="<?php echo $products->id;?>" data-service="<?php echo $products->title;?>" data-bs-target="#enquiryModal">Enquiry Now</a>

                                        
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            <p><?php echo $products->description;?></p>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('enquiry.php');?>


