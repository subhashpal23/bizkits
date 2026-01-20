		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">cart</a></li>
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
							<h2>Cart</h2>
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
        ?>
		<!-- cart-main-area-start -->
		<div class="cart-main-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<form action="#">
							<div class="table-content table-responsive mb-15 border-1">
								<table>
									<thead>
										<tr>
										    
											<th class="product-thumbnail">Image</th>
											<th class="product-name">Product</th>
											<th class="product-price">Unit Price</th>
											<th class="product-quantity">Upgrade</th>
											<th class="product-subtotal">Subtotal</th>
											<th class="product-remove">Remove</th>
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
										<tr>
											<td class="product-thumbnail"><a href="#"><img src="<?php echo base_url();?>product_images/<?php echo $product_details["product_image"];?>" alt="man" /></a></td>
											<td class="product-name"><a href="#"><?php echo $product_details['title'];?></a></td>
											<td class="product-price"><span class="amount"><?php echo currency().$new_price?></span></td>
											<td class="product-quantity">
											    <!--<input type="number" name="quantity" id="quantity_<?php echo $item['product_id'];?>" class="qty-val" value="<?php echo $item['qty'];?>">-->
											    <select name="" onchange="updatecartpackage(<?php echo $item['product_id'];?>)" id="package_<?php echo $item['product_id'];?>" class="form-select">
											        <option value='Basic' <?php echo ($item['package']=='Basic')?'selected':'';?>>Basic</option>
											        <option value='Economy' <?php echo ($item['package']=='Economy')?'selected':'';?>>Pro</option>
											        <option value='Enterprise' <?php echo ($item['package']=='Enterprise')?'selected':'';?>>Enterprise</option>
											    </select>
											    <!--<a href="#" onclick="updatecart(<?php echo $item['product_id'];?>)" class="btn"><i class="fa fa-refresh"></i></a>-->
											</td>
											<td class="product-subtotal"><?php echo currency().$cart_total;?></td>
											<td class="product-remove"><a href="#" onclick="removefromcartproduct(<?php echo $item['product_id'];?>)"><i class="fa fa-times"></i></a></td>
										</tr>
										<?php
                                }
                                ?>
									
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
                    <div class="col-lg-8 col-md-6 col-12">
                        <div class="buttons-cart mb-30">
                            <ul>
                                <!--<li><a href="#">Update Cart</a></li>-->
                                <li><a href="<?php echo base_url();?>">Continue Shopping</a></li>
                            </ul>
                        </div>
                        <!--<div class="coupon">
                            <h3>Coupon</h3>
                            <p>Enter your coupon code if you have one.</p>
                            <form action="#">
                                <input type="text" placeholder="Coupon code">
                                <a href="#">Apply Coupon</a>
                            </form>
                        </div>-->
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="cart_totals">
                            <!--<h2>Cart Totals</h2>-->
                            <table>
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>
                                            <span class="amount"><?php echo $currency.$cart_total;?></span>
                                        </td>
                                    </tr>
                                    <!--<tr class="shipping">
                                        <th>Shipping</th>
                                        <td>
                                            <ul id="shipping_method">
                                                <li>
                                                    <input type="radio">
                                                    <label>
                                                        Flat Rate:
                                                        <span class="amount">£7.00</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input type="radio">
                                                    <label> Free Shipping </label>
                                                </li>
                                            </ul>
                                            <a href="#">Calculate Shipping</a>
                                        </td>
                                    </tr>-->
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <strong>
                                                <span class="amount"><?php echo $currency.($cart_total-$cart_total_discount);?></span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="wc-proceed-to-checkout">
                                <a href="<?php echo base_url();?>checkout">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- cart-main-area-end -->

