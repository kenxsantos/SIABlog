<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h3>Create a New Post</h3>
        <form method="post" action="<?= base_url('index.php/user/create_post') ?>">
            <textarea name="content" class="form-control mb-3" placeholder="Write a one-sentence post..."
                maxlength="255" required></textarea>
            <button class="btn btn-primary">Post</button>
        </form>

        <hr>
        <h4>My Posts</h4>
        <ul class="list-group">
            <?php foreach ($posts as $post): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($post['username'] ?? 'User') ?>:</strong>
                    <?= htmlspecialchars($post['content']) ?>
                    <small class="text-muted float-end"><?= $post['created_at'] ?></small>
                </li>
            <?php endforeach; ?>
        </ul>