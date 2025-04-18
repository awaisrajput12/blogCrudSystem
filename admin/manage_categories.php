    <?php
    session_start();
    require_once '../config/db.php';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $categoryName = trim($_POST['categoryName']);

        if (!empty($categoryName)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
            $stmt->bind_param("s", $categoryName);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Category added successfully!";
            } else {
                $_SESSION['error'] = "Error adding category: " . $conn->error;
            }
            $stmt->close();

            // Redirect to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['error'] = "Category name cannot be empty!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Check for session messages
    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }

    // Fetch existing categories
    $categories = [];
    $result = $conn->query("SELECT id, name, created_at FROM categories ORDER BY created_at DESC");
    if ($result) {
        $categories = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }

    // Handle delete all confirmation
    if (isset($_GET['confirm_delete_all']) && $_GET['confirm_delete_all'] == 1 && isset($_SESSION['delete_all_confirmation'])) {
        // Show confirmation modal again but with POST method
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var confirmModal = new bootstrap.Modal(document.getElementById("deleteAllModal"));
            confirmModal.show();
            
            // Change the delete button to use POST
            document.querySelector("#deleteAllModal .btn-danger").onclick = function() {
                var form = document.createElement("form");
                form.method = "POST";
                form.action = "catgy-dlt-all.php";
                document.body.appendChild(form);
                form.submit();
            };
        });
        </script>';
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <?php include "includes/header.php" ?>

    <body>

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <?php include "./includes/sidebar.php" ?>


        <!-- Content Area -->
        <main class="main-content my-5">
            <div class="container-fluid">
                <?php if (isset($success)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="category-form">
                    <h2 class="mb-4">Create Category</h2>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter category name" required />
                        </div>
                        <button type="submit" class="btn btn-custom">
                            Create Category
                        </button>
                    </form>
                </div>

                <div class="category-table mt-5">
                    <h2 class="mb-4">Existing Categories</h2>
                    <?php if (empty($categories)): ?>
                        <div class="alert alert-info">No categories found. Please add some categories.</div>
                    <?php else: ?>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllModal">
                                <i class="fas fa-trash"></i> Delete All Categories
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($category['id']); ?></td>
                                            <td><?php echo htmlspecialchars($category['name']); ?></td>
                                            <td><?php echo date('M d, Y H:i', strtotime($category['created_at'])); ?></td>
                                            <td class="action-btns">
                                                <a href="catgy-edit.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="catgy-dlt.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>


        <!-- Delete All Confirmation Modal -->
        <!-- Delete All Confirmation Modal -->
        <div class="modal fade" id="deleteAllModal" tabindex="-1" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAllModalLabel">Confirm Delete All</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="catgy-dlt-all.php">
                        <div class="modal-body">
                            <p>Are you sure you want to delete ALL categories? This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete All</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script>
            // Mobile sidebar toggle
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuBtn = document.getElementById('mobileMenuBtn');
                const sidebar = document.getElementById('sidebar');
                const sidebarOverlay = document.getElementById('sidebarOverlay');

                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    sidebarOverlay.classList.toggle('active');
                });

                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });

                // Close sidebar when clicking outside on desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 992) {
                        sidebar.classList.remove('active');
                        sidebarOverlay.classList.remove('active');
                    }
                });
            });
        </script>
    </body>

    </html>