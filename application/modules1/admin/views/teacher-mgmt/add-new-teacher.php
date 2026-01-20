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
            <li class="active">Add New Teacher</li>
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
                  <h5 class="panel-title">Add New Teacher</h5>
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
                  echo form_open(ci_site_url()."admin/teacher/addNewTeacher",array('method'=>'post','class'=>'form-horizontal','enctype'=>'multipart/form-data'));
                  ?>
               <!--<form method="post" class="form-horizontal">-->								
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Username:</label>
                     <div class="col-lg-9">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Teacher Username">
						<span id="valid_username" style="color:red;font-weight:bold;display:none"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Password:</label>
                     <div class="col-lg-9">
                        <input type="password" name="password" class="form-control" placeholder="Teacher Password">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher First Name:</label>
                     <div class="col-lg-9">
                        <input type="text" name="first_name" class="form-control" placeholder="Teacher First Name">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Last Name:</label>
                     <div class="col-lg-9">
                        <input type="text" name="last_name" class="form-control" placeholder="Teacher Last Name">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Phone No:</label>
                     <div class="col-lg-9">
                        <input type="text" name="phone_no" class="form-control" placeholder="Teacher Phone No">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Email:</label>
                     <div class="col-lg-9">
                        <input type="text" name="email" class="form-control" placeholder="Teacher Email">
                     </div>
                  </div>
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Teacher Image:</label>
                     <div class="col-lg-9">
						<input name='image' type="file" class="file-input form-control">

                     </div>
                  </div>
				  <div class="text-right">
                     <button type="submit" name="btn" id="btn" value="addNewRank" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/jquery.loading.block.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/loader.function.js"></script>
<script>
$(document).ready(function(){
  	$(".file-caption-name").text("No Profile Pic Selected");
});//end ready
$(document).ready(function(){
	$("#btn").click(function(){
		var username_exists=false;
		var request_url='<?php echo ci_site_url();?>admin/teacher/isTeacherExists/';
		var username=$("#username").val();
		if(username=="" || username==null)
		{
			$("#valid_username").text("Please enter username!").css('display','');
			$("#username").focus();
			return false;
		}
		jQuery.ajax({
                  type:'POST',
                  url:request_url,
				  data:{'username':username},
                  async:false,
                  beforeSend: function () {
                       $.loader("on", '<?php echo base_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
					  if(res.exist=='1')
					  {
						  username_exists=true;
					  }
                  },//end success
                  complete: function () {
                       $.loader("off", '<?php echo base_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax	
		if(username_exists==true)
		{
		$("#valid_username").text("Sorry enter username already exists!").css('display','');
		$("#username").focus();
		return false;
		}
	});
	$("#username").keyup(function(){
		$("#valid_username").text('').css('display','none');
	});
});//end ready
  
</script>		