<?php

require_once '../config/database.php';




class Tag extends GestionBaseDeDonnees {



    public function create($tag_title, $tag_color){
        $query = "INSERT INTO tag(tag_title, tag_color ) VALUES (?,?)";
        $params = [$tag_title, $tag_color];
        return  $this->execute($query, $params);
    }

    public function update($id ,$tag_title, $tag_color){
        $query = "UPDATE tag SET tag_title = ?,tag_color= ? WHERE tag_id = ?";
        $params = [$tag_title, $tag_color, $id];
        return  $this->execute($query, $params);
    }


    public function deleteById($id){
        $query = "DELETE FROM  tag  WHERE tag_id = ?";
        // $query = "DELETE FROM  avis  WHERE id_avis = ?";
        $params = [$id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM tag  WHERE tag_id = ?";
        $params = [$id];
        return  $this->select($query , $params);
    }


    public function readAll(){
        $query = "SELECT * FROM tag";
        return  $this->select($query);
    }
    public function readAllById($id){
        $query = "SELECT tg.* FROM tagging t JOIN tag tg ON t.tag_id=tg.tag_id  WHERE   t.article_id = ? ";
        $params = [$id];
        return  $this->select($query , $params);
    }

}
