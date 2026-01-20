<!--<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/dashboard.js"></script>-->
<script type= "text/javascript" src = "<?php echo base_url();?>frontassets/js/countries.js"></script>
<!-- Main content -->

    <style>
        .img-responsiv {
            width:100;
            height:auto;
        }
    </style>
   <!-- Page header -->
<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Wallet</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Wallet</li>
                    </ul>
                </div>
                
      <div class="row">
         <div class="col-lg-12 col-sm-12">
            <div class="row">
    			<div class="card card-body" >
    			    <div class="card-heading">
                                    <a class="mini-cart-icon" href="javascript:void(0);" style="float:right">
                                        <img alt="Nest" src="<?php echo base_url();?>frontassets/imgs/theme/icons/icon-cart.svg">
                                        
                                        <span class="pro-count blue carttotal"></span>
                                        
                                    </a>
                                    <a href="<?php echo base_url().'Admin/Eshop/ourCartTopup';?>"  style="float:right"><span class="lable">Cart &nbsp;<span class="totalproducts"></span></span></a>
             
                    </div>
    			 
                    <div class="col-lg-6" style="float:left">
        								<div class="form-group">
                        <label for="">Choose Stockist</label>
                        <div class="styled-select clearfix">
                            
        											<select class="form-control required" name="stockist" id="stockist" onchange="showStockist(this.value);">
        												<option value="">Select Customer</option>
                                
        											<?php
        											foreach($all_stockist as $key=>$val)
        											{
        											    echo "<option value='".$val->user_id."'>".$val->first_name.' '.$val->last_name."</option>";
        											}
        											?>
        											                           
        											</select>
        										</div>
        														
        								</div>
        							</div>
        			
    			</div>
			</div>
			
							<div class="row">
							    <div class="card card-body" >
							        <div class="" id="showstockistdetails"></div>
							        
							    </div>
							</div>
							
      <!-- Main charts -->
      
          <?php
          //pr($all_category);
          foreach($all_category as $key=>$val)
          {
                $all_products=$controller->productslist($val->id);
                if(count($all_products)>0)
                {
              ?>
                <div class="row showproducts" style="display:none">
                    <h3 class="modtitle" style="width:100%">
                        <span><?php echo $val->category_name;?></span>
                    </h3>
                     <?php
                     foreach($all_products as $keyp=>$product)
                     {
                        if(file_exists("product_images/".$product['product_image']))
                        {
                            $product_image=$product['product_image'];
                        }
                        else
                        {
                            $product_image='img-default.gif';
                        }
                        $filename=showproductimage($product['product_image']);
                        $purl=base_url()."product_images/".$product['product_image'];
                     ?>
                     
                <div class="col-sm-6 col-md-3">
                    <div class="card card-body ">
                        <div class="card no-margin">
                            <div class="img-responsive">
                              <img data-sizes="auto" src="<?php echo $purl;?>" alt="<?php echo $product['title'];?>" class="lazyload img-responsive">
                            </div>
                            <div class="card-body">
                                <h3 class="no-margin"><?php echo $product['title'];?></h3>
                                <!--<span class="text-uppercase"><?php if($product['qty']){ echo "<samp>Available</samp>";}else{ echo "<samp>Out Of Stock</samp>";} ?></span>-->
                                
                            </div>
                            <div class="card-footer">
                                <input type="number" name="quanity<?php echo $product['id'];?>" id="quantity<?php echo $product['id'];?>" value="1">
                              <a href="javascript:void(0)" onclick="addcartvalueproducts(<?php echo $product['id'];?>)" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add To Cart</a>
                              <!--<button type="button" class ="btn btn-primary" onclick="loadDoc(<?php echo $product['id'];?>);">Add To Cart</button>-->
                              <!--<button type="button" class ="btn btn-primary" onclick="view_products_details('<?php echo $product['id'];?>');">View</button>-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    echo "</div>";
                }
                else
                {
                    ?>
                    <?php
                }
          }
          ?>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>

<div id="view_order_details_modal"  class="modal fade">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-success">
            <h6 class="modal-title" id="view_booking_product_name">Product Details <b></b></h6>
         </div>
         <div class="modal-body" id="preview_info_body">
            <!-------------------------->
            
            <!--------------------------->
         </div>
         <div class="modal-footer">
            <!--
               <button type="button" onclick="print_invoice();" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i> Print</button>
               -->
            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
    function addcartvalue(id)
    {
        var qty=document.getElementById('quantity'+id).value;
        var url="<?php echo site_url();?>Admin/Cart/addToCartRepurchase/"+id+"/eshop/"+qty;
        window.location.href=url;
    }
</script>