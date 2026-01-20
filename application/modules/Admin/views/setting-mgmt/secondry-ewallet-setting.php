<!-- Main content -->
      <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-default">
          <div class="page-header-content">
            <div class="page-title">
              <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Investment </span> - Ewallet Setting</h4>
            </div>

           
          </div>

          <div class="breadcrumb-line">
            <ul class="breadcrumb">
              <li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
              <li><a href="#">Settings</a></li>
              <li class="active">Investment Ewallet Setting</li>
            </ul>

            <ul class="breadcrumb-elements">
              <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-gear position-left"></i>
                  Settings
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All setting</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <!-- /page header -->
        <!-- Content area -->
        <div class="content">
          <?php 
               if(!empty($this->session->flashdata('flash_msg')))
               {
               ?>
               <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                 <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                 <?php echo $this->session->flashdata('flash_msg');?>
               </div>
               <?php  
               }
               ?>
          <!-- Horizontal form options -->
          <div class="row">
            <div class="col-md-12">
              <!-- Basic layout-->
                <div class="panel panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title">Investment Ewallet Setting</h5>
                    <div class="heading-elements">
                      <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                              </ul>
                            </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                    <?php 
                    echo form_open(ci_site_url()."admin/setting/updateSecondryEwalletSetting",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
                    ?>
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Enable Secondry wallet:</label>
                          <div class="col-lg-9">
                           <div class="checkbox">
                              
                              <label>
                                <input <?php if($status=='1') echo 'checked';?> type="radio" name="status" value="1" class="control-primary">
                                Enabled
                              </label>
                              
                              <label>
                                <input <?php if($status=='0') echo 'checked';?> type="radio" name="status" value="0" class="control-primary">
                                Disbaled
                              </label>

                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Enter Income Percent:</label>
                          <div class="col-lg-9">
                            <input type="number" value="<?php echo $deduction_percent;?>" required="" min="0" name="deduction_percent" class="form-control" placeholder="Enter Income Percent">
                          </div>
                        </div>
                       
                        <div class="text-right">
                          <button type="submit" name="btn" value="addNewPackage" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                      </div>
                    <!--</form>-->
                    <?php echo form_close();?>
                </div>
                <!-- /basic layout -->
            </div>
          </div>
          <!-- /vertical form options -->
          <!-- Footer -->
                    <?php
                    $this->load->view("common/footer-text");
                    ?>
                     <!-- /footer -->
        </div>
        <!-- /content area -->
      </div>
  <script>
  CKEDITOR.replace( 'description');
  </script>