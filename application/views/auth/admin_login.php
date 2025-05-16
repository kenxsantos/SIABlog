<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f5f2;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }
        .login-container {
            border: 2px solid violet;
            padding: 30px;
            background-color: #e9dfd7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .login-left {
            flex: 1;
            padding: 20px;
        }
        .login-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .btn-login {
            background-color: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 6px;
            transition: background-color 0.3s, opacity 0.3s;
        }
        .btn-login:hover {
            opacity: 0.85;
        }
        .text-center a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="row" style="width: 90%; max-width: 1000px; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <div class="login-left">
                <div class="logo">
                    <img src="<?= base_url('assets/img/logo.jpg') ?>" alt="Logo">
                </div>
                <h3 class="text-center fw-bold">Admin Login</h3>
                <form method="post" action="<?= base_url('auth/admin_login') ?>">
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="#">Forgot Password?</a>
                        <a href="<?= site_url('auth/register') ?>">Go to Register</a>
                    </div>
                    <button class="btn btn-login w-100 mb-2">Login</button>
                </form>
            </div>
            <div class="login-right">
                <img src="<?= base_url('assets/img/bg1.jpg') ?>" alt="Login Visual" class="img-fluid rounded shadow" style="max-height: 65vh; max-width: 70%; object-fit: cover;">
            </div>
        </div>
    </div>
</body>
</html>
