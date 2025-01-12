<?php

require_once '../config/database.php';




class Theme extends GestionBaseDeDonnees {

    public function create($theme_name, $description){
        $query = "INSERT INTO theme(theme_name, description ) VALUES (?,?)";
        $params = [$theme_name, $description];
        return  $this->execute($query, $params);
    }

    public function update($id ,$theme_name, $description){
        $query = "UPDATE theme SET theme_name = ?,description= ? WHERE theme_id = ?";
        $params = [$theme_name, $description, $id];
        return  $this->execute($query, $params);
    }


    public function deleteById($id){
        $query = "DELETE FROM  theme  WHERE theme_id = ?";
        $params = [$id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM theme  WHERE theme_id = ?";
        $params = [$id];
        return  $this->select($query , $params);
    }


    public function readAll(){
        $query = "SELECT * FROM theme";
        return  $this->select($query);
    }

}
