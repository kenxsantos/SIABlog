<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
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

        .profile-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: black;
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

        .form-box,
        .post-box {
            background: #f4ede4;
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid #999;
            margin-bottom: 1rem;
            position: relative;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hashtag {
            margin-right: 0.5rem;
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            color: white;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .hashtag:nth-child(1) {
            background-color: #a58f72;
        }

        .hashtag:nth-child(2) {
            background-color: #d18863;
        }

        .hashtag:nth-child(3) {
            background-color: #431a04;
        }

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

        .menu-toggle {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
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

        .action-button {
            display: block;
            width: 100px;
            padding: 0.5rem;
            margin-bottom: 0.4rem;
            border: none;
            border-radius: 999px;
            font-weight: bold;
            font-size: 0.9rem;
            color: white;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .edit-btn {
            background-color: #4b4b4b;
        }

        .delete-btn {
            background-color: #8c2f1b;
        }

        .profile-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: black;
            position: relative;
        }

        .profile-icon a {
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <div class="nav-bar">
<!-- Logo -->
    <div class="">
        <a href="<?= base_url('index.php/user/dashboard') ?>">
            <img src="<?= base_url('assets/img/logo.png') ?>" style="height: 40px;">
        </a>
    </div>

    <!-- Menu Links -->
    <div>
        <a href="#" class="active" style="margin-right: 15px;">POSTS</a>
        <a href="<?= base_url('index.php/user/explore') ?>">EXPLORE</a>
    </div>

    <!-- Profile Icon -->
    <div class="profile-icon" style="width: 40px; height: 40px;">
        <a href="<?= base_url('index.php/user/edit_profile') ?>" style="display: block;">
            <img src="<?= base_url('assets/img/icon_person.png') ?>" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
        </a>
    </div>
</div>

    <!-- Main Container -->
    <div class="container mt-4">

        <!-- Add Post Form -->
        <h5 class="mb-3">ADD POST</h5>
        <div class="form-box">
        <form method="post" action="<?= base_url('index.php/user/dashboard') ?>">
                <textarea name="content" class="form-control mb-2" placeholder="What’s on your mind?" maxlength="255" required></textarea>
                <button type="button" class="btn btn-sm btn-secondary me-2">Hashtags</button>
                <button class="btn btn-sm btn-dark">Post</button>
            </form>
        </div>

        <!-- My Posts Section -->
        <h6 class="mt-4">MY POSTS</h6>
        <?php foreach ($posts as $post): ?>
            <div class="post-box position-relative">

                <!-- Post Header -->
                <div class="post-header mb-2">
                    <small class="text-muted"><?= date('F j, Y', strtotime($post['created_at'])) ?></small>
                </div>

                <!-- 3-Dot Menu -->
                <div class="custom-actions">
                    <button class="menu-toggle" onclick="toggleMenu(this)">⋯</button>
                    <div class="action-menu">
                        <a href="<?= base_url('index.php/user/edit_post/' . $post['post_id']) ?>" class="action-button edit-btn">Edit Post</a>
                        <a href="javascript:void(0);" class="action-button delete-btn" onclick="showDeleteModal('<?= base_url('index.php/user/delete_post/' . $post['post_id']) ?>')">Delete Post</a>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="position-fixed top-50 start-50 translate-middle text-white p-4 rounded-3" style="z-index: 1050; display: none; width: 400px; text-align: center; background-color: #8b3b29;">
                    <p class="mb-3 fw-bold">Are you sure you want to delete this post?</p>
                    <button onclick="hideDeleteModal()" class="btn btn-sm btn-secondary me-2">Cancel</button>
                    <button id="confirmDeleteBtn" class="btn btn-sm btn-dark">Yes</button>
                </div>

                <!-- Post Content -->
                <textarea class="form-control mb-2"><?= htmlspecialchars($post['content']) ?></textarea>

                <!-- Hashtags and Like -->
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="hashtag">Hashtag1</span>
                        <span class="hashtag">Hashtag2</span>
                        <span class="hashtag">Hashtag3</span>
                    </div>
                    <div>
                        <span class="like-icon">♥</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <!-- JavaScript -->
    <script>
        let currentDeleteUrl = "";

        function toggleMenu(button) {
            const menu = button.nextElementSibling;
            const isVisible = menu.style.display === 'block';
            document.querySelectorAll('.action-menu').forEach(m => m.style.display = 'none');
            if (!isVisible) {
                menu.style.display = 'block';
            }
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.custom-actions')) {
                document.querySelectorAll('.action-menu').forEach(m => m.style.display = 'none');
            }
        });

        function showDeleteModal(url) {
            currentDeleteUrl = url;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function hideDeleteModal() {
            currentDeleteUrl = "";
            document.getElementById('deleteModal').style.display = 'none';
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentDeleteUrl) {
                window.location.href = currentDeleteUrl;
            }
        });
    </script>

</body>

</html>