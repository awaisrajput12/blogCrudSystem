
 <style>
      body {
          background-color: #f8f9fa;
          font-family: 'Arial', sans-serif;
          overflow-x: hidden;
      }

      .sidebar {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          height: 100vh;
          position: fixed;
          left: 0;
          top: 0;
          color: white;
          transition: all 0.3s;
          overflow-y: auto;
          z-index: 1000;
          box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
      }

      .sidebar a {
          color: white;
          text-decoration: none;
          padding: 12px 15px;
          display: block;
          border-left: 3px solid transparent;
          transition: all 0.2s;
          font-size: 0.9rem;
      }

      .sidebar a:hover,
      .sidebar a.active {
          background-color: rgba(255, 255, 255, 0.1);
          border-left: 3px solid white;
      }

      .sidebar a i {
          width: 20px;
          margin-right: 10px;
          text-align: center;
      }

      .main-content {
          margin-left: 16.666667%;
          /* col-md-2 is 16.666667% width */
          padding: 20px;
          transition: all 0.3s;
      }

      .card-icon {
          position: absolute;
          right: 15px;
          top: 15px;
          font-size: 2em;
          opacity: 0.5;
      }

      .sidebar-header {
          padding: 20px;
          margin-top: 20px;
          border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .mobile-menu-btn {
          display: none;
          position: fixed;
          top: 10px;
          left: 10px;
          z-index: 1100;
          background: rgba(255, 255, 255, 0.2);
          border: none;
          color: white;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          font-size: 1.2rem;
      }

      .sidebar-overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
          z-index: 999;
          display: none;
      }

      .user-avatar {
          width: 40px;
          height: 40px;
          border-radius: 50%;
          object-fit: cover;
      }

      @media (max-width: 992px) {
          .sidebar {
              transform: translateX(-250px);
              width: 250px;
          }

          .sidebar.active {
              transform: translateX(0);
          }

          .main-content {
              margin-left: 0;
          }

          .mobile-menu-btn {
              display: block;
          }

          .sidebar-overlay.active {
              display: block;
          }
      }
  </style>

  <!-- Mobile Menu Button -->
  <button class="mobile-menu-btn" id="mobileMenuBtn">
      <i class="fas fa-bars"></i>
  </button>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <div class="sidebar col-md-2" id="sidebar">
      <div class="sidebar-header py-4 text-center">
          <h5>Admin panel</h5>
          <small class="text-white-50">Administrator</small>
      </div>
      <nav>
          <a href="dashboard.php" class="active">
              <i class="fas fa-home"></i> Dashboard
          </a>
          <a href="users.php">
              <i class="fas fa-users"></i> Users
          </a>
          <a href="manage_blog.php">
              <i class="fas fa-edit"></i> Manage Blog
          </a>
          <a href="./manage_categories.php">
              <i class="fas fa-tags"></i> Categories
          </a>
          <a href="logout.php" class="mt-4">
              <i class="fas fa-sign-out-alt"></i> Logout
          </a>
      </nav>
  </div>

  