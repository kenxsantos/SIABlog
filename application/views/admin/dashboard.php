<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Admin Dashboard - Manage Posts</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Post ID</th>
                <th>User</th>
                <th>Content</th>
                <th>Hashtags</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop your posts here -->
            <tr>
                <td>1</td>
                <td>johndoe</td>
                <td>Welcome to my blog!</td>
                <td>#welcome</td>
                <td><button class="btn btn-danger btn-sm">Delete</button></td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
