<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Account Management</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li><?php echo $title;?></li>
                    </ul>
                </div>
				<?php 
					if(!empty($this->session->flashdata('flash_msg')))
					 {
					 ?>
					 <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
						  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						  <?php echo $this->session->flashdata('flash_msg');?>
					 </div>
					 <?php    
					 }
					 ?>
					<!-- Horizontal form options -->
					
					<div class="row">
					    <!--<div class="card">
					  	    <div class="card-body">-->
									<!--<div class="card-heading">
										
									</div>-->
					  	<?php 
					  	//pr($packages);
					  	if(!empty($packages) && count($packages)>0)
					  	{
					  		foreach ($packages as $package) 
					  		{
					  	?>
					  	
					  	<div class="col-md-4">
					  	   
							<div class="card card-flat border-top-success">
									<div class="card-body text-center">
									<!--<div class="border-success text-success">
										<i class="icon-book"></i>
										<img style='border-radius:50%' width="90%" src='<?php echo base_url().'images/'.$package->pkg_image;?>'>
									</div>-->
									<h5 class="text-semibold">Package Name : <?php echo $package->title;?></h5>
									<p class="mb-15">Package Amount : <?php echo currency();?> <?php echo $package->amount;?></p>
									<p class="mb-15">PV :  <?php echo $package->pv;?></p>
									<p class="mb-15">Diff Amount : <?php echo currency();?> <?php echo ($package->amount-$old_package->amount);?></p>
									<p class="mb-15">Diff PV :  <?php echo ($package->pv-$old_package->pv);?></p>
									<p class="mb-15">Level Upto : Direct Referral</p>
									<a href="<?php echo ci_site_url();?>Affiliate/Package/selectPaymentMethod/<?php echo ID_encode($package->id);?>" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Purchase Package</a>
								</div>
							</div>
						</div>
					  	<?php 	
					  		}
					  	}
					  	else 
					  	{
					  	?>
					  	<h4>No Package available for upgrade.</h4>
					  	<?php	
					  	}
					  	?>
					</div>
				</div>
			</div>
			</div>
			</div>
