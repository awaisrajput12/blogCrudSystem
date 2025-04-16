<?php
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark navbar-custom py-2">
    <div class="container">
        <!-- Brand/logo on the left -->
        <a class="navbar-brand fs-2" href="index.php">BLOG PRO</a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left-aligned links (empty in this case) -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Can add left items here if needed -->
            </ul>

            <!-- Right-aligned links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="all_blogs.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <?php if (!$isLoggedIn): ?>
                    <!-- User is not logged in: Show Login and Register -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php else: ?>
                    <!-- User is logged in: Show Dashboard and Logout -->
                    <li class="nav-item">
                        <a class="nav-link" href="user/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Custom Navbar Styling */
    .navbar-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: background 0.3s ease;
        height: 10vh;
    }

    /* Optional: Hover effect for nav links */
    .navbar-custom .nav-link {
        color: rgba(255, 255, 255, 0.8);
        transition: color 0.3s ease;
    }

    .navbar-custom .nav-link:hover {
        color: #ffffff;
    }

    /* Ensure active link stands out */
    .navbar-custom .nav-link.active {
        color: #ffffff;
        font-weight: bold;
    }

    /* Optional: Slight glow effect on brand */
    .navbar-custom .navbar-brand {
        color: #ffffff;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .navbar-custom {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }
    }
</style>