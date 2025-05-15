<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #eae0d5;
        font-family: 'Segoe UI', sans-serif;
    }

    .nav-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #999;
    }

    .nav-bar a {
        margin: 0 1rem;
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    .nav-bar a.active {
        border-bottom: 2px solid #6f42c1;
    }

    .logo {
        background-color: #d6cfc1;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        text-align: center;
        line-height: 60px;
        font-weight: bold;
    }

    .post-box {
        background: #f4ede4;
        padding: 1rem;
        border-radius: 10px;
        border: 1px solid #999;
        margin-bottom: 1rem;
        position: relative;
    }

    .custom-actions {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .action-menu {
        position: absolute;
        top: 30px;
        right: 0;
        background: white;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 100;
    }

    .action-menu a {
        display: block;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: #333;
        font-weight: 500;
    }

    .action-menu a:hover {
        background-color: #f0f0f0;
    }

    .menu-toggle {
        background: transparent;
        border: none;
        font-size: 1.5rem;
        color: #6c757d;
        cursor: pointer;
    }

    textarea {
        border: 1px solid #ccc;
        width: 100%;
        border-radius: 8px;
        padding: 0.5rem;
        resize: none;
        background: #fff;
    }

    .btn-cancel {
        background-color: #8c2f1b;
        color: white;
        font-weight: bold;
        padding: 0.4rem 1.2rem;
        border: none;
        border-radius: 999px;
        margin-right: 0.5rem;
    }
    </style>
</head>

<body>
    <div class="container mt-5" style="max-width: 700px;">
        <div class="bg-light p-4 rounded-4 border position-relative" style="background-color: #f4ede4;">

            <!-- Profile Top Info -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>

                    <p class="text-muted mb-0">Hi, there! ✋</p>
                    <h5 class="fw-bold"><?= htmlspecialchars($user['username']) ?></h5>

                </div>
                <div class="rounded-circle bg-dark d-flex justify-content-center align-items-center"
                    style="width: 80px; height: 80px;">
                    <span class="text-white fs-2">👤</span>
                </div>
            </div>

            <!-- Profile Edit Form -->
            <form method="post" action="<?= base_url('index.php/user/update_profile') ?>">

                <div class="p-3 rounded-3 border mb-3" style="background-color: #fdfaf6;">
                    <div class="mb-3">
                        <label class="form-label fw-bold">USERNAME</label>
                        <input type="text" name="username" class="form-control"
                            value="<?= htmlspecialchars($user['username']) ?>" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">PASSWORD</label>
                        <input type="password" name="password" class="form-control" placeholder="**********">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">CONFIRM PASSWORD</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="**********">
                    </div>
                </div>

                <button type="submit" class="btn btn-dark px-4 py-1">SAVE CHANGES</button>
            </form>


            <!-- Logout Button -->
            <form method="post" action="<?= base_url('index.php/auth/logout') ?>" class="text-center mt-4">
                <button type="button" class="btn-cancel"
                    onclick="window.location.href='<?= base_url('index.php/user/dashboard') ?>'">Cancel</button>
                <button type="submit" class="btn btn-dark rounded-pill px-5 py-2">LOGOUT</button>
            </form>
        </div>
    </div>
</body>

</html>