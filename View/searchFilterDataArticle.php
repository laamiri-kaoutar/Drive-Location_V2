<?php
require_once '../Model/Article.php';
require_once '../Model/Tag.php';


if (isset($_GET['tag_id'])) {
    $tag_id = intval($_GET['tag_id']); // Assurez-vous que c'est un entier
    
    $tag = new Tag();
    $articleObject = new Article();
    
    $response = []; 
    
    if ($articles = $articleObject->filterByTag($tag_id)) {
        foreach ($articles as $article) { 
            $tags = $tag->readAllById($article["article_id"]);
            
            $response[] = [
                "article" => $article,
                "tags" => $tags
            ];
        }
        
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "No articles found"]);
    }
} elseif (isset($_GET['article_title'])) {
    $article_title = $_GET['article_title']; // Assurez-vous que c'est un entier
    
    $tag = new Tag();
    $articleObject = new Article();
    
    $response = []; 
    
    if ($articles = $articleObject->searchByTitle($article_title)) {
        foreach ($articles as $article) { 
            $tags = $tag->readAllById($article["article_id"]);
            
            $response[] = [
                "article" => $article,
                "tags" => $tags
            ];
        }
        
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "No articles found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
} 
?>
