<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agent Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h3 class="mb-4 text-center">Welcome, <?= htmlspecialchars($agent->name ?? 'Agent') ?></h3>

        <div class="mb-4 text-center">
            <?php if ($isConnected): ?>
                <div class="alert alert-success">
                    ✅ <strong>Google Calendar Connected!</strong><br>
                    You can now receive Google Meet links automatically when customers book.
                </div>
                <a href="<?= base_url('google/auth') ?>" class="btn btn-warning mt-2">Reconnect Google</a>
            <?php else: ?>
                <div class="alert alert-danger">
                    ⚠️ <strong>Google Calendar not connected.</strong><br>
                    Please connect your Google account to enable Meet link generation.
                </div>
                <a href="<?= base_url('google/auth') ?>" class="btn btn-primary">Connect Google Calendar</a>
            <?php endif; ?>
        </div>

        <hr>

        <h5>Booking Info (example)</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Duration</th>
                    <th>Meet Link</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings ?? [])): ?>
                    <?php foreach ($bookings as $b): ?>
                    <tr>
                        <td><?= htmlspecialchars($b->customer_name) ?></td>
                        <td><?= $b->duration ?> min</td>
                        <td>
                            <?php if ($b->meet_link): ?>
                                <a href="<?= $b->meet_link ?>" target="_blank">Join Meeting</a>
                            <?php else: ?>
                                <span class="text-muted">Not generated</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($b->meet_link && strtotime($b->meet_end) < time()): ?>
                                <span class="badge bg-danger">Expired</span>
                            <?php elseif ($b->meet_link): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Pending</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center text-muted">No bookings yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
