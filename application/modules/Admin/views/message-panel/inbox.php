<div class="dashboard-content-one">
    <div class="breadcrumbs-area">
        <h3>Message Inbox</h3>
        <ul>
            <li>
                <a href="<?php echo base_url()."Admin";?>">Home</a>
            </li>
            <li>Message Inbox</li>
            <hr>
            <br>
            <div class="card card-body">
                <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                <div class="card-body">
                    <div class="content-wrapper">
                        <!-- Page header -->
                        <div class="page-header page-header-default">
                            <div class="page-header-content">

                                <div class="heading-elements">
                                    <div class="heading-btn-group">
                                        <a href="#" class="btn btn-link btn-float has-text"><i
                                                class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                        <a href="#" class="btn btn-link btn-float has-text"><i
                                                class="icon-calculator text-primary"></i>
                                            <span>Invoices</span></a>
                                        <a href="#" class="btn btn-link btn-float has-text"><i
                                                class="icon-calendar5 text-primary"></i>
                                            <span>Schedule</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="breadcrumb-line">
                                <!-- <ul class="breadcrumb">
												<li><a href="<?php echo ci_site_url();?>admin"><i
																class="icon-home2 position-left"></i> Home</a></li>
												<li><a href="#">Message Panel</a></li>
												<li class="active">Inbox</li>
											</ul> -->
                                <ul class="breadcrumb-elements">
                                    <li><a href="#"><i class="icon-comment-discussion position-left"></i>
                                            Support</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-gear position-left"></i>
                                            Settings
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-user-lock"></i> Account security</a>
                                            </li>
                                            <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                            <li><a href="#"><i class="icon-accessibility"></i>
                                                    Accessibility</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /page header -->
                        <!-- Content area -->
                        <div class="content">
                            <!-- Daterange picker -->
                            <!-- /daterange picker -->
                            <div class="row">
                                <div class="panel panel-flat">
                                    <!-- <div class="panel-heading">
														<h5 class="panel-title">Inbox</h5>
														<div class="heading-elements">
															<ul class="icons-list">
																<li><a data-action="collapse"></a></li>
																<li><a data-action="reload"></a></li>
																<li><a data-action="close"></a></li>
															</ul>
														</div>
												</div> -->
                                    <?php 
		if(!empty($this->session->flashdata('flash_msg')))
		{
		?>
                                    <div
                                        class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                        <!--<span class="text-semibold">Well done!</span> Message is sent successfully-->
                                        <?php echo $this->session->flashdata('flash_msg');?>
                                    </div>
                                    <?php    
		}
		?>
                                    <table
                                        class="table table-striped table-bordered table-hover align-middle datatable-responsive">
                                        <thead class="bg-slate-800 ">
                                            <tr>
                                                <th style="width:70px">Sr.No</th>
                                                <th style="width:120px">Message Id</th>
                                                <th style="width:140px">Date</th>
                                                <th>Subject</th>
                                                <th style="width:180px">Sender</th>
                                                <th style="width:180px">Attachment</th>
                                                <th style="width:120px">Action</th>
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
                                                    <?php if(!empty($msg->attachment)) { ?>
                                                    <a class="btn btn-xs btn-default"
                                                        href="<?php echo ci_site_url();?>uploads/images/<?php echo $msg->attachment;?>"
                                                        target="_blank" rel="noopener">View Attachment</a>
                                                    <?php } else { ?>
                                                    <span class="text-muted">---</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-xs" role="group"
                                                        aria-label="Actions">
                                                        <button type="button" class="btn btn-xs btn-success read_msg"
                                                            data-msg-id="<?php echo ID_encode($msg->id);?>"
                                                            data-toggle="modal" data-target="#modal_form_vertical"
                                                            title="Read Message">
                                                            <i class="icon-eye"></i>
                                                        </button>
                                                        <a class="btn btn-xs btn-danger js-confirm-delete"
                                                            data-confirm="Are you sure, you want to delete the message?"
                                                            href="<?php echo ci_site_url();?>admin/MessagePanel/deleteInboxMessage/<?php echo ID_encode($msg->id);?>"
                                                            title="Delete">
                                                            <i class="icon-trash"></i>
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
                                                <td colspan="7" class="text-center text-muted">No inbox
                                                    messages found.</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Vertical form modal -->
                            <div id="modal_form_vertical" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h5 class="modal-title" id="msg_subject"></h5>
                                        </div>
                                        <form action="#">
                                            <div class="modal-body">
                                                <h5 class="modal-title" id="sender_name"></h5>
                                                <h5 class="modal-title" id="sender_id"></h5>
                                                <p id="msg"></p>
                                                <!--
				<div class="form-group">
					<div class="row">
						<textarea rows="5" cols="5" class="form-control" placeholder="Reply Message"></textarea>
					</div>
				</div>
				-->
                                            </div>
                                            <!--
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Reply Message</button>
			</div>
			-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /vertical form modal -->
                            <!-- Footer -->
                            <!-- /footer -->
                        </div>
                        <!-- /content area -->
                    </div>
                </div>
            </div>

        </ul>
        <!-- <?php $this->load->view('common/footer-text');?> -->

    </div>
    <!-- Main content -->

    <!-- /main content -->
</div>
<script>
$(document).ready(function() {

    // consistent confirm delete (works even if table redraws)
    $(document).on('click', '.js-confirm-delete', function(e) {
        var msg = $(this).data('confirm') || 'Are you sure, you want to delete the message?';
        if (!window.confirm(msg)) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('click', '.read_msg', function() {
        var msg_id = $(this).data('msg-id');
        $.ajax({
            url: "<?php echo ci_site_url();?>admin/MessagePanel/readMessage/",
            type: "POST",
            dataType: "json",
            data: {
                'msg_id': msg_id
            },
            beforeSend: function() {
                $.loader("on", '<?php echo ci_site_url();?>/images/default.svg');
            },
            success: function(msg) {
                $("#msg_subject").html('Subject :' + (msg?.subject ?? ''));
                $("#sender_name").text('Sender Name :' + (msg?.sender_name ?? ''));
                $("#sender_id").text('Sender id :' + (msg?.sender_id ?? ''));
                $("#msg").html('<h5>Message :</h5>' + (msg?.message ?? ''));
            },
            error: function() {
                $("#msg_subject").html('Error');
                $("#sender_name").text('');
                $("#sender_id").text('');
                $("#msg").html('<span class="text-danger">Unable to load message.</span>');
            },
            complete: function() {
                $.loader("off", '<?php echo ci_site_url();?>/images/default.svg');
            }
        }); //end $.ajax


    }); //end read msg click here
}); //end ready
</script>
