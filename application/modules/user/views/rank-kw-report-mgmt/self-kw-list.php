<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Rank Knowledge Point Report</span> - Self Knowledge Point</h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">Rank Knowledge Point Report</a></li>
            <li class="active">Self Knowledge Point</li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
               <div class="row">
                 <div class="panel panel-flat">
                     <div class="panel-heading">
                        <h5 class="panel-title">Self Knowledge Point</h5>
                        <div class="heading-elements">
                           <ul class="icons-list">
                              <li><a data-action="collapse"></a></li>
                              <li><a data-action="reload"></a></li>
                              <li><a data-action="close"></a></li>
                           </ul>
                        </div>
                     </div>
                    
                     <table class="table">
                        <thead>
                        <tr>
                           <th>Sr.No</th>
                           <th>Package Name</th>
                           <th>KP Point</th>
                           <th>Date</th>
                        </tr>
						</thead>
						<tbody>
						<?php 
						$total_kw_point=0;
						if(!empty($kw_point) && count($kw_point)>0)
						{
							$sno=0;
							foreach($kw_point as $point)
							{
							$sno++;
							$total_kw_point=$total_kw_point+$point->rank_knowledge_points;
						?>
						<tr>
                           <td><?php echo $sno;?></td>
                           <td><?php echo get_package_name($point->pkg_id);?></td>
                           <td><?php echo $point->rank_knowledge_points;?></td>
                           <td><?php echo date(date_formats(),strtotime($point->create_date));?></td>
                        </tr>
						<?php 
							}
						}
						?>
						</tbody>
                        
                     </table>
                  </div>
               </div>
			   <div class="row">
                 <div class="col-md-6">
                   <div class="panel bg-primary">
                        <div class="panel-heading">
                           <h6 class="panel-title">Total Self Knowledge Points</h6>
                        </div>
                        <div class="panel-body">
                           <?php echo $total_kw_point;?>
                        </div>
                     </div>
                 </div>
               </div>
               <?php 
               $this->load->view('common/footer-text');
               ?>
			   
               <!-- /footer -->

            </div>
   <!-- /content area -->
</div>
<script>
   function deleteConfirm()
   {
   
   	if(window.confirm("Are you sure, you want to delete"))
       return true;
     else 
       return false;
   }
</script>