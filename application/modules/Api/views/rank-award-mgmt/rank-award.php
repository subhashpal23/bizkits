<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Rank & Award List</span></h4>
         </div>
         
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Rank & Award List</li>
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
               <h5 class="panel-title">Rank & Award List</h5>
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
                     <th>Sr.No</th>
                     <th>Rank Name</th>
                     <th>Award</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_rank) && count($all_rank)>0)
                  {
                     $sno=1;
                     foreach ($all_rank as $rank) 
                     {
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
						<td><?php echo $rank->rank_name;?></td>
						<td><?php echo $rank->rank_award;?></td>
                        <td><?php echo date(date_formats(),strtotime($rank->create_date));?></td>
						<td></td>
						<td></td>
                     </tr>
                  <?php
                     $sno++;       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- /pickadate picker -->
      <!-- Anytime picker -->
      <!-- /anytime picker -->
      <!-- Footer -->
      <?php 
         $this->load->view('common/footer-text');
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>