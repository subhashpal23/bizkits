<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Meeting Link</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
    function checkExpiry(endTime) {
        const end = new Date(endTime).getTime();
        const now = new Date().getTime();
        const diff = end - now;

        if (diff <= 0) {
            document.getElementById('expired').style.display = 'block';
            document.getElementById('active').style.display = 'none';
        } else {
            const minutes = Math.floor(diff / 60000);
            document.getElementById('timer').innerText = minutes + ' min remaining';
        }
    }
    window.onload = function() {
        checkExpiry('<?= $booking->meet_end ?>');
        setInterval(() => checkExpiry('<?= $booking->meet_end ?>'), 60000);
    };
    </script>
</head>
<body class="bg-light">

<div class="container mt-5 text-center">
    <div class="card shadow-lg p-4">
        <h3>Consultation Meeting</h3>
        <p><strong>Start:</strong> <?= $booking->meet_start ?><br>
           <strong>End:</strong> <?= $booking->meet_end ?></p>

        <?php if (strtotime($booking->meet_end) > time()): ?>
            <div id="active">
                <p id="timer" class="text-success"></p>
                <a href="<?= $booking->meet_link ?>" target="_blank" class="btn btn-primary">Join Google Meet</a>
            </div>
        <?php endif; ?>

        <div id="expired" style="display:none;">
            <p class="text-danger fw-bold">Meeting Expired</p>
            <a href="<?= base_url('customer/book/'.$booking->agent_id) ?>" class="btn btn-secondary">Book Again</a>
        </div>
    </div>
</div>

</body>
</html>
