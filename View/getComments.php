<?php
session_start();
require_once '../Model/Comment.php';

// Get the article ID from the query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = intval($_GET['id']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid article ID.']);
    exit;
}

// Fetch comments for the article
$comment = new Comment();
$comments= $comment->getCommentsByArticleId($article_id);

if ($comments) {
    echo json_encode(['success' => true, 'comments' => $comments]);
} else {
    echo json_encode(['success' => false, 'message' => 'No comments found.']);
}
