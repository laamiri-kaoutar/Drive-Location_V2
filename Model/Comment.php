<?php

require_once '../config/database.php';




class Comment extends GestionBaseDeDonnees {

    public function create($article_id , $user_id , $comment){
        $query = "INSERT INTO comment(article_id , user_id , comment) VALUES (?,?,?)";
        $params = [$article_id , $user_id , $comment];
        return  $this->execute($query, $params);
    }

    public function update($id, $comment){
        $query = "UPDATE comment SET comment = ? WHERE comment_id = ?";
        $params = [$comment, $id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM comment WHERE comment_id  = ?";
        $params = [$id];
        return  $this->select($query , $params);
    }

    public function getCommentsByArticleId($id){
        $query = "SELECT * FROM comment c JOIN utilisateur u ON u.user_id=c.user_id WHERE c.article_id  = ?";
        $params = [$id];
        return  $this->select($query , $params);
     
    }
 
    public function deleteById($id){
        $query = "DELETE FROM  comment  WHERE comment_id = ?";
        $params = [$id];
        return  $this->execute($query, $params);
    }


}
