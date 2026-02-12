<?php
$segment=$this->uri->segment(1);
?>
<div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="<?php echo base_url();?>dashboard" class="<?= ($segment=='dashboard')?'active':'';?>" ><i
                                            class="fa fa-dashboard"></i>
                                        Dashboard</a>
                                        <a href="<?php echo base_url();?>Web/composeMessage" class="<?= ($segment=='composeMessage')?'active':'';?>" ><i
                                            class="fa fa-dashboard"></i>
                                        Compose Message</a>
                                        <a href="<?php echo base_url();?>Web/inbox" class="<?= ($segment=='inbox')?'active':'';?>" ><i
                                            class="fa fa-dashboard"></i>
                                        Inbox</a>
                                        <a href="<?php echo ci_site_url();?>Web/sentMessage" class="<?= ($segment=='sentMessage')?'active':'';?>" ><i
                                            class="fa fa-dashboard"></i>
                                        Sent Message</a>
                                        
                                    <?php
                                           // echo '<pre>';
                                        //    print_r($_SESSION);
                                        //    exit;
                                             
                                            if ($_SESSION['userType'] == '1') {?>

                                    <!-- <a href="#dashboad" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                                Portal</a> -->
                                    <!-- <a href="#product" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                                Product</a> -->
                                    <a href="<?php echo base_url();?>payments" class="<?= ($segment=='payments')?'active':'';?>"><i class="fa fa-dashboard"></i>
                                        Payment</a>
                                    <a href="<?php echo base_url();?>google_meet" class="<?= ($segment=='google_meet')?'active':'';?>"><i class="fa fa-dashboard"></i>
                                        Sessions</a>
                                    <!-- <a href="<?php echo base_url('meetvideo'); ?>"><i class="fa fa-dashboard"></i>
                                                Video Call</a> -->

                                    <?php
                                            }else{?>
                                                <a href="<?php echo base_url();?>sessions" class="<?= ($segment=='sessions')?'active':'';?>"><i class="fa fa-phone"></i>
                                        Sessions</a>
                                    <a href="<?php echo base_url();?>expertbooking" class="<?= ($segment=='expertbooking')?'active':'';?>"><i class="bi bi-person-badge"></i>
                                        Connect with Expert</a>
                                    <a href="<?php echo base_url();?>addmoney" class="<?= ($segment=='addmoney')?'active':'';?>"><i class="bi bi-wallet"></i>
                                        Add Money</a>
                                    <?php } ?>

                                    <a href="<?php echo base_url();?>orders" class="<?= ($segment=='orders')?'active':'';?>"><i class="fa fa-cart-arrow-down"></i>
                                        Orders</a>
                                    <!-- <a href="#download" data-bs-toggle="tab"><i class="fa fa-cloud-download"></i>
                                                Download</a>-->
                                    <!--<a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i>
                                                Payment
                                                Method</a>-->
                                    <!-- <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i>
                                        address</a> -->
                                    <a href="<?php echo base_url();?>profile" class="<?= ($segment=='profile')?'active':'';?>"><i class="fa fa-user"></i> Account
                                        Details</a>
                                    <a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>