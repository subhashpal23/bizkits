<div class="dashboard-content-one">
    <div class="breadcrumbs-area">
        <h3>Sent Message</h3>
        <ul>
            <li>
                <a href="<?php echo base_url()."Admin";?>">Home</a>
            </li>
            <li>Sent Message</li>
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

                        <!-- /page header -->
                        <!-- Content area -->
                        <div class="content">
                            <table class="table datatable-responsive">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Message Id</th>
                                        <th>Date </th>
                                        <th>Subject</th>
                                        <th>Sent To</th>
                                        <th>Attachment</th>
                                        <th>Action</th>
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
                                        <td><?php echo $msg->message_id;?></td>
                                        <td><?php echo date(date_formats(),strtotime($msg->ts));?></td>
                                        <td><?php echo $msg->subject;?></td>
                                        <td><?php echo $msg->receiver_name;?></td>
                                        <td>
                                            <?php
                           if(!empty($msg->attachment))
                           {
                           ?>
                                            <a href="<?php echo ci_site_url();?>uploads/images/<?php echo $msg->attachment;?>"
                                                target="_blank">View Attachment</a>
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
                                                    <a href="#" msg-id="<?php echo ID_encode($msg->id);?>"
                                                        class="read_msg" data-popup="tooltip" title=""
                                                        data-original-title="Read Message" data-toggle="modal"
                                                        data-target="#modal_form_vertical"><i class="icon-eye"></i></a>
                                                </li>
                                                <li>
                                                    <a onclick="return deleteConfirm();"
                                                        href="<?php echo ci_site_url();?>admin/MessagePanel/deleteSentMessage/<?php echo ID_encode($msg->id);?>"
                                                        data-popup="tooltip" title=""
                                                        data-original-title="Close Message"><i
                                                            class="icon-trash"></i></a>
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
                        <!-- /content area -->
                    </div>
                </div>
            </div>

        </ul>
        <!-- <?php $this->load->view('common/footer-text');?> -->

    </div>
    <!-- Main content -->

    <!- <!-- /main content -->
        <div id="modal_form_vertical" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title" id="msg_subject"></h5>
                    </div>
                    <form action="#">
                        <div class="modal-body">
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
        <script>
        function deleteConfirm() {

            if (window.confirm("Are you sure, you want to delete the message"))
                return true;
            else
                return false;
        }

        $(document).ready(function() {
            $(".read_msg").click(function() {
                var msg_id = $(this).attr("msg-id");
                //alert(msg_id);
                $.ajax({
                    url: "<?php echo ci_site_url();?>admin/MessagePanel/readMessage/", // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: {
                        'msg_id': msg_id
                    },
                    beforeSend: function() {
                        $.loader("on", '<?php echo ci_site_url();?>/images/default.svg');
                    },
                    success: function(msg) {
                        $("#msg_subject").html('Subject :' + msg.subject);
                        $("#msg").html('<h5>Message :</h5>' + msg.message);
                    },
                    complete: function() {
                        $.loader("off", '<?php echo ci_site_url();?>/images/default.svg');
                    }
                }); //end $.ajax


            }); //end read msg click here
        }); //end ready
        </script>
