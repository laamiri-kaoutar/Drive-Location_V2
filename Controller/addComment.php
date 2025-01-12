<?php
header('Content-Type: application/json');

session_start();
require_once '../Model/Comment.php';



       $user_id=$_SESSION["user"]["id"];
    //    var_dump($user_id);
       
// Get the article ID from the query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = intval($_GET['id']); // Validate and sanitize the ID
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid article ID.']);
    exit;
}

// Now you can proceed with handling the comment
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['comment']) && !empty(trim($data['comment']))) {
    $commentData = htmlspecialchars(trim($data['comment'])); // Sanitize input

    $comment = new Comment();

    if ($comment->create($article_id , $user_id , $commentData)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}
