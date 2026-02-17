<!-- breadcrumbs-area-start -->

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
                    <h2>My Account</h2>
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
                                    <div class="tab-pane fade show active" id="orders" role="tabpanel">

                                        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

                                        <div class="card shadow-sm p-3">

                                            <!-- Wallet Balance -->
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-wallet2 fs-2 text-primary me-2"></i>
                                                <div>
                                                    <small class="text-muted">Wallet Balance</small>
                                                    <h5 class="mb-0">$ <span id="walletAmount"><?php echo (!empty($wallet) && isset($wallet->amount)) ? $wallet->amount : 0;?></span></h5>
                                                </div>
                                            </div>

                                            <!-- Add Money Form -->
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="addAmount" placeholder="Enter Amount" min="1" step="1">
                                            </div>

                                            <button type="button" class="btn btn-primary w-100" id="addMoneyBtn">
                                                <i class="bi bi-plus-circle"></i> Add Money (PayPal)
                                            </button>

                                            <div class="mt-3" id="paypal-button-container" style="display:none;"></div>

                                            <small class="text-muted d-block mt-2">
                                                Payment will be processed by PayPal and wallet will be credited after successful capture.
                                            </small>

                                        </div>

                                        <!-- ✅ Wallet Topup History -->
                                        <div class="card shadow-sm p-3 mt-4">
                                            <h5 class="mb-3">Wallet Topup History</h5>

                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover align-middle">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Payment ID</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($wallet_topups)): $i = 1; foreach ($wallet_topups as $t): ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><span class="badge bg-info"><?= !empty($t->paypal_capture_id) ? $t->paypal_capture_id : $t->paypal_order_id; ?></span></td>
                                                                <td><b><?= currency(); ?><?= number_format((float)$t->amount, 2); ?></b> <small class="text-muted"><?= htmlspecialchars($t->currency ?? 'USD'); ?></small></td>
                                                                <td>
                                                                    <?php
                                                                        $st = strtoupper($t->payment_status ?? '');
                                                                        $cls = ($st === 'SUCCESS' || $st === 'COMPLETED') ? 'bg-success' : 'bg-secondary';
                                                                    ?>
                                                                    <span class="badge <?= $cls; ?>"><?= htmlspecialchars($t->payment_status ?? '--'); ?></span>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        $dt = $t->payment_time ?: $t->created_at;
                                                                        echo $dt ? date('d M Y h:i A', strtotime($dt)) : '--';
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-sm btn-primary viewTopup"
                                                                        data-topup='<?= htmlspecialchars(json_encode($t), ENT_QUOTES, 'UTF-8'); ?>'>
                                                                        View
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; else: ?>
                                                            <tr>
                                                                <td colspan="6" class="text-center text-danger">No wallet topups found</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- ✅ Topup Details Modal -->
                                        <div class="modal fade" id="topupModal" tabindex="-1">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content shadow">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Wallet Topup Details</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <p><b>Payer:</b> <span id="t_payer_name"></span></p>
                                                                <p><b>Email:</b> <span id="t_payer_email"></span></p>
                                                                <p><b>Country:</b> <span id="t_payer_country"></span></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><b>PayPal Order ID:</b> <span id="t_order_id"></span></p>
                                                                <p><b>Capture ID:</b> <span id="t_capture_id"></span></p>
                                                                <p><b>Date:</b> <span id="t_date"></span></p>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <div class="alert alert-success">
                                                                    <b>Amount:</b><br>
                                                                    <?= currency(); ?><span id="t_amount"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="alert alert-warning">
                                                                    <b>PayPal Fee:</b><br>
                                                                    <?= currency(); ?><span id="t_fee"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="alert alert-info">
                                                                    <b>Net Amount:</b><br>
                                                                    <?= currency(); ?><span id="t_net"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><b>Status:</b> <span id="t_status"></span></p>
                                                                <p><b>Currency:</b> <span id="t_currency"></span></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><b>Topup ID (DB):</b> <span id="t_id"></span></p>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <h6>Raw PayPal Response</h6>
                                                        <pre id="t_raw" style="max-height:250px; overflow:auto; background:#f8f9fa; padding:10px;"></pre>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->

<!-- PayPal SDK (client-id should come from config ideally) -->
<script src="https://www.paypal.com/sdk/js?client-id=Aa91_WNVYuVT8JDjxCpCKLWv0eJSIbVimPTVqG3GnwzdPiQ-2PX8VqfvPwyADCZ1VB6J6eFsWmMmVZRB&currency=USD"></script>

<?php if ($this->session->flashdata('payment_success')):
    $pay = $this->session->flashdata('payment_success'); ?>

<div class="modal fade" id="paymentSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header text-white" style="background:linear-gradient(45deg,#28a745,#20c997)">
                <h5 class="modal-title">
                    <i class="fa fa-check-circle"></i> Payment Successful
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">

                <div class="mb-3">
                    <i class="fa fa-check-circle text-success" style="font-size:60px;"></i>
                </div>

                <h4 class="text-success mb-2">Wallet Credited Successfully!</h4>
                <p class="text-muted">Your payment has been received and wallet has been updated.</p>

                <hr>

                <div class="row text-left">
                    <div class="col-6"><b>Order ID</b></div>
                    <div class="col-6 text-end" id="ps_order_id"><?= $pay['order_id']; ?></div>

                    <div class="col-6"><b>Payment ID</b></div>
                    <div class="col-6 text-end text-primary" id="ps_payment_id"><?= $pay['payment_id']; ?></div>

                    <div class="col-6"><b>Amount Paid</b></div>
                    <div class="col-6 text-end text-success" id="ps_amount"><?= currency() . $pay['amount']; ?></div>

                    <div class="col-6"><b>Date & Time</b></div>
                    <div class="col-6 text-end" id="ps_paid_at"><?= $pay['paid_at']; ?></div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function() {
        try {
            var el = document.getElementById('paymentSuccessModal');
            if (el && window.bootstrap) {
                new bootstrap.Modal(el).show();
            }
        } catch (e) {}
    });
</script>

<?php endif; ?>

<script>
(function() {
    const addBtn = document.getElementById('addMoneyBtn');
    const amountInput = document.getElementById('addAmount');
    const walletAmountEl = document.getElementById('walletAmount');
    const paypalContainer = document.getElementById('paypal-button-container');

    function getAmount() {
        const val = parseFloat(amountInput.value);
        if (!val || val <= 0) return null;
        return val.toFixed(2);
    }

    function setLoading(isLoading) {
        addBtn.disabled = isLoading;
        addBtn.innerText = isLoading ? 'Please wait...' : 'Add Money (PayPal)';
    }

    function resetPaypalUI() {
        // remove/hide PayPal buttons after completion/cancel so they don't stay on screen
        try {
            paypalContainer.innerHTML = '';
        } catch (e) {}
        paypalContainer.style.display = 'none';
        setLoading(false);
    }

    function renderButtons() {
        // Always re-render for each new topup so UI stays clean and amount can change.
        paypalContainer.innerHTML = '';

        paypal.Buttons({
            createOrder: function() {
                const amount = getAmount();
                if (!amount) {
                    alert('Enter valid amount');
                    return;
                }

                setLoading(true);
                return fetch("<?= base_url('web/paypal_wallet_create_order'); ?>", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ amount: amount, currency: 'USD' })
                })
                .then(res => res.json())
                .then(data => {
                    setLoading(false);
                    if (!data || !data.id) {
                        throw new Error('PayPal order create failed');
                    }
                    return data.id;
                })
                .catch(err => {
                    setLoading(false);
                    console.error(err);
                    alert(err.message || 'PayPal create order error');
                });
            },

            onApprove: function(data) {
                setLoading(true);
                return fetch("<?= base_url('web/paypal_wallet_capture_order/'); ?>" + data.orderID, {
                    method: 'POST'
                })
                .then(res => res.json())
                .then(resp => {
                    if (!resp || resp.status !== true) {
                        throw new Error((resp && resp.message) ? resp.message : 'Capture failed');
                    }

                    // Update wallet amount from server
                    if (resp.balance !== undefined && resp.balance !== null) {
                        walletAmountEl.innerText = parseFloat(resp.balance).toFixed(2);
                    }

                    amountInput.value = '';
                    showSuccessModal({
                        order_id: resp.order_id,
                        payment_id: resp.payment_id,
                        amount: resp.amount,
                        paid_at: resp.paid_at
                    });

                    // ✅ Remove the PayPal buttons after success
                    resetPaypalUI();
                })
                .catch(err => {
                    setLoading(false);
                    console.error(err);
                    alert(err.message || 'PayPal capture error');
                });
            },

            onCancel: function(data) {
                // Store cancelled attempt
                try {
                    const amount = getAmount();
                    fetch("<?= base_url('web/paypal_wallet_cancel'); ?>", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            orderID: data && data.orderID ? data.orderID : null,
                            amount: amount,
                            currency: 'USD',
                            reason: 'USER_CANCELLED'
                        })
                    }).catch(() => {});
                } catch (e) {}

                alert('Payment cancelled');
                resetPaypalUI();
            },

            onError: function(err) {
                // Store failed attempt (optional but useful)
                try {
                    const amount = getAmount();
                    fetch("<?= base_url('web/paypal_wallet_cancel'); ?>", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            orderID: null,
                            amount: amount,
                            currency: 'USD',
                            reason: (err && err.message) ? err.message : 'PAYPAL_ERROR'
                        })
                    }).catch(() => {});
                } catch (e) {}

                console.error(err);
                alert('Payment error');
                resetPaypalUI();
            }
        }).render('#paypal-button-container');
    }

    function showSuccessModal(details) {
        try {
            var el = document.getElementById('paymentSuccessModal');

            // If modal markup not present (no flashdata), create a minimal one dynamically.
            if (!el) {
                var wrap = document.createElement('div');
                wrap.innerHTML = `
<div class="modal fade" id="paymentSuccessModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">
      <div class="modal-header text-white" style="background:linear-gradient(45deg,#28a745,#20c997)">
        <h5 class="modal-title"><i class="fa fa-check-circle"></i> Payment Successful</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <div class="mb-3"><i class="fa fa-check-circle text-success" style="font-size:60px;"></i></div>
        <h4 class="text-success mb-2">Wallet Credited Successfully!</h4>
        <p class="text-muted">Your payment has been received and wallet has been updated.</p>
        <hr>
        <div class="row text-left">
          <div class="col-6"><b>Order ID</b></div>
          <div class="col-6 text-end" id="ps_order_id"></div>
          <div class="col-6"><b>Payment ID</b></div>
          <div class="col-6 text-end text-primary" id="ps_payment_id"></div>
          <div class="col-6"><b>Amount Paid</b></div>
          <div class="col-6 text-end text-success" id="ps_amount"></div>
          <div class="col-6"><b>Date & Time</b></div>
          <div class="col-6 text-end" id="ps_paid_at"></div>
        </div>
      </div>
    </div>
  </div>
</div>`;
                document.body.appendChild(wrap.firstElementChild);
                el = document.getElementById('paymentSuccessModal');
            }

            if (details) {
                const orderId = details.order_id || 'WALLET_TOPUP';
                const paymentId = details.payment_id || '';
                const amount = details.amount || '';
                const paidAt = details.paid_at || '';

                const o = document.getElementById('ps_order_id');
                const p = document.getElementById('ps_payment_id');
                const a = document.getElementById('ps_amount');
                const t = document.getElementById('ps_paid_at');

                if (o) o.innerText = orderId;
                if (p) p.innerText = paymentId;
                if (a) a.innerText = amount;
                if (t) t.innerText = paidAt;
            }

            if (window.bootstrap && el) {
                new bootstrap.Modal(el).show();
            }
        } catch (e) {
            // fallback
        }
    }

    addBtn.addEventListener('click', function() {
        const amount = getAmount();
        if (!amount) {
            alert('Enter valid amount');
            return;
        }

        paypalContainer.style.display = 'block';
        renderButtons();
    });
})();
</script>

<script>
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('viewTopup')) {
        let t = JSON.parse(e.target.getAttribute('data-topup'));

        document.getElementById('t_id').innerText = t.id ?? '';
        document.getElementById('t_payer_name').innerText = t.payer_name ?? '--';
        document.getElementById('t_payer_email').innerText = t.payer_email ?? '--';
        document.getElementById('t_payer_country').innerText = t.payer_country ?? '--';

        document.getElementById('t_order_id').innerText = t.paypal_order_id ?? '--';
        document.getElementById('t_capture_id').innerText = t.paypal_capture_id ?? '--';

        const d = (t.payment_time || t.created_at);
        document.getElementById('t_date').innerText = d ? d : '--';

        document.getElementById('t_amount').innerText = t.amount ?? '0.00';
        document.getElementById('t_fee').innerText = t.paypal_fee ?? '0.00';
        document.getElementById('t_net').innerText = t.net_amount ?? '0.00';

        document.getElementById('t_status').innerText = t.payment_status ?? '--';
        document.getElementById('t_currency').innerText = t.currency ?? 'USD';

        let raw = t.paypal_response;
        try {
            if (typeof raw === 'string') {
                raw = JSON.parse(raw);
            }
        } catch (err) {}
        document.getElementById('t_raw').innerText = (typeof raw === 'object') ? JSON.stringify(raw, null, 2) : (raw ?? '');

        new bootstrap.Modal(document.getElementById('topupModal')).show();
    }
});
</script>
