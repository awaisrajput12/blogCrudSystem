<?php
session_start();
require_once '../config/db.php'; // Include DB connection

// Check if ID is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoryId = intval($_GET['id']);

    // Prepare delete statement
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $categoryId);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Category deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting category: " . $conn->error;
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid category ID.";
}

// Redirect back to the category management page
header("Location: manage_categories.php");
exit;
