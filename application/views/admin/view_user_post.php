<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Users</title>
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

        .user-box {
            background: #f4ede4;
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid #999;
            margin-bottom: 1rem;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info i {
            font-size: 2rem;
        }

        .custom-actions {
            position: relative;
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
            min-width: 130px;
        }

        .action-menu button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.5rem 1rem;
            border: none;
            background: none;
            font-weight: bold;
            cursor: pointer;
        }

        .action-menu button.edit {
            background-color: #6c757d;
            color: white;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }

        .action-menu button.delete {
            background-color: #8a3c2f;
            color: white;
            border-radius: 6px;
        }

        .menu-toggle {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
        }

        .confirm-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #843e33;
            color: white;
            padding: 2rem;
            border-radius: 12px;
            z-index: 200;
            display: none;
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        .confirm-modal button {
            margin: 1rem 0.5rem 0;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            border: none;
        }

        .confirm-modal .cancel {
            background: #6c757d;
            color: white;
        }

        .confirm-modal .confirm {
            background: #000;
            color: white;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="nav-bar">
        <div class="logo">Logo</div>
        <div>
            <a href="<?= base_url('index.php/admin/dashboard') ?>">ALL POSTS</a>
            <br>
            <strong>@<?= $user['username'] ?></strong>
        </div>
        <div><i class="bi bi-person-circle fs-4"></i></div>
    </div>

    <div class="container mt-4">
        <h6 class="fw-bold mb-3">ALL Posts</h6>

        <?php foreach ($posts as $post): ?>
            <div class="user-box">
                <div class="user-info">
                    <i class="bi bi-person-circle"></i>
                    <p><?= htmlspecialchars($post['content']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>






    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>

</html>