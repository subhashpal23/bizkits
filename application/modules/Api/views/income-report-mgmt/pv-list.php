<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Income Report Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <?php echo $breadcrumb;?>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3><?php echo $title;?></h3>
                            </div>
                            <a href="<?php echo base_url();?>Affiliate/IncomeReport/pvList/unused" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Unused PV</a>
                            <!--<a href="<?php echo base_url();?>Affiliate/IncomeReport/pvList/used" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Used PV</a>-->
                        </div>
                        
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    
                                        <tr>
                                         <th>Sr.No</th>
                                         <th>User Id</th>
                                         <th>User Name</th>
                                         <th>PV</th>
                                         <th>Level</th>
                                         <th>Leg</th>
                                         <th>Status</th>
                                         <th>Type</th>
                                         <th>Date</th>
                                      </tr>
                                </thead>
                                <tbody>
                                 <?php 
                                  $total_direct_income=0;
                                  $total_left=0;
                                  $total_right=0;
                                  $total_leftused=0;
                                  $total_rightused=0;
                                  $total_leftpending=0;
                                  $total_rightpending=0;
                                  $total_caryy_pv=0;
                                  if(!empty($direct_referral_income) && count($direct_referral_income)>0)
                                  {
                                     $sno=1;
                                     $currency=currency();
                                     foreach ($direct_referral_income as $income) 
                                     {
                                      $total_direct_income=$total_direct_income+$income->pv; 
                                      if($income->type!='Carry Forward PV')
                                      {
                                          if($income->leg=='left' || $income->leg=='Left')
                                          {
                                            $total_left=$total_left+$income->pv; 
                                            if($income->status)
                                            {
                                                $total_leftused=$total_leftused+$income->pv;
                                            }
                                            else
                                            {
                                                $total_leftpending=$total_leftpending+$income->pv;
                                            }
                                          }
                                          else if($income->leg=='right' || $income->leg=='Right')
                                          {
                                            $total_right=$total_right+$income->pv; 
                                            if($income->status)
                                            {
                                                $total_rightused=$total_rightused+$income->pv;
                                            }
                                            else
                                            {
                                                $total_rightpending=$total_rightpending+$income->pv;
                                            }
                                          }
                                      }
                                      else
                                      {
                                          if($income->leg=='left' || $income->leg=='Left')
                                          {
                                            if($income->status)
                                            {
                                                
                                            }
                                            else
                                            {
                                                $total_caryy_pv=$total_caryy_pv+$income->pv;
                                            }
                                          }
                                          else if($income->leg=='right' || $income->leg=='Right')
                                          {
                                            if($income->status)
                                            {
                                                
                                            }
                                            else
                                            {
                                                $total_caryy_pv=$total_caryy_pv+$income->pv;
                                            }
                                          }
                                      }
                                      $fromusername=get_user_name($income->down_id);
                                      
                                  ?>
                                     <tr <?php if($income->status){?> style="background-color:#e1bdae" <?php } else{?> style="background-color:#aee1ae"<?php } ?>>
                                        <td><?php echo $sno;?></td>
                                        <td><?php echo $income->down_id;?></td>
                                        <td><?php echo $fromusername;?></td>
                                        <td><?php echo $income->pv;?></td>
                                        <td><span class="label label-success"><?php echo $income->level;?></span></td>
                                        <td><?php echo $income->leg;?></td>
                                        <td><?php if($income->status){ echo "<font color='red'>Used</font>";}else{ echo "<font color='green'>Unused</font>";}?></td>
                                        <td><?php echo $income->type;?></td>
                                        <td><?php echo date(date_formats(),strtotime($income->l_date));?></td>
                                     </tr>
                                  <?php
                                     $sno++;       
                                     }//end foreach
                                  }//end if
                                  ?>
                                  
                                    </tbody>
                                    
                            </table>
                            <table id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    
                                  <tr>
                                            <td colspan=""><strong>Total Left PV</strong></td>
                                            <td colspan=""><strong>Total Right PV</strong></td>
                                            <td colspan=""><strong>Total Left Used PV</strong></td>
                                            <td colspan=""><strong>Total Right Used PV</strong></td>
                                            <td colspan=""><strong>Total Left Pending PV</strong></td>
                                            <td colspan=""><strong>Total Right Pending PV</strong></td>
                                            <td colspan=""><strong>Total Carry Forward PV</strong></td>
                                        </tr>
                                        
                                </thead>
                                <tbody>
                                    
                                  
                                        <tr>
                                            <td colspan=""><?php echo $total_left;?></td>
                                            <td colspan=""><?php echo $total_right;?></td>
                                            <td colspan=""><?php echo $total_leftused;?></td>
                                            <td colspan=""><?php echo $total_rightused;?></td>
                                            <td colspan=""><?php echo $total_leftpending;?></td>
                                            <td colspan=""><?php echo $total_rightpending;?></td>
                                            <td colspan=""><?php echo $total_caryy_pv;?></td>
                                        </tr>
                                </tbody>
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