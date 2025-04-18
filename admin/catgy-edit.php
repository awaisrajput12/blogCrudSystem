<?php
session_start();
require_once '../config/db.php'; // Assuming this contains your database connection

// Check if user is logged in and has admin privileges
// You should implement proper authentication here

// Check if an ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage_categories.php");
    exit();
}

$categoryId = intval($_GET['id']);
$category = null;

// Fetch the existing category
$stmt = $conn->prepare("SELECT id, name FROM categories WHERE id = ?");
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Category not found
    header("Location: manage_categories.php");
    exit();
}

$category = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newCategoryName = trim($_POST['categoryName']);

    if (!empty($newCategoryName)) {
        // Update category in database
        $updateStmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $updateStmt->bind_param("si", $newCategoryName, $categoryId);

        if ($updateStmt->execute()) {
            $success = "Category updated successfully!";
            // Refresh the category data
            $category['name'] = $newCategoryName;
        } else {
            $error = "Error updating category: " . $conn->error;
        }
        $updateStmt->close();
    } else {
        $error = "Category name cannot be empty!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "./includes/header.php" ?>

<body>
    <div class="container">
        <div class="edit-category-container">
            <h2 class="mb-4 text-center">Edit Category</h2>

            <?php if (isset($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($success); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName"
                        value="<?php echo htmlspecialchars($category['name']); ?>"
                        placeholder="Enter category name" required />
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom">
                        Update Category
                    </button>
                    <a href="manage_categories.php" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>