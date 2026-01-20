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
            <div class="card-heading">
               <h5 class="card-title">Commission List</h5>
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
            <table class="table datatable-responsive" id="example">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Commission %</th>
                     <th>Level</th>
                     
                     <!--
					 <th>View Genealogy</th>
      				 <th>Referral Tree</th>
					 -->
                  </tr>
               </thead>
               <tbody>
                                 <?php
                                 $sno=1;
                                 //echo "<pre>";print_r($all_members['data']);
                                 foreach($allcommission as $key=>$val)
                                 {
                                 ?>
                                    <tr role="row" class="odd">
                                        <td><?php echo $sno;?></td>
                                      <td><?php echo $val->commission;?></td>
                                      <td><?php echo $val->level;?></td>  
                                    </tr>
                                    <?php
                                    $sno++;
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