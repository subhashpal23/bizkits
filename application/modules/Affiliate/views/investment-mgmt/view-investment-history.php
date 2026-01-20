<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Investment Management</span> - Investment History</h4>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo ci_site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Investment History</li>
                     </ul>
					 <ul class="breadcrumb">
                     </ul>
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
               <div class="content">
				<?php echo $this->session->flashdata('flash_msg');?>
                 <div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Investment History</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
						<div class="table-responsive">
							<table class="table datatable-html">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Deposit Id</th>
										<th>Income</th>
										<th>Balance</th>
										<th>Amount</th>
										<th>Status</th>
										<th>%</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									//pr($data);
									if(!empty($all_statements) && count($all_statements)>0)
									{
									    $array=array('Active','Closed');
										$sno=1;
										foreach ($all_statements as $statementObj) 
										{
											# code...
    										$status=$statementObj->status;
    										$amount=$statementObj->amount;
										    if($statementObj->title=='psi')
										    {
										        $balance=$amount+$statementObj->roi_amount;
										    }
										    else if($statementObj->title=='roi')
										    {
										        $balance=0;
										    }
										    else
										    {
										        $balance=$statementObj->roi_amount;
										    }
											$color=($statementObj->status==1)?"green":"red";
										?>
											<tr>
												<td><?php echo $sno;?></td>
												<td><?php echo $statementObj->deposit_id;?></td>
												<td><?php echo $statementObj->title;?></td>
												<td style="color:<?php echo $color;?>"><?php echo currency()."".$balance;?></td>
												<td style="color:<?php echo $color;?>"><?php echo currency()."".$amount;?></td>
												<td><?php echo $array[$status];?></td>
												<td><?php echo $statementObj->roi_per;?>%</td>
												<td><?php echo date(date_formats(),strtotime($statementObj->request_date));?></td>
												<td><a href="<?php echo base_url();?>user/investment/roiHistory/<?php echo $statementObj->deposit_id;?>">History</a></td>
											</tr>
											<?php
											$sno++;		
										}//end foreach!
									}//end empty if!
									?>

								</tbody>
							</table>
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

  function deleteConfirm()
  {

  	if(window.confirm("Are you sure, you want to delete"))
      return true;
    else 
      return false;
  }
</script>            