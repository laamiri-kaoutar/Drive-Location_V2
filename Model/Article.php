<?php

require_once '../config/database.php';





class Article extends GestionBaseDeDonnees {


    


    public function create($user_id, $article_title , $theme_id, $image , $content){
        $query = "INSERT INTO article(user_id, article_title , theme_id, image , content) VALUES (?,?,?,?,?)";
        $params = [$user_id, $article_title , $theme_id, $image , $content];
        return  $this->execute($query, $params);
    }


    public function update($article_id , $user_id, $article_title , $theme_id, $image , $content ){
        $query = "UPDATE article SET user_id= ? article_title= ? theme_id= ? image= ? content= ? WHERE article_id = ?";
        $params = [$user_id, $article_title , $theme_id, $image , $content ,$article_id ];
        return  $this->execute($query, $params);
    }

    public function updateStatus($id ,$status  ){
        $query = "UPDATE article SET status = ? WHERE article_id = ?";
        $params = [$status, $id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT a.* , u.username FROM article a JOIN theme t ON t.theme_id=a.theme_id JOIN utilisateur u ON u.user_id=a.user_id WHERE a.article_id = ? ";
        $params = [$id];
        $article = $this->select($query , $params);
        return  $article[0];
    }

    public function deleteById($id){

        $query = "DELETE FROM  article  WHERE article_id = ?";
        $params = [$id];
        return  $this->execute($query, $params);
    }


    public function readAll(){
        $query = "SELECT a.* , u.username , t.theme_name FROM article a JOIN utilisateur u ON u.user_id=a.user_id JOIN theme t ON t.theme_id=a.theme_id;";
        return  $this->select($query);
    }

    public function getArticleByTheme($id){

        $query = "SELECT a.* , u.username FROM article a JOIN utilisateur u ON u.user_id=a.user_id  WHERE a.theme_id = ?";
        $params = [$id];
        return  $this->select($query, $params);
    }

    public function filterByTag($id){
        $query = "SELECT a.* , u.username FROM tagging t  JOIN `article` a ON a.article_id= t.article_id JOIN utilisateur u ON u.user_id=a.user_id WHERE t.tag_id= ?";
        $params = [$id];
        return  $this->select($query, $params);
    }
    public function searchByTitle($title) {
        $query = "SELECT a.*, u.username
                  FROM `article` a
                  JOIN `utilisateur` u ON u.user_id = a.user_id
                  WHERE a.article_title LIKE ?";
        $params = ['%' . $title . '%']; // Add wildcards around the title
        return $this->select($query, $params);
    }

    public function articlesPerPage($page ,$itemsPerPage , $id)
    {
        $offset = ($page - 1) * $itemsPerPage;
        $query = $this->pdo->prepare("SELECT a.* , u.username FROM article a JOIN utilisateur u ON u.user_id=a.user_id  WHERE a.theme_id = :id LIMIT :offset, :limit");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', var: $itemsPerPage, type: PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }

    
  

    // public function getArticleByTheme($id){
    //     $query = "SELECT * FROM article a JOIN utilisateur u ON u.user_id=a.user_id JOIN theme t ON t.theme_id=a.theme_id WHERE a.theme_id = ?";
    //     $params = [$id];
    //     return  $this->select($query, $params);
    // }




}
