<div class="body-wrapper">
            <div class="bodywrapper__inner">

                <div class="row align-items-center mb-30 justify-content-between">
    <div class="col-lg-6 col-sm-6">
        <h6 class="page-title">Category</h6>
    </div>
    <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3 right-part">
            
    </div>
</div>
      <div class="row">
	   <div class="col-lg-12 col-sm-12">
         <div class="card card-flat">
            
            <div class="card-heading">

               <h5 class="card-title">View All Sub Category</h5>
              
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
            <div style="overflow-x:auto">
            <table class="table table--light style--two">
               <thead>
                  <tr>
                     
                     <th>Sr.No</th>
					 
					 <th>Category Name</th>					                 
					 <th>Parent</th>
					 <th>Home Page Display</th>
					 <th>Move Up</th>
					 <th>Active Status</th>
                     <th>Date</th>
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
                     $active_status_label=($cat['active_status']=='1')?'Active':'Inactive';
								   
                  ?>
                  <tr>
				  
                     <td><?php echo $sno;?></td>
                     <td><?php echo $cat['subcategory_name'];?></td>
                     <td><?php echo $cat['category_name'];?></td>
					 <td>
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
				  </td>
					 <td><span class="label <?php echo $active_status_class;?>"><?php echo $active_status_label;?></span></td>
                     <td><?php echo $cat['create_date'];?></td>
                     <td>
                         <a href="<?php echo site_url().$module_name;?>/eshop/editSubCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>
                         <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/eshop/deleteSubCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Delete Category"><i class="fa fa-trash"></i></a>
                             
                        
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