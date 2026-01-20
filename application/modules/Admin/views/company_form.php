<div class="dashboard-content-one">
	<div class="breadcrumbs-area">
		<h3>Company Details</h3>
		<ul>
			<li>
				<a href="<?php echo base_url()."Admin";?>">Home</a>
			</li>
			<li>Company Details</li>
			<hr>
			<br>
			<div class="card card-body">
			<?php if ($this->session->flashdata('success')) { ?>
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?= $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>
				<div class="card-body">
					<form method="post" action="<?= base_url('Admin/company/save') ?>">

						<div class="form-group">
							<label class="col-lg-3 control-label">Company Name:</label>
							<div class="col-lg-9">
								<input type="text" name="company_name"
									value="<?= isset($company->company_name) ? $company->company_name : '' ?>"
									required class="form-control" placeholder="Company Name">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">GST Number:</label>
							<div class="col-lg-9">
								<input type="text" name="gst_number"
									value="<?= isset($company->gst_number) ? $company->gst_number : '' ?>"
									class="form-control" placeholder="GST Number (15 characters)">
							</div>
						</div>

						<!-- Email -->
						<div class="form-group">
							<label class="col-lg-3 control-label">Email:</label>
							<div class="col-lg-9">
								<input type="email" name="email"
									value="<?= isset($company->email) ? $company->email : '' ?>"
									class="form-control" placeholder="Email">
							</div>
						</div>

						<!-- Phone -->
						<div class="form-group">
							<label class="col-lg-3 control-label">Phone:</label>
							<div class="col-lg-9">
								<input type="text" name="phone"
									value="<?= isset($company->phone) ? $company->phone : '' ?>"
									class="form-control" placeholder="Phone Number">
							</div>
						</div>

						<!-- Address -->
						<div class="form-group">
							<label class="col-lg-3 control-label">Address:</label>
							<div class="col-lg-9">
								<textarea name="address" class="form-control"
										placeholder="Company Address"><?= isset($company->address) ? $company->address : '' ?></textarea>
							</div>
						</div>

						<!-- Submit -->
						<div class="form-group">
							<div class="col-lg-offset-3 col-lg-9">
								<button type="submit" class="btn btn-success">Save</button>
							</div>
						</div>

					</form>
				</div>
			</div>
			
		</ul>
	</div>
</div>
                
