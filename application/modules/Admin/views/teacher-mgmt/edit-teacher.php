 <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/uploaders/fileinput.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/uploader_bootstrap.js"></script>
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Teacher</span> - Management</h4>
         </div>
         <div class="heading-elements">
			 <div class="heading-btn-group">
				<a href="<?php echo ci_site_url();?>admin/teacher/viewAllTeacher" class="btn btn-success"><i class="icon-arrow-left52 position-left"></i>BACK</a>
             </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="#">Teacher Management</li>
            <li class="active">Edit Teacher</li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Horizontal form options -->
      <div class="row">
         <div class="col-md-12">
            <!-- Basic layout-->
            <div class="panel panel-flat">
               <div class="panel-heading">
                  <h5 class="panel-title">Edit Teacher</h5>
                  <div class="heading-elements">
                     <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                     </ul>
                  </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
               </div>
               <?php 
			     $username=(!empty($teacher->username))?$teacher->username:null;
			     $password=(!empty($teacher->password))?$teacher->password:null;
			     $first_name=(!empty($teacher->first_name))?$teacher->first_name:null;
			     $last_name=(!empty($teacher->last_name))?$teacher->last_name:null;
			     $phone_no=(!empty($teacher->phone_no))?$teacher->phone_no:null;
			     $email=(!empty($teacher->email))?$teacher->email:null;
			     $image=(!empty($teacher->image))?$teacher->image:null;

				 echo form_open(ci_site_url()."admin/teacher/editTeacher/".ID_encode($teacher->id),array('method'=>'post','class'=>'form-horizontal','enctype'=>'multipart/form-data'));
                  ?>
               <!--<form method="post" class="form-horizontal">-->								
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Username:</label>
                     <div class="col-lg-9">
                        <input type="text" value="<?php echo $username;?>" disabled class="form-control" placeholder="Teacher Username">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Password:</label>
                     <div class="col-lg-9">
                        <input type="password" value="<?php echo $password;?>" name="password" class="form-control" placeholder="Teacher Password">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher First Name:</label>
                     <div class="col-lg-9">
                        <input type="text" value="<?php echo $first_name;?>" name="first_name" class="form-control" placeholder="Teacher First Name">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Last Name:</label>
                     <div class="col-lg-9">
                        <input type="text" value="<?php echo $last_name;?>" name="last_name" class="form-control" placeholder="Teacher Last Name">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Phone No:</label>
                     <div class="col-lg-9">
                        <input type="text" value="<?php echo $phone_no;?>" name="phone_no" class="form-control" placeholder="Teacher Phone No">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Email:</label>
                     <div class="col-lg-9">
                        <input type="text" value="<?php echo $email;?>" name="email" class="form-control" placeholder="Teacher Email">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Image:</label>
                     <div class="col-lg-9">
					    <?php
						if(!empty($image))
						{ 
						?>
                         <div class="file-preview-old">
															   <div class="file-preview-thumbnails">
															<div class="file-preview-frame">
															   <img src="<?php echo base_url();?>images/<?php echo $image;?>" class="file-preview-image" style="width:auto;height:160px;">
															</div>
															</div>
															   <div class="clearfix"></div>   <div class="file-preview-status text-center text-success"></div>
															   <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                                       </div>	
														<?php	
													     }
														?>
						<input name='image' type="file" class="file-input form-control">
						<input name='old_image' value="<?php echo $image;?>" type="hidden">

                     </div>
                  </div>
				  <div class="text-right">
                     <button type="submit" name="btn" value="addNewRank" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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
<style>
button.btn.btn-default.btn-icon.kv-fileinput-upload{
	display: none;
}
.file-preview-old {
    /*border-radius: 2px;
    border: 1px solid #ddd;*/
    width: 100%;
    margin-bottom: 20px;
    position: relative;
}
</style>
<script>
  $(document).ready(function(){
  	$(".file-caption-name").text("No Profile Pic Selected");
  });//end ready
</script>		