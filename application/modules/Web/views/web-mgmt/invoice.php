<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

   
    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        body {
            background: #f8f9fa;
        }
        .invoice-box {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<!-- breadcrumbs-area-start -->
        <div class="breadcrumbs-area mb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumbs-menu">
                            <ul>
                                <li><a href="#">Home</a></li>
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
<div class="container my-5">
    <div class="invoice-box" id="invoice">
		
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4 class="fw-bold"><?php echo $company_details->company_name; ?></h4>
                <p>
                    Address : <strong><?php echo $company_details->address; ?> </strong><br>
                    GSTIN: <strong><?php echo $company_details->gst_number; ?></strong>
                </p>
            </div>
            <div class="col-md-6 text-end">
                <h5>Invoice</h5>
                <p>
                    <strong>Invoice No:</strong> <?php echo $_GET['order_id'];?><br>
                    <strong>Date:</strong> <?= date('l, d F Y', strtotime($latesorders[0]->order_date)); ?>

                </p>
            </div>
        </div>

        <!-- Customer -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6>Billed To</h6>
                <p>
                    Customer Name : <strong><?= $user->first_name ?? 'N/A'; ?></strong><br>
                    Customer Address : <strong><?= $user->address_line1 ?? 'N/A'; ?></strong><br>
                    Phone: <strong><?= $user->contact_no ?></strong>
                </p>
            </div>
        </div>

        <!-- Items Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Rate</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
				<tbody>
                    <?php
                    $s = 1;

                    // JSON decode (multiple products ho sakte hain)
                    $products = json_decode($invoice_order->order_details, true);

                    if (!empty($products)) {
                        foreach ($products as $product) {
                    ?>
                        <tr>
                            <td><?= $s++; ?></td>
                            <td><?= $product['product_name']; ?></td>
                            <td class="text-end"><?= $product['qty']; ?></td>
                            <td class="text-end">
                                <?= currency() . number_format($product['product_price'], 2); ?>
                            </td>
                            <td class="text-end">
                                <?= currency() . number_format($product['qty'] * $product['product_price'], 2); ?>
                            </td>
                        </tr>
                    <?php
                        }
                    }  ?>
                    </tbody>


            </table>
        </div>

				<!-- Totals -->
				<?php
		$subtotal = 0;

		// JSON decode
		$products = json_decode($invoice_order->order_details, true);

		if (!empty($products)) {
			foreach ($products as $product) {
				$subtotal += $product['qty'] * $product['product_price'];
			}
		}

		// Total = Subtotal (no tax)
		$total = $subtotal;
		?>

		<div class="row justify-content-end">
			<div class="col-md-4">
				<table class="table">
					<tr>
						<th>Total</th>
						<td class="text-end fw-bold"><?= currency().number_format($total, 2); ?></td>
					</tr>
				</table>
			</div>
		</div>

        <!-- Footer -->
        <div class="text-center mt-4">
            <p class="text-muted">Thank you for your business</p>
        </div>
    </div>

    <!-- Download Button -->
    <div class="text-center mt-4">
        <button class="btn btn-primary" onclick="downloadPDF()">Download PDF</button>
    </div>
</div>

<script>
    
function downloadPDF() {
    const element = document.getElementById('invoice');

    const options = {
        margin: [10, 10, 10, 10], // top, left, bottom, right (mm)
        filename: 'invoice.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: {
            scale: 3,
            useCORS: true,
            scrollY: 0
        },
        jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'portrait'
        }
    };

    html2pdf()
        .set(options)
        .from(element)
        .save();
}
</script>


</body>
</html>
