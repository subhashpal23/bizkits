<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Admin Dashboard</h3>
        <ul>
            <li>
                <a href="<?php echo base_url();?>/Admin">Home</a>
            </li>
            <li>Payment Details</li>
        </ul>
    </div>
    <!-- Main content -->

    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } ?>

        <?php if($this->session->flashdata('error')){ ?>
        <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php } ?>

        <div class="panel panel-flat item-content">

            <div class="panel-body" style="overflow:auto;">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Txn ID</th>
                            <th>Status</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($payment_details)) { $i=1; foreach($payment_details as $p) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $p->user_id ?? ''; ?></td>
                            <td><?php echo $p->username ?? ''; ?></td>
                            <td>
                                <?php
                                        $name = trim(($p->first_name ?? '').' '.($p->last_name ?? ''));
                                        echo $name !== '' ? $name : 'N/A';
                                    ?>
                            </td>
                            <td><?php echo $p->email ?? 'N/A'; ?></td>
                            <td><?php echo isset($p->amount) ? $p->amount : (isset($p->paid_amount) ? $p->paid_amount : ''); ?>
                            </td>
                            <td><?php echo $p->currency ?? ($p->currency_code ?? ''); ?></td>
                            <td><?php echo $p->txn_id ?? ($p->transaction_id ?? ''); ?></td>
                            <td><?php echo $p->payment_status ?? ($p->status ?? ''); ?></td>
                            <td>
                                <?php
                                        // Try common column names used in gateways
                                        echo $p->payment_date ?? ($p->created_at ?? ($p->date ?? '')); 
                                    ?>
                            </td>
                        </tr>
                        <?php } } else { ?>
                        <tr>
                            <td colspan="10" class="text-center">No payment records found.</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php $this->load->view('common/footer-text'); ?>
    </div>
    <!-- /content area -->
</div>
<!-- /main content -->