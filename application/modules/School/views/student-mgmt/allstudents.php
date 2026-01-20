<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Students</li>
                    </ul>
                </div>
                <?php echo $this->session->flashdata('flash_msg');?>
                 <div class="card card-flat">
                     <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Students</h3>
                            </div>
                            <a href="<?php echo site_url();?>School/Students/addStudent" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Student</a>
                            <!--<div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>-->
                        </div>
                    <div class="table-responsive">
                     <table class="table table--light style--two">
                        <thead>
                           <tr>
                              <th>Sr.No</th>
                              <th>User Id</th>
                              <th>User Name</th>
                              <th>Full Name</th>
                              <th>Contact No.</th>
                              <th>Rank</th>
                              <th>Status</th>
                              <th>Registration Method</th>
                              <th>Registration Date</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                           if(!empty($all_students) && count($all_students)>0)
                           {
                              $sno=1;
                              foreach($all_students as $member)
                              {
                                $status=($member->active_status=='1')?'Active':'Inactive'; 
								
								$contact_no=(!empty($member->contact_no))?$member->contact_no:'Null';
								
								$full_name=$member->first_name.$member->last_name;
								$full_name=(!empty($full_name))?$member->first_name." ".$member->last_name:'Null';
								
                           ?>
                           <tr>
                              <td><?php echo $sno;?></td>
                              <td><?php echo $member->user_id;?></td>
                              <td><?php echo $member->username;?></td>
                              <td><?php echo $full_name;?></td>
                              <td><?php echo $contact_no;?></td>
                              <td><?php echo $member->rank_name;?></td>
                              <td><?php echo $status;?></td>
                              <td><?php echo $member->registration_method_name;?></td>
                              <td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
                           </tr>
                           <?php       
                               $sno++;  
                              }
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               
              
               
            </div>
   <!-- /content area -->
</div>
<script>
   function deleteConfirm()
   {
   
   	if(window.confirm("Are you sure, you want to delete"))
       return true;
     else 
       return false;
   }
</script>