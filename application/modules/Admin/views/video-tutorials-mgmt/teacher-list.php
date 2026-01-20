<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Video Tutorials Management</span> - View All Teacher List</h4>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Video Tutorials Management</a></li>
            <li class="active">View All Teacher List</li>
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
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Detached content -->
      <div class="container-detached">
         <div class="content-detached">
            <!-- Grid -->
            
			<?php 
			if(!empty($all_teacher) && count($all_teacher)>0)
			{
				$total_rows=ceil(count($all_teacher)/3);
				$total_teacher=count($all_teacher);
				$teacher_counter=0;
				for($i=1;$i<=$total_rows;$i++)
				{
					echo '<div class="row">';			
					for($j=1;$j<=3;$j++)
					{
						if($teacher_counter==$total_teacher)break;
						list($k,$teacher)=each($all_teacher);
						
			 ?>
					<div class="col-lg-4">
						  <div class="panel">
							 <div class="panel-body">
								<img src="<?php echo base_url();?>images/<?php echo $teacher->image;?>" class="img-responsive">
								<div class="card-body text-center">
								   <h6 class="font-weight-semibold"><?php echo $teacher->username;?></h6>
								   <!--<p class="text-muted">Short Description About Teacher</p>
								   -->
								   <div class="list-icons list-icons-extended">
									  <a href="#" class="list-icons-item"><i class="icon-mic2"></i> <?php echo get_teacher_total_video($teacher->user_id);?> Videos</a>
								   </div>
								   <br>
								   <a href="<?php echo ci_site_url();?>admin/video_tutorials/courseList/<?php echo ID_encode($teacher->user_id);?>" class="btn bg-indigo-400"><i class="icon-link mr-2"></i> View Courses</a>
								</div>
							 </div>
						  </div>
					   </div>
			<?php 
					$teacher_counter++;
					}//end inner for loop here!
					echo '</div>';
				}//end outer for loop here!
			}
			?>
			
            <!-- /grid -->
            <!-- Pagination -->
            <!--
			<div class="text-center content-group-lg pt-20">
               <ul class="pagination">
                  <li class="disabled"><a href="#"><i class="icon-arrow-small-left"></i></a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#"><i class="icon-arrow-small-right"></i></a></li>
               </ul>
            </div>
			-->
            <!-- /pagination -->
         </div>
      </div>
      <!-- /detached content -->
      <!-- Detached sidebar -->
      <!-- /detached sidebar -->
      <!-- Footer -->
      <?php
         $this->load->view("common/footer-text");
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->