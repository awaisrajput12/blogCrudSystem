<style>
    :root {
        --primary-color: #6a11cb;
        --secondary-color: #2575fc;
        --text-color: #333;
        --bg-light: #f4f7fa;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Sidebar Styling */
    .sidebar {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 30px 15px;
        transition: all 0.3s ease;
        height: 100vh;
        position: sticky;
        top: 0;
    }

    .sidebar .profile-section {
        text-align: center;
        margin-bottom: 30px;
        margin-top: 20px;
    }

    .sidebar .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 15px;
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.7);
        padding: 10px 15px;
        border-radius: 5px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateX(5px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            left: -100%;
            top: 0;
            width: 250px;
            z-index: 1000;
            height: 100vh;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-overlay.show {
            display: block;
        }

        .sidebar-toggle {
            display: block;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }   
    }
</style>

<div class="col-md-2 px-0 sidebar">
    <div class="profile-section">
        <h5 class="text-white"><?php echo htmlspecialchars($user['username']); ?></h5>
    </div>

    <nav class="nav flex-column">
        <a class="nav-link active" href="dashboard.php">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="nav-link" href="create_blog.php">
            <i class="fas fa-plus"></i> Create blog
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-cog"></i> Settings
        </a>
    </nav>
</div>

<script>
    // Mobile Sidebar Toggle
    document.querySelector('.sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('show');
        document.querySelector('.sidebar-overlay').classList.toggle('show');
    });

    document.querySelector('.sidebar-overlay').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.remove('show');
        document.querySelector('.sidebar-overlay').classList.remove('show');
    });
</script>