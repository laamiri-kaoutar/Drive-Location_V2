<?php
require_once '../Model/Comment.php';


    if($_SERVER['REQUEST_METHOD'] == "POST" ) {
   
   

            $commentData = htmlspecialchars(trim($_POST["commentText"])); // Sanitize input
            $idData = htmlspecialchars(trim($_POST["commentId"])); // Sanitize input
        
        var_dump($commentData);
        
            $comment = new Comment();
        
            if ($comment->update($idData , $commentData)) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

   
   }