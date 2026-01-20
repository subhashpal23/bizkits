<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Teacher</span> - Management</h4>
         </div>
		 <div class="heading-elements">
			 <div class="heading-btn-group">
				<a href="<?php echo ci_site_url();?>admin/teacher/addNewTeacher" class="btn btn-success"><i class="icon-add position-left"></i> Add New Teacher</a>
             </div>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Teacher Management </a></li>
            <li class="active">All Teacher</li>
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
                  <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
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
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">View All Teacher</h5>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
         <table class="table datatable-responsive">
            <thead>
               <tr>
                  <th>Sr.</th>
                  <th>Teacher Id</th>
                  <th>Teacher Username</th>
                  <th>Teacher Password</th>
                  <th>Teacher Email</th>
                  <th>Teacher Phone</th>
				  <th>View All Details</th>
				  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
                  //pr($all_ranks);
                  $sno=0;
                  foreach ($all_teacher as $teacher) 
                  {
                   $sno++; 
				   $status_label=(!empty($teacher->active_status) && $teacher->active_status=='1')?'Active':'Inactive';
				   
				   $status_label_class=(!empty($teacher->active_status) && $teacher->active_status=='1')?'label-success':'label-warning';

				   ?>
               <tr>
                  <td><?php echo $sno;?></td>
                  
                  <td><?php echo $teacher->user_id; ?></td>
                  <td><?php echo $teacher->username; ?></td>
                  <td><?php echo $teacher->password; ?></td>
                  <td><?php echo $teacher->email; ?></td>
				  <td><?php echo $teacher->phone; ?></td>
				  <td><a class="view_details" teacher_id="<?php echo $teacher->user_id;?>" href="#">View Details</a></td>
				  <td><span class="label <?php echo $status_label_class;?>"><?php echo $status_label;?></span></td>
                  <td>
                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              
							  <?php 
                              if($teacher->active_status=='0')
                              {
                              ?>
                              <li><a title="click to Publish" href="<?php echo ci_site_url();?>admin/teacher/changeTeacherStatus/<?php echo ID_encode($teacher->id);?>/1"><i class="icon-eye"></i> Active Teacher</a></li>
                              <?php    
                              }
                              else 
                              {
                              ?>
                              <li><a title="click to Unpublish" href="<?php echo ci_site_url();?>admin/teacher/changeTeacherStatus/<?php echo ID_encode($teacher->id);?>/0"><i class="icon-eye-blocked"></i> Inactive Teacher</a></li>
                              <?php    
                              }
                              ?>
							  
							  <li><a onclick="return confirmEdit();"  href="<?php echo ci_site_url()."admin/teacher/editTeacher"?>/<?php echo ID_encode($teacher->id);?>"><i class="icon-pencil"></i> Edit Teacher</a></li>
                              
							  
							  <li><a onclick="return confirmDelete();" href="<?php echo ci_site_url()."admin/teacher/deleteTeacher"?>/<?php echo ID_encode($teacher->id);?>"><i class="icon-file-excel"></i> Delete Teacher</a></li>
                           </ul>
                        </li>
                     </ul>
                  </td>
               </tr>
               <?php 
                  }
                  ?>
            </tbody>
         </table>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<div id="view_teacher_modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-success">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h6 class="modal-title" id="view_teacher_username"></h6>
								</div>
								<div class="modal-body">
								<!------------------------>
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr class="bg-blue">
													<th>#</th>
													<th>#</th>
												</tr>
											</thead>
											<tbody id="details_modal_body">
												
											</tbody>
										</table>
									</div>
								<!------------------------->
								
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
<style>
.icons-list {
    margin: 0;
    padding: 20px;
    line-height: 1;
    font-size: 0;
}
</style>
<script>
function confirmDelete()
{
   
 if(window.confirm("Are you sure, you want to delete a Teacher"))
    return true;
 else 
   return false;
}
function confirmChangeStatus()
{
   
 if(window.confirm("Are you sure, you want to change the Teacher status"))
    return true;
 else 
   return false;
}
function confirmEdit()
{
   
 if(window.confirm("Are you sure, you want to edit the Teacher"))
    return true;
 else 
   return false;
}
$(document).ready(function(){
	$(".view_details").click(function(){
		var teacher_id=$(this).attr('teacher_id');
		var request_url='<?php echo ci_site_url();?>admin/teacher/getAjaxTeacherDetails/'+teacher_id;
		///////////////////////
		jQuery.ajax({
                  type:'GET',
                  url:request_url,
                  async:false,
                  beforeSend: function () {
                       $.loader("on", '<?php echo base_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
					
					var details_modal_body='<tr>';
					details_modal_body +='<td>User Id:</td>';
					details_modal_body +='<td>'+res.user_id+'</td>';
					details_modal_body +='</tr>';
					////////////////
					details_modal_body +='<tr>';
					details_modal_body +='<td>username:</td>';
					details_modal_body +='<td>'+res.username+'</td>';
					details_modal_body +='</tr>';
					////////////////
					details_modal_body +='<tr>';
					details_modal_body +='<td>password:</td>';
					details_modal_body +='<td>'+res.password+'</td>';
					details_modal_body +='</tr>';
					////////////////
					details_modal_body +='<tr>';
					details_modal_body +='<td>first_name:</td>';
					details_modal_body +='<td>'+res.first_name+'</td>';
					details_modal_body +='</tr>';
					////////////////
					details_modal_body +='<tr>';
					details_modal_body +='<td>last_name:</td>';
					details_modal_body +='<td>'+res.last_name+'</td>';
					details_modal_body +='</tr>';
					////////////////
					details_modal_body +='<tr>';
					details_modal_body +='<td>phone_no:</td>';
					details_modal_body +='<td>'+res.phone_no+'</td>';
					details_modal_body +='</tr>';
					////////////////
					details_modal_body +='<tr>';
					details_modal_body +='<td>email:</td>';
					details_modal_body +='<td>'+res.user_id+'</td>';
					details_modal_body +='</tr>';
					////////////////
					details_modal_body +='<tr>';
					details_modal_body +='<td>image:</td>';
					details_modal_body +='<td><img width="150" src="<?php echo base_url();?>images/'+res.image+'"></td>';
					details_modal_body +='</tr>';
					
					
					$("details_modal_body").children().remove();
					$("#details_modal_body").append(details_modal_body);
					
					$("#view_teacher_username").text('Username: '+res.username);
					
					$("#view_teacher_modal").modal('show');
                  
				  },//end success
                  complete: function () {
                       $.loader("off", '<?php echo base_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax		
		//////////////////////////
	});
});//end ready     
</script>