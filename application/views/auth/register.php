<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #e9dfd7;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            border: 1px solid #3a3a3a;
            padding: 40px;
            background-color: #e9dfd7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            width: 100%;
            border-radius: 8px;
        }

        .register-left {
            flex: 1;
            display: flex;
            justify-content: center;
            padding-right: 20px;
        }

        .image-placeholder {
            width: 100%;
            max-width: 400px;
            height: 380px;
            background-color: #d4d1c2;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            font-weight: bold;
        }

        .register-right {
            flex: 1;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            width: 90px;
            height: 90px;
            background-color: #ccc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        form {
            width: 100%;
            max-width: 350px;
        }

        .btn-register {
            background-color: #1a1a1a;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-left">
            <img src="<?= base_url('assets/img/bg1.jpg') ?>" alt="Registration Visual" class="register-image" />
        </div>
        <div class="register-right">
            <div class="logo">
                <img src="<?= base_url('assets/img/logo.jpg') ?>" alt=" Logo" class="logo-image" />
            </div>
            <h3 class="fw-bold mb-3">Register</h3>
            <form method="post" action="<?= base_url('index.php/auth/register') ?>">
                <div class="form-group mb-2">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required />
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                        required>
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********" required />
                </div>
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="********" required />
                </div>
                <!-- Inside your register.php -->
                <select name="role" class="form-select" required>
                <option value="User">User</option>
                <option value="Admin">Admin</option>
                </select>

                <button class="btn btn-register" type="submit">Register</button>
                <div class="text-center mt-2">
                    <a href="<?= site_url('auth/user_login'); ?>">I already have an account</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>