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
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <div class="nav-bar">
        <div class="logo">Logo</div>
        <div>
            <a href="<?= base_url('index.php/user/dashboard') ?>">POSTS</a>
            <a href="#" class="active">EXPLORE</a>
        </div>
        <div class="profile-icon"></div>
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
                            <span class="hashtag">Hashtag1</span>
                            <span class="hashtag">Hashtag2</span>
                            <span class="hashtag">Hashtag3</span>
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
