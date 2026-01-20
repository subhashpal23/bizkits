<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Eshop</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Eshop</li>
                    </ul>
                </div>

          <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Products</h3>
                            </div>
                            <a href="<?php echo site_url().$module_name;?>/Eshop/addNewProduct" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Product</a>
                            <!--<div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>-->
                        </div>
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
            <div class="table-responsive">
            <table class="table table--light style--two">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Title</th>	
					 <th>SKU</th>	
                     <th>Image</th>
					 <th>Old Price</th>
					 <th>New Price</th>
                     <th>Status</th>
                     <th>Date</th>
                     <th>Action</th>
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
					 				   
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $prod['title'];?></td>
                     <td><?php echo $prod['sku'];?></td>
                     <td><img src="<?php echo base_url(); ?>product_images/<?php echo $prod['product_image'];?>" width='50' /></td>
					 <td><?php echo $prod['old_price'];?></td>
					 <td><?php echo $prod['new_price'];?></td>
					 <td><span class="label <?php echo $active_status_class;?>"><?php echo $active_status_label;?></span></td>
                     <td><?php echo $prod['created_date'];?></td>
                     <td>
                         <a href="<?php echo site_url().$module_name;?>/Eshop/editProduct/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Product"><i class="fa fa-edit"></i></a>
                           <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/Eshop/deleteProduct/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="" data-original-title="Delete Product"><i class="fa fa-trash"></i></a>
                           
                        
                     </td>
                  </tr>
                  <?php    
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
     </div>
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<script>

function deleteConfirm(){

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