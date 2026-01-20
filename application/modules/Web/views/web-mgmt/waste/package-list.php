    <!--Common hero Section Starts -->
    <section class="cmn_heros pb-120 pt-120">
        <div class="container">
            <div class="row justify-content-center mt-5 mt-md-8 mt-lg-0">
                <div class="col-xxl-6">
                    <div class="cmn_heros__title text-center pt-15 pt-lg-6">
                        <h1 class="display-three mb-5 mb-md-7 wow fadeInUp">Our Pricing Plan</h1>
                        <p class="roboto wow fadeInUp"> Discover our unbeatable pricing plan, offering the perfect balance of value
                            and features, tailored to meet your unique needs in Coiner Website.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Common hero Section Ends -->
    <!-- Pricing Plan Section Starts Starts -->
    <section class="pricing_plan pt-40 pb-120 bg5-color">
        <div class="container">
            <div class="row gy-6">
                <div class="pricing_plan__title mb-md-4">
                    <h2 class="mb-4 wow fadeInUp">Pricing Plan</h2>
                    <p class="roboto wow fadeInUp">Explainability features and deep model. Specialized consectetur adipiscing sed do
                        eiusmod.Explainability features and deep model.</p>
                </div>
                <?php
                                    $s=1;
                                    foreach($package as $key=>$val)
                                    {
                                    ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="pricing_plan__cards p-6 p-md-8 rounded-20 br2 position-relative wow fadeInUp">
                        <!--<div class="pricing_plan__cards-icon mb-3">
                            <img src="assets/images/icon/pricing_plan3.png" alt="Icons">
                        </div>-->
                        <h4 class="mb-5 mb-md-6"><?php echo $val->title;?></h4>
                        <div class="pricing_plan__cards-price d-flex align-items-center gap-3 mb-5 mb-md-6">
                            <h1 class="p1-color"><?php echo currency().$val->amount;?></h1>
                            <!--<span>month</span>-->
                        </div>
                        <div class="pricing_plan__cards-befit mb-5 mb-md-6">
                            <ul class="d-flex flex-column gap-4">
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>BV:<?php echo $val->pv;?></p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Upto Level:<?php echo $val->to_level;?></p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>24/7 customer support</p>
                                </li>
                                <!--<li class="d-flex align-items-center gap-3 opacity-50">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Regular updates & improvements</p>
                                </li>
                                <li class="d-flex align-items-center gap-3 opacity-50">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Premium educational resources</p>
                                </li>-->
                            </ul>
                        </div>
                        <div class="pricing_plan__cards-btn">
                            <a href="<?php echo base_url();?>Web/register?pkg=<?php echo $val->id;?>"  class="cmn-btn px-3 px-sm-5 px-md-6 py-2 py-sm-3 d-flex align-items-center gap-1">Apply Now</a>
                        </div>
                    </div>
                </div>
                <?php
                                    }
                ?>
                <!--<div class="col-12 col-md-6 col-xl-4">
                    <div class="pricing_plan__cards p-6 p-md-8 rounded-20 br2 position-relative wow fadeInUp">
                        <div class="pricing_plan__cards-icon mb-3">
                            <img src="assets/images/icon/pricing_plan2.png" alt="Icons">
                            <img src="assets/images/icon/pricing_plan3.png" class="picon" alt="Icons">
                        </div>
                        <h4 class="mb-5 mb-md-6">Pro Plan</h4>
                        <div class="pricing_plan__cards-price d-flex align-items-center gap-3 mb-5 mb-md-6">
                            <h1 class="p1-color">$29.99_</h1>
                            <span>month</span>
                        </div>
                        <div class="pricing_plan__cards-befit mb-5 mb-md-6">
                            <ul class="d-flex flex-column gap-4">
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Full platform access</p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Flexible subscription options</p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>24/7 customer support</p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Regular updates & improvements</p>
                                </li>
                                <li class="d-flex align-items-center gap-3 opacity-50">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Premium educational resources</p>
                                </li>
                            </ul>
                        </div>
                        <div class="pricing_plan__cards-btn">
                            <button type="button" class="rounded-2 py-3 px-6 p1-color br4 w-100">Apply Now</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="pricing_plan__cards p-6 p-md-8 rounded-20 br2 position-relative wow fadeInUp">
                        <div class="pricing_plan__cards-icon mb-3">
                            <img src="assets/images/icon/pricing_plan2.png" alt="Icons">
                            <img src="assets/images/icon/pricing_plan3.png" class="picon" alt="Icons">
                            <img src="assets/images/icon/pricing_plan4.png" class="picon" alt="Icons">
                        </div>
                        <h4 class="mb-5 mb-md-6">Expert Plan</h4>
                        <div class="pricing_plan__cards-price d-flex align-items-center gap-3 mb-5 mb-md-6">
                            <h1 class="p1-color">$39.99_</h1>
                            <span>month</span>
                        </div>
                        <div class="pricing_plan__cards-befit mb-5 mb-md-6">
                            <ul class="d-flex flex-column gap-4">
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Full platform access</p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Flexible subscription options</p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>24/7 customer support</p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Regular updates & improvements</p>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <span class="bg1-color px-1 rounded-item">
                                        <i class="ti ti-check p1-color"></i>
                                    </span>
                                    <p>Premium educational resources</p>
                                </li>
                            </ul>
                        </div>
                        <div class="pricing_plan__cards-btn">
                            <button type="button" class="rounded-2 py-3 px-6 p1-color br4 w-100">Apply Now</button>
                        </div>
                    </div>
                </div>-->
                
            </div>
        </div>
    </section>
    <!-- Pricing Plan Section Starts Ends -->