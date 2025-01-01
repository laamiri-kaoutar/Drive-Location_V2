<?php

require_once '../config/database.php';




class Categorie extends GestionBaseDeDonnees {

    public function create($nom_categorie ){
        $query = "INSERT INTO categorie(nom_categorie ) VALUES (?)";
        $params = [$nom_categorie];
        return  $this->execute($query, $params);
    }

    public function update($id , $nom_categorie  ){
        $query = "UPDATE categorie SET nom_categorie = ? WHERE id_categorie = ?";
        $params = [$nom_categorie, $id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM categorie WHERE id_categorie  = ?";
        $params = [$id];
        return  $this->select($query , $params);
    }

    public function readAll(){
        $query = "SELECT * FROM categorie ";
        return  $this->select($query );
    }
 
    public function deleteById($id){
        $query = "DELETE FROM  categorie  WHERE id_categorie = ?";
        $params = [$id];
        return  $this->execute($query, $params);
    }


}
