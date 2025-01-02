<?php

require_once '../config/database.php';




class Reservation extends GestionBaseDeDonnees {


    


    // public function create($user, $vehicule , $date_debut, $date_fin , $lieu ){
    //     $query = "INSERT INTO reservation(user_id , id_vehicule , date_debut , date_fin , lieu_prise_en_charge  ) VALUES (?,?,?,?,?)";
    //     $params = [$user, $vehicule , $date_debut, $date_fin , $lieu];
    //     return  $this->execute($query, $params);
    // }

    public function create($user, $vehicule , $date_debut, $date_fin , $lieu ){
        $query = "CALL AddReservation(?,?,?,?,?)";
        $params = [$user, $vehicule , $date_debut, $date_fin , $lieu];
        return  $this->execute($query, $params);
    }

    public function update($id ,$user, $vehicule , $date_debut, $date_fin , $lieu  ){
        $query = "UPDATE reservation SET user_id = ?,id_vehicule= ? ,date_debut= ? ,date_fin= ?,lieu_prise_en_charge= ? WHERE id_reservation = ?";
        $params = [$user, $vehicule , $date_debut, $date_fin , $lieu, $id];
        return  $this->execute($query, $params);
    }

    public function updateStatus($id ,$status  ){
        $query = "UPDATE reservation SET status = ? WHERE id_reservation = ?";
        $params = [$status, $id];
        return  $this->execute($query, $params);
    }

    public function getElementById($id){
        $query = "SELECT * FROM reservation WHERE id_reservation = ? ";
        $params = [$id];
        return  $this->select($query , $params);
    }

    public function deleteById($id){

        // $query = "DELETE FROM  reservation  WHERE id_reservation = ?";
        $query = "UPDATE reservation SET is_deleted = 1 WHERE id_reservation = ?";

        $params = [$id];
        return  $this->execute($query, $params);
    }


    public function readAll(){
        $query = "SELECT * FROM reservation r JOIN vehicule v ON v.id_vehicule = r.id_vehicule  JOIN utilisateur u ON u.user_id = r.user_id ";
        return  $this->select($query , $params);
    }

    public function readByUser($id){
        $query = "SELECT * FROM reservation r JOIN vehicule v ON v.id_vehicule = r.id_vehicule  where r.user_id = ? AND is_deleted = 0";
        $params = [$id];
        return  $this->select($query , $params);
    }

    








}
