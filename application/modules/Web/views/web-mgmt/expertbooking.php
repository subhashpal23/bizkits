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
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->

                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <?php echo $this->load->view('leftmenu');?>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                   

                                   
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade  show active" id="expert_booking" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Connect With Expert</h5>
                                            
                                            <div class="row">
                                                <?php if($totalcalls){?>
                                                <div class="col-md-9">
                                                    <div id="customerCalendar"></div>
                                                </div>

                                                <div class="col-md-3 card">
                                                    <h5 id="title">Select Date</h5>
                                                    <h6 id="date"></h6>
                                                    <div id="desc"></div>
                                                </div>

                                                <!-- <div id="customerCalendar"></div> -->
                                                <button class="btn btn-primary mt-2" onclick="openRequestModal()">
                                                    Add Request
                                                </button>
                                                <?php
                                                }
                                                else
                                                {
                                                    echo "<p style='color:red'>You dont have any sessions count. Please purchase sessions.</p>";
                                                }
                                                ?>
                                                <!-- <div class="col-md-9 card">
                                                    <div id="calendar_customer" class="card-body"></div>
                                                    </div> -->
                                                <!-- <div class="col-md-3 card">
                                                    <div id="infoBoxExpert" class="mt-2">

                                                    <h3 id="titleExpert">Select Date</h3>
                                                    <h5 id="dateExpert"></h5>
                                                    <p id="descExpert"></p>
                                                    </div>
                                                    </div> -->
                                            </div>

                                        </div>
                                    </div>



                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="download" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Downloads</h5>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Date</th>
                                                            <th>Expire</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Haven - Free Real Estate PSD Template</td>
                                                            <td>Aug 22, 2018</td>
                                                            <td>Yes</td>
                                                            <td><a href="#" class="btn btn-sqr"><i
                                                                        class="fa fa-cloud-download"></i>
                                                                    Download File</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>HasTech - Profolio Business Template</td>
                                                            <td>Sep 12, 2018</td>
                                                            <td>Never</td>
                                                            <td><a href="#" class="btn btn-sqr"><i
                                                                        class="fa fa-cloud-download"></i>
                                                                    Download File</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Payment Method</h5>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="payment" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5 class="mb-3">💳 Payment Details</h5>

                                            <table class="table table-bordered table-hover align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Order ID</th>
                                                        <th>Amount</th>
                                                        <th>Payment ID</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php if(!empty($payments)): $i=1; foreach($payments as $p): ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><span class="badge bg-info"><?= $p->order_id ?></span></td>
                                                        <td><b>$<?= number_format($p->amount,2) ?></b></td>
                                                        <td><?= $p->paypal_capture_id ?></td>
                                                        <td>
                                                            <span
                                                                class="badge bg-success"><?= $p->payment_status ?></span>
                                                        </td>
                                                        <td><?= date('d M Y h:i A', strtotime($p->payment_time)) ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-primary viewPayment"
                                                                data-order='<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8'); ?>'>
                                                                View
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; else: ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center text-danger">No Payments
                                                            Found</td>
                                                    </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                            <div class="modal fade" id="paymentModal" tabindex="-1">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content shadow">

                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Payment & Order Details</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <p><b>Customer:</b> <span id="m_name"></span></p>
                                                                    <p><b>Email:</b> <span id="m_email"></span></p>
                                                                    <p><b>Country:</b> <span id="m_country"></span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><b>Order ID:</b> <span id="m_orderid"></span></p>
                                                                    <p><b>Payment ID:</b> <span id="m_paymentid"></span>
                                                                    </p>
                                                                    <p><b>Date:</b> <span id="m_date"></span></p>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <div class="alert alert-success">
                                                                        <b>Total Amount:</b><br>
                                                                        $<span id="m_amount"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="alert alert-warning">
                                                                        <b>PayPal Fee:</b><br>
                                                                        $<span id="m_fee"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="alert alert-info">
                                                                        <b>Net Amount:</b><br>
                                                                        $<span id="m_net"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <h6 class="mt-3">🛒 Products</h6>
                                                            <ul id="m_products" class="list-group"></ul>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="google_meet" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Google Meet</h5>

                                            <!-- <a href="<?php echo base_url('webgooglemeet'); ?>"
                                                class="btn btn-sqr">Create Meeting</a> -->
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Date</th>
                                                    <th>Title</th>
                                                    <th>Meet Link</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>

                                                <?php foreach($requests as $r): ?>
                                                <tr>
                                                    <td><?= $r->customer_name ?></td>
                                                    <td><?= $r->requested_date ?></td>
                                                    <td><?= $r->title ?></td>
                                                    <td><a href="<?= $r->meet_link ?>"
                                                            target="_blank"><?= $r->meet_link ?></a></td>
                                                    <td><?= ucfirst($r->status) ?></td>
                                                    <td>
                                                        <?php if($r->status == 'pending'): ?>
                                                        <a href="<?= site_url('webgooglemeet/createMeeting/'.$r->id) ?>"
                                                            class="btn btn-success btn-sm">
                                                            Approve
                                                        </a>

                                                        <a href="<?= site_url('meeting/reject/'.$r->id) ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to reject this meeting?')">
                                                            Reject
                                                        </a>
                                                        <?php else: ?>
                                                        ---
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </table>

                                            <!-- <div class="row">
                                                <div class="col-md-9 card">
                                                    <div id="calendar" class="card-body"></div>
                                                </div>
                                                <div class="col-md-3 card">
                                                    <button id="addEventBtn" class="btn btn-primary">➕ Add
                                                        Event</button>

                                                    <div id="infoBox" class="mt-2">

                                                        <h3 id="title">Select Date</h3>
                                                        <h5 id="date"></h5>
                                                        <p id="desc"></p>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="modal fade" id="addEventModal" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Add Event</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <input type="hidden" id="event_id">

                                                            <input type="hidden"
                                                                value="<?php echo $_SESSION['user_id']; ?>"
                                                                id="add_user_id" class="form-control">

                                                            <div class="mb-2">
                                                                <label>Title</label>
                                                                <input type="text" id="add_title" class="form-control"
                                                                    required>
                                                            </div>

                                                            <div class="mb-2">
                                                                <label>Description</label>
                                                                <textarea id="add_description" class="form-control"
                                                                    required></textarea>
                                                            </div>

                                                            <div class="mb-2">
                                                                <label>Date</label>
                                                                <input type="date" id="add_date" class="form-control"
                                                                    required>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-success"
                                                                    id="saveAddEvent">Submit</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Billing Address</h5>
                                            <address>
                                                <p><strong>Erik Jhonson</strong></p>
                                                <p>1355 Market St, Suite 900 <br>
                                                    San Francisco, CA 94103</p>
                                                <p>Mobile: (123) 456-7890</p>
                                            </address>
                                            <a href="#" id="editAddressBtn" class="btn btn-sqr"><i
                                                    class="fa fa-edit"></i>
                                                Edit Address</a>
                                            <div class="user_address" style="display:none;margin-top: 20px;">
                                                <div class="myaccount-content">
                                                    <h5>Address Details</h5>
                                                    <div class="account-details-form">
                                                        <form id="addressForm">
                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo $_SESSION['user_id']; ?>">

                                                            <div class="single-input-item">
                                                                <label>Address Line 1</label>
                                                                <input type="text" name="address_line1"
                                                                    value="<?php echo $user->address_line1; ?>"
                                                                    placeholder="Address Line 1">
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label>Address Line 2</label>
                                                                <input type="text" name="address_line2"
                                                                    value="<?php echo $user->address_line2; ?>"
                                                                    placeholder="Address Line 2">
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label>Country</label>
                                                                <input type="text" name="country"
                                                                    value="<?php echo $user->country; ?>"
                                                                    placeholder="Country">
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label>State</label>
                                                                <input type="text" name="state"
                                                                    value="<?php echo $user->state; ?>"
                                                                    placeholder="State">
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label>City</label>
                                                                <input type="text" name="city"
                                                                    value="<?php echo $user->city; ?>"
                                                                    placeholder="City">
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label>ZIP Code</label>
                                                                <input type="text" name="zip_code"
                                                                    value="<?php echo $user->zip_code; ?>"
                                                                    placeholder="ZIP Code">
                                                            </div>

                                                            <div class="single-input-item">
                                                                <button type="submit" class="btn btn-sqr">Update
                                                                    Address</button>
                                                            </div>
                                                            <div id="formMsgA" style="margin-top:10px;"></div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Account Details</h5>
                                            <div class="account-details-form">
                                                <form id="userFormdetail">
                                                    <input type="hidden" name="user_id"
                                                        value="<?php echo $_SESSION['user_id']; ?>">
                                                    <!-- existing user id -->

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first-name" class="required">First
                                                                    Name</label>
                                                                <input type="text" id="first-name" name="first_name"
                                                                    value="<?php echo $user->first_name; ?>"
                                                                    placeholder="First Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="last-name" class="required">Last
                                                                    Name</label>
                                                                <input type="text" id="last-name" name="last_name"
                                                                    value="<?php echo $user->last_name; ?>"
                                                                    placeholder="Last Name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="contact_no" class="required">Phone
                                                            Number</label>
                                                        <input type="text" id="contact_no" name="contact_no"
                                                            value="<?php echo $user->contact_no; ?>"
                                                            placeholder="Phone Number" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email
                                                            Addres</label>
                                                        <input type="email" id="email" name="email"
                                                            value="<?php echo $user->email; ?>"
                                                            placeholder="Email Address" />
                                                    </div>
                                                    <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item">
                                                            <label for="current_password" class="required">Current
                                                                Password</label>
                                                            <input type="password" id="current_password"
                                                                name="current_password"
                                                                placeholder="Current Password" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">New
                                                                        Password</label>
                                                                    <input type="password" id="new-pwd"
                                                                        name="new_password"
                                                                        placeholder="New Password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Confirm
                                                                        Password</label>
                                                                    <input type="password" name="confirm_password"
                                                                        id="confirm-pwd"
                                                                        placeholder="Confirm Password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button type="submit" class="btn btn-sqr">Save
                                                            Changes</button>
                                                    </div>
                                                    <div id="formMsg" style="margin-top:10px;"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="requestModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Request Meeting</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="addEventForm">
                    <select id="expert_id" class="form-control mb-2">
                        <option value="">-- Select Expert --</option>
                        <?php foreach ($experts as $e) { ?>
                        <option value="<?= $e->user_id ?>">
                            <?= $e->first_name ?> <?= $e->last_name ?> -
                            <?= $e->email ?>
                        </option>
                        <?php } ?>
                    </select>

                    <input type="text" id="req_title" class="form-control mb-2" placeholder="Meeting Title">

                    <input type="date" id="req_date" class="form-control mb-2">

                    <textarea id="req_message" class="form-control" placeholder="Message for expert"></textarea>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" onclick="sendRequest()">
                    Send Request
                </button>
            </div>

        </div>
    </div>
</div>
<?php if ($this->session->flashdata('payment_success')):
$pay = $this->session->flashdata('payment_success'); ?>

<div class="modal fade" id="paymentSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <!-- HEADER -->
            <div class="modal-header text-white" style="background:linear-gradient(45deg,#28a745,#20c997)">
                <h5 class="modal-title">
                    <i class="fa fa-check-circle"></i> Payment Successful
                </h5>
            </div>

            <!-- BODY -->
            <div class="modal-body text-center">

                <div class="mb-3">
                    <i class="fa fa-check-circle text-success" style="font-size:60px;"></i>
                </div>

                <h4 class="text-success mb-2">Thank You for Your Order!</h4>
                <p class="text-muted">Your payment has been received successfully.</p>

                <hr>

                <div class="row text-left">
                    <div class="col-6"><b>Order ID</b></div>
                    <div class="col-6 text-right"><?= $pay['order_id']; ?></div>

                    <div class="col-6"><b>Payment ID</b></div>
                    <div class="col-6 text-right text-primary"><?= $pay['payment_id']; ?></div>

                    <div class="col-6"><b>Amount Paid</b></div>
                    <div class="col-6 text-right text-success"><?= currency() .$pay['amount']; ?></div>

                    <div class="col-6"><b>Date & Time</b></div>
                    <div class="col-6 text-right"><?= $pay['paid_at']; ?></div>
                </div>

            </div>



        </div>
    </div>
</div>

<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- my account wrapper end -->
<script>
$(window).on('load', function() {
    <?php if ($this->session->flashdata('payment_success')) { ?>
    $('#paymentSuccessModal').modal('show');
    <?php } ?>
});
</script>
<script>
document.addEventListener('click', function(e){
    if(e.target.classList.contains('viewPayment')){

        let data = JSON.parse(e.target.getAttribute('data-order'));

        document.getElementById('m_name').innerText = data.payer_name;
        document.getElementById('m_email').innerText = data.payer_email;
        document.getElementById('m_country').innerText = data.payer_country;

        document.getElementById('m_orderid').innerText = data.order_id;
        document.getElementById('m_paymentid').innerText = data.paypal_capture_id;
        document.getElementById('m_date').innerText = data.payment_time;

        document.getElementById('m_amount').innerText = data.amount;
        document.getElementById('m_fee').innerText = data.paypal_fee;
        document.getElementById('m_net').innerText = data.net_amount;

        // Products
        let products = JSON.parse(data.order_details);
        let list = document.getElementById('m_products');
        list.innerHTML = '';

        Object.values(products).forEach(p => {
            let li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between';
            li.innerHTML = `
                <span>${p.product_name} (x${p.qty})</span>
                <b>$${p.product_price}</b>
            `;
            list.appendChild(li);
        });

        new bootstrap.Modal(document.getElementById('paymentModal')).show();
    }
});
</script>

<script>
$(document).on('click', '.viewPayment', function() {

    let name = $(this).data('name');
    let amount = $(this).data('amount');
    let paymentid = $(this).data('paymentid');

    $('#m_name').text(name);
    $('#m_amount').text(amount);
    $('#m_paymentid').text(paymentid);

    $('#paymentModal').modal('show');
});
</script>
<!-- <script>
        document.addEventListener('DOMContentLoaded', function() {

            var today = new Date();
            var todayStr = today.toISOString().split('T')[0];

            var eventsData = [{
                    title: 'Meeting',
                    start: '2026-01-10',
                    description: 'Office meeting at 10 AM'
                },
                {
                    title: 'Birthday',
                    start: '2026-01-15',
                    description: 'Neeraj Birthday Party 🎉'
                },
                {
                    title: 'Project Deadline',
                    start: '2026-01-20',
                    description: 'Final project submission'
                }
            ];

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: eventsData,

                dateClick: function(info) {
                    document.getElementById('title').innerText = 'Selected Date';
                    document.getElementById('date').innerText = info.dateStr;
                    document.getElementById('desc').innerText = 'No event selected';
                },

                eventClick: function(info) {
                    document.getElementById('title').innerText = info.event.title;
                    document.getElementById('date').innerText =
                        info.event.start.toDateString();
                    document.getElementById('desc').innerText =
                        info.event.extendedProps.description;
                }
            });

            calendar.render();

            // 🔥 TODAY AUTO SHOW LOGIC
            var todayEvent = eventsData.find(e => e.start === todayStr);

            if (todayEvent) {
                document.getElementById('title').innerText = todayEvent.title;
                document.getElementById('date').innerText = today.toDateString();
                document.getElementById('desc').innerText = todayEvent.description;
            } else {
                document.getElementById('title').innerText = 'Today';
                document.getElementById('date').innerText = today.toDateString();
                document.getElementById('desc').innerText = 'Aaj koi event nahi hai';
            }
        });
    </script> -->

<script>
document.addEventListener('DOMContentLoaded', function() {

    var addModal = new bootstrap.Modal(document.getElementById('addEventModal'));

    let allEvents = [];

    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',

        events: function(fetchInfo, successCallback) {
            fetch("<?= base_url('calendar/fetch_events') ?>")
                .then(res => res.json())
                .then(data => {
                    allEvents = data; // sab events store
                    successCallback(data); // calendar load
                });
        },


        // 📅 DATE CLICK
        dateClick: function(info) {

            let selectedDate = info.dateStr;

            let filtered = allEvents.filter(ev => ev.start === selectedDate);

            document.getElementById('date').innerText = selectedDate;

            if (filtered.length > 0) {

                document.getElementById('title').innerText = 'Events';
                let descHtml = '';

                filtered.forEach(ev => {
                    descHtml += `
                       <div class="border p-2 mb-2 rounded">
                            <b>${ev.title}</b><br>
                            ${ev.description}<br>

                            <button 
                                class="btn btn-sm btn-warning mt-1"
                                onclick="editEvent(${ev.id})">
                                Edit
                            </button>

                            <button 
                                class="btn btn-sm btn-danger mt-1"
                                onclick="deleteEvent(${ev.id})">
                                Delete
                            </button>
                        </div>
                    `;
                });

                document.getElementById('desc').innerHTML = descHtml;

            } else {

                document.getElementById('title').innerText = 'No Event';
                // document.getElementById('desc').innerText = 'Is date par koi event nahi hai';
            }
        }
    });

    calendar.render();

    // ➕ OPEN ADD MODAL
    $('#addEventBtn').click(function() {
        $('#saveAddEvent').text('Submit');

        $('#add_title,#add_description,#add_date,#event_id').val('');
        addModal.show();
    });

    // 💾 SAVE ADD EVENT
    $('#saveAddEvent').off('click').on('click', function() {

        let id = $('#event_id').val();
        let title = $('#add_title').val().trim();
        let description = $('#add_description').val().trim();
        let event_date = $('#add_date').val();
        let user_id = $('#add_user_id').val();

        if (title === '' || description === '' || event_date === '') {
            alert('All fields are required');
            return;
        }

        $.post("<?= base_url('calendar/save_event') ?>", {
            id: id, // 👈 empty = add | value = edit
            title: title,
            description: description,
            event_date: event_date,
            user_id: user_id
        }, function() {

            calendar.refetchEvents();
            addModal.hide();
            resetForm();

        }, 'json');
    });

    window.editEvent = function(id) {

        $.get("<?= base_url('calendar/get_event/') ?>" + id, function(res) {

            if (!res.status) {
                alert('Event not found');
                return;
            }

            let ev = res.data;

            $('#event_id').val(ev.id);
            $('#add_title').val(ev.title);
            $('#add_description').val(ev.description);
            $('#add_date').val(ev.event_date);
            $('#add_user_id').val(ev.user_id);

            $('#saveAddEvent').text('Update Event');

            addModal.show();

        }, 'json');
    }
    window.deleteEvent = function(id) {

        if (!confirm('Are you sure you want to delete this event?')) {
            return;
        }

        $.ajax({
            url: "<?= base_url('calendar/delete_event/') ?>" + id,
            type: "POST",
            dataType: "json",
            success: function(res) {

                if (res.status) {

                    calendar.refetchEvents();

                    // infoBox reset
                    $('#title').text('Select Date');
                    $('#date').text('');
                    $('#desc').html('');

                } else {
                    alert(res.msg || 'Delete failed');
                }
            }
        });
    }


    // 💾 UPDATE EVENT
    $('#saveEditEvent').click(function() {
        $.post("<?= base_url('calendar/save_event') ?>", {
            id: $('#edit_event_id').val(),
            title: $('#edit_title').val(),
            description: $('#edit_description').val(),
            event_date: $('#edit_date').val(),
            user_id: $('#edit_user_id').val()
        }, function() {
            calendar.refetchEvents();
            addModal.hide();
        });
    });

});
</script>
<!-- <script>
    let calendar_customer;
    let allEvents = [];
    let selectedDateGlobal = '';

    document.addEventListener('DOMContentLoaded', function() {

        let customerCalendar;

        document.addEventListener('DOMContentLoaded', function() {

            customerCalendar = new FullCalendar.Calendar(
                document.getElementById('customerCalendar'), {
                    initialView: 'dayGridMonth',

                    events: "<?= base_url('calendar/customer_calendar_events') ?>",

                    dateClick: function(info) {
                        $('#req_date').val(info.dateStr);
                        openAddModal();
                    }
                });

            customerCalendar.render();
        });

        calendar_customer = new FullCalendar.Calendar(
            document.getElementById('calendar_customer'), {
                initialView: 'dayGridMonth',
                selectable: true,
                editable: false,

                /* =========================
                   LOAD EVENTS
                ========================= */
                events: function(fetchInfo, successCallback) {

                    let expertId = document.getElementById('expertSelect').value;

                    if (!expertId) {
                        successCallback([]);
                        return;
                    }

                    fetch("<?= base_url('calendar/get_expert_events/') ?>" + expertId)
                        .then(res => res.json())
                        .then(data => {
                            allEvents = data;
                            successCallback(data);
                        });
                },

                /* =========================
                   EVENT COLOR & LABEL
                ========================= */
                eventDidMount: function(info) {

                    let ev = info.event.extendedProps;

                    // 🟢 My booking
                    if (ev.is_my_booking) {
                        info.el.style.backgroundColor = '#198754';
                        info.el.style.borderColor = '#198754';
                        info.el.title = 'Booked by you';
                    }
                    // 🔴 Booked by others
                    else if (ev.booked_by) {
                        info.el.style.backgroundColor = '#dc3545';
                        info.el.style.borderColor = '#dc3545';
                        info.el.title = 'Already booked';
                    }
                    // 🔵 Available
                    else {
                        info.el.style.backgroundColor = '#0d6efd';
                        info.el.style.borderColor = '#0d6efd';
                        info.el.title = 'Available';
                    }
                },

                /* =========================
                   DATE CLICK
                ========================= */
                dateClick: function(info) {
                    selectedDateGlobal = info.dateStr;
                    refreshRightPanel();
                }
            }
        );

        calendar_customer.render();

        /* =========================
           EXPERT CHANGE
        ========================= */
        document.getElementById('expertSelect').addEventListener('change', function() {
            calendar_customer.refetchEvents();
            document.getElementById('titleExpert').innerText = 'Select Date';
            document.getElementById('dateExpert').innerText = '';
            document.getElementById('descExpert').innerHTML = '';
            selectedDateGlobal = '';
        });
    });

    /* =========================
       RIGHT PANEL REFRESH
    ========================= */
    function refreshRightPanel() {

        if (!selectedDateGlobal) return;

        document.getElementById('dateExpert').innerText = selectedDateGlobal;

        let filtered = allEvents.filter(ev => ev.start === selectedDateGlobal);

        if (filtered.length > 0) {

            document.getElementById('titleExpert').innerText = 'Events';

            let descHtml = '';

            filtered.forEach(ev => {

                let desc = ev.description ? ev.description : 'No description';
                let btnHtml = '';

                if (!ev.booked_by) {

                    btnHtml = `
                    <button class="btn btn-sm btn-success mt-1"
                        onclick="bookEvent(${ev.id})">
                        Book Now
                    </button>
                `;

                } else if (ev.is_my_booking) {

                    btnHtml = `
                    <button class="btn btn-sm btn-danger mt-1"
                        onclick="cancelBooking(${ev.id})">
                        Cancel Booking
                    </button>
                `;

                } else {

                    btnHtml = `
                    <button class="btn btn-sm btn-secondary mt-1" disabled>
                        Booked
                    </button>
                `;
                }

                descHtml += `
                <div class="border p-2 mb-2 rounded">
                    <b>${ev.title}</b><br>
                    ${desc}<br>
                    ${btnHtml}
                </div>
            `;
            });

            document.getElementById('descExpert').innerHTML = descHtml;

        } else {

            document.getElementById('titleExpert').innerText = 'No Event';
            document.getElementById('descExpert').innerHTML =
                '<span class="text-muted">Is date par koi event nahi hai</span>';
        }
    }

    /* =========================
       BOOK EVENT
    ========================= */
    function bookEvent(eventId) {

        $.post("<?= base_url('calendar/book_event') ?>", {
            event_id: eventId
        }, function(res) {

            let r = JSON.parse(res);
            alert(r.msg);

            calendar_customer.refetchEvents();

            setTimeout(() => {
                refreshRightPanel();
            }, 300);
        });
    }

    /* =========================
       CANCEL BOOKING
    ========================= */
    function cancelBooking(eventId) {

        if (!confirm('Are you sure you want to cancel booking?')) return;

        $.post("<?= base_url('calendar/cancel_booking') ?>", {
            event_id: eventId
        }, function(res) {

            let r = JSON.parse(res);
            alert(r.msg);

            calendar_customer.refetchEvents();

            setTimeout(() => {
                refreshRightPanel();
            }, 300);
        });
    }
</script> -->
<script>
let customerCalendar;
let allEvents = [];

document.addEventListener('DOMContentLoaded', function() {

    customerCalendar = new FullCalendar.Calendar(
        document.getElementById('customerCalendar'), {
            initialView: 'dayGridMonth',

            events: function(fetchInfo, successCallback) {
                fetch("<?= base_url('calendar/customer_calendar_events') ?>")
                    .then(res => res.json())
                    .then(data => {
                        allEvents = data;
                        successCallback(data);
                    });
            },

            // 👉 Date click = show data (NO modal)
            dateClick: function(info) {

                let selectedDate = info.dateStr;
                $('#date').text(selectedDate);

                let filtered = allEvents.filter(ev => ev.start === selectedDate);

                if (filtered.length > 0) {

                    $('#title').text('Your Meeting');

                    let html = '';
                    filtered.forEach(ev => {
                        html += `
                        <div class="border p-2 mb-2 rounded">
                            <b>${ev.title}</b><br>
                            <small>${ev.message ?? ''}</small><br>
                            ${ev.meet_link ?? ''}
                        </div>`;
                    });

                    $('#desc').html(html);

                } else {
                    $('#title').text('No Meeting');
                    $('#desc').html(
                        '<span class="text-muted">There are no meetings scheduled for this date.</span>'
                    );
                }
            }
        }
    );

    customerCalendar.render();
});

// 👉 Add Event button se modal open
function openRequestModal() {
    $('#addEventForm')[0].reset();
    $('#requestModal').modal('show');
}

// 👉 Send meeting request
function sendRequest() {

    let expert_id = $('#expert_id').val();
    let title = $('#req_title').val();
    let date = $('#req_date').val();
    let message = $('#req_message').val();

    if (!expert_id || !title || !date) {
        alert('All fields are required');
        return;
    }

    $.ajax({
        url: "<?= base_url('meeting/send_request') ?>",
        type: "POST",
        dataType: "json",
        data: {
            expert_id: expert_id,
            title: title,
            date: date,
            message: message
        },
        success: function(res) {

            if (res.status) {
                $('#requestModal').modal('hide');
                alert(res.msg);

                // ✅ Calendar auto refresh
                customerCalendar.refetchEvents();
            }
        }
    });
}
</script>