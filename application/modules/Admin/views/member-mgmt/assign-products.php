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
                        <form action="<?php echo base_url();?>Admin/Member/assignProducts/<?php echo ID_encode($user_id);?>" method="post">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo $username;?>
                                    <input type="hidden" name="user_id" class="form-control" placeholder="UserID" value="<?php echo $user_id;?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="product_id" class="form-control select2">
                                        <option value="">Select Products</option>
                                        <?php
                                        foreach($products as $key=>$val)
                                        {
                                            $sel="";
                                            if($pid==$val->id)
                                            {
                                                $sel="selected";
                                            }
                                            echo '<option value="'.$val->id.'" '.$sel.'>'.$val->title.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="<?php echo ($qty)?$qty:0;?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" name="search" value="search" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"><?php echo $button;?></button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                   <a  class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" href="<?php echo base_url();?>Admin/Member/generateBill/<?php echo ID_encode($user_id);?>">Generate Bill</a>
                                </div>
                            </div>
                        </form>
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Assigned Products</h3>
                            </div>
                            
                        </div>
                        
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    
                                    <tr role="row">
                                        <th class="sorting">S.No.</th>
                                        <th class="sorting">Product</th>
                                        <th class="sorting">Monthly Quantity</th>
                                        
                                        <th class="sorting">Action</th>
                                        <!--<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 47.55px;"></th>-->
                                        </tr>
                                </thead>
                                <tbody>
                                 <?php
                                 $s=0;
                                 //echo "<pre>";print_r($all_members['data']);
                                 foreach($assign_products as $key=>$val)
                                 {
                                     $s++;
                                 ?>
                                <tr role="row" class="odd">
                                       <td><?php echo $s;?></td>
                                        <td><?php echo $val->title;?></td>
                                        <td><?php echo $val->quantity;?></td>
                                        <td><a href="<?php echo base_url();?>Admin/Member/assignProducts/<?php echo ID_encode($user_id);?>/<?php echo $val->product_id;?>"><i class="fa fa-edit"></i></a></td>
                                        
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
               
                