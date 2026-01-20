<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Admin">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
   <div class="content">
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
            <h5 class="card-title">All Packages</h5>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
         <table class="table datatable-responsive">
            <thead>
                           <tr>
                              <th>Sr.</th>
                              <th>Title</th>
                              <th>Package Image</th>
                              <th>Amount</th>
                              <th>Status</th>
                             <!--
							  <th>Description</th>
                               -->
							  <th>Manage Commission</th>
                              
							  <th>Created Date</th>
                              <th>Action</th>
                           </tr>
            </thead>
            <tbody>
               <?php 
                  if(!empty($all_packages) && count($all_packages)>0)
                  {
                     $sno=0;
                     foreach ($all_packages as $rowObj) 
                     {
                     $sno++;
                     $status_label=($rowObj->status=='1')?'label-success':'label-danger';
                     $status=($rowObj->status=='1')?'Active':'Inactive';
                  ?>
               <tr>
                              <td><?php echo $sno;?></td>
                              <td><?php echo $rowObj->title;?></td>
                              <td><img width="50" src="<?php echo base_url()."images/".$rowObj->pkg_image;?>"></td>
                              <td><?php echo $rowObj->amount." ".currency();?></td>
                   <td><span class="label <?php echo $status_label;?>"><?php echo $status;?></span></td>
                     
					 <!--
					 <td><?php echo $rowObj->description;?></td>
                     -->
					 <td><a href="<?php echo ci_site_url();?>admin/package/manageCommission/<?php echo ID_encode($rowObj->id);?>">Manage Commission</td>
						
                              <td><?php echo date(date_formats(),strtotime($rowObj->created_date));?></td>

                                       <td>

                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              <li><a  href="<?php echo ci_site_url()."Admin/Package/editPackage"?>/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-pdf"></i>Edit Package</a></li>
                              
                              <!--
							  <li><a onclick="return confirmDelete();" href="<?php echo ci_site_url()."Admin/Package/deletePackage"?>/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-excel"></i> Delete Package</a></li>
                              -->
                              <li><a onclick="return confirmChangeStatus();" href="<?php echo ci_site_url();?>Admin/Package/changePackageStatus/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-word"></i> Activate/Deactivate</a></li>
							  
                           </ul>
                        </li>
                     </ul>
                  </td>
               </tr>
               <?php       
                  }
                  }
                  ?>
            </tbody>
         </table>
      </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
   function confirmChangeStatus()
   {
   
      if(window.confirm('Are you sure, you want to change the status!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
   function confirmDelete()
   {
   
      if(window.confirm('Are you sure, you want to delete the Package!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
</script>