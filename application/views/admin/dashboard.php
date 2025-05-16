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
    .logo-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;

        }
        .btn-cancel {
        background-color: #8c2f1b;
        color: white;
        font-weight: bold;
        padding: 0.4rem 1.2rem;
        border: none;
        border-radius:10px;
        margin-right: 0.5rem;
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="nav-bar">
    <img src="<?= base_url('assets/image/logo.png') ?>" alt="Logo" class="logo-img">
        <div>
            <a href="#" class="active">POSTS</a>
            <a href="<?= base_url('index.php/admin/users') ?>">USERS</a>
        </div>
        <div>

        <form method="post" action="<?= base_url('index.php/auth/logout') ?>" class="text-center mt-4">
        <button  type="submit" class="btn-cancel"
        onclick="window.location.href='<?= base_url('index.php/admin/dashboard') ?>'">Logout</button>
            </form>
       
        </div>
    </div>

    <div class="container mt-4">
        <h6 class="fw-bold mb-3">ALL POSTS</h6>

        <?php foreach ($posts as $post): ?>
        <div class="post-box position-relative">
            <div class="custom-actions">
                <button class="menu-toggle" onclick="toggleMenu(this)">⋯</button>
                <div class="action-menu">
                    <a href="<?= base_url('index.php/admin/edit_post/' . $post['post_id']) ?>"
                        class="action-button edit-btn">Edit
                        Post</a>
                    <a href="javascript:void(0);" class="action-button delete-btn"
                        onclick="showDeleteModal('<?= base_url('index.php/admin/delete_post/' . $post['post_id']) ?>')">Delete
                        Post</a>
                </div>
            </div>

            <div id="deleteModal" class="position-fixed top-50 start-50 translate-middle text-white p-4 rounded-3"
                style="z-index: 1050; display: none; width: 400px; text-align: center; background-color: #8b3b29;">
                <p class="mb-3 fw-bold">Are you sure you want to delete this post?</p>
                <button onclick="hideDeleteModal()" class="btn btn-sm btn-secondary me-2">Cancel</button>
                <button id="confirmDeleteBtn" class="btn btn-sm btn-dark">Yes</button>
            </div>

            <div>
                <strong>@<?= htmlspecialchars($post['username']) ?></strong>
            </div>

            <div class="d-flex justify-content-between mb-2">
            <p class="form-control mb-2"><?= htmlspecialchars($post['content']) ?></p>
               
            </div>

            <div class="d-flex justify-content-between align-items-center">
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
    <!-- Profile Section -->


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
        const isMenu = event.target.closest('.custom-actions');
        if (!isMenu) {
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