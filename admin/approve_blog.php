<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user role
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (($user['role'] ?? '') !== 'admin') {
    $_SESSION['error_message'] = "You don't have permission to perform this action.";
    header("Location: blog_posts.php");
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

// Approve the blog post
$approveStmt = $conn->prepare("UPDATE blog_posts SET is_approved = 1 WHERE id = ?");
$approveStmt->bind_param("i", $postId);

if ($approveStmt->execute()) {
    $_SESSION['success_message'] = "Blog post approved successfully!";
} else {
    $_SESSION['error_message'] = "Error approving blog post.";
}

$approveStmt->close();
$conn->close();

header("Location: manage_blog.php");
exit();
?>