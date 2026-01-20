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
                <!-- Breadcubs Area End Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <form action="<?php echo base_url();?>Admin/Member/viewAllMember" method="post">
                            
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
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Members Data</h3>
                            </div>
                            
                        </div>
                        
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    
                                    <tr role="row">
                                        <th class="sorting">S.No.</th>
                                        <th class="sorting">Username</th>
                                        <th class="sorting">Member ID</th>
                                        <th class="sorting">Name</th>
                                        <th class="sorting">Phone</th>
                                        <th class="sorting">Joining Date</th>
                                        
                                        <th class="sorting">Status</th>
                                        
                                        <th class="sorting">Action</th>
                                        <!--<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 47.55px;"></th>-->
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
                    </div>
                </div>
               
                