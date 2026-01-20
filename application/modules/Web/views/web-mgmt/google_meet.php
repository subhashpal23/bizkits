<?php
date_default_timezone_set('Asia/Kolkata');

$startDateTime = $event->getStart()->getDateTime();
$endDateTime   = $event->getEnd()->getDateTime();

$startDate = date('d M Y', strtotime($startDateTime));
$startTime = date('h:i A', strtotime($startDateTime));
$endTime   = date('h:i A', strtotime($endDateTime));

$meetLink = $event->getHangoutLink();
?>

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
							<h2>Google Meet Generate</h2>
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
                            <p><strong>Date:</strong> <?= $startDate ?></p>
							<p><strong>Start Time:</strong> <?= $startTime ?></p>
							<p><strong>End Time:</strong> <?= $endTime ?></p>

							<!-- Link Show -->
							<div class="form-group">
								<label><strong>Google Meet Link:</strong></label>
								<input type="text" id="meetLink" class="form-control" value="<?= $meetLink ?>" readonly>
								<button class="btn btn-primary" onclick="copyMeetLink()">
								Copy Link
							</button>

							<p id="copyMsg" style="color:green;margin-top:10px;display:none;">
								✔ Link Copied Successfully
							</p>
							</div>

							<!-- Buttons -->
							<a href="<?= $meetLink ?>" target="_blank" class="btn btn-success">
								Join Meet
							</a>

						</div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
		

<script>
function copyMeetLink() {
    var copyText = document.getElementById("meetLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999); // mobile support
    document.execCommand("copy");

    document.getElementById("copyMsg").style.display = "block";
}
</script>