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
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Fetch categories from the database
    $categoryQuery = "SELECT id, name FROM categories";
    $categoryResult = $conn->query($categoryQuery);

    $categories = [];
    if ($categoryResult && $categoryResult->num_rows > 0) {
        while ($row = $categoryResult->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    // Initialize success message variable
    $successMessage = '';

    // Process form data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if this is a duplicate submission
        if (isset($_SESSION['last_post'])) {
            $time_diff = time() - $_SESSION['last_post']['time'];
            // If same form was submitted within 5 seconds, consider it a duplicate
            if ($time_diff < 5 && $_SESSION['last_post']['title'] == $_POST['title']) {
                $successMessage = "Blog already submitted successfully!";
            } else {
                // Process the new submission
                processFormSubmission($conn);
            }
        } else {
            // Process the submission
            processFormSubmission($conn);
        }
    }

    function processFormSubmission($conn)
    {
        global $successMessage;

        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $featured = isset($_POST['featured']) ? 1 : 0;
        $image_path = null;

        // Handle single image upload
        // Modify the image upload section in processFormSubmission()
        if (!empty($_FILES['images']['name'][0])) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                if (!mkdir($upload_dir, 0755, true)) {
                    die("Failed to create upload directory");
                }
            }

            // Check for upload errors
            if ($_FILES['images']['error'][0] !== UPLOAD_ERR_OK) {
                die("Upload error: " . $_FILES['images']['error'][0]);
            }

            $file_name = basename($_FILES['images']['name'][0]);
            $file_path = $upload_dir . uniqid() . '_' . $file_name;

            if (move_uploaded_file($_FILES['images']['tmp_name'][0], $file_path)) {
                $image_path = $file_path;
            } else {
                die("Failed to move uploaded file");
            }
        }

        try {
            // Insert blog post with optional image
            // Modify the insert query in processFormSubmission()
            $stmt = $conn->prepare("INSERT INTO blog_posts (title, author, content, category, featured, image_path, is_approved) VALUES (?, ?, ?, ?, ?, ?, 0)");
            $stmt->bind_param("ssssis", $title, $author, $content, $category, $featured, $image_path);
            $stmt->execute();
            $post_id = $conn->insert_id;
            $stmt->close();

            // Store submission info in session to prevent duplicates
            $_SESSION['last_post'] = [
                'time' => time(),
                'title' => $title
            ];

            $successMessage = "Your blog has been submitted successfully!";
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <?php include "./assets/includes/header.php" ?>


    <body>
        <!-- Sidebar Toggle Button (visible only on mobile) -->
        <button class="btn sidebar-toggle d-md-none">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar Overlay (mobile only) -->
        <div class="sidebar-overlay"></div>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <?php include "./assets/includes/sidebar.php" ?>

                <!-- Content Area -->
                <div class="col-md-10">
                    <div class="content-area">
                        <h2 class="mb-4 text-center">Create Blog Post</h2>

                        <?php if (!empty($successMessage)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $successMessage; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <script>
                                // Clear form fields after successful submission
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('blogForm').reset();
                                    document.getElementById('imagePreviewContainer').innerHTML = '';
                                });
                            </script>
                        <?php endif; ?>

                        <form id="blogForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="blogTitle" class="form-label">Blog Title</label>
                                <input type="text" class="form-control" id="blogTitle" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="blogAuthor" class="form-label">Author Name</label>
                                <input type="text" class="form-control" id="blogAuthor" name="author" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="blogContent" class="form-label">Blog Content</label>
                                <textarea class="form-control" id="blogContent" name="content" rows="5" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="blogImages" class="form-label">Upload Images</label>
                                <input type="file" class="form-control" id="blogImages" name="images[]" multiple accept="image/*">
                                <div id="imagePreviewContainer" class="mt-2"></div>
                            </div>

                            <div class="mb-3">
                                <label for="blogCategory" class="form-label">Category</label>
                                <select class="form-select" id="blogCategory" name="category" required>
                                    <option value="" selected disabled>Select a category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= htmlspecialchars($category['name']) ?>">
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="featuredPost" name="featured">
                                <label class="form-check-label" for="featuredPost">Featured Post</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Publish Blog Post</button>
                        </form>
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