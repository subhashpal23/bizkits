<style>
.short-desc p {
    font-size: 17px;
    color: #000;
    text-align: justify;
    line-height: 1.6;
    
    border-radius: 5px;
}

/* Fix ordered list numbering */
.short-desc ol {
    padding-left: 30px;
    list-style-type: decimal;
}

.short-desc ol li {
    margin-bottom: 8px;
    font-weight: bold;
}

/* Ensure nested lists have proper bullets */
.short-desc ul {
    padding-left: 40px;
    list-style-type: disc;
}

.short-desc ul li {
    font-weight: normal;
    margin-bottom: 5px;
}

.detail-gallery .zoom-icon{
    display:none;
}

</style>
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home </a>
                  
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="product-detail accordion-detail">
                                <div class="row mb-50 mt-30">
                                    <div class="col-md-8 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                        <div class="detail-gallery">
										 <h2 class="title-detail"><?php echo $products->title;?></h2><br>
                                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        
											
                                            <div class="product-image-slider">
                                               
                                                    <img src="<?php echo base_url();?>product_images/<?php echo $products->product_image;?>" alt="product image" />
                                              
                                                
                                            </div>
                                            <!-- THUMBNAILS -->
                                          
                                        </div>
                                        <!-- End Gallery -->
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="detail-info pr-30 pl-30">
                                           
                                            <div class="short-desc mb-30" style="font-size: 17px;color: #2a2a2a;align: justify;">
                                               
												<?php echo $products->description;?>
                                            </div>
                                           
                                         <div class="mt-30">
                                    <a aria-label="Enquiry now" class="btn enquiry" data-bs-toggle="modal" data-serviceid="<?php echo $products->id;?>" data-service="<?php echo $products->title;?>" data-bs-target="#enquiryModal">Enquiry Now</a>
                                    
                                </div>
                                        </div>
                                        <!-- Detail Info -->
                                    </div>
                                </div>
 
                 
                            </div>
                        </div>
                        <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30">
                            <div class="sidebar-widget widget-category-2 mb-30">
                                <h5 class="section-title style-1 mb-30">
                                    <?php 
                                    $mainCat=getMainCategory($main_cat);
                                    $subcatlist=getSubCategoryList($main_cat);
                                   // print_r($subcatlist);
                                   echo $mainCat->category_name;
                                    ?>
                                    </h5>
                                <ul>
                                    <?php
                                    foreach($subcatlist as $k=>$cat)
									{
									    ?>
									    <li>
									        <a href="<?php echo base_url();?>Web/servicelist/<?php echo $main_cat.'/'.$cat->id;?>"> <img src="<?php echo base_url();?>frontassets/imgs/arrow.png" alt="" /><?php echo $cat->subcategory_name;?></a>
                                        
                                        </li>
                                        <? }?>
                                    
							
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
     <?php include('enquiry.php');?>