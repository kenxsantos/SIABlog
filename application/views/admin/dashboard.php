<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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

        .hashtag {
            margin-right: 0.5rem;
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            color: white;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .hashtag:nth-child(1) { background-color: #a58f72; }
        .hashtag:nth-child(2) { background-color: #d18863; }
        .hashtag:nth-child(3) { background-color: #431a04; }

        .like-icon {
            color: #a58f72;
            font-size: 1.2rem;
            cursor: pointer;
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="nav-bar">
        <div class="logo">Logo</div>
        <div>
            <a href="#" class="active">POSTS</a>
            <a href="#">USERS</a>
        </div>
        <div><i class="bi bi-person-circle fs-4"></i></div>
    </div>

    <div class="container mt-4">
        <h6 class="fw-bold mb-3">ALL POSTS</h6>

        <?php foreach ($posts as $post): ?>
            <div class="post-box position-relative">
                <div class="custom-actions">
                    <button class="menu-toggle" onclick="toggleMenu(this)">⋯</button>
                    <div class="action-menu">
                    <a href="<?= base_url('user/edit_post/' . $post['post_id']) ?>" class="action-button edit-btn">Edit Post</a>
                    <a href="javascript:void(0);" class="action-button delete-btn" onclick="showDeleteModal('<?= base_url('user/delete_post/' . $post['post_id']) ?>')">Delete Post</a>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <textarea readonly><?= htmlspecialchars($post['content']) ?></textarea>
                    <small class="text-muted ms-2">Date: <?= date('F j, Y', strtotime($post['created_at'])) ?></small>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <?php foreach (explode(',', $post['hashtags']) as $i => $tag): ?>
                            <span class="hashtag"><?= trim($tag) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div>
                        <span class="like-icon">♥</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Profile Section -->
<div class="container mt-5" style="max-width: 700px;">
    <div class="bg-light p-4 rounded-4 border position-relative" style="background-color: #f4ede4;">

        <!-- Profile Top Info -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold">USERNAME</h5>
                <p class="text-muted mb-0">Add Bio……..</p>
            </div>
            <div class="rounded-circle bg-dark d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                <span class="text-white fs-2">👤</span>
            </div>
        </div>

        <!-- Profile Edit Form -->
        <form method="post" action="<?= base_url('user/update_profile') ?>">
            <div class="p-3 rounded-3 border mb-3" style="background-color: #fdfaf6;">
                <div class="mb-3">
                    <label class="form-label fw-bold">USERNAME</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
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
        <form method="post" action="<?= base_url('auth/logout') ?>" class="text-center mt-4">
            <button type="submit" class="btn btn-dark rounded-pill px-5 py-2">LOGOUT</button>
        </form>
    </div>
</div>

    <script>
        function toggleMenu(button) {
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
    </script>
</body>
</html>
