<?php
require_once '../Model/Article.php';
require_once '../Model/Tag.php';


class ArticleController extends GestionBaseDeDonnees {


    function getThemeArticlesWithTags($theme_id){

        $theme_id = intval($theme_id); // Assurez-vous que c'est un entier
    
        $tag = new Tag();
        $articleObject = new Article();
        
        $response = []; 
        
        if ($articles = $articleObject->getArticleByTheme($theme_id)) {
            foreach ($articles as $article) { 
                $tags = $tag->readAllById($article["article_id"]);
                
                $response[] = [
                    "article" => $article,
                    "tags" => $tags
                ];
            }
            
            return $response;
        } else {
            return $response; 
        }


    }

    function paginationArticles($page ,$itemsPerPage , $theme_id){

        $theme_id = intval($theme_id); // Assurez-vous que c'est un entier
    
        $tag = new Tag();
        $articleObject = new Article();
        
        $response = []; 
        
        if ($articles = $articleObject->articlesPerPage($page ,$itemsPerPage , $theme_id)) {
            foreach ($articles as $article) { 
                $tags = $tag->readAllById($article["article_id"]);
                
                $response[] = [
                    "article" => $article,
                    "tags" => $tags
                ];
            }
            
            return $response;
        } else {
            return $response; 
        }


    }



    public function totalArticles(){
        $query = "SELECT COUNT(*) AS total FROM article a WHERE a.theme_id = 2";
        $total = $this->select($query);
        return $total[0]['total'];
    }




}