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
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="card card-body">
            <form action="<?php echo base_url();?>Admin/Member/passwordTracker" method="post">
                            
                            <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="user_id" class="form-control" placeholder="UserID" value="<?php echo $conditions['user_id'];?>">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $conditions['username'];?>">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" name="search" value="search" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Search</button>
                            </div>
                            </div>
                        </form>
            <div class="card-heading">
               <h5 class="card-title">Password Tracker</h5>
               
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
            <table class="table datatable-responsive" id="example">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Member Name</th>
                     <th>User Id</th>
                     <th>Name</th>
                     <th>Phone</th>
                     <!--<th>Joining Date</th>
                     <th>Sponsor Name</th>-->
					 <th>Password</th>
					 <th>Reset Password</th>
                     <!--<th>Transaction Password</th>
					 <th>Reset Transaction Password</th>-->
					 <!--<th>Status</th>-->
                     <!--
					 <th>View Genealogy</th>
      				 <th>Referral Tree</th>
					 -->
                  </tr>
               </thead>
               <tbody>
                                 <?php
                                 //echo "<pre>";print_r($all_members['data']);
                                 foreach($all_members['data'] as $key=>$val)
                                 {
                                 ?>
                                <tr role="row" class="odd">
                                        <?php
                                        foreach($val as $key1=>$val1)
                                        {
                                        ?>
                                        <td><?php echo $val1;?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
            </table>
         </div>
      </div>
      <!-- Render pagination links -->
<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<script>
/*$(document).ready(function() {
    $('#example').DataTable( {
		"destroy":true,
        "processing": true,
        "serverSide": true,
        "ajax":"<?php echo ci_site_url();?>admin/member/password_tracker_list_ajax",
         "columnDefs"      : [{ 'className': 'control', 'orderable': false, 'targets':[]}, 
                    {'orderable': false, 'targets': [] }, 
                    {"targets": [ ],"visible": false,"searchable": false}
                ]
    } );
} );*/
</script>