<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel Sidebar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Sidebar Styles */
        body {
            background-color: #f8f9fa;
            padding-left: 0; /* Remove default padding */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 16.666667%; /* col-md-2 width (2/12 = 16.666667%) */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transition: transform 0.3s ease;
            z-index: 1040;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-nav a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 15px;
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background-color: rgba(255,255,255,0.1);
            border-left-color: white;
        }

        .sidebar-nav a i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .main-content {
            margin-left: 16.666667%; /* Match sidebar width */
            transition: margin-left 0.3s;
        }

        .mobile-menu-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1050;
            background: rgba(255,255,255,0.2);
            border: none;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: 250px; /* Fixed width for mobile */
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        @media (min-width: 992px) {
            .mobile-menu-btn {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid px-0">
        <div class="row flex-nowrap">
            <!-- Sidebar Column -->
            <div class="col-md-2 px-0">
                <!-- Mobile Menu Button -->
                <button class="btn btn-outline-light mobile-menu-btn d-lg-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Sidebar -->
                <div class="sidebar" id="sidebar">
                    <div class="sidebar-header text-center">
                        <h5 class="mb-1">Admin Panel</h5>
                        <small class="text-white-50">Administrator</small>
                    </div>
                    
                    <nav class="sidebar-nav">
                        <a href="./dashboard.php" class="active">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                        <a href="./users.php">
                            <i class="fas fa-users"></i> Users
                        </a>
                        <a href="./manage_blog.php">
                            <i class="fas fa-edit"></i> Manage Blog
                        </a>
                        <a href="./manage_categories.php">
                            <i class="fas fa-tags"></i> Categories
                        </a>
                        <a href="./logout.php" class="mt-4">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            // Toggle sidebar on mobile
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 991.98) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickOnToggleButton = sidebarToggle.contains(event.target);

                    if (!isClickInsideSidebar && !isClickOnToggleButton && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Prevent sidebar toggle on larger screens
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>