<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3><?php echo $user_details->first_name;?> Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>School</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <?php 
                                if($doccount>0)
                                {
                                $array=array('pending','online','offline');
                                $array_message=array('Documents uploaded and under review on ','Documents reviewed and approved on ','Documents reviewed and cancelled on ');
                                
                                $status=$array[$verify_status];
                                $message=$array_message[$verify_status];
                                ?>
                                <div class="user-status <?php echo $status;?>"></div>
                                <div><?php echo $message;?>
                                <?php echo date('d/m/Y', strtotime($verify_date));?></div>
                                <?php
                                }
                                else
                                {
                                    echo "<a href='".base_url()."School/allDocuments'>Click Here to Upload Documents</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Students</div>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $students;?>"><?php echo $students;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Teachers</div>
                                        <div class="item-number"><span class="counter" data-num="2250">2,250</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-couple text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Products</div>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $products;?>"><?php echo $products;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-yellow">
                                        <i class="flaticon-money text-orange"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Sold</div>
                                        <div class="item-number"><span>$</span><span class="counter" data-num="<?php echo $final_price;?>"><?php echo $final_price;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-red">
                                        <i class="flaticon-money text-red"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Earnings</div>
                                        <div class="item-number"><span>$</span><span class="counter" data-num="<?php echo $ewallet_balance;?>"><?php echo $ewallet_balance;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard summery End Here -->
                <!-- Dashboard Content Start Here -->
                
                <!-- Dashboard Content End Here -->
                <!-- Social Media Start Here -->
                
                <!-- Social Media End Here -->
<style>
    .user-status {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 10px;
}

.online {
    background-color: green;
}

.offline {
    background-color: red;
}
.pending {
    background-color: yellow;
}
</style>