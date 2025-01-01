<?php
ob_start();
session_start();

 require_once '../Model/Reservation.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {

         
         




         $vehicule=$_POST["id_vehicule"];
         $user= $_SESSION["user"]["id"];
         $date_debut = $_POST["date_debut"]; 
         $date_fin=$_POST["date_fin"] ; 
         $lieu = $_POST["lieu_prise_en_charge"] ;
         var_dump($user, $vehicule , $date_debut, $date_fin , $lieu );



         $reservation = new Reservation();
         if ($reservation->create($user, $vehicule , $date_debut, $date_fin , $lieu )) {
            echo "this is wooooorkinggg";
            // header('Location: ../View/dashboard.php');     

        }
       
           ob_end_flush();


 


}