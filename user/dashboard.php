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

// Initialize empty arrays for activities and notifications
$recentActivities = [];
$notifications = [];
?>
<!DOCTYPE html>
<html lang="en">

<?php include "./assets/includes/header.php" ?>

<body>
    <!-- Sidebar Toggle Button (visible only on mobile) -->
    <button class="btn btn-primary sidebar-toggle d-lg-none position-fixed" style="z-index: 999; top: 10px; left: 10px;">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay (mobile only) -->
    <div class="sidebar-overlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Column -->
            <?php include "./assets/includes/sidebar.php" ?>

            <!-- Main Content Column -->
            <div class="col-lg-10 py-4 main-content">
                <header class="dashboard-header">
                    <div>
                        <h1 class="mb-1">Dashboard</h1>
                        <p class="text-muted">Welcome back, <?php echo htmlspecialchars($user['username']); ?>!</p>
                    </div>
                    <a href="../index.php" class="btn btn-outline-primary">
                        <i class="fas fa-home me-2"></i> Back to Home
                    </a>
                </header>

                <!-- Stats Summary Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <i class="fas fa-newspaper"></i>
                            <h2><?php echo $blogCount; ?></h2>
                            <p>Total Blogs</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card" style="background: linear-gradient(135deg, var(--success-color), var(--accent-color));">
                            <i class="fas fa-comments"></i>
                            <h2><?php echo $commentCount; ?></h2>
                            <p>Total Comments</p>
                        </div>
                    </div>
                </div>

                <div class="dashboard-cards">
                    <!-- Personal Information Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h5 class="card-title">Personal Information</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Username:</th>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>CNIC:</th>
                                        <td><?php echo htmlspecialchars($user['cnic']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <?php include "./assets/includes/js.php" ?>
    <!-- Your custom JS -->
    <script src="assets/js/script.js"></script>

</body>

</html>