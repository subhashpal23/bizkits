<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h3 class="mb-3 text-center">Book a Consultation</h3>
        <form method="post" action="<?= base_url('customer/payment_success') ?>">
            <input type="hidden" name="agent_id" value="<?= $agent_id ?>">
            <div class="mb-3">
                <label for="duration" class="form-label">Select Duration</label>
                <select name="duration" id="duration" class="form-select">
                    <option value="30">30 Minutes</option>
                    <option value="60">1 Hour</option>
                    <option value="120">2 Hours</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Pay & Book</button>
        </form>
    </div>
</div>

</body>
</html>
