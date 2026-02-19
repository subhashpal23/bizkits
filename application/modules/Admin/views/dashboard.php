<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Admin Dashboard</h3>
        <ul>
            <li>
                <a href="<?php echo base_url();?>">Home</a>
            </li>
            <li>Admin</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
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
                            <div class="item-title">Users</div>
                            <div class="item-number"><span class="counter"
                                    data-num="<?php echo $total_users;?>"><?php echo $total_users;?></span></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- <div class="row gutters-20 mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Calendar</h4>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="eventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Event Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3><b>Title:</b> <span id="mTitle"></span></h3>
                    <p><b>Date:</b> <span id="mDate"></span></p>
                    <p><span id="mDesc"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
    $(document).ready(function() {
        var allEvents = [];

        $('#calendar').fullCalendar({
            // Load events from backend endpoint
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: "<?= base_url('Admin/request_calendar_events_ex') ?>",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        allEvents = Array.isArray(res) ? res : [];
                        callback(allEvents);
                    },
                    error: function() {
                        allEvents = [];
                        callback([]);
                    }
                });
            },

            // Ensure custom color from API is applied
            eventRender: function(event, element) {
                if (event.color) {
                    element.css({
                        'background-color': event.color,
                        'border-color': event.color
                    });
                }
            },

            eventClick: function(event) {
                $('#mTitle').text(event.title || '');
                $('#mDate').text(event.start ? moment(event.start).format('YYYY-MM-DD') : '');

                // Full info from API
                var status = event.status ? String(event.status) : '';
                var msg = event.message ? String(event.message) : '';
				var customer_username = event.customer_username ? String(event.customer_username) : '';
				var expert_username = event.expert_username ? String(event.expert_username) : '';
                var descHtml = '';
				if(customer_username) {
					descHtml += '<div class="mt-1"><b>Request Customer :</b> ' + customer_username + '</div>';
				}
				if(customer_username) {
					descHtml += '<div class="mt-1"><b>Expert :</b> ' + customer_username + '</div>';
				}
                if (status) {
                    descHtml += '<div><b>Status:</b> ' + status + '</div>';
                }
                if (msg) {
                    descHtml += '<div class="mt-1"><b>Message:</b>' +
                        $('<div/>').text(msg).html().replace(/\n/g, '<br>') +
                        '</div>';
                }
				
                // meet_link comes as HTML button string in API
                if (event.meet_link) {
                    descHtml += '<div class="mt-2">' + event.meet_link + '</div>';
                }

                $('#mDesc').html(descHtml || '<span class="text-muted">No details</span>');
                $('#eventModal').modal('show');
            },

            // Optional: click on a date to show all events for that date
            dayClick: function(date) {
                var selected = moment(date).format('YYYY-MM-DD');

                // normalize start to date-only in case API sends datetime
                var filtered = (allEvents || []).filter(function(ev) {
                    var raw = (ev.start != null) ? String(ev.start) : '';
                    var dateOnly = raw ? raw.substring(0, 10) : '';
                    return dateOnly === selected;
                });

                if (filtered.length === 1) {
                    // trigger click behavior
                    $('#calendar').fullCalendar('clientEvents', filtered[0].id);
                }
            }
        });
    });
    </script>