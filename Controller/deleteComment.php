<?php
header('Content-Type: application/json');

session_start();
require_once '../Model/Comment.php';

       
// Get the article ID from the query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = intval($_GET['id']); // Validate and sanitize the ID
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid article ID.']);
    exit;
}


    $comment = new Comment();

    if ($comment->deleteById($article_id)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }

