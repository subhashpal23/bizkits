
   
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
      <!-- /daterange picker -->
      <div class="row">
         <div class="card card-body">
            
            <div class="card-heading">

               <h5 class="card-title">View All Stockist</h5>
              
               <div class="heading-elements">
                  <!--<a href="<?php echo site_url().$module_name;?>/Stockist/addNewStockist" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Stockist</a>-->
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
					 <th>Assign Stock</th>
                     <th>Total Stock Supplied</th>
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
                     <td><?php echo $cat['first_name'];?></td>
                     <td><?php echo $cat['user_id'];?></td>
                     <td><?php echo $cat['username'];?></td>
					<td><?php echo $cat['email'];?></td>
					<td><?php echo $cat['contact_no'];?></td>
                     <td><a href="<?php echo site_url().$module_name;?>/Stockist/showStock/<?php echo ID_encode($cat['id']);?>" data-popup="tooltip" title="" data-original-title="Edit Stockist"><i class="fa fa-eye"></i></a></td>
                     <td>
                        
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