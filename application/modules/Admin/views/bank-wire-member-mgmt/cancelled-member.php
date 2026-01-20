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
							<h5 class="card-title">All Cancelled Members</h5>
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
										<th>Email</th>
										<th>Contact No.</th>
										<th>View Proof</th>
										<th>Cancelled Date</th>
										<th>Registration Date</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(!empty($all_cancelled_member) && count($all_cancelled_member)>0) 
									{
										$sno=0;
										foreach($all_cancelled_member as $member)
										{
										$sno++;	
									?>
									<tr>
										<td><?php echo $sno;?></td>
										<td><?php echo $member->username;?></td>
										<td><?php echo $member->first_name;?></td>
										<td><?php echo $member->last_name;?></td>
										<td><?php echo $member->email;?></td>
										<td><?php echo $member->contact_no;?></td>
										<td><a href="<?php echo ci_site_url();?>images/<?php echo $member->proof; ?>" target="_blank">View Proof</a></td>
										<td><?php echo date(date_formats(),strtotime($member->action_date));?></td>
										<td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
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