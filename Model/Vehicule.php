<?php

require_once '../config/database.php';




class Vehicule extends GestionBaseDeDonnees {

    public function create($marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image ){
        $query = "INSERT INTO vehicule(marque,modele  , prix_par_jour , disponibilite , id_categorie , description ,image ) VALUES (?,?,?,?,?,?,?)";
        $params = [$marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image];
        return  $this->execute($query, $params);
    }

    public function update($id , $marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description ,  $status  ){
        $query = "UPDATE vehicule SET marque = ?,modele= ? ,prix_par_jour= ? ,disponibilite= ?,id_categorie= ? , description= ?, status= ? WHERE id_vehicule = ?";
        $params = [$marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $status, $id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM vehicule v JOIN categorie c ON c.id_categorie= v.id_categorie WHERE  id_vehicule = ?";
        $params = [$id];
        return  $this->select($query , $params);
    }

    public function readAll(){
        $query = "SELECT * FROM vehicule v JOIN categorie c ON c.id_categorie= v.id_categorie";
        return  $this->select($query);
    }
 
    public function deleteById($id){
        $query = "DELETE FROM  vehicule  WHERE id_vehicule = ?";
        $params = [$id];
        return  $this->execute($query, $params);
    }


}
