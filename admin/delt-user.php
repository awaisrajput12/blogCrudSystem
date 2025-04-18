<?php
session_start();
require_once '../config/db.php';

// Authentication check
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Check if user ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = (int)$_POST['user_id'];
    
    try {
        // Prepare and execute deletion query
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'user'");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        // Check if any row was affected
        if ($stmt->affected_rows > 0) {
            $_SESSION['success_msg'] = "User deleted successfully!";
        } else {
            $_SESSION['error_msg'] = "User not found or you can't delete this account!";
        }
        
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        $_SESSION['error_msg'] = "Error deleting user: " . $e->getMessage();
    }
    
    // Redirect back to user management page
    header("Location: users.php");
    exit();
} else {
    // If no user ID provided, redirect with error
    $_SESSION['error_msg'] = "Invalid request!";
    header("Location: users.php");
    exit();
}
?>