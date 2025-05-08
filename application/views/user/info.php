<!DOCTYPE html>
<html>
<head>
    <title>User Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Profile Information</h3>
    <form method="post" action="<?= base_url('user/update_info') ?>">
        <div class="form-group mb-3">
            <label>Username</label>
            <input type="text" name="username" value="johndoe" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label>Bio</label>
            <textarea name="bio" class="form-control" rows="3">Just a blogger!</textarea>
        </div>
        <hr>
        <h4>Change Password</h4>
        <div class="form-group mb-2">
            <label>Old Password</label>
            <input type="password" name="old_password" class="form-control">
        </div>
        <div class="form-group mb-2">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control">
        </div>
        <button class="btn btn-success mt-2">Update</button>
    </form>
</div>
</body>
</html>
