<?php

require_once '../config/database.php';


class Tagging extends GestionBaseDeDonnees {

    public function create($tag_id, $article_id){
        $query = "INSERT INTO tagging(tag_id, article_id ) VALUES (?,?)";
        $params = [$tag_id, $article_id];
        return  $this->execute($query, $params);
    }

    public function update($tag_id, $article_id){
        $query = "UPDATE tagging SET tag_id = ?,article_id= ? WHERE tag_id = ? AND article_id = ? ";
        $params = [$theme_name, $description, $id];
        return  $this->execute($query, $params);
    }


    public function deleteById($id){
        $query = "DELETE FROM  tagging  WHERE  tag_id = ? OR article_id = ? ";
        $params = [$id,$id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM tagging  WHERE  tag_id = ? OR article_id = ? ";
        $params = [$id,$id];
        return  $this->select($query , $params);
    }

    public function readAllById($id){
        $query = "SELECT * FROM tagging t JOIN tag tg ON t.tag_id=tg.tag_id  WHERE   t.article_id = ? ";
        $params = [$id];
        return  $this->select($query , $params);
    }

    public function readAll(){
        $query = "SELECT * FROM tagging";
        return  $this->select($query);
    }

}
