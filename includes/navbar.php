<?php
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark navbar-custom py-2">
    <div class="container">
        <!-- Brand/logo on the left -->
        <a class="navbar-brand fs-2" href="index.php">BLOG PRO</a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
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
        transition: background 0.3s ease, padding 0.3s ease;
        height: 10vh;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Navbar brand styling */
    .navbar-custom .navbar-brand {
        color: #ffffff;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        font-weight: 700;
    }

    /* Nav link styling */
    .navbar-custom .nav-link {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
        padding: 0.5rem 1rem;
        transition: color 0.3s ease, background 0.3s ease;
        border-radius: 5px;
    }

    .navbar-custom .nav-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-custom .nav-link.active {
        color: #ffffff;
        font-weight: bold;
        background: rgba(255, 255, 255, 0.15);
    }

    /* Toggler styling */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }

    /* Smooth collapse animation */
    .navbar-collapse {
        transition: height 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .navbar-custom {
            height: auto;
            padding: 0.5rem 1rem !important;
        }

        .navbar-collapse {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem;
            border-radius: 0 0 10px 10px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .navbar-nav {
            text-align: center;
        }

        .nav-item {
            margin: 0.5rem 0;
        }

        .nav-link {
            padding: 0.75rem 1rem !important;
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .navbar-brand {
            font-size: 1.5rem !important;
        }

        .navbar-custom {
            padding: 0.5rem 0.75rem !important;
        }
    }
</style>