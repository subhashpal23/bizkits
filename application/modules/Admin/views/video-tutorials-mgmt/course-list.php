<style>
	  .course .lesson-index {
    margin-bottom: 80px;
}

.lesson-index {
    position: relative;
    overflow: hidden;
}

.lesson-index__chapter {
    font: bold 13px/16px "Roboto", Arial, sans-serif;
    color: #2a3744;
    background: #f5f7f8;
    padding: 10px;
    margin: 0;
    position: relative;
}

.lesson-index__chapter-title {
    display: inline-block;
    width: 100%;
    position: relative;
    font-size: 18px;
}

.lesson-index__chapter--inaccessible .lesson-index__chapter-number {
    color: #9d9e9f;
}

.lesson-index__chapter-title-text {
    display: inline-block;
    margin-left: 24px;
}

.lesson-index__chapter-meta {
    font-size: 14px;
    float: right;
}

.lesson-index__lesson-text {
    margin-left: 24px;
}
.lesson-index__lesson--current, .lesson-index__lesson--current.lesson-index__lesson--watched {
    background: #fdfdfd;
}

.lesson-index__lesson--current .lesson-index__lesson-link, .lesson-index__lesson--current.lesson-index__lesson--watched .lesson-index__lesson-link {
    color: #2a3744;
}

.lesson-index__lesson-button {
    float: right;
    margin-right: 0;
    margin-top: 2px;
    margin-left: 10px;
    color: #0085b6;
}

.lesson-index__lesson-number {
    display: inline;
    margin-right: 5px;
}

.lesson-index__lesson-title {
    display: inline;
    margin-right: 10px;
}

.lesson-index__lesson-duration {
    display: inline;
    font-size: 12px;
    color: #7d7d7d;
}

.content-heading__primary {
    padding: 15px 0;
    border-top: solid 1px #e4e4e4;
    border-bottom: solid 1px #e4e4e4;
}
.content-heading__primary {
    display: table;
    width: 100%;
}
.content-heading__primary-authorship {
    display: table-cell;
}

.content-heading__primary-attributes {
    display: table-cell;
    text-align: right;
}
	</style>
<!-- /theme JS files -->

<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Extras</span> - Dynamic Trees</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="extra_trees.html">Extras</a></li>
            <li class="active">Dynamic trees</li>
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
      <!-- Initialization options -->
      <div class="panel-heading">
         <h6 class="panel-title text-semibold">View Video List</h6>
         <div class="heading-elements">
            <ul class="icons-list">
               <li><a data-action="collapse"></a></li>
               <li><a data-action="reload"></a></li>
               <li><a data-action="close"></a></li>
            </ul>
         </div>
      </div>
      <div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="thumbnail">
               <div class="video-container">
                  <iframe id="view-frame-video" width="560" height="500" src="<?php echo $video_path;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
               </div>
               
            </div>
         </div>
      </div>
      
	   <div class="row">
         <div class="col-md-12">
            <!-- Default unordered list markup -->
            <div class="panel panel-body border-top-primary text-center">
			   <div class="btn-group btn-group-justified">
					<?php 
					if(!empty($all_subject) && count($all_subject)>0)
					{
						foreach($all_subject as $subject)
						{
					?>
						<a href="<?php echo ci_site_url();?>admin/video_tutorials/courseList/<?php echo ID_encode($subject->user_id);?>/<?php echo ID_encode($subject->id);?>"  class="btn bg-slate-700"><?php echo $subject->subject_name;?></a>
					<?php 
						}
					}
					?>
				</div>
			</div>
            <!-- /default unordered list markup -->
         </div>
      </div>	 
      <div class="row">
         <div class="col-md-12">
            <!-- Default unordered list markup -->
            <div class="panel panel-flat">
               <div class="lesson-index">
				   <!----------------------------------->
				   <?php 
				   if(!empty($all_category) && count($all_category)>0)
				   {
					   $category_no=0;
					   foreach($all_category as $category)
					   {
						   $category_no++;
				  ?>
				  <h2 class="lesson-index__chapter lesson-index__chapter--inaccessible nolinks">
					  <div class="lesson-index__chapter-title">
						 <span class="lesson-index__chapter-number"><?php echo $category_no;?>.</span><span class="lesson-index__chapter-title-text"><?php echo $category->category_name;?></span>
					  </div>
				   </h2>
				  <?php 
						   if(!empty($category->all_video) && count($category->all_video)>0)
						   {
							   $all_video=$category->all_video;
							   $video_no=0;
							   foreach($all_video as $video)
							   {
								   $video_no++;
				 ?>
				 <h3 class="lesson-index__lesson lesson-index__lesson--last-in-chapter nolinks">
					  <a class="view_video" video_path="<?php echo $video->video_path;?>" href="#" class="lesson-index__lesson-link" href="#">
						 <div class="lesson-index__lesson-text">
							<div class="lesson-index__lesson-number"><?php echo $video_no;?></div>
							<div class="lesson-index__lesson-title"><?php echo $video->video_title;?></div>
						 </div>
					  </a>
				   </h3>
				 <?php 
							   }
						   }
				   
					   }
				   }
				   ?>
				   <!----------------------------------->
				   
				</div>
            </div>
            <!-- /default unordered list markup -->
         </div>
      </div>
      <!-- Footer -->
      <?php
         $this->load->view("common/footer-text");
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<script>
$(document).ready(function(){
	$(".view_video").click(function(){
		var video_path=$(this).attr('video_path');
		$("#view-frame-video").attr('src',video_path);
		moveUp();
		return false;
	});
});
function moveUp()
{
	$('html, body').animate({
    scrollTop:200
	}, $(window).scrollTop() / .5);
  return false;
}
</script>
