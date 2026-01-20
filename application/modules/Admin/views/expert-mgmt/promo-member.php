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
                        
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Promo Members </h3>
                            </div>
                            
                        </div>
                        
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    
                                    <tr role="row">
                                        <th class="sorting">S.No.</th>
                                        <th class="sorting">Username</th>
                                        <th class="sorting">Member ID</th>
                                        <th class="sorting">Date</th>
                                        <th class="sorting">Package</th>
                                        
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
               
                