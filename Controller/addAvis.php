<?php
ob_start();
session_start();
 require_once '../Model/Avis.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


         $vehicule=$_POST["id_vehicule"];
         $user= $_SESSION["user"]["id"];
         $commentaire = $_POST["commentaire"]; 
         $note=$_POST["note"] ; 
         var_dump($user, $vehicule , $commentaire, $note);



         $avis = new Avis();
         if ($avis->create($user, $vehicule , $commentaire, $note)) {
            echo "this is wooooorkinggg";
            header('Location: ../View/index.php');     

        }
       
           ob_end_flush();


 


}