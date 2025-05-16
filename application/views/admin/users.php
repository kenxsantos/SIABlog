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
            <a href="<?= base_url('admin/dashboard') ?>">POSTS</a>
            <a href="#" class="active">USERS</a>
        </div>
        <div><i class="bi bi-person-circle fs-4"></i></div>
    </div>

    <div class="container mt-4">
        <h6 class="fw-bold mb-3">ALL USERS</h6>

        <?php foreach ($users as $user): ?>
            <div class="user-box">
                <div class="user-info">
                    <i class="bi bi-person-circle"></i>
                    <strong>@<?= $user['username'] ?></strong>
                </div>
                <div>
                    <a href="<?= base_url('admin/view_user_posts/'.$user['id']) ?>" class="me-3">View All Post</a>

                    <div class="custom-actions d-inline-block">
                        <button class="menu-toggle" onclick="toggleUserMenu(this)">⋯</button>
                        <div class="action-menu">
                            <button class="edit" onclick="window.location.href='<?= base_url('admin/edit_user/'.$user['id']) ?>'">Edit User</button>
                            <button class="delete" onclick="showConfirmModal(<?= $user['id'] ?>)">Delete User</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Confirmation Modal -->
    <div class="confirm-modal" id="confirmModal">
        <p><strong>Are you sure you want to delete this user?</strong></p>
        <div>
            <button class="cancel" onclick="hideConfirmModal()">Cancel</button>
            <button class="confirm" id="confirmDeleteBtn">Yes</button>
        </div>
    </div>

    <script>
        function toggleUserMenu(button) {
            const menu = button.nextElementSibling;
            const isVisible = menu.style.display === 'block';
            document.querySelectorAll('.action-menu').forEach(m => m.style.display = 'none');
            if (!isVisible) {
                menu.style.display = 'block';
            }
        }

        document.addEventListener('click', function(event) {
            const isMenu = event.target.closest('.custom-actions');
            if (!isMenu) {
                document.querySelectorAll('.action-menu').forEach(m => m.style.display = 'none');
            }
        });

        let userToDeleteId = null;

        function showConfirmModal(userId) {
            userToDeleteId = userId;
            document.getElementById('confirmModal').style.display = 'block';
        }

        function hideConfirmModal() {
            userToDeleteId = null;
            document.getElementById('confirmModal').style.display = 'none';
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (userToDeleteId !== null) {
                window.location.href = `<?= base_url('admin/delete_user/') ?>${userToDeleteId}`;
            }
        });
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
