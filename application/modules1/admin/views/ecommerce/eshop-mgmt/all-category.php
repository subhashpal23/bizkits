<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Eshop</span> - Category</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-elements">
            <div class="heading-btn-group">
            <a href="<?php echo site_url().$module_name;?>/eshop/addNewCategory" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Category</a>
            </div>
                     </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Eshop</a></li>
            <li class="active">Category</li>
         </ul>
         
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            
            <div class="panel-heading">

               <h5 class="panel-title">View All Category</h5>
              
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
					 <th>Move Up</th>
					 <th>Active Status</th>
                     <th>Date</th>
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
                     $active_status_label=($cat['active_status']=='1')?'Active':'Inactive';
								   
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $cat['category_name'];?></td>
					 <td>
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
				  </td>
                   
					 <td><span class="label <?php echo $active_status_class;?>"><?php echo $active_status_label;?></span></td>
                     <td><?php echo $cat['create_date'];?></td>
                     <td>
                        <ul class="icons-list">
                           <li>
                              <a href="<?php echo site_url().$module_name;?>/eshop/editCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Category"><i class="icon-pencil7"></i></a>
                           </li>
						   <!--
						   <li>
                              <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/eshop/deleteCategory/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Delete Category"><i class="icon-trash"></i></a>
                           </li>
						   -->
                           
                        </ul>
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
      <?php $this->load->view('common/footer-text') ?>
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