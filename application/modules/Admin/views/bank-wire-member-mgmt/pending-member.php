<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">
               <div class="content">
				<?php echo $this->session->flashdata('flash_msg');?>
                 <div class="card card-body">
						<div class="card-heading">
							<h5 class="card-title">All Pending Members</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
						<div class="table-responsive">
							<table class="table datatable-responsive">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Username</th>
										<th>First</th>
										<th>Last Name</th>
										<th>Sponsor Name</th>
										<th>Sponsor ID</th>
										
										<th>Contact No.</th>
										<th>Registration Date</th>
										<th>Package</th>
										<th>View Proof</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php
									if(!empty($all_pending_member) && count($all_pending_member)>0) 
									{
										$sno=0;
										$total=0;
										foreach($all_pending_member as $member)
										{
										    //pr($member);
										    $sno++;	
										    $total=$total+$member->package_fee;
									?>
									<tr>
										<td><?php echo $sno;?></td>
										<td><?php echo $member->username;?></td>
										<td><?php echo $member->first_name;?></td>
										<td><?php echo $member->last_name;?></td>
										<td><?php echo get_user_name($member->ref_id);?></td>
										<td><?php echo $member->ref_id;?></td>
										
										<td><?php echo $member->contact_no;?></td>
										
										<td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
										<td><?php echo get_package_name($member->platform)."<br>".currency().$member->package_fee;?></td>
										<td>
										  <?php 
										  if(!empty($member->proof))
										  {
										  ?>
										   <a href="<?php echo ci_site_url();?>images/<?php echo $member->proof; ?>" target="_blank">View Proof</a>
										  <?php
										  }
										  else 
										  {
										  ?>
										   not uploaded
										  <?php 
										  }
										  ?>  
										</td>
										<td>
					                      <ul class="icons-list">
					                        <li class="dropdown">
					                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					                            <i class="icon-menu9"></i>
					                          </a>

					                          <ul class="dropdown-menu dropdown-menu-right" style="font-size: 16px;">
					                            <li><a onclick="return approveConfirm();" href="<?php echo ci_site_url();?>Admin/BankWireMemberReport/approveMember/<?php echo ID_encode($member->id);?>">Approve</a>
					                            </li>
					                            
					                            <li><a onclick="return cancelConfirm();" href="<?php echo ci_site_url();?>Admin/BankWireMemberReport/cancelMember/<?php echo ID_encode($member->id);?>">Cancel</a>
					                            </li>
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
								<tfoot>
								    <td colspan="8" style="text-alig:right">Total Package:</td>
								    <td colspan="3">
								        <?php echo currency().$total;?>
								    </td>
								</tfoot>
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
function approveConfirm()
  {
    if(window.confirm("Are you sure, you want to approve the member"))
      return true;
    else 
      return false;
  }
function cancelConfirm()
  {
    if(window.confirm("Are you sure, you want to cancel the member"))
      return true;
    else 
      return false;
  }
</script>            