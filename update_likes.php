<?php
// Database connection
require_once 'config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $postId = (int)$_POST['post_id'];
    
    // Update likes count in database
    $stmt = $conn->prepare("UPDATE blog_posts SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    
    // Get the new like count
    $result = $conn->query("SELECT likes FROM blog_posts WHERE id = $postId");
    $row = $result->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'new_likes' => $row['likes']
    ]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>