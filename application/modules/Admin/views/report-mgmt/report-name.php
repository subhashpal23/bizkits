<?php
// ...existing code...
?>
<div class="dashboard-content-one">
    <div class="breadcrumbs-area">
        <h3><?php echo $title ?? 'Report';?></h3>
        <ul>
            <li><a href="<?php echo base_url();?>Admin">Home</a></li>
            <li>Report</li>
        </ul>
    </div>

    <div class="card height-auto">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="customerReportTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Calls</th>
                            <th>Used Calls</th>
                            <th>Remaining Calls</th>
                            <th>Total Meeting Requests</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach(($customers ?? []) as $c){
                            $i++;
                            $call = $callsMap[$c->user_id] ?? null;
                            $total_calls = !empty($call) ? (int)$call->total_calls : 0;
                            $used_calls = !empty($call) ? (int)$call->used_calls : 0;
                            $remaining_calls = !empty($call) ? (int)$call->remaining_calls : 0;
                            $meetCnt = $meetCountMap[$c->user_id] ?? 0;
                            $fullName = trim(($c->first_name ?? '').' '.($c->last_name ?? ''));
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo (int)$c->user_id;?></td>
                            <td>
                                <a href="javascript:void(0)" class="js-customer-detail" data-user-id="<?php echo (int)$c->user_id;?>">
                                    <?php echo htmlspecialchars($c->username ?? ''); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($fullName);?></td>
                            <td><?php echo htmlspecialchars($c->email ?? ''); ?></td>
                            <td><?php echo $total_calls;?></td>
                            <td><?php echo $used_calls;?></td>
                            <td><?php echo $remaining_calls;?></td>
                            <td><?php echo (int)$meetCnt;?></td>
                            <td><?php echo ((string)($c->active_status ?? '0') === '1') ? 'Active' : 'Inactive';?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="customerDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="customerDetailLoading" class="text-muted">Loading...</div>
                <div id="customerDetailBody" style="display:none;">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Customer Information</h6>
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <tr><th>User ID</th><td id="cd_user_id"></td></tr>
                                    <tr><th>Username</th><td id="cd_username"></td></tr>
                                    <tr><th>Name</th><td id="cd_name"></td></tr>
                                    <tr><th>Email</th><td id="cd_email"></td></tr>
                                    <tr><th>Contact</th><td id="cd_contact"></td></tr>
                                    <tr><th>Country</th><td id="cd_country"></td></tr>
                                    <tr><th>Status</th><td id="cd_status"></td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Call Summary (user_calls)</h6>
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <tr><th>Total Calls</th><td id="cd_total_calls"></td></tr>
                                    <tr><th>Used Calls</th><td id="cd_used_calls"></td></tr>
                                    <tr><th>Remaining Calls</th><td id="cd_remaining_calls"></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr>
                    <h6>Customer Meeting Requests (customer_meeting_requests)</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="cd_requests_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Expert</th>
                                    <th>Requested Date</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Meet Link</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function($){
    function esc(str){
        return $('<div/>').text(str == null ? '' : String(str)).html();
    }

    function showModal(){
        // Bootstrap 4
        if ($.fn && $.fn.modal) {
            $('#customerDetailModal').modal('show');
            return;
        }
        // Bootstrap 5 fallback
        if (window.bootstrap && window.bootstrap.Modal) {
            var el = document.getElementById('customerDetailModal');
            if (el) {
                (new bootstrap.Modal(el)).show();
            }
        }
    }

    $(function(){
        $(document).on('click', '.js-customer-detail', function(e){
            e.preventDefault();

            var userId = $(this).data('user-id');
            $('#customerDetailBody').hide();
            $('#customerDetailLoading').text('Loading...').show();
            $('#cd_requests_table tbody').html('');
            showModal();

            $.get('<?php echo ci_site_url();?>Admin/ReportName/customer_detail/' + userId)
                .done(function(res){
                    var data;
                    try { data = (typeof res === 'object') ? res : JSON.parse(res); }
                    catch(e){ data = null; }

                    if(!data || !data.status){
                        $('#customerDetailLoading').text('No data found');
                        return;
                    }

                    var c = data.customer || {};
                    var calls = data.calls || {};
                    var reqs = data.requests || [];

                    $('#cd_user_id').html(esc(c.user_id));
                    $('#cd_username').html(esc(c.username));
                    $('#cd_name').html(esc((c.first_name||'') + ' ' + (c.last_name||'')));
                    $('#cd_email').html(esc(c.email));
                    $('#cd_contact').html(esc(c.contact_no));
                    $('#cd_country').html(esc(c.country));
                    $('#cd_status').html(String(c.active_status)==='1' ? 'Active' : 'Inactive');

                    $('#cd_total_calls').html(esc(calls.total_calls || 0));
                    $('#cd_used_calls').html(esc(calls.used_calls || 0));
                    $('#cd_remaining_calls').html(esc(calls.remaining_calls || 0));

                    var html = '';
                    for(var i=0;i<reqs.length;i++){
                        var r = reqs[i];
                        var expert = (r.expert_username ? r.expert_username : '') + (r.expert_first_name || r.expert_last_name ? (' (' + (r.expert_first_name||'') + ' ' + (r.expert_last_name||'') + ')') : '');
                        html += '<tr>';
                        html += '<td>'+(i+1)+'</td>';
                        html += '<td>'+esc(r.id)+'</td>';
                        html += '<td>'+esc(expert)+'</td>';
                        html += '<td>'+esc(r.requested_date)+'</td>';
                        html += '<td>'+esc(r.title)+'</td>';
                        html += '<td style="max-width:350px; white-space:pre-wrap;">'+esc(r.message)+'</td>';
                        html += '<td>'+esc(r.status)+'</td>';
                        html += '<td>'+(r.meet_link ? ('<a href="'+esc(r.meet_link)+'" target="_blank">Open</a>') : '')+'</td>';
                        html += '<td>'+esc(r.created_at || r.created || '')+'</td>';
                        html += '</tr>';
                    }
                    if(!html){
                        html = '<tr><td colspan="9" class="text-muted">No meeting requests</td></tr>';
                    }
                    $('#cd_requests_table tbody').html(html);

                    $('#customerDetailLoading').hide();
                    $('#customerDetailBody').show();
                })
                .fail(function(){
                    $('#customerDetailLoading').text('Request failed');
                });
        });
    });
})(jQuery);
</script>