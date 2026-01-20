
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
							<h2>Google Meet Create</h2>
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
                            <form method="post" action="<?= site_url('webgooglemeet/createMeeting') ?>">
								<div class="form-group">
									<label>Meeting Date:</label>
									<input type="date" name="meet_date" class="form-control" required>
								</div>

								<div class="form-group">
									<label>Start Time:</label>
									<input type="time" name="start_time" class="form-control" required>
								</div>

								<div class="form-group">
									<label>End Time:</label>
									<input type="time" name="end_time" class="form-control" required>
								</div>

								<button type="submit" class="btn btn-primary mt-2">Generate Google Meet</button>
							</form>
						</div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
		