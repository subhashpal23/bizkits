<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Wallet</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Wallet</li>
                    </ul>
                </div>
               <div class="content">
				<?php echo $this->session->flashdata('flash_msg');?>
                 <div class="card card-body">
						<div class="card-heading">
							<h5 class="card-title"><?php echo $title;?></h5>
							
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
						<div class="table-responsive">
							<table class="table datatable-html">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Deposit ID</th>
										<th>Deposit Amount</th>
										<th>View Proof</th>
										<th>Status</th>
										<th>Request Date</th>
										<th>Response Date</th>	
									</tr>
								</thead>
								<tbody>
									<?php 
									if(!empty($deposit_request) && count($deposit_request)>0)
									{
										$sno=0;
										foreach ($deposit_request as $request) 
										{
										$sno++;
									    if($request->status=='0')
									        $status="<b style='color:red'>Pending</b>";
									    elseif($request->status=='1')
									        $status="<b style='color:green'>Approved</b>";
									    elseif($request->status=='2')
									        $status="<b style='color:red'>Cancelled</b>";
									    $response_date=(!empty($request->response_date))?date(date_formats(),strtotime($request->response_date)):'---';

									?>
									<tr>
										<td><?php echo $sno;?></td>
										<td><?php echo $request->deposit_id;?></td>
										<td><?php echo $request->amount." ".currency();?></td>
										<td><a target="_blank" href="<?php echo base_url();?>images/<?php echo $request->file_proof;?>">View Proof</a></td>
										<td><?php echo $status;?></td>
										<td><?php echo date(date_formats(),strtotime($request->request_date));?></td>
										<td><?php echo $response_date;?></td>	
									</tr>
									<?php 		
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
                  <!-- Footer -->
                  <?php
                  //$this->load->view("common/footer-text");
                  ?>
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