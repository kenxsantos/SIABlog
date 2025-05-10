<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
        background-color: #e9dfd7;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

        .login-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .btn-login {
        background-color:#797979;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease, opacity 0.3s ease;
        }

        .btn-login:hover {
        opacity: 0.8;
        background-color:rgb(0, 0, 0); 
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 login-card text-center">
            <img src="<?= base_url('assets/image/logo.jpg') ?>" alt="Logo" class="logo-img">
            <h3 class="mb-4">User Login</h3>
            <form method="post" action="<?= base_url('index.php/auth/user_login') ?>">
                <div class="form-group mb-3 text-start">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3 text-start">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-login w-100">Login</button>
                <div class="text-center mt-3">
                <p>Don't have an account? <a href="<?= site_url('auth/register') ?>">Create one</a></p>
                <p><a href="<?= site_url('auth/admin_login') ?>">Go to Admin Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
