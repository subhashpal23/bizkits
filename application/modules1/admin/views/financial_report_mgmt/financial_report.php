<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/picker_date.js"></script>
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Financial Report List</span></h4>
         </div>
         
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo ci_site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Financial Report List</li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
					<div class="row">
						<div class="panel-body">
							<form action="<?php echo ci_site_url();?>admin/financial_report/" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Select Start Date:</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar22"></i></span>
												<input type="text" name="start_date" id="start_date" class="form-control daterange-single" value="<?php echo $start_date;?>">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Select End Date:</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar22"></i></span>
												<input type="text" name="end_date" id="end_date" class="form-control daterange-single" value="<?php echo $end_date;?>">
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label>&nbsp;</label>
											<div class="input-group">
												<button type="submit" name='btn' id="btn" value='submit' class="btn btn-info form-control">Search</button>
											</div>
										</div>
										
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label>&nbsp;</label>
											<div class="input-group">
												<button type="submit" name='download_csv' id="download_csv" value='submit' class="btn btn-info form-control">Download CSV</button>
											</div>
										</div>
										
									</div>
									
								</div>
							</form>
				        </div>
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Financial Report List</h5>
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
						<th>Date</th>
						<th>Total Registration</th>
						<th>Total Package sold</th>
						<th>Total Commission</th>
						<th>Total Paid Payout</th>
						<th>Total Profit</th>
                    </tr>
               </thead>
               <tbody>
                  <?php 
				  //pr($finacial_report_array);
                  if(!empty($finacial_report_array) && count($finacial_report_array)>0)
                  {
                     $sno=0;
                     foreach ($finacial_report_array as $report) 
                     {
						$sno++; 
                  ?>
                    <tr>
						<td><?php echo $sno;?></td>
						<td><?php echo $report->create_date;?></td>
						<td><?php echo $report->total_registered_user;?></td>
						<td><?php echo number_format($report->package_sold_amount,2).currency();?></td>
						<td><?php echo number_format($report->total_paid_commission,2).currency();?></td>
						<td><?php echo number_format($report->payout_amount,2).currency();?></td>
						<td><?php echo number_format($report->profit,2).currency();?></td>
                    </tr>
                  <?php
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

