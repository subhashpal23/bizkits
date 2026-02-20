<!-- breadcrumbs-area-start -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<?php
  // Messages page tabs: compose, inbox, sent
  $activeTab = $this->input->get('tab') ?: 'compose';
  if (!in_array($activeTab, ['compose','inbox','sent'], true)) {
    $activeTab = 'compose';
  }
?>

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

                                <div class="myaccount-content">
                                    <h5>Messages</h5>
									<?php 
                                              if(!empty($this->session->flashdata('flash_msg')))
                                              {
                                            ?>
                                            <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                                                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                                                <?php echo $this->session->flashdata('flash_msg');?>
                                            </div>
                                            <?php } ?>
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?= ($activeTab==='compose')?'active':'';?>" id="tab-compose" data-bs-toggle="tab" data-bs-target="#pane-compose" type="button" role="tab">Compose</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?= ($activeTab==='inbox')?'active':'';?>" id="tab-inbox" data-bs-toggle="tab" data-bs-target="#pane-inbox" type="button" role="tab">Inbox</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?= ($activeTab==='sent')?'active':'';?>" id="tab-sent" data-bs-toggle="tab" data-bs-target="#pane-sent" type="button" role="tab">Sent</button>
                                        </li>
                                    </ul>


                                    <div class="tab-content">

                                        <!-- Compose -->
                                        <div class="tab-pane fade <?= ($activeTab==='compose')?'show active':'';?>" id="pane-compose" role="tabpanel">
                                           

                                            <div class="card card-flat">
                                                <?php 
                                                    echo form_open(ci_site_url()."Web/composeMessage",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
                                                ?>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label class="col-lg-3 control-label">Users:</label>
                                                                <div class="col-lg-9">
                                                                    <select name="users[]" id="users" multiple="multiple" data-placeholder="Select Users" class="form-select">
                                                                        <optgroup label="Users">
                                                                            <?php 
                                                                                if(!empty($all_active_members) && count($all_active_members)>0)
                                                                                {
                                                                                    foreach($all_active_members as $member)
                                                                                    {
                                                                                        if($member->user_id!=COMP_USER_ID)
                                                                                        {
                                                                            ?>
                                                                            <option value="<?php echo $member->user_id;?>"><?php echo $member->username.' ('.$member->first_name.' '.$member->last_name.')'  ;?></option>
                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </optgroup>
                                                                    </select>
                                                                    <span class="valid_users" style="color:red;font-weight:bold"></style>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label class="col-lg-3 control-label">Subject:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject Here">
                                                                    <span class="valid_subject" style="color:red;font-weight:bold"></style>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label class="col-lg-3 control-label">Message:</label>
                                                                <div class="col-lg-9">
                                                                    <textarea name="message" id="message" class="col-lg-3 form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label class="col-lg-3 control-label">Attach File:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="file" name="attachment" id="attachment" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="text-right mt-3">
                                                                <button type="submit" name="btn" id="btn" value="send" class="btn btn-primary">Send<i class="icon-arrow-right14 position-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo form_close();?>
                                            </div>
                                        </div>

                                        <!-- Inbox -->
                                        <div class="tab-pane fade <?= ($activeTab==='inbox')?'show active':'';?>" id="pane-inbox" role="tabpanel">
                                            <div class="row">
                                                <div class="panel panel-flat">
                                                   

                                                    <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Message Id</th>
                     <th>Date </th>
                     <th>Subject</th>
                     <th>Sender</th>
                     <th>Attachment</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_inbox_msg) && count($all_inbox_msg)>0)
                  {
                    $sno=0;
                    foreach ($all_inbox_msg as $msg) 
                    {
                        $sno++;
                  ?>
                    <tr>
                       <td><?php echo $sno;?></td>
                       <td><?php echo $msg->message_id;?></td>
                       <td><?php echo date(date_formats(),strtotime($msg->ts));?></td>
                       <td><?php echo $msg->subject;?></td>
                       <td><?php echo $msg->sender_name;?></td>
                        <td>
                           <?php
                           if(!empty($msg->attachment))
                           {
                           ?>
                           <a href="<?php echo ci_site_url();?>uploads/images/<?php echo $msg->attachment;?>" target="_blank">View Attachment</a>
                           <?php    
                           } 
                           else 
                           {
                           ?>
                           ---
                           <?php    
                           }
                           ?>
                        </td>
                       <td>
                          <ul class="icons-list">
                             <li>
                                <a href="#" msg-id="<?php echo ID_encode($msg->id);?>" class="read_msg" data-popup="tooltip" title="" data-original-title="Read Message" data-toggle="modal" data-target="#modal_form_vertical"><i class="icon-eye"></i></a>
                             </li>
                             <li>
                                <a onclick="return deleteConfirm();" href="<?php echo ci_site_url();?>Web/deleteInboxMessage/<?php echo ID_encode($msg->id);?>" data-popup="tooltip" title="" data-original-title="Close Ticket"><i class="icon-trash"></i></a>
                             </li>
                          </ul>
                       </td>
                    </tr>
                  <?php     
                    }
                  }
                  ?>
               </tbody>
            </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sent -->
                                        <div class="tab-pane fade <?= ($activeTab==='sent')?'show active':'';?>" id="pane-sent" role="tabpanel">
										<table class="table table-striped table-bordered align-middle mb-0">
               <thead class="table-light">
                  <tr>
                     <th style="width:70px">Sr.No</th>
                     <th style="width:140px">Date</th>
                     <th>Subject</th>
                     <th style="width:180px">Sent To</th>
                     <th style="width:160px">Attachment</th>
                     <th style="width:110px">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  //pr($all_sent_msg);
                  if(!empty($all_sent_msg) && count($all_sent_msg)>0)
                  {
                     $sno=0;
                     foreach ($all_sent_msg as $msg) 
                     {
                        $sno++;
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo date(date_formats(),strtotime($msg->ts));?></td>
                        <td><?php echo $msg->subject;?></td>
                        <td><?php echo $msg->receiver_name;?></td>
                        <td>
                           <?php
                           if(!empty($msg->attachment))
                           {
                           ?>
                           <a class="btn btn-sm btn-outline-primary" href="<?php echo ci_site_url();?>uploads/images/<?php echo $msg->attachment;?>" target="_blank" rel="noopener">View</a>
                           <?php    
                           } 
                           else 
                           {
                           ?>
                           <span class="text-muted">---</span>
                           <?php    
                           }
                           ?>
                        </td>
                        <td>
                           <div class="d-flex gap-2">
                              <button 
                                 type="button"
                                 class="btn btn-sm btn-outline-success read_msg"
                                 data-msg-id="<?php echo ID_encode($msg->id);?>"
                                 data-bs-toggle="modal"
                                 data-bs-target="#modal_form_vertical"
                                 title="View">
                                 <i class="fa fa-eye"></i>
                              </button>

                              <a class="btn btn-sm btn-outline-danger js-confirm-delete" data-confirm="Are you sure you want to delete this message?" href="<?php echo ci_site_url();?>Web/deleteSentMessage/<?php echo ID_encode($msg->id);?>" title="Delete">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </td>
                     </tr>                  
                  <?php       
                     }
                  }
                  else
                  {
                  ?>
                     <tr>
                        <td colspan="6" class="text-center text-muted">No sent messages found.</td>
                     </tr>
                  <?php
                  }
                  ?>
               </tbody>
            </table>
                                        </div>

                                    </div> <!-- tab-content -->

                                </div> <!-- myaccount-content -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reuse existing modal for reading message -->
<div id="modal_form_vertical" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="msg_subject"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="msg" class="text-break"></div>
            </div>
        </div>
    </div>
</div>

<style>
.control-label{
  font-weight: 700;
}
/* keep Select2 height similar to Bootstrap input */
.select2-container--default .select2-selection--multiple{
  min-height: calc(1.5em + .75rem + 2px);
  border: 1px solid #ced4da;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered{
  padding: .375rem .75rem;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
  margin-top: .25rem;
}
</style>
<div class="modal fade" id="requestModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Request Meeting</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="addEventForm">
                    <!-- <input type="hidden1" id="expert_id" value=""> -->
                    <select id="expert_id" class="form-control mb-2">
                        <option value="">-- Select Expert --</option>
                        <?php foreach ($experts as $e) { ?>
                        <option value="<?= $e->user_id ?>">
                            <?= $e->first_name ?> <?= $e->last_name ?> - 
                            <?= $e->email ?>
                        </option>
                        <?php } ?>
                    </select>
                    <!-- <input type="text" id="expert_id_name" readonly="" class="form-control mb-2"> -->
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

<!-- Select2 (must be after jQuery) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- my account wrapper end -->
<script>
    $(document).ready(function(){

      // confirm delete
      $(document).on('click', '.js-confirm-delete', function(e){
        var msg = $(this).data('confirm') || 'Are you sure you want to delete?';
        if(!confirm(msg)) {
          e.preventDefault();
          return false;
        }
      });

      // delegated handler so it works even if table is re-rendered
      $(document).on('click', '.read_msg', function(){
        var msg_id = $(this).data('msg-id');

        // reset modal content while loading
        $('#msg_subject').text('Loading...');
        $('#msg').html('<div class="text-muted">Please wait...</div>');

        $.ajax({
          url: "<?php echo ci_site_url();?>Web/readMessage/",
          type: "POST",
          dataType: "json",
          data: { msg_id: msg_id },
          success: function (res) {
            // support both {subject,message} and {status,data:{...}} formats
            var subject = res?.subject ?? res?.data?.subject ?? '';
            var message = res?.message ?? res?.data?.message ?? '';

            $('#msg_subject').text(subject ? ('Subject: ' + subject) : 'Message');
            $('#msg').html(message ? ('<h6 class="mb-2">Message</h6><div>' + message + '</div>') : '<div class="text-muted">No message content.</div>');
          },
          error: function() {
            $('#msg_subject').text('Error');
            $('#msg').html('<div class="text-danger">Unable to load message. Please try again.</div>');
          }
        });
      });

      // Select2 for users (search enabled)
      if ($.fn.select2) {
        $('#users').select2({
          placeholder: $('#users').data('placeholder') || 'Select Users',
          width: '100%',
          closeOnSelect: false,
          allowClear: true
        });
      }

    });//end ready

    // backward compatible (if any old onclick exists somewhere)
    function deleteConfirm(){
      return confirm('Are you sure you want to delete this message?');
    }

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
function openRequestModal(v,n) {
    $('#addEventForm')[0].reset();
    $('#requestModal').modal('show');
    $('#expert_id').val(v);
    //$('#expert_id_name').val(n);
    //document.getElementById('expert_id').value = v;
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
                window.location.href='sessions';
                // ✅ Calendar auto refresh
                customerCalendar.refetchEvents();
            }
        }
    });
}
</script>

<!-- Simple About Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">About <span id="expertName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img src="" id="expertImage" style="width:100px; height: 100px; border-radius: 100%">
                <p id="expertEmail"></p>
                <p id="expertAddress"></p>
                
                <p id="expertAbout"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var aboutModal = document.getElementById('aboutModal');
    
    aboutModal.addEventListener('shown.bs.modal', function(event) {
        var button = event.relatedTarget;
        
        var name = button.getAttribute('data-name');
        var email = button.getAttribute('data-email');
        var address = button.getAttribute('data-address');
        var about = button.getAttribute('data-about');
        var image = button.getAttribute('data-image');
        //alert(name+about)
        document.getElementById('expertName').textContent = "Name:"+name;
        document.getElementById('expertEmail').textContent = "Email:"+email;
        document.getElementById('expertAddress').textContent = "Address:"+address;
        document.getElementById('expertAbout').textContent = about;
        document.getElementById('expertImage').src = image;
    });
});
</script>

<script>
  // keep tab in URL (optional) so refresh maintains selection
  document.addEventListener('shown.bs.tab', function(event) {
    var btn = event.target;
    if (!btn || !btn.id) return;
    var tab = 'compose';
    if (btn.id === 'tab-inbox') tab = 'inbox';
    if (btn.id === 'tab-sent') tab = 'sent';

    var url = new URL(window.location.href);
    url.searchParams.set('tab', tab);
    window.history.replaceState({}, '', url.toString());
  });
</script>