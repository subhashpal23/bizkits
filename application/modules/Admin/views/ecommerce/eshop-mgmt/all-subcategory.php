
   
   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Sub Cateogry Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Sub Cateogry </li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
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
			 <?php 
                  if(!empty($this->session->flashdata('error_msg')))
                  {
                  ?>
               <div class="alert alert-warning alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
                  ?>
      <div class="row">
	   
         <div class="card card-body">
            
            <div class="card-heading">
<a href="<?php echo site_url().$module_name;?>/Eshop/addNewSubCategory" style="float:right"><i class="fa fa-plus"></i> Add New Sub Category</a>
               <h5 class="card-title">My Sub Categories</h5>
              
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
					 
					 <th>Name</th>					                 
					 <th>Parent Category</th>
					 <!--<th>Home Page Display</th>
					 <th>Move Up</th>-->
					 <th>Service Status</th>
                     <!--<th>Date</th>-->
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_subcategory) && count($all_subcategory)>0)
                  {
                     $sno=0;
					 $index=0;
                     foreach ($all_subcategory as $cat) 
                     {
                     $sno++;  
                     $active_status_class=($cat['active_status']=='1')?'label-success':'label-danger';
                     $active_status_label=($cat['active_status']=='1')?'Product':'Service';
								   
                  ?>
                  <tr>
				  
                     <td><?php echo $sno;?></td>
                     <td><?php echo $cat['subcategory_name'];?></td>
                     <td><?php echo $cat['category_name'];?></td>
					 <!--<td>
					 <?php 
					 if(!empty($cat['is_display_on_home']) && $cat['is_display_on_home']=='1')
					 {
						echo "Yes[position=".$cat['display_home_position']."]"; 
					 }
					 else 
					 {
						echo "No"; 
					 }
					 ?>
					 
					 </td>
					 <td>
						  <?php 
						  if($index>0)
						  {
							  $previous_subject=$all_subcategory[$index-1];
							  //pr($previous_subject);
						  ?>
						  <a href="<?php echo site_url().$module_name."/".$controller_name;?>/moveUp/eshop_subcategory/<?php echo $cat['position'];?>/<?php echo $previous_subject['position'];?>">Move Up</a>
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
                        
                              <a href="<?php echo site_url().$module_name;?>/Eshop/editSubCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>
                         <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/Eshop/deleteSubCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Delete Category"><i class="fa fa-trash"></i></a>
                         
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