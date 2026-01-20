<?php
date_default_timezone_set('Asia/Kolkata');

$startDateTime = $event->getStart()->getDateTime();
$endDateTime   = $event->getEnd()->getDateTime();

$startDate = date('d M Y', strtotime($startDateTime));
$startTime = date('h:i A', strtotime($startDateTime));
$endTime   = date('h:i A', strtotime($endDateTime));

$meetLink = $event->getHangoutLink();
?>

<div class="card card-body">
    <h3>Google Meet Created</h3>

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
