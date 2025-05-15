<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
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

    .edit-form {
        background: #f4ede4;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid #999;
    }

    .hashtag-btn {
        background-color: #a58f72;
        color: white;
        font-weight: bold;
        padding: 0.4rem 1rem;
        border: none;
        border-radius: 10px;
        font-size: 0.9rem;
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

    .btn-save {
        background-color: #1d1d1d;
        color: white;
        font-weight: bold;
        padding: 0.4rem 1.2rem;
        border: none;
        border-radius: 999px;
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
</head>

<body>

    <!-- Navigation -->
    <div class="nav-bar">
        <div class="logo">Logo</div>
        <div>
            <a href="#" class="active">POSTS</a>
            <a href="#">EXPLORE</a>
        </div>
        <div class="profile-icon"></div>
    </div>

    <!-- Edit Post Form -->
    <div class="container mt-4">
        <h6 class="mb-3 fw-bold">EDIT POST</h6>
        <div class="edit-form">
            <form method="post" action="<?= base_url('index.php/admin/edit_post/' . $post['post_id']) ?>">
                <textarea class="form-control mb-3" name="content" rows="6" maxlength="255"
                    required><?= htmlspecialchars($post['content']) ?></textarea>
                <?php foreach ($tags as $tag): ?>
                <label class="badge-radio">
                    <input type="radio" name="tag_id" value="<?= $tag['id'] ?>"
                        <?= $tag['id'] == $post['tag_id'] ? 'checked' : '' ?>>
                    <span><?= htmlspecialchars($tag['name']) ?></span>
                </label>
                <?php endforeach; ?>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-cancel"
                        onclick="window.location.href='<?= base_url('index.php/admin/dashboard') ?>'">Cancel</button>
                    <button class="btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>