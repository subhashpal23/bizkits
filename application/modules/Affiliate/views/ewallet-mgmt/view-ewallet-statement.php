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
      <div class="row">
				<?php echo $this->session->flashdata('flash_msg');?>
                 <div class="card card-body">
						<div class="card-heading">
							<h5 class="card-title"><?php echo $title;?></h5>
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
										<th>Transaction No.</th>
										<th>Title</th>
										<?php
										if($fundtshow=='show')
										{
										    ?>
										    <th>Send By</th>
										    <th>Receive By</th>
										    <?php
										}
										?>
										<th>Balance</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Description</th>
										
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									//pr($data);
									if(!empty($all_statements) && count($all_statements)>0)
									{
										$sno=1;
										foreach ($all_statements as $statementObj) 
										{
											# code...
										$status=($statementObj->status==1)?"Credit":"Debit";
										$amount=($statementObj->status==1)?$statementObj->credit_amt:$statementObj->debit_amt;
										$sign=($statementObj->status==1)?"+":"-";
										$color=($statementObj->status==1)?"green":"red";
										?>
											<tr>
												<td><?php echo $sno;?></td>
												<td><?php echo $statementObj->transaction_no;?></td>
												<td><?php echo $statementObj->title;?></td>
												<?php
										if($fundtshow=='show')
										{
										    ?>
										    <td><?php echo get_user_name($statementObj->sender_id);?></td>
										    <td><?php echo get_user_name($statementObj->receiver_id);?></td>
										    <?php
										}
										?>
												<td><?php echo currency()."".$statementObj->balance." ";?></td>
												<td style="color:<?php echo $color;?>"><?php echo $sign.currency()."".$amount;?></td>
												<td style="color:<?php echo $color;?>"><?php echo $status;?></td>
												<td><?php echo $statementObj->description;?></td>
												
												<td><?php echo date(date_formats(),strtotime($statementObj->date));?></td>
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
                  //$this->load->view("common/footer-text");
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