<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="breadcrumbs-menu">
		                    <ul>
		                        <li><a href="#">Home</a></li>
		                        <li><a href="#" class="active">checkout</a></li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- entry-header-area-start -->
		<div class="entry-header-area">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="entry-header-title">
		                    <h2>Checkout</h2>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- entry-header-area-end -->
		<?php
        $cart_item=$this->session->userdata('cart_reg');
        if($cart_item)
        {
            $count=count($cart_item);
        }
        //pr($cart_item);
        ?>
		<!-- coupon-area-area-start -->
		<div class="coupon-area mb-70">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="coupon-accordion">
		                    <?php
                            if(!$this->session->userdata('username'))
                            {
                            ?>
		                    <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
		                    <div class="coupon-content" id="checkout-login">
		                        <div class="coupon-info">
		                            <!--<p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>-->
		                            <form action="<?php echo base_url();?>Web/logincheckout" method="post">
		                                <p class="form-row-first">
		                                    <label>Username or email <span class="required">*</span></label>
		                                    <input type="text" name="username">
		                                </p>
		                                <p class="form-row-last">
		                                    <label>Password <span class="required">*</span></label>
		                                    <input type="password" name="password">
		                                </p>
		                                <p class="form-row">
		                                    <input type="submit" name="login" value="Login">
		                                    <!--<label>
												<input type="checkbox">
												 Remember me 
											</label>-->
		                                </p>
		                                <!--<p class="lost-password">
											<a href="#">Lost your password?</a>
										</p>-->
		                            </form>
		                        </div>
		                    </div>
		                    <?php
                            }
							?>
		                    <style>
		                    .form-group {
		                        margin: 20px 0;
		                    }
		                    </style>
		                    <?php
                            if(!$this->session->userdata('username'))
                            {
                            ?>
		                    <h3>Don't have an account? <span id="showcoupon">Create Account</span></h3>
		                    <div class="coupon-checkout-content" id="checkout_coupon">
		                        <div class="coupon-info">
		                            <form action="<?php echo base_url();?>Web/registercheckout" method="post">
		                                <div class="form-group">
		                                    <label>Register As</label>
		                                    <select name="account_type" class="form-control" required="">
		                                        <option value="1">Experts</option>
		                                        <option value="2">Customer</option>
		                                    </select>
		                                </div>
		                                <div class="form-group">
		                                    <input type="text" name="username" required="" onblur="check_username(this.value)"
		                                        id="username" class="form-control required" placeholder="Username"
		                                        onchange="getVals(this, 'username');">
		                                    <span id="check_username"
		                                        style="font-weight: bold; color: green; margin: 0px; padding: 0px; float: left; font-size: 14px;">
		                                        <div class="text-success"></div>
		                                    </span>
		                                </div>
		                                <div class="form-group">
		                                    <input type="text" required="" name="email" class="form-control required"
		                                        placeholder="Email">
		                                </div>
		                                <div class="form-group">
		                                    <input required="" type="password" id="password" class="form-control required"
		                                        name="password" placeholder="Password">
		                                </div>
		                                <div class="form-group">
		                                    <input required="" type="password" id="confirm_password"
		                                        class="form-control required" name="confirm_password"
		                                        onblur="matchPassword();" placeholder="Confirm password">
		                                    <span id="matchpassword"></span>
		                                </div>
		                                <div class="form-group">
		                                    <input required="" type="text" id="first_name" class="form-control required"
		                                        name="first_name" placeholder="Name">
		                                    <span id="matchpassword"></span>
		                                </div>
		                                <div class="form-group">
		                                    <input required="" type="text" id="contact_no" class="form-control required"
		                                        name="contact_no" placeholder="Phone">
		                                    <span id="matchpassword"></span>
		                                </div>
		                                <div class="login_footer form-group mb-50">
		                                    <div class="chek-form">
		                                        <div class="custome-checkbox">
		                                            <input class="form-check-input" type="checkbox" name="checkbox"
		                                                id="exampleCheckbox12" value="">
		                                            <label class="form-check-label" for="exampleCheckbox12"><span>I agree to
		                                                    terms &amp; Policy.</span></label>
		                                        </div>
		                                    </div>
		                                    <!--<a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>-->
		                                </div>
		                                <div class="form-group mb-30">
		                                    <button type="submit" class="btn btn-primary btn-block hover-up" name="login"
		                                        value="login">Submit &amp; Register</button>
		                                </div>

		                            </form>
		                        </div>
		                    </div>
		                    <?php
                            }
							?>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- coupon-area-area-end -->
		<!-- checkout-area-start -->
		<div class="checkout-area mb-70">
		    <div class="container">
		        <div class="row">
		            <div class="col-12">
		                <form action="<?php echo base_url();?>Web/billInvoice" method="post" id="checkoutForm">
		                    <div class="row">
		                        <div class="col-lg-6 col-md-12 col-12">
		                            <div class="checkbox-form">
		                                <h3>Billing Details</h3>

		                                <!-- Hidden full name field to send with the form -->
		                                <?php
		                                $user_id=$this->session->userdata('user_id');
$ud=get_user_details($user_id);
//pr($ud->first_name);
		                                ?>
		                                <input type="hidden" name="billing_name" id="billing_name">

		                                <div class="row">


		                                    <div class="col-lg-6 col-md-6 col-12">
		                                        <div class="checkout-form-list">
		                                            <label>Name <span class="required">*</span></label>
		                                            <input type="text" id="bill_first" name="bill_first" data-required="true"
		                                                placeholder="" value="<?php echo $ud->first_name;?>">
		                                        </div>
		                                    </div>
		                                    <div class="col-lg-6 col-md-6 col-12" style="display: none">
		                                        <div class="checkout-form-list">
		                                            <label>Last Name <span class="required">*</span></label>
		                                            <input type="text" id="bill_last" name="bill_last" data-required="true"
		                                                placeholder="">
		                                        </div>
		                                    </div>

		                                    <div class="col-lg-6 col-md-12 col-12">
		                                        <div class="checkout-form-list">
		                                            <label>Company Name</label>
		                                            <input type="text" id="bill_company" name="bill_company" placeholder=""
		                                                value="<?php echo $ud->first_name;?>">
		                                        </div>
		                                    </div>

		                                    <div class="col-lg-12 col-md-12 col-12">
		                                        <div class="checkout-form-list">
		                                            <label>Address <span class="required">*</span></label>
		                                            <input type="text" id="bill_address1" name="bill_address1"
		                                                data-required="true" placeholder="Street address"
		                                                value="<?php echo $ud->address_line1;?>">
		                                        </div>
		                                    </div>

		                                    <div class="col-lg-12 col-md-12 col-12">
		                                        <div class="checkout-form-list">
		                                            <input type="text" id="bill_address2" name="bill_address2"
		                                                placeholder="Apartment, suite, unit etc. (optional)"
		                                                value="<?php echo $ud->address_line2;?>">
		                                        </div>
		                                    </div>

		                                    <div class="col-lg-6">
		                                        <div class="country-select">
		                                            <label>Country <span class="required">*</span></label>
		                                            <select id="bill_country" name="bill_country" data-required="true"
		                                                onchange="print_state('bill_state',this.selectedIndex);">
		                                                <option value="">-- select --</option>

		                                            </select>
		                                        </div>
		                                    </div>
		                                    <div class="col-lg-6 col-md-12 col-12">
		                                        <div class="country-select">
		                                            <label>State <span class="required">*</span></label>
		                                            <select id="bill_state" name="bill_state">
		                                                <option value="">--select--</option>
		                                            </select>
		                                        </div>
		                                    </div>
		                                    <div class="col-lg-6 col-md-6 col-12">
		                                        <div class="checkout-form-list">
		                                            <label> City <span class="required">*</span></label>
		                                            <input type="text" id="bill_city" name="bill_city" data-required="true"
		                                                placeholder="City" value="<?php echo $ud->city;?>">
		                                        </div>
		                                    </div>


		                                    <div class="col-lg-6 col-md-6 col-12">
		                                        <div class="checkout-form-list">
		                                            <label>Postcode / Zip</label>
		                                            <input type="text" id="bill_zip" name="bill_zip"
		                                                placeholder="Postcode / Zip" value="<?php echo $ud->zipcode;?>">
		                                        </div>
		                                    </div>

		                                    <div class="col-lg-6 col-md-6 col-12">
		                                        <div class="checkout-form-list">
		                                            <label>Email Address <span class="required">*</span></label>
		                                            <input type="email" id="bill_email" name="bill_email" data-required="true"
		                                                placeholder="" value="<?php echo $ud->email;?>">
		                                        </div>
		                                    </div>

		                                    <div class="col-lg-6 col-md-6 col-12">
		                                        <div class="checkout-form-list">
		                                            <label>Phone <span class="required">*</span></label>
		                                            <input type="text" id="bill_phone" name="bill_phone" data-required="true"
		                                                placeholder="Phone" value="<?php echo $ud->contact_no;?>">
		                                        </div>
		                                    </div>

		                                    <div class="col-lg-12 col-md-12 col-12" style="display:none;">
		                                        <div class="checkout-form-list create-acc">
		                                            <input type="checkbox" id="cbox">
		                                            <label for="cbox">Create an account?</label>
		                                        </div>
		                                        <div class="checkout-form-list create-account" id="cbox_info"
		                                            style="display:none;">
		                                            <p>Create an account by entering the information below. If you are a
		                                                returning customer please login at the top of the page.</p>
		                                            <label>Account password <span class="required">*</span></label>
		                                            <input type="password" id="account_password" name="account_password"
		                                                placeholder="password">
		                                        </div>
		                                    </div>
		                                </div>

		                                <div class="different-address" style="display: none">
		                                    <div class="ship-different-title">
		                                        <h3>
		                                            <label for="ship-box">Ship to a different address?</label>
		                                            <input type="checkbox" id="ship-box">
		                                        </h3>
		                                    </div>

		                                    <!-- Hidden full name for shipping -->
		                                    <input type="hidden" name="shipping_name" id="shipping_name">

		                                    <div class="row" id="ship-box-info" style="display:none;">
		                                        <div class="col-lg-12">
		                                            <div class="country-select">
		                                                <label>Country <span class="required">*</span></label>
		                                                <select id="ship_country" name="ship_country">
		                                                    <option value="">-- select --</option>
		                                                    <option value="Bangladesh">Bangladesh</option>
		                                                    <option value="Algeria">Algeria</option>
		                                                    <option value="Afghanistan">Afghanistan</option>
		                                                    <option value="Ghana">Ghana</option>
		                                                    <option value="Albania">Albania</option>
		                                                    <option value="Bahrain">Bahrain</option>
		                                                    <option value="Colombia">Colombia</option>
		                                                    <option value="Dominican Republic">Dominican Republic</option>
		                                                </select>
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>First Name <span class="required">*</span></label>
		                                                <input type="text" id="ship_first" name="ship_first" placeholder="">
		                                            </div>
		                                        </div>
		                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>Last Name <span class="required">*</span></label>
		                                                <input type="text" id="ship_last" name="ship_last" placeholder="">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>Company Name</label>
		                                                <input type="text" id="ship_company" name="ship_company"
		                                                    placeholder="">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>Address <span class="required">*</span></label>
		                                                <input type="text" id="ship_address1" name="ship_address1"
		                                                    placeholder="Street address">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <input type="text" id="ship_address2" name="ship_address2"
		                                                    placeholder="Apartment, suite, unit etc. (optional)">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>Town / City <span class="required">*</span></label>
		                                                <input type="text" id="ship_city" name="ship_city"
		                                                    placeholder="Town / City">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>State / County <span class="required">*</span></label>
		                                                <input type="text" id="ship_state" name="ship_state" placeholder="">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>Postcode / Zip <span class="required">*</span></label>
		                                                <input type="text" id="ship_zip" name="ship_zip"
		                                                    placeholder="Postcode / Zip">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>Email Address <span class="required">*</span></label>
		                                                <input type="email" id="ship_email" name="ship_email" placeholder="">
		                                            </div>
		                                        </div>

		                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                                            <div class="checkout-form-list">
		                                                <label>Phone <span class="required">*</span></label>
		                                                <input type="text" id="ship_phone" name="ship_phone"
		                                                    placeholder="Phone">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="order-notes">
		                                        <div class="checkout-form-list">
		                                            <label>Order Notes</label>
		                                            <textarea id="checkout-mess" name="order_notes" rows="10" cols="30"
		                                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>


		                        <div class="col-lg-6 col-md-12 col-12">
		                            <div class="your-order">
		                                <h3>Your order</h3>
		                                <div class="your-order-table table-responsive">
		                                    <table>
		                                        <thead>
		                                            <tr>
		                                                <th class="product-name">Product</th>
		                                                <th class="product-total">Total</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <?php
                                $currency=currency();
                                $cart_total=0;
                                //pr($cart_item);
                                foreach($cart_item as $key=>$item)
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
                                    			 $new_price=($item['qty']*$price_new);
		                            $cart_total=$cart_total+$new_price;
		                            
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
                                ?>
		                                            <tr class="cart_item">
		                                                <td class="product-name">
		                                                    <?php echo $product_details['title'];?> <strong
		                                                        class="product-quantity"> ×
		                                                        <?php echo $item['qty'];?></strong>
		                                                </td>
		                                                <td class="product-total">
		                                                    <span class="amount"><?php echo currency().$new_price;?></span>
		                                                </td>
		                                            </tr>
		                                            <?php
                                }
                                            ?>
		                                            <!--<tr class="cart_item">
                                                    <td class="product-name">
                                                        Vestibulum suscipit	<strong class="product-quantity"> × 1</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount">£50.00</span>
                                                    </td>
                                                </tr>-->
		                                        </tbody>
		                                        <tfoot>
		                                            <tr class="cart-subtotal">
		                                                <th>Cart Subtotal</th>
		                                                <td><span class="amount"><?php echo currency().$cart_total;?></span>
		                                                </td>
		                                            </tr>
		                                            <!--<tr class="shipping">
                                                    <th>Shipping</th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <input type="radio">
                                                                <label>
                                                                    Flat Rate: <span class="amount">£7.00</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input type="radio">
                                                                <label>Free Shipping:</label>
                                                            </li>
                                                            <li></li>
                                                        </ul>
                                                    </td>
                                                </tr>-->
		                                            <tr class="order-total">
		                                                <th>Order Total</th>
		                                                <td><strong><span
		                                                            class="amount"><?php echo currency().$cart_total;?></span></strong>
		                                                </td>
		                                            </tr>
		                                        </tfoot>
		                                    </table>
		                                </div>
		                                <div class="payment-method">
		                                    <div class="payment-accordion">
		                                        <div class="collapses-group">
		                                            <div class="panel-group" id="accordion" role="tablist"
		                                                aria-multiselectable="true">
		                                                <div class="panel panel-default">
		                                                    <!-- <div class="panel-heading" role="tab" id="headingOne">
		                                                        <h4 class="panel-title">
		                                                            <a data-bs-toggle="collapse" data-bs-parent="#accordion"
		                                                                href="#collapseOne" aria-expanded="true"
		                                                                aria-controls="collapseOne">
		                                                                Direct Bank Transfer
		                                                            </a>
		                                                        </h4>
		                                                    </div> -->
		                                                    <div id="collapseOne" class="panel-collapse collapse in"
		                                                        role="tabpanel" aria-labelledby="headingOne">
		                                                        <div class="panel-body">
		                                                            <p>Make your payment directly into our bank account.
		                                                                Please use your Order ID as the payment reference.
		                                                                Your order won’t be shipped until the funds have
		                                                                cleared in our account.</p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="panel panel-default">
		                                                    <!-- <div class="panel-heading" role="tab" id="headingTwo">
		                                                        <h4 class="panel-title">
		                                                            <a class="collapsed" role="button"
		                                                                data-bs-toggle="collapse" data-bs-parent="#accordion"
		                                                                href="#collapseTwo" aria-expanded="false"
		                                                                aria-controls="collapseTwo">
		                                                                Cheque Payment
		                                                            </a>
		                                                        </h4>
		                                                    </div> -->
		                                                    <div id="collapseTwo" class="panel-collapse collapse"
		                                                        role="tabpanel" aria-labelledby="headingTwo">
		                                                        <div class="panel-body">
		                                                            <p>Please send your cheque to Store Name, Store Street,
		                                                                Store Town, Store State / County, Store Postcode.</p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="panel panel-default">

		                                                    <div id="collapseThree" class="panel-collapse collapse show"
		                                                        role="tabpanel" aria-labelledby="headingThree">
		                                                        <div class="panel-body">
		                                                            <!-- <p>Pay via PayPal; you can pay with your credit card if
		                                                                you don’t have a PayPal account.</p> -->

		                                                            <div class="container mt-4">
		                                                                <h5 class="mb-3">Select Payment Method</h5>

		                                                                <div class="row g-3">
		                                                                    <div class="col-md-4">
		                                                                        <label class="payment-card">
		                                                                            <input type="radio" name="payment_method"
		                                                                                value="wallet">

		                                                                            <div class="card text-center">
		                                                                                <div class="card-body">
		                                                                                    <i
		                                                                                        class="fas fa-wallet fa-2x text-primary mb-2"></i>

		                                                                                    <h6 class="mb-0">
		                                                                                        Wallet
		                                                                                        <?php 
																									echo currency() . (!empty($wallet->amount) ? $wallet->amount : '0');
																								?>
		                                                                                    </h6>
		                                                                                </div>
		                                                                            </div>
		                                                                        </label>
		                                                                    </div>

		                                                                    <!-- PayPal -->
		                                                                    <div class="col-md-4">
		                                                                        <label class="payment-card">
		                                                                            <input type="radio" name="payment_method"
		                                                                                value="paypal">
		                                                                            <div class="card text-center">
		                                                                                <div class="card-body">
		                                                                                    <i
		                                                                                        class="fab fa-paypal fa-2x text-primary mb-2"></i>
		                                                                                    <h6 class="mb-0">PayPal</h6>
		                                                                                </div>
		                                                                            </div>
		                                                                        </label>
		                                                                    </div>

		                                                                    <!-- Stripe -->
		                                                                    <div class="col-md-4">
		                                                                        <label class="payment-card">
		                                                                            <input type="radio" name="payment_method"
		                                                                                value="stripe">
		                                                                            <div class="card text-center">
		                                                                                <div class="card-body">
		                                                                                    <i
		                                                                                        class="fab fa-stripe fa-2x text-indigo mb-2"></i>
		                                                                                    <h6 class="mb-0">Stripe</h6>
		                                                                                </div>
		                                                                            </div>
		                                                                        </label>
		                                                                    </div>

		                                                                    <!-- Credit Card -->
		                                                                    <div class="col-md-4">
		                                                                        <label class="payment-card">
		                                                                            <input type="radio" name="payment_method"
		                                                                                value="card">
		                                                                            <div class="card text-center">
		                                                                                <div class="card-body">
		                                                                                    <i
		                                                                                        class="fas fa-credit-card fa-2x text-success mb-2"></i>
		                                                                                    <h6 class="mb-0">Credit / Debit
		                                                                                        Card</h6>
		                                                                                </div>
		                                                                            </div>
		                                                                        </label>
		                                                                    </div>

		                                                                </div>
		                                                            </div>

		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <!-- <div class="order-button-payment">
		                                        <input type="submit" value="Place order">
		                                    </div> -->
		                                    <div class="order-button-payment">
		                                        <input type="button" id="placeOrderBtn" value="Place order">
		                                    </div>

		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                    <input type="hidden" name="paypal_transaction_id" id="paypal_transaction_id" value="">

		                </form>

		            </div>
		        </div>
		    </div>
		</div>
		<div class="modal fade" id="confirmPaymentModal">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">

		            <div class="modal-header">
		                <h5>Confirm Payment</h5>
		            </div>

		            <div class="modal-body">
		                <p>Are you sure you want to place this order and proceed to payment?</p>
		            </div>
		            <div class="card">
		                <div class="card-body">
		                    <div id="paypal-button-container" style="display:none;"></div>

		                </div>

		                <div class="modal-footer">
		                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
		                    <button type="button" class="btn _bbtn-success" id="payNowBtn">Yes, Pay Now</button>
		                </div>

		            </div>
		        </div>
		    </div>

		    <script
		        src="https://www.paypal.com/sdk/js?client-id=Aa91_WNVYuVT8JDjxCpCKLWv0eJSIbVimPTVqG3GnwzdPiQ-2PX8VqfvPwyADCZ1VB6J6eFsWmMmVZRB&currency=USD">
		    </script>

		    <!-- checkout-area-end -->
		    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		    <script>
		    let paypalRendered = false;
		    var finalAmount = "<?php echo $cart_total;?>";

		    // NEW: wallet amount passed from PHP
		    var walletAmount = parseFloat("<?php echo isset($wallet) && isset($wallet->amount) ? (float) $wallet->amount : 0; ?>") || 0;

		    function getSelectedPaymentMethod() {
		        return $('input[name="payment_method"]:checked').val() || '';
		    }

		    // Place Order Button Click
		    $('#placeOrderBtn').on('click', function(e) {
		        e.preventDefault();

		        // First validate the form
		        if (!validateForm()) return;

		        const method = getSelectedPaymentMethod();
		        if (!method) {
		            alert('Please select a payment method.');
		            return;
		        }

		        // Wallet flow: no PayPal, just submit (server will deduct)
		        if (method === 'wallet') {
		            const orderTotal = parseFloat(finalAmount) || 0;
		            if (walletAmount < orderTotal) {
		                const shortBy = (orderTotal - walletAmount).toFixed(2);
		                alert('Insufficient wallet balance. Please add amount ' + shortBy + ' to your wallet.');
		                return;
		            }

		            // submit directly (billInvoice will deduct wallet)
		            $('#checkoutForm').submit();
		            return;
		        }

		        // PayPal flow
		        if (method === 'paypal') {
		            $('#confirmPaymentModal').modal('show');
		            return;
		        }

		        // Other methods not implemented yet
		        alert('Selected payment method is not available right now. Please choose PayPal or Wallet.');
		    });

		    // Yes Pay Now Button (PayPal)
		    $('#payNowBtn').on('click', function() {
		        $('#payNowBtn').hide();
		        $('#paypal-button-container').show();

		        if (!paypalRendered) {
		            renderPaypalButton();
		            paypalRendered = true;
		        }
		    });

		    function renderPaypalButton() {
		        paypal.Buttons({
		            createOrder: function() {
		                return fetch("<?= base_url('paypal/create_order'); ?>", {
		                        method: "POST",
		                        headers: {
		                            "Content-Type": "application/json"
		                        },
		                        body: JSON.stringify({
		                            amount: finalAmount
		                        })
		                    })
		                    .then(res => res.json())
		                    .then(data => data.id);
		            },

		            onApprove: function(data) {
		                return fetch("<?= base_url('paypal/capture_order/'); ?>" + data.orderID, {
		                        method: "POST"
		                    })
		                    .then(res => res.json())
		                    .then(details => {
		                        console.log('Payment Success:', details);

		                        // Store PayPal transaction ID in hidden field
		                        $('#paypal_transaction_id').val(details.id || data.orderID);

		                        // Submit the form after successful payment
		                        $('#checkoutForm').submit();
		                    });
		            },

		            onCancel: function() {
		                alert('Payment Cancelled');
		                $('#payNowBtn').show();
		                $('#paypal-button-container').hide();
		                $('#confirmPaymentModal').modal('hide');
		            },

		            onError: function(err) {
		                console.log(err);
		                alert('Payment Error: ' + (err && err.message ? err.message : 'Unknown error'));
		                $('#payNowBtn').show();
		                $('#paypal-button-container').hide();
		            }

		        }).render('#paypal-button-container');
		    }

		    function validateForm() {
		        let isValid = true;

		        // Clear previous errors
		        $('.field-error').remove();
		        $('.is-invalid').removeClass('is-invalid');

		        const requiredFields = [
		            { id: '#bill_first', name: 'First Name' },
		            { id: '#bill_email', name: 'Email' },
		            { id: '#bill_phone', name: 'Phone' },
		            { id: '#bill_address1', name: 'Address' },
		            { id: '#bill_country', name: 'Country' }
		        ];

		        requiredFields.forEach(field => {
		            const $field = $(field.id);
		            if (!$field.val() || !$field.val().trim()) {
		                isValid = false;
		                $field.addClass('is-invalid');
		                $field.after(`<div class="field-error text-danger">${field.name} is required</div>`);
		            }
		        });

		        // Email validation
		        const email = $('#bill_email').val();
		        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		        if (email && !emailRegex.test(email)) {
		            isValid = false;
		            $('#bill_email').addClass('is-invalid');
		            $('#bill_email').after('<div class="field-error text-danger">Please enter a valid email</div>');
		        }

		        if (!isValid) {
		            $('html, body').animate({
		                scrollTop: $('.is-invalid').first().offset().top - 100
		            }, 500);
		        }

		        return isValid;
		    }
		    </script>
		    <script src="<?php echo base_url();?>assets/js/countries.js"></script>
		    <script language="javascript">
		    print_country("bill_country");
		    </script>
		    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

		    <style>
		    .payment-card {
		        cursor: pointer;
		        display: block;
		    }

		    .payment-card input[type="radio"] {
		        display: none;
		    }

		    .payment-card .card {
		        border: 2px solid #dee2e6;
		        transition: all 0.2s ease;
		    }

		    .payment-card input[type="radio"]:checked+.card {
		        border-color: #0d6efd;
		        background-color: #f0f7ff;
		    }

		    .payment-card .card:hover {
		        border-color: #0d6efd;
		    }

		    .text-indigo {
		        color: #635bff;
		    }
		    </style>
