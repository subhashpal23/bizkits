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
                                <h3>Income Report</h3>
                            </div>
                            <!--<div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>-->
                        </div>
                        <!--<form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                    <input type="text" placeholder="Search by Roll ..." class="form-control">
                                </div>
                                <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                                    <input type="text" placeholder="Search by Name ..." class="form-control">
                                </div>
                                <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                    <input type="text" placeholder="Search by Class ..." class="form-control">
                                </div>
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                    <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                </div>
                            </div>
                        </form>-->
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    
                                        <tr>
                                         <th>Sr.No</th>
                                         <th>User Id</th>
                                         <th>User Name</th>
                                         <th>Amount</th>
                                         <th>Transaction Type</th>
                                         <th>Summary</th>
                                         <th>Date</th>
                                      </tr>
                                </thead>
                                <tbody>
                                 <?php 
                                  $total_direct_income=0;
                                  if(!empty($direct_referral_income) && count($direct_referral_income)>0)
                                  {
                                     $sno=1;
                                     $currency=currency();
                                     foreach ($direct_referral_income as $income) 
                                     {
                                      $total_direct_income=$total_direct_income+$income->credit_amt;  
                                      $fromusername=get_user_name($income->sender_id);
                                      if($income->level==1)
                                      {
                                          $summary="Direct ".$income->ttype." From ".$fromusername;
                                      }
                                      else
                                      {
                                          $summary="Indirect ".$income->ttype." From ".$fromusername;
                                      }
                                      
                                      $status=($income->status==1)?"Credit":"Debit";
										$amount=($income->status==1)?$income->credit_amt:$income->debit_amt;
										$sign=($income->status==1)?"+":"-";
										$color=($income->status==1)?"green":"red";
                                  ?>
                                     <tr>
                                        <td><?php echo $sno;?></td>
                                        <td><?php echo $income->sender_id;?></td>
                                        <td><?php echo $fromusername;?></td>
                                        <td style="color:<?php echo $color;?>"><?php echo $sign.$currency.$income->credit_amt;?></td>
                                        <td style="color:<?php echo $color;?>"><span class="label label-success"><?php echo $status;?></span></td>
                                        <td><?php echo $summary;//$income->tranDescription;?></td>
                                        <td><?php echo date(date_formats(),strtotime($income->create_date));?></td>
                                     </tr>
                                  <?php
                                     $sno++;       
                                     }//end foreach
                                  }//end if
                                  ?>
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