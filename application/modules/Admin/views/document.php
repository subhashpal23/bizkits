<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Documents</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Admin">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Documents</h3>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
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
                                    
                                    <tr role="row">
                                        <th class="sorting">S.No.</th>
                                        <th class="sorting">Username</th>
                                        <th class="sorting">Member ID</th>
                                        <th class="sorting">Request Date</th>
                                        <th class="sorting">Documents</th>
                                        
                                        <th class="sorting">Status</th>
                                        <th class="sorting">Verify Date</th>
                                        <th class="sorting" colspan="2">Action</th>
                                        <!--<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 47.55px;"></th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                 echo $this->session->flashdata('success');
                                 $sn=1;
                                 foreach($user_info as $key=>$val)
                                 {
                                ?>
                                    <tr role="row" class="odd">
                                        <td><?php echo $sn;?></td>
                                        <td><?php echo get_user_name($val->user_id);?></td>
                                        <td><?php echo $val->user_id;?></td>
                                        <td><?php echo $val->request_date;?></td>
                                        <td><?php $arr=json_decode($val->documents_list);?>
                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $sn;?>">Open Documents</button>

                                            <!-- Modal -->
                                            <div id="myModal<?php echo $sn;?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                            
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Documents</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <?php
                                                    //pr($arr);
                                                    foreach($arr as $key1=>$val1)
                                                    {
                                                        if($key1!='user_id' && $key1!='document_upload_date')
                                                        {
                                                            echo "<strong>".$key1.":</strong><br><img src='".base_url()."schooldocuments/".$val1."'><br>";
                                                        }
                                                        else
                                                        {
                                                        echo "<strong>".$key1.":</strong><br>".$val1."<br>";
                                                        }
                                                    }
                                                    ?>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                            
                                              </div>
                                            </div>
        </td>
                                        <td><?php 
                                        if($val->verify_status==1){ echo $action="Verified";}
                                        else if($val->verify_status==2){ echo $action="Cancelled";}
                                        if($val->verify_status==0){ echo $action="Pending";}?></td>
                                        <td><?php echo $val->verify_date;?></td>
                                        <td><?if($val->verify_status==0){?><a href="<?php echo base_url();?>Admin/changeDocStatus/verify/<?php echo $val->id;?>">Click Here For Verify</a><?php }?></td>
                                        <td><?if($val->verify_status==0){?><a href="<?php echo base_url();?>Admin/changeDocStatus/cancel/<?php echo $val->id;?>">Click Here For Cancel</a><?php }?></td>
                                    </tr>
                                <?php
                                $sn++;
                                    }
                                ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>