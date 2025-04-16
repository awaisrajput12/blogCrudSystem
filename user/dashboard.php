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
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch total blogs by this user (FIXED: using user_id instead of id)
$stmt = $conn->prepare("SELECT COUNT(*) as total_blogs FROM blog_posts WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$blogResult = $stmt->get_result();
$blogCount = $blogResult->fetch_assoc()['total_blogs'];
$stmt->close();

// Fetch total comments by this user (FIXED: using user_id instead of id)
$stmt = $conn->prepare("SELECT COUNT(*) as total_comments FROM comments WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$commentResult = $stmt->get_result();
$commentCount = $commentResult->fetch_assoc()['total_comments'];
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">


<body>
    <!-- Sidebar Toggle Button (visible only on mobile) -->
    <button class="btn sidebar-toggle d-md-none">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay (mobile only) -->
    <div class="sidebar-overlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Column (col-md-2) -->
            <?php include "includes/sidebar.php" ?>

            <!-- Main Content Column (col-md-10) -->
            <div class="col-md-10 main-content">
                <header class="dashboard-header">
                    <div>
                        <h1 class="mb-2">Dashboard</h1>
                        <p class="text-muted">Welcome back, <?php echo htmlspecialchars($user['username']); ?>!</p>
                    </div>
                    <!-- Add this back button -->
                    <a href="../index.php" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i> Back to Index
                    </a>
                </header>
                <!-- Blog & Comment Stats Card -->
                <div class="card my-4">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h5 class="card-title">Your Content</h5>
                        <p><strong>Total Blogs:</strong> <?php echo $blogCount; ?></p>
                        <p><strong>Total Comments:</strong> <?php echo $commentCount; ?></p>
                    </div>
                </div>

                <div class="dashboard-cards">
                    <!-- Personal Information Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h5 class="card-title">Personal Information</h5>
                            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                            <p><strong>CNIC:</strong> <?php echo htmlspecialchars($user['cnic']); ?></p>
                            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                        </div>
                    </div>

                    <!-- Recent Activities Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <h5 class="card-title">Recent Activities</h5>
                            <?php if (!empty($recentActivities)): ?>
                                <ul class="list-unstyled">
                                    <?php foreach ($recentActivities as $activity): ?>
                                        <li>
                                            <?php echo htmlspecialchars($activity['action']); ?>
                                            <small class="text-muted">
                                                (<?php echo htmlspecialchars($activity['date']); ?>)
                                            </small>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No recent activities</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Notifications Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <h5 class="card-title">Notifications</h5>
                            <?php if (!empty($notifications)): ?>
                                <div class="notifications-list">
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($notifications as $notification): ?>
                                            <li class="list-group-item <?php echo htmlspecialchars($notification['type']); ?>">
                                                <?php echo htmlspecialchars($notification['message']); ?>
                                                <span class="badge bg-primary">New</span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <p>No new notifications</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>