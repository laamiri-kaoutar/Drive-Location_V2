<?php

require_once '../config/database.php';




class Favorit extends GestionBaseDeDonnees {

    public function create($article_id , $user_id){
        $query = "INSERT INTO favorit(article_id , user_id ) VALUES (?,?)";
        $params = [$article_id , $user_id];
        return  $this->execute($query, $params);
    }

    public function getFavoritById($article_id, $user_id){
        $query = "SELECT * FROM favorit  WHERE article_id  = ? AND user_id= ?";
        $params = [$article_id,$user_id];
        return  $this->select($query , $params);
     
    }
    public function readAll(){
        $query = "SELECT * FROM favorit f JOIN utilisateur u ON u.user_id=f.user_id JOIN article a ON  a.article_id  = f.article_id";
        return  $this->select($query , $params);
     
    }

    // public function deleteById($id){
    //     $query = "DELETE FROM  comment  WHERE comment_id = ?";
    //     $params = [$id];
    //     return  $this->execute($query, $params);
    // }


}
