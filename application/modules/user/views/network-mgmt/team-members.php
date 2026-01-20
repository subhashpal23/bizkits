<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Network Management</span> - <?php echo $title;?></h4>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo ci_site_url().$module_name;?>"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Network Management</li>
                        <li class="active"><?php echo $title;?></li>
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
							<h5 class="panel-title"><?php echo $title;?></h5>
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
										<th>User</th>
										<th>Sponsor</th>
										<th>Nom</th>
										<th>Level</th>
										<th>Leg Position</th>
										<th>Package</th>
										<th>Ewallet Amount</th>
										<th>Rank</th>
										<th>Status</th>
										<th>Register date</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($all_downline_members))
										{
											$sno=1;
											foreach ($all_downline_members as $userObj) 
											{
											$active_status=($userObj->active_status==1)?'Active':'Inactive';	
											?>
												<tr>
													<td><?php echo $sno; ?></td>
													<td><?php echo $userObj->username;?></td>
													<td><?php echo $userObj->sponsor_name;?></td>
													<td><?php echo $userObj->nom_name;?></td>
													<td><?php echo $userObj->level;?></td>
													<td><?php echo $userObj->binary_pos; ?></td>
													<td><?php echo $userObj->package_name;?></td>
													<td><?php echo $userObj->amount." ".currency();?></td>
													<td><?php echo $userObj->rank_name;?></td>
													<td><?php echo $active_status;?></td>
													<td><?php echo date(date_formats(),strtotime($userObj->registration_date));?></td>
												</tr>
											<?php	
											$sno++;
											}//end foreach
										}//end empty if
									?>
								</tbody>
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