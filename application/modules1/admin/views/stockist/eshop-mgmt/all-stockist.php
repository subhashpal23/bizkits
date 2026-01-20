<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Eshop</span> - Stockist</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-elements">
            <div class="heading-btn-group">
            <a href="<?php echo site_url().$module_name;?>/stockist/addNewStockist" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Stockist</a>
            </div>
                     </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Eshop</a></li>
            <li class="active">Stockist</li>
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

               <h5 class="panel-title">View All Stockist</h5>
              
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
					 <th>Name</th>
					 <th>User ID</th>
					 <th>Username</th>
					 <th>Email</th>
					 <th>Mobile</th>
					 <th>Stock</th>
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
                     $active_status_class=($cat['status']=='1')?'label-success':'label-danger';
                     $active_status_label=($cat['status']=='1')?'Active':'Inactive';
								   
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $cat['name'];?></td>
                     <td><?php echo $cat['user_id'];?></td>
                     <td><?php echo $cat['username'];?></td>
					<td><?php echo $cat['email'];?></td>
					<td><?php echo $cat['mobile'];?></td>
                     <td><a href="<?php echo site_url().$module_name;?>/stockist/showStock/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Stockist">Show Stock</a></td>
                     <td>
                        <ul class="icons-list">
                           <li>
                              <a href="<?php echo site_url().$module_name;?>/stockist/editStockist/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Stockist"><i class="icon-pencil7"></i></a>
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