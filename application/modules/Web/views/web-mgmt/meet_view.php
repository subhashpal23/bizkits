
    <script src="https://meet.jit.si/external_api.js"></script>

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
		<div class="entry-header-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="entry-header-title">
							<h2>Video Call</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="my-account-wrapper mb-70">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
						<div id="jitsi-container" style="width:100%; height:100vh;"></div>

</div>
</div>
</div>
</div>
</div>

<script>
    const domain = "meet.jit.si";
    const options = {
        roomName: "<?php echo $room; ?>",
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#jitsi-container'),
        userInfo: {
            displayName: "Guest User"
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);
</script>
