<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eae0d5;
            font-family: 'Segoe UI', sans-serif;
        }

        .profile-icon img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
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
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <div class="nav-bar">
        <img src="<?= base_url('assets/image/logo.png') ?>" alt="Logo" class="logo-img">
        <div>
            <a href="<?= site_url('user/dashboard') ?>">POSTS</a>
            <a href="<?= site_url('user/explore') ?>" class=" active">EXPLORE</a>
        </div>
        <div class="profile-icon">
            <a href="<?= base_url('index.php/user/edit_profile') ?>">
                <img src="<?= base_url('assets/image/profile.png') ?>" alt="Profile">
            </a>
        </div>
    </div>


    <!-- Explore Posts Section -->
    <div class="container mt-4">
        <h6 class="mb-3 fw-bold">ALL POSTS</h6>

        <?php foreach ($posts as $post): ?>
            <?php if (!empty($post['content'])): ?>
                <div class="post-box">
                    <!-- Post Header (Date) -->
                    <div class="post-header mb-2">
                        <small class="text-muted"><?= date('F j, Y', strtotime($post['created_at'])) ?></small>
                    </div>

                    <!-- Post Content -->
                    <textarea class="form-control mb-2" readonly><?= htmlspecialchars($post['content']) ?></textarea>

                    <!-- Hashtags & Like -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="hashtag"><?= htmlspecialchars($post['tag_name']) ?></span>
                        </div>
                        <div>
                            <span class="like-icon">♥</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</body>

</html>