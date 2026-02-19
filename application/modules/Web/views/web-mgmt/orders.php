<!-- breadcrumbs-area-start -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>


<div class="breadcrumbs-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs-menu">
                    <ul>
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li><a href="#" class="active">my-account</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<!-- entry-header-area-start -->
<div class="entry-header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="entry-header-title">
                    <h2>My-Account</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- entry-header-area-end -->
<!-- my account wrapper start -->
<div class="my-account-wrapper mb-70">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <?php echo $this->load->view('leftmenu');?>
                            </div>

                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <!-- Orders Only -->
                                    <div class="tab-pane fade show active" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Orders</h5>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Total</th>
                                                            <th>Invoice</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $s=1;
                                                        foreach($orders as $key=>$val)
                                                        {
															 $orderDetails = json_decode($val->order_details, true);

                                                        ?>
                                                        <tr>
                                                            <td><?php echo $val->order_id; ?></td>
                                                            <td><?php echo $val->order_date; ?></td>
                                                            <td><?php echo currency() . $val->final_price; ?></td>
                                                            <td>
                                                                <a href="<?php echo base_url(); ?>invoice?order_id=<?php echo $val->order_id; ?>"
                                                                    class="btn btn-sqr"><i class="fa fa-eye"></i></a>
                                                            </td>

                                                            <td>
<?php
if (!empty($orderDetails)) {
    foreach ($orderDetails as $item) {

        $product_id = $item['product_id'];

        // eshop_products se product data
        $product = $this->db
            ->where('id', $product_id)
            ->get('eshop_products')
            ->row();

        // safety check
        if (empty($product)) {
            continue;
        }

        // BASIC
        if ($item['product_price'] == $product->price1 && !empty($product->zip1)) {

            $downloadPath = base_url('uploads/' . $product->zip1);
            ?>
            <a href="<?= $downloadPath; ?>" download class="btn btn-sqr">
                <i class="fa fa-download"></i>
            </a>
            <?php
        }

        // PRO
        elseif ($item['product_price'] == $product->price2 && !empty($product->zip2)) {

            $downloadPath = base_url('uploads/' . $product->zip2);
            ?>
            <a href="<?= $downloadPath; ?>" download class="btn btn-sqr">
                <i class="fa fa-download"></i>
            </a>
            <?php
        }

        // ENTERPRISE
        elseif ($item['product_price'] == $product->price3 && !empty($product->zip3)) {

            $downloadPath = base_url('uploads/' . $product->zip3);
            ?>
            <a href="<?= $downloadPath; ?>" download class="btn btn-sqr">
                <i class="fa fa-download"></i>
            </a>
            <?php
        }

        // fallback (kuch bhi match na ho)
        else {
            ?>
            <!-- <span class="text-muted">No file</span> -->
            <?php
        }
    }
}
?>
</td>


                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Orders Only -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>