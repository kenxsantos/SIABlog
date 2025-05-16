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


        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;

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
            padding: 5px 10px;
            border-radius: 8px;
            color: white;
            font-size: 0.8rem;
            font-weight: bold;
            border-radius: 100px;
        }

        .hashtag:nth-child(1) {
            background-color: rgba(0, 248, 132, 0.77);
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

        .profile-icon img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .badge-radio {
            display: inline-block;
            margin-right: 10px;
            cursor: pointer;
            position: relative;
        }

        .badge-radio input[type="radio"] {
            display: none;
        }

        .badge-radio span {
            display: inline-block;
            background-color: #e0e0e0;
            color: #333;
            padding: 5px 12px;
            border-radius: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .badge-radio input[type="radio"]:checked+span {
            background-color: #007bff;
            color: white;
        }
    </style>

    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <div class="nav-bar">
        <img src="<?= base_url('assets/image/logo.png') ?>" alt="Logo" class="logo-img">
        <div>
            <a href="#" class="active">POSTS</a>
            <a href="<?= site_url('user/explore') ?>">EXPLORE</a>
        </div>
        <div class="profile-icon">
            <a href="<?= base_url('index.php/user/edit_profile') ?>">
                <img src="<?= base_url('assets/image/profile.png') ?>" alt="Profile">
            </a>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container mt-4">

        <!-- Add Post Form -->
        <h5 class="mb-3">ADD POST</h5>
        <div class="form-box">
            <form method="post" action="<?= base_url('index.php/user/dashboard') ?>">
                <textarea name="content" class="form-control mb-2" placeholder="What’s on your mind?" maxlength="255"
                    required></textarea>

                <?php foreach ($tags as $tag): ?>
                    <label class="badge-radio">
                        <input type="radio" name="tag_id" value="<?= $tag['id'] ?>" required>
                        <span><?= htmlspecialchars($tag['name']) ?></span>
                    </label>
                <?php endforeach; ?>
                <br>
                <br>
                <button class="btn btn-sm btn-dark">Post</button>
            </form>
        </div>

        <!-- My Posts Section -->
        <h6 class="mt-4">BLOGS FEED</h6>
        <?php foreach ($posts as $post): ?>
            <div class="post-box position-relative">

                <!-- Post Header -->


                <!-- 3-Dot Menu -->
                <div class="custom-actions">
                    <button class="menu-toggle" onclick="toggleMenu(this)">⋯</button>
                    <div class="action-menu">
                        <a href="<?= base_url('index.php/user/edit_post/' . $post['post_id']) ?>"
                            class="action-button edit-btn">Edit
                            Post</a>
                        <a href="javascript:void(0);" class="action-button delete-btn"
                            onclick="showDeleteModal('<?= base_url('index.php/user/delete_post/' . $post['post_id']) ?>')">Delete
                            Post</a>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="position-fixed top-50 start-50 translate-middle text-white p-4 rounded-3"
                    style="z-index: 1050; display: none; width: 400px; text-align: center; background-color: #8b3b29;">
                    <p class="mb-3 fw-bold">Are you sure you want to delete this post?</p>
                    <button onclick="hideDeleteModal()" class="btn btn-sm btn-secondary me-2">Cancel</button>
                    <button id="confirmDeleteBtn" class="btn btn-sm btn-dark">Yes</button>
                </div>
                <strong>@<?= htmlspecialchars($post['username']) ?></strong>
                <p class="form-control mb-2"><?= htmlspecialchars($post['content']) ?></p>
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="hashtag"><?= htmlspecialchars($post['tag_name']) ?></span>
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