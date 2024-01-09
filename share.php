<?php
session_start();
require_once('db.php');

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $email = $_SESSION['user_email']; // Assuming you have a user authentication system

    // Check if the user has already shared the post
    $checkSql = "SELECT * FROM shares WHERE post_id = ? AND email = ?";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([$post_id, $email]);
    $existingShare = $checkStmt->fetch();

    if (!$existingShare) {
        // If the user hasn't shared the post yet, add a new share record
        $insertSql = "INSERT INTO shares (post_id, email) VALUES (?, ?)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->execute([$post_id, $email]);

        // Update shares_count in blog_posts table
        $updateSql = "UPDATE blog_posts SET shares_count = shares_count + 1 WHERE post_id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$post_id]);
    }

    header("Location: blogPost.php?post_id=$post_id");
    exit();
} else {
    echo "Invalid request";
}
?>
