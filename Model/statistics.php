<?php

require_once '../config/database.php';


class Statistics extends GestionBaseDeDonnees {
    function totalFeedback(){
        $query = "SELECT COUNT(*) totalFeedback FROM avis";
        $total = $this->select($query);
        return $total[0]['totalFeedback'];
    }

    function avrFeedback(){
        $query = "SELECT AVG(a.note) avrFeedback FROM avis a";
        $total = $this->select($query);
        return $total[0]['avrFeedback'];
    }

    function available(){
        $query = "SELECT COUNT(*) available  FROM vehicule v WHERE v.disponibilite=1";
        $total = $this->select($query);
        return $total[0]['available'];
    }
    function mostRated(){
        $query = "SELECT v.*, c.* FROM vehicule v JOIN avis a ON a.id_vehicule=v.id_vehicule JOIN categorie c ON c.id_categorie = v.id_categorie ORDER BY a.note DESC LIMIT 1";
        $car = $this->select($query);
        return $car[0];
    }

    function approved(){
        $query = "SELECT COUNT(*) approved FROM reservation r WHERE r.status='approved'";
        $approved = $this->select($query);
        return $approved[0]['approved'];
    }

    function mostRented(){
        $query = "SELECT v.*, c.* ,COUNT(*) total FROM `reservation` r JOIN vehicule v ON v.id_vehicule=r.id_vehicule JOIN categorie c ON c.id_categorie = v.id_categorie GROUP BY r.id_vehicule ORDER BY total DESC LIMIT 1 ";
        $car = $this->select($query);
        return $car[0];
    }

}