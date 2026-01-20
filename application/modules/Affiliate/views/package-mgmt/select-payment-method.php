<script type= "text/javascript" src = "<?php echo base_url();?>frontassets/js/countries.js"></script>
<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Account Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Payment Method</li>
                    </ul>
                </div>
                <div class="row">
							<div class="col-md-6">
								<div class="form-group">
                <label for="">Country</label>
                <div class="styled-select clearfix">
											<select class="form-control" id="country" name ="country" onchange="print_state('state',this.selectedIndex);" >
												<option value="">Select your Country</option>
                                                
											                           
											</select>
										</div>
									</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
                <label for="">State</label>
                <div class="styled-select clearfix">
											<select class="form-control" name ="state" id ="state" onchange="showStockistStateWise(this.value);">
												<option value="">Select your State</option>
                                                
											</select>
										</div>
														
								</div>
							</div>
						</div>
					<div class="row">
						 
						   <div class="col-md-12">
					  	   
							<div class="card card-flat border-top-success">
									<div class="card-body text-center">
									    <div class="col-md-6">
								<div class="form-group">
                <label for="">Choose Stockist</label>
                <div class="styled-select clearfix">
                    
											<select class="form-control required" name="stockist" id="stockist" onchange="showStockist(this.value);">
												<option value="">Select your Stockist</option>
                        
											<?php
											foreach($all_stockist as $key=>$val)
											{
											    echo "<option value='".$val->user_id."'>".$val->username."</option>";
											}
											?>
											                           
											</select>
										</div>
														
								</div>
							</div>
							<div class="row">
							    <div class="card card-body" >
							        <div class="" id="showstockistdetails"></div>
							        
							    </div>
							</div>
									    
									    <div class="submit step showproducts">
									<h3 class="main_question"><strong></strong>Choose Product Of Amount <?php echo currency().$diff_amount;?></h3>
                  <div class="row">
                      <?php
                      foreach($all_products as $kry=>$val)
                      {
                        ?>
                        <div class="col-md-3">
								<div class="form-group">
                <label for="" style="color:#017d03;"><?php echo $val->title;?></label>
                <figure><img src="<?php echo base_url();?>product_images/<?php echo $val->product_image;?>" alt="" class="img-fluid"></figure>
                Quantity:<input type="number" id="qty_<?php echo $val->id;?>" value="1" style="width:45%">
                <button type="button" name="process" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" id="addcart_<?php echo $val->id;?>" onclick="addtocart('<?php echo $val->id;?>')">Add To Cart</button>
                <button type="button" name="process" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark nodispaly" style="display:none" id="removecart_<?php echo $val->id;?>" onclick="removefromcart('<?php echo $val->id;?>')">Remove</button>
									</div>
							</div>
                        <?php
                      }
                      ?>
						
								</div>
								<div class="row">
							    <div class="card card-body" >
							        <div class="" id="total_reason"></div>
							        <div class="" id="total_msg"></div>
							        <div class="" id="total_cost"></div>
							        <div class="" id="total_product">
							            
							        </div>
							        <input type="hidden" id="diff_package_amount" value="<?php echo $diff_amount;?>">
							    </div>
							</div>
								<!-- /step-->
							</div>
									    <div class="text-left col-md-6">
                                                       <a id="createbtn" href="<?php echo site_url();?>Affiliate/Package/ewalletPayment">
                                                           <img src="<?php echo site_url();?>frontassets/ewallet.png">
                                                        </a>
                                                    </div>
						                            
					</div>
				
				</div>
			</div>
			
			<!--<div class="col-md-4">
					  	   
							<div class="card card-flat border-top-success">
									<div class="card-body text-center">
									   
						                            <div class="text-left col-md-6">
                                                       <a  href="<?php echo site_url();?>Affiliate/Package/callPlisio/<?php echo $pkg_id;?>">
                                                           <img src="https://plisio.net/v2/images/logo-color.svg" style="width:100%"/>
                                                        </a>
                                                    </div>
					</div>
				
				</div>
			</div>-->
					</div>
				
				</div>