
   
   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Cateogry Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>All Cateogry</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
           
         <div class="card card-body">
            
            <div class="card-heading">
<a href="<?php echo site_url().$module_name;?>/Eshop/addNewCategory" style="float:right"><i class="fa fa-plus"></i> Add New Category</a>
               <h5 class="card-title">My Categories</h5>
              
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
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
            <table class="table datatable-responsive table-bordered table-striped table-hover">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Category Name</th>
					 <!--<th>Move Up</th>-->
					 <th>Service Status</th>
                     <!--<th>Date</th>-->
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_category) && count($all_category)>0)
                  {
                     $sno=0;
					 $index=0;
                     foreach ($all_category as $cat) 
                     {
                     $sno++;  
                     $active_status_class=($cat['active_status']=='1')?'label-success':'label-danger';
                     $active_status_label=($cat['active_status']=='1')?'Product':'Service';
								   
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $cat['category_name'];?></td>
					<!-- <td>
						  <?php 
						  if($index>0)
						  {
							  $previous_subject=$all_category[$index-1];
							  
						  ?>
						  <a href="<?php echo site_url().$module_name."/".$controller_name;?>/moveUp/eshop_category/<?php echo $cat['position'];?>/<?php echo $previous_subject['position'];?>">Move Up</a>
						  <?php 
						  }
						  else 
						  {
						  ?>
						  ----
						  <?php 
						  }
						  ?>
				  </td>-->
                   
					 <td><span class="label <?php echo $active_status_class;?>"><?php echo $active_status_label;?></span></td>
                     <!--<td><?php echo $cat['create_date'];?></td>-->
                     <td>
                       <a href="<?php echo site_url().$module_name;?>/Eshop/editCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>
                           <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/Eshop/deleteCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Delete Category"><i class="fa fa-trash"></i></a>
                          
                     </td>
                  </tr>
                  <?php 
						$index++;
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