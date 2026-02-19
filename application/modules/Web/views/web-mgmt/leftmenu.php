<?php
$segment=$this->uri->segment(1);
?>
<div class="myaccount-tab-menu nav" role="tablist">
    <a href="<?php echo base_url();?>dashboard" class="<?= ($segment=='dashboard')?'active':'';?>"><i
            class="fa fa-dashboard"></i>
        Dashboard</a>

    <!-- Messages (Compose/Inbox/Sent are now tabs on one page) -->
    <a href="<?php echo base_url();?>Web/composeMessage" class="<?= in_array($segment, ['composeMessage','inbox','sentMessage'])?'active':'';?>"><i
            class="fa fa-envelope"></i>
        Messages</a>

    <?php
                                            if ($_SESSION['userType'] == '1') {?>

    <a href="<?php echo base_url();?>payments" class="<?= ($segment=='payments')?'active':'';?>"><i
            class="fa fa-dashboard"></i>
        Payment</a>
    <a href="<?php echo base_url();?>google_meet" class="<?= ($segment=='google_meet')?'active':'';?>"><i
            class="fa fa-dashboard"></i>
        Sessions</a>

    <?php
                                            }else{?>
    <a href="<?php echo base_url();?>sessions" class="<?= ($segment=='sessions')?'active':'';?>"><i
            class="fa fa-phone"></i>
        Sessions</a>
    <a href="<?php echo base_url();?>expertbooking" class="<?= ($segment=='expertbooking')?'active':'';?>"><i
            class="bi bi-person-badge"></i>
        Connect with Expert</a>
    <a href="<?php echo base_url();?>addmoney" class="<?= ($segment=='addmoney')?'active':'';?>"><i
            class="bi bi-wallet"></i>
        Add Money</a>
    <?php } ?>

    <a href="<?php echo base_url();?>orders" class="<?= ($segment=='orders')?'active':'';?>"><i
            class="fa fa-cart-arrow-down"></i>
        Orders</a>

    <a href="<?php echo base_url();?>profile" class="<?= ($segment=='profile')?'active':'';?>"><i
            class="fa fa-user"></i> Account
        Details</a>
    <a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i> Logout</a>
</div>
