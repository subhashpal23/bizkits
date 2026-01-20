   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
   <div class="content">
      <!-- Daterange picker -->
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
      <!-- /daterange picker -->
      <div class="row">
         
		 <div class="card card-body">
            
            <div class="card-heading">

               <h5 class="card-title">View All Assigned Product</h5>
             
            </div>
             
            <table class="table datatable-responsive table-bordered table-striped table-hover">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Title</th>	
					 <th>SKU</th>	
                     <th>Image</th>
					 <th>Assigned To</th>
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
    					 <td><a href="<?php echo site_url().$module_name;?>/Eshop/assignProducts/<?php echo ID_encode($prod['id']);?>"><i class="fa fa-eye"></i></a></td>
    					 <td><?php echo $prod['new_price'];?></td>
    					 <td><span class="label <?php echo $active_status_class;?>"><?php echo $active_status_label;?></span></td>
                         <td><?php echo $prod['created_date'];?></td>
                         <td>
                               <a href="<?php echo site_url().$module_name;?>/Eshop/editProduct/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Product"><i class="fa fa-edit"></i></a>
                               <!--<a href="<?php echo site_url().$module_name;?>/Eshop/assignProducts/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="" data-original-title="View Products"><i class="fa fa-eye"></i></a>
    						   -->
    						   <!--
    						   <li>
                                  <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/eshop/deleteProduct/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="" data-original-title="Delete Product"><i class="icon-trash"></i></a>
                               </li>
    						   -->
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