<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }

        .container {
            margin-top: 100px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>User Registration</h3>
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url('index.php/auth/register') ?>">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Enter your username" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter your password" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                            placeholder="Confirm your password" required>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Register</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <p>Already have an account? <a href="<?= base_url('auth/user_login') ?>">Login here</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>