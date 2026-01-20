<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Income Report Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Income Report</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Fast Start PV List</h3>
                            </div>
                            
                        </div>
                        
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    
                                        <tr>
                                         <th>Sr.No</th>
                                         <th>User Id</th>
                                         <th>User Name</th>
                                         <th>Sponsor Id</th>
                                         <th>Sponsor Name</th>
                                         <th>PV</th>
                                        <!--
                                         <th>Date</th>-->
                                      </tr>
                                </thead>
                                <tbody>
                                 <?php 
                                  $total_direct_income=0;
                                  $total_left=0;
                                  $total_right=0;
                                  //pr($direct_referral_income); exit;
                                  if(!empty($direct_referral_income) && count($direct_referral_income)>0)
                                  {
                                     $sno=1;
                                     $currency=currency();
                                     foreach ($direct_referral_income as $income) 
                                     {
                                      $total_direct_income=$total_direct_income+$income['pv']; 
                                      
                                      $fromusername=get_user_name($income['user_id']);
                                      $refusername=get_user_name($income['ref_id']);
                                      
                                  ?>
                                     <tr>
                                        <td><?php echo $sno;?></td>
                                        <td><?php echo $income['user_id'];?></td>
                                        <td><?php echo $fromusername;?></td>
                                        <td><?php echo $income['ref_id'];?></td>
                                        <td><?php echo $refusername;?></td>
                                        <td><?php echo $income['pv'];?></td>
                                       
                                     </tr>
                                  <?php
                                     $sno++;       
                                     }//end foreach
                                  }//end if
                                  ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><strong>Total PV:<?php echo $total_direct_income;?></strong></td>
                                            
                                        </tr>
                                    </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
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