<?php
// Start the session to access user information
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
require_once '../config/db.php';

// Fetch user details using session user ID
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, role FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Check if user is admin
$isAdmin = ($user['role'] ?? '') === 'admin';

// Fetch all blog posts with category names
$query = "SELECT bp.*, c.name as category_name 
          FROM blog_posts bp 
          LEFT JOIN categories c ON bp.category = c.id 
          ORDER BY bp.created_at DESC";
$result = $conn->query($query);
$blog_posts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blog_posts[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
        }
        .container-fluid {
            display: flex;
        }
        .content-area {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 50px;
            margin-left: auto;
            width: calc(100% - 350px);
        }
        .btn-primary {
            background-color: #2575fc;
            border-color: #2575fc;
        }
        .btn-danger {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }
        .btn-success {
            background-color: #48bb78;
            border-color: #48bb78;
        }
        .thumbnail-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .table-actions {
            display: flex;
            gap: 5px;
        }
        .truncate-text {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <?php include "includes/sidebar.php" ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper w-100">
            <div class="content-area">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Blog Posts Management</h2>
                </div>

                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_SESSION['success_message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_SESSION['error_message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($blog_posts)): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4">No blog posts found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($blog_posts as $post): ?>
                                    <tr>
                                        <td><?= $post['id'] ?></td>
                                        <td>
                                            <?php if (!empty($post['image_path'])): ?>
                                                <img src="<?= htmlspecialchars($post['image_path']) ?>" class="thumbnail-img" alt="Blog thumbnail">
                                            <?php else: ?>
                                                <div class="bg-light d-flex align-items-center justify-content-center" style="width:60px;height:60px;border-radius:5px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="truncate-text" title="<?= htmlspecialchars($post['title']) ?>">
                                            <?= htmlspecialchars($post['title']) ?>
                                        </td>
                                        <td><?= htmlspecialchars($post['author']) ?></td>
                                        <td><?= htmlspecialchars($post['category_name'] ?? 'Uncategorized') ?></td>
                                        <td>
                                            <?= $post['is_approved'] ? 
                                                '<span class="badge bg-success">Approved</span>' : 
                                                '<span class="badge bg-warning">Pending</span>' 
                                            ?>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($post['created_at'])) ?></td>
                                        <td>
                                            <div class="table-actions">
                                                <?php if ($isAdmin && !$post['is_approved']): ?>
                                                    <a href="approve_blog.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-success" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="delete_blog.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>