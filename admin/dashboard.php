<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Get dashboard statistics
$total_users = 0;
$pending_blogs = 0;
$total_categories = 0;
$user_growth_data = [];

try {
    // Total Users
    $total_users_stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users");
    $total_users_stmt->execute();
    $total_users_result = $total_users_stmt->get_result()->fetch_assoc();
    $total_users = $total_users_result['total_users'];

    // Total Categories
    $categories_stmt = $conn->prepare("SELECT COUNT(*) as total_categories FROM categories");
    $categories_stmt->execute();
    $categories_result = $categories_stmt->get_result()->fetch_assoc();
    $total_categories = $categories_result['total_categories'];

    // Query to count pending blogs
    $sql = "SELECT COUNT(*) AS total FROM blog_posts WHERE approval_status = 'pending'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $pendingCount = $row['total'];

} catch (mysqli_sql_exception $e) {
    error_log("Database query error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 0.6rem;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        .card-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 2.5rem;
            opacity: 0.3;
        }
    </style>
</head>

<body>
    <!--sidebar -->
    <?php include "./includes/sidebar.php"; ?>

    <!-- Main Content -->
    <div class="main-content col-md-10" id="mainContent">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Overview</h2>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2 class="card-text"><?= $total_users ?></h2>
                        <div class="d-flex align-items-center">
                            <span class="me-2">+12%</span>
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <i class="fas fa-users card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title">Pending Blogs</h5>
                        <h2 class="card-text"><?= $pendingCount ?></h2>
                        <div class="d-flex align-items-center">
                            <span class="me-2">+<?= $pendingCount ?></span>
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <i class="fas fa-tasks card-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Categories</h5>
                        <h2 class="card-text"><?= $total_categories ?></h2>
                        <div class="d-flex align-items-center">
                            <span class="me-2">+2</span>
                            <i class="fas fa-plus"></i>
                        </div>
                        <i class="fas fa-tags card-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Growth Chart -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">User Growth</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="growthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        // User Growth Chart
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        const growthChart = new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'User Growth',
                    data: [12, 19, 3, 5, 2, 3, 10],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>