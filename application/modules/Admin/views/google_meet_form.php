<div class="card card-body">
    <h3>Create Google Meet</h3>

    <form method="post" action="<?= site_url('admin/googlemeet/createMeeting') ?>">
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
</div>
