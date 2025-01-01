<?php

require_once '../config/database.php';

class User extends GestionBaseDeDonnees {
    private $id;
    private $username;
    private $email;
    private $image;
    private $password;
    private $role; 

    public function __construct($id, $username,$email, $password, $role ) {
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        // $this->image = $image;
        $this->password = $password;
        $this->role = $role;
    }

    // getters et setters 
    public function getId() {return $this->id ;}
    public function getUser() {return $this->username ;}
    public function getPassword() {return $this->password;}
    public function getRole() {return $this->role;}
    public function getEmail() {return $this->email;}


    public function setUsername($username) { $this->username = $username ;}
    public function setId($id) { $this->id = $id ;}

    public function setPassword($password) { $this->password = $password;}

    //  les methodes pour ajouter update ....

    public function create(){
        $query = "INSERT INTO utilisateur(username,email  , password , role) VALUES (?,?,?,?)";
        $params = [ $this->username,$this->email, $this->password, $this->role ];
        return  $this->execute($query, $params);
    }

    public function getElementByEmail(){
        $query = "SELECT * FROM utilisateur WHERE email = ? ";
        $params = [$this->email];
        return  $this->select($query , $params);
    }
}    