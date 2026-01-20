<!-- breadcrumbs-area-start -->
<style>
.cke_notifications_area{
    display: none !important;
}
</style>
<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">my-account</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- entry-header-area-start -->
		<div class="entry-header-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="entry-header-title">
							<h2>Product Add</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- my account wrapper start -->
        <div class="my-account-wrapper mb-70">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">

								<form method="post" action="<?= site_url('product_store'); ?>" enctype="multipart/form-data">

									<!-- COMMON PRODUCT INFO -->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Category</label>
												<select name="category_id" class="form-control" required>
													<option value="">Select Category</option>
													<?php foreach($categories as $cat){ ?>
														<option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Product Name</label>
												<input type="text" name="product_name" class="form-control" required>
											</div>
										</div>
									</div>

									<!-- PLAN TABS (NEW ROW) -->
									<div class="row mt-4">
										<div class="col-md-12">

											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#basic" role="tab">Basic</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#pro" role="tab">Pro</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#enterprise" role="tab">Enterprise</a>
												</li>
											</ul>

											<div class="tab-content border p-4">

												<!-- BASIC PLAN -->
												<div class="tab-pane fade show active" id="basic" role="tabpanel">
													<div class="row">
														<div class="col-md-4">
															<label>Basic Price</label>
															<input type="number" name="basic_price" class="form-control">
														</div>

														<div class="col-md-4">
															<label>Basic Image</label>
															<input type="file" name="basic_image" class="form-control">
														</div>

														<div class="col-md-12 mt-3">
															<label>Basic Description</label>
															<textarea name="basic_description" id="basic_description"  class="form-control"></textarea>
														</div>
													</div>
												</div>

												<!-- PRO PLAN -->
												<div class="tab-pane fade" id="pro" role="tabpanel">
													<div class="row">
														<div class="col-md-4">
															<label>Pro Price</label>
															<input type="number" name="pro_price" class="form-control">
														</div>

														<div class="col-md-4">
															<label>Pro Image</label>
															<input type="file" name="pro_image" class="form-control">
														</div>

														<div class="col-md-12 mt-3">
															<label>Pro Description</label>
															<textarea name="pro_description" id="pro_description" class="form-control"></textarea>
														</div>
													</div>
												</div>

												<!-- ENTERPRISE PLAN -->
												<div class="tab-pane fade" id="enterprise" role="tabpanel">
													<div class="row">
														<div class="col-md-4">
															<label>Enterprise Price</label>
															<input type="number" name="enterprise_price" class="form-control">
														</div>

														<div class="col-md-4">
															<label>Enterprise Image</label>
															<input type="file" name="enterprise_image" class="form-control">
														</div>

														<div class="col-md-12 mt-3">
															<label>Enterprise Description</label>
															<textarea name="enterprise_description" id="enterprise_description" class="form-control"></textarea>
														</div>
													</div>
												</div>

											</div>

										</div>
									</div>

									<!-- SUBMIT -->
									<div class="row mt-4">
										<div class="col-md-12 text-right">
											<button type="submit" class="btn btn-success">
												Save Product
											</button>
										</div>
									</div>

								</form>

                            </div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<script>
    CKEDITOR.replace('basic_description');
    CKEDITOR.replace('pro_description');
    CKEDITOR.replace('enterprise_description');
</script>
        <!-- my account wrapper end -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
