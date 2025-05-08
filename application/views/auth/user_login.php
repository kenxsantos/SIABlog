<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5 col-md-4">
        <h3 class="text-center mb-4">User Login</h3>
        <form method="post" action="<?= base_url('index.php/auth/user_login') ?>">
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-success w-100">Login</button>
        </form>
    </div>
</body>

</html>