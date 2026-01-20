<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Team Report Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Team Report</li>
                    </ul>
                </div>
               <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                        <div class="item-title">
                                <h3>Team Report </h3>
                                <h5>Level1:<?php echo $level1;?> Level2:<?php echo $level2;?> Level3:<?php echo $level3;?> Level4:<?php echo $level4;?></h5>
                                
                            </div>
                        <div class="heading-elements">
                           <ul class="icons-list">
                              <li><a data-action="collapse"></a></li>
                              <li><a data-action="reload"></a></li>
                              <li><a data-action="close"></a></li>
                           </ul>
                        </div>
                     </div>
                    
                    <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                <table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                        <thead>
                        <tr>
                           <th>Sr.No</th>
                           <th>User Id</th>
                           <th>User Name</th>
                           <th>Full Name</th>
                           <th>Contact No.</th>
                           <th>Level</th>
                           
                           <th>Rank</th>
                           <th>Status</th>
                           <th>Registration Method</th>
                           <th>Registration Date</th>
                        </tr>
                        </thead>
                        <tbody>
                           <?php 
                           if(!empty($team_member) && count($team_member)>0)
                           {
                              $sno=1;
                              foreach($team_member as $member)
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
                              
                              <td><?php echo $member->leg; ?></td>
                              <td><?php echo $member->rank_name;?></td>
                              <td><?php echo $status;?></td>
                              <td><?php echo $member->registration_method_name;?></td>
                              <td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
                           </tr>                           
                           <?php       
                              $sno++;
                              }//end foreach here!
                           }//end if here!
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