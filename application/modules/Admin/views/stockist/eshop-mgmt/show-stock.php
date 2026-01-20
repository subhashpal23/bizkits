<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Stock</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <?php 
                  if(!empty($this->session->flashdata('flash_msg')))
                  {
                  ?>
               <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('flash_msg');?>
               </div>
               <?php    
                  }
                  ?>
		 <div class="card card-body">
            
            <div class="card-heading">

               <h5 class="card-title"><?php echo $stockist_detail->username.'('.$stockist_detail->first_name.')';?></h5>
              
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
             
            <table class="table datatable-responsive table-bordered table-striped table-hover">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Product</th>	
					 <!--<th>SKU</th>	-->
                     <th>Image</th>
					 <!--
					 <th>Web Qty</th>-->
					 <!--<th>Quantity</th>-->
					 <th>Stockist Qty</th>
					 <th>Assign Qty</th>
					 <th>Remove Qty</th>
					 <th>PV</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_products) && count($all_products)>0)
                  {
                     $sno=0;
                     foreach ($all_products as $prod) 
                     {
                     $sno++;  
                     $active_status_class=($prod['status']=='1')?'label-success':'label-danger';
                     $active_status_label=($prod['status']=='1')?'Active':'Inactive';
					 $products=	$controller_name->getProduct($prod['id']);	
					 $stockistdetail=$controller_name->getStockistQty($prod['id'],$stockist_id);
					 //print_r($stockistdetail);
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $products->title;?></td>
                     <!--<td><?php echo $products->sku;?></td>-->
                     <td><img src="<?php echo base_url(); ?>product_images/<?php echo $products->product_image;?>" width='50' /></td>
					 <!--<td><?php //echo $prod['qty'];?>
					 <input type="text" readonly id="qty_<?php echo $prod['id'];?>" value="<?php echo $prod['quantity'];?>" style="width:50px; border:0px;">
					 </td>-->
					 <!--<td><?php //echo $prod['qty'];?>
					 <input type="readonly" id="qty_<?php echo $prod['id'];?>" value="<?php echo $prod['qty'];?>" style="width:50px; border:0px;">
					 
					 </td>
					 <td><?php echo $prod['assign_web'];?>
					 <input type="hidden" id="assign_web_<?php echo $prod['id'];?>" value="<?php echo $prod['assign_web'];?>">
					 <input type="hidden" id="assign_stockist_old_<?php echo $prod['id'];?>" value="<?php echo $stockistdetail->qty;?>">
					 </td>-->
					 <td>
					      <input type="text" readonly id="assign_stockist_old_<?php echo $prod['id'];?>" value="<?php echo $stockistdetail->qty;?>">
					      
					 </td>
					 <td>
					      <span id="showstockistqty_<?php echo $prod['id'];?>"><?php echo $stockistdetail->qty;?></span>
					      
					      <input type="text" name="assign_stockist_<?php echo $prod['id'];?>" id="assign_stockist_<?php echo $prod['id'];?>" value="0" >
					 <a href="javascript:updateqty('assign_stockist','<?php echo $prod['id'];?>');"><i class="fa fa-check" aria-hidden="true"></i></a>
					 </td>
					 <td>
					      <input type="text" name="remove_stockist_<?php echo $prod['id'];?>" id="remove_stockist_<?php echo $prod['id'];?>" value="0" >
					 <a href="javascript:updateqty('remove_stockist_','<?php echo $prod['id'];?>');"><i class="fa fa-check" aria-hidden="true"></i></a>
					 </td>
					 <td>
					      <?php echo $prod['guest_point'];?>
					     <!-- <input type="text" name="tax_stockist_<?php echo $prod['id'];?>" id="tax_stockist_<?php echo $prod['id'];?>" value="<?php echo $stockistdetail->taxper;?>" style="width:50px">
					 <a href="javascript:updatetax('tax_stockist_','<?php echo $prod['id'];?>');"><i class="icon-pencil7" aria-hidden="true"></i></a>-->
					 </td>
                     <td><?php echo currency().$products->new_price;?></td>
                    
                  </tr>
                  <?php    
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<script>

function deleteConfirm()
{
   if(window.confirm('Are you sure, you want to delete the member'))
   {
      return true;
   }
   else
   {
      return false;
   }
}
</script>