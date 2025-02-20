<?php

require_once '../config/database.php';




class Vehicule extends GestionBaseDeDonnees {

    public function create($marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image ){
        $query = "INSERT INTO vehicule(marque,modele  , prix_par_jour , disponibilite , id_categorie , description ,image ) VALUES (?,?,?,?,?,?,?)";
        $params = [$marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image];
        return  $this->execute($query, $params);
    }

    public function update($id , $marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description ,  $image  ){
        $query = "UPDATE vehicule SET marque = ?,modele= ? ,prix_par_jour= ? ,disponibilite= ?,id_categorie= ? , description= ?, image= ? WHERE id_vehicule = ?";
        $params = [$marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image, $id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM vehicule v JOIN categorie c ON c.id_categorie= v.id_categorie WHERE  v.id_vehicule = ?";
        $params = [$id];
        return  $this->select($query , $params);
    }
    public function search($key){
        $query = "SELECT * FROM vehicule v JOIN categorie c ON c.id_categorie= v.id_categorie WHERE  v.marque = ? OR v.modele = ? OR v.prix_par_jour = ?";
        $params = [$key, $key, $key];
        return  $this->select($query , $params);
    }

    public function getElementByCategory($category){
        $query = "SELECT * FROM vehicule v JOIN categorie c ON c.id_categorie= v.id_categorie WHERE  c.nom_categorie = ?";
        $params = [$category];
        return  $this->select($query , $params);
    }

    public function readAll(){
        $query = "SELECT * FROM ListeVehicule";
        return  $this->select($query);
    }
 
    public function deleteById($id){
        $query = "DELETE FROM  vehicule  WHERE id_vehicule = ?";
        $params = [$id];
        return  $this->execute($query, $params);
    }

    public function totalVehicules(){
        $query = "SELECT COUNT(*) AS total FROM vehicule ";
        $total = $this->select($query);
        return $total[0]['total'];
    }

    public function isRentad($car , $user){
        $query = "SELECT COUNT(*) AS total FROM vehicule ";
        $car = $this->select($query);
        return $car[0];
    }
    public function vehiculesPerPage($page ,$itemsPerPage)
    {

        $offset = ($page - 1) * $itemsPerPage;
        $query = $this->pdo->prepare("SELECT * FROM vehicule LIMIT :offset, :limit");
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', var: $itemsPerPage, type: PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();

    }


}






