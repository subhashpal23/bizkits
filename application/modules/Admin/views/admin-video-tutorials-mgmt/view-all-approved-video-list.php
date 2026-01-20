<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/gallery_library.js"></script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Video Tutorials Management</span> - View All Approved Video List</h4>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Video Tutorials Management</a></li>
            <li class="active">View All Approved Video List</li>
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
               <!--
                  <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
                  -->
               <?php 
                  echo $this->session->flashdata('flash_msg');
                  ?>
            </div>
            <?php    
               }
            ?>
      <!-- Media library -->
      <div class="panel panel-white">
         <div class="panel-heading">
            <h6 class="panel-title text-semibold">View All Approved Video List</h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
            
         <table class="table table-striped media-library table-lg">
            <thead>
               <tr>
                  <th>S.No</th>
				  <th>Video Title</th>
				  <th>Category Name</th>
				  <th>Teacher</th>
				  <th>View Video</th>
                  <th>Approval Status</th>
                  <th>Date</th>
                  <th class="text-center">Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php 
               if(!empty($all_video) && count($all_video)>0)
               {
                  $sno=0;
                  foreach ($all_video as $video) 
                  {
                    $sno++; 
					if($video->role_type=='1')
					{
						$teacher="Admin";
						$approve_status_label_class=($video->approve_status=='1')?'label-success':'label-danger';
						$approve_status_label=($video->approve_status=='1')?'Approved':'Unapproved';
						
					}
               ?>
               <tr>
                  <!--<td><input type="checkbox" class="styled"></td>-->
                  <td><?php echo $sno;?></td>
				  <td><?php echo $video->title;?></td>
				  <td><?php echo $video->category_name;?></td>
				  <td><?php echo $teacher;?></td>
                  <td><a class="view-video" video-path="<?php echo $video->video_path;?>" href="javascript:void(0)">View Video</a></td>
				  <td><span class="label <?php echo $approve_status_label_class;?>"><?php echo $approve_status_label;?></span></td>
				   
				  <td><?php echo date(date_formats(),strtotime($video->create_date));?></td>
                  <td class="text-center">
                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              <!--<li><a href="#"><i class="icon-eye"></i> Publish</a></li>-->
                              <li><a title="click to Unpublish" href="<?php echo ci_site_url();?>admin/admin_video_tutorials/changeVideoStatus/<?php echo ID_encode($video->id);?>/0"><i class="icon-eye-blocked"></i> Unapprove Video</a></li>
							  
							   <li><a title="Edit" href="<?php echo ci_site_url();?>admin/admin_video_tutorials/editVideo/<?php echo ID_encode($video->id);?>/1"><i class="icon-pencil"></i> Edit</a></li>
                           </ul>
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
      <!-- /media library -->
      <!-- Footer -->
      <?php $this->load->view("common/footer-text");?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<div id="view_video" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
								<!------------------------>
										<div id="view-clicked-video" class="video-container">
										</div>
								<!------------------------->
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
</div>
<script>
function confirm_edit()
{
	if(window.confirm('Are you sure, you want to edit the video'))
		return true;
	else
		return false;
}
function confirm_delete()
{
	if(window.confirm('Are you sure, you want to delete the video'))
		return true;
	else
		return false;
}
function confirm_change_status()
{
	if(window.confirm('Are you sure, you want to change the video status'))
		return true;
	else
		return false;
}
$(document).ready(function(){
	$(".view-video").click(function(){
	   var video_path=$(this).attr('video-path');
	   var frame ='<iframe  width="560" height="500" src="'+video_path+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
       $("#view-clicked-video").children().remove();
	   $("#view-clicked-video").append(frame);
	   $("#view_video").modal('show');
	});
});
</script>