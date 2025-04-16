<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if ID parameter exists
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error_message'] = "Invalid blog post ID.";
    header("Location: manage_blog.php");
    exit();
}

$postId = $_GET['id'];

// Check if blog post exists
$checkStmt = $conn->prepare("SELECT id FROM blog_posts WHERE id = ?");
$checkStmt->bind_param("i", $postId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows === 0) {
    $_SESSION['error_message'] = "Blog post not found.";
    header("Location: manage_blog.php");
    exit();
}

// Delete the blog post
$deleteStmt = $conn->prepare("DELETE FROM blog_posts WHERE id = ?");
$deleteStmt->bind_param("i", $postId);

if ($deleteStmt->execute()) {
    $_SESSION['success_message'] = "Blog post deleted successfully!";
} else {
    $_SESSION['error_message'] = "Error deleting blog post.";
}

$deleteStmt->close();
$conn->close();

header("Location: manage_blog.php");
exit();
?>