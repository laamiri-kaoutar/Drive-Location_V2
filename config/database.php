<?php

class GestionBaseDeDonnees {


    protected $pdo;
    private $host = "localhost";
    private $db_name = "drive_location"; 
    private $username = "root"; 
    private $password = ""; 

    public function __construct() {
        $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        return $this->pdo;
    }



    public function select($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function selectElement($query, $params = []) {
    //     $stmt = $this->pdo->prepare($query);
    //      $stmt->execute($params);
    //     return $stmt->fetch_assoc();
        
    // }

    public function execute($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
}