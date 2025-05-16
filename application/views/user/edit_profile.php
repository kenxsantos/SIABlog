<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eae0d5;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-box {
            background: #f4ede4;
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid #999;
            max-width: 500px;
            margin: 4rem auto;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }

        .btn-update {
            background-color: #4b4b4b;
            color: white;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h4 class="mb-4 text-center">Edit Profile</h4>

            <form action="<?= base_url('index.php/user/update_profile') ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        value="<?= htmlspecialchars($this->session->userdata('username')) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password (optional)</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Leave blank to keep current password">
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Retype new password">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('index.php/user/dashboard') ?>" class="btn btn-secondary">Cancel</a>
                    <div>
                        <a href="<?= base_url('index.php/user/logout') ?>" class="btn btn-outline-danger me-2">Logout</a>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>