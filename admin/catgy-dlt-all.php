<?php
session_start();
require_once '../config/db.php';

// Verify this is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Optional: Add CSRF protection here

    // Delete all categories
    $result = $conn->query("DELETE FROM categories");

    if ($result) {
        $_SESSION['success'] = "All categories have been deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting categories: " . $conn->error;
    }

    $conn->close();
    header("Location: manage_categories.php"); // Redirect back to categories page
    exit();
} else {
    // If someone tries to access this directly without POST, redirect
    header("Location: manage_categories.php");
    exit();
}
