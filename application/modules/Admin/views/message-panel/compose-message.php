<!-- Main content -->
<div class="dashboard-content-one">
    <div class="breadcrumbs-area">
        <h3>Compose Message</h3>
        <ul>
            <li>
                <a href="<?php echo base_url()."Admin";?>">Home</a>
            </li>
            <li>Compose Message</li>
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
                        <div class="content">
        <?php 
      if(!empty($this->session->flashdata('flash_msg')))
      {
      ?>
        <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                    class="sr-only">Close</span></button>
            <?php echo $this->session->flashdata('flash_msg');?>
        </div>
        <?php    
      }
      ?>
        <div class="panel panel-flat">
            <?php 
            echo form_open(ci_site_url()."admin/MessagePanel/composeMessage",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
            ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Select Users:</label>
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
                                  <option value="<?php echo $member->user_id;?>"><?php echo $member->username;?></option>
                                  <?php
                                      }
                                    }//end foreach
                                 }//end if
                               ?>
                           </optgroup>
                        </select>
                                <span class="help-block text-danger valid_users"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Subject:</label>
                            <div class="col-lg-9">
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Enter Subject Here">
                                <span class="help-block text-danger valid_subject"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Message:</label>
                            <div class="col-lg-9">
                                <textarea name="message" id="message" class="form-control" rows="6"
                                    placeholder="Type your message..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Attach File:</label>
                            <div class="col-lg-9">
                                <input type="file" name="attachment" id="attachment" class="form-control">
                                <span class="help-block">Optional: attach an image/pdf if required.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <div class="text-right">
                                    <button type="submit" name="btn" id="btn" value="send" class="btn btn-primary">
                                        Send <i class="icon-arrow-right14 position-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
        <!-- Footer -->
        <!-- <?php $this->load->view('common/footer-text') ?> -->
        <!-- /footer -->
    </div>
                        
                        <!-- /content area -->
                    </div>
                </div>
            </div>

        </ul>
        <!-- <?php $this->load->view('common/footer-text');?> -->

    </div>
    <!-- /page header -->
    <!-- Content area -->
    
    <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
CKEDITOR.replace('message');
</script>
<script>
$(document).ready(function() {
    $(document).on('click', '#btn', function() {
        if ($("#users").val() == "" || $("#users").val() == null) {
            $(".valid_users").text("Please select atleast any user!");
            return false;
        }
        if ($("#subject").val() == "") {
            $(".valid_subject").text("Please enter subject!");
            return false;
        }
        return true;
    });

    $(document).on('change', '#users', function() {
        if ($(this).val() != '') {
            $(".valid_users").text('');
        }
    });

    $(document).on('keyup', '#subject', function() {
        if ($(this).val().length > 0) {
            $(".valid_subject").text('');
        }
    });
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/form_select2.js"></script>
