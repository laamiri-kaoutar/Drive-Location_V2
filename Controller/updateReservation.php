<?php
ob_start();
session_start();
 require_once '../Model/Reservation.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


         $vehicule=$_POST["id_vehicule"];
         $id = $_POST["id_reservation"];
         $user= $_SESSION["user"]["id"];
         $date_debut = $_POST["date_debut"]; 
         $date_fin=$_POST["date_fin"] ; 
         $lieu = $_POST["lieu_prise_en_charge"] ;
         var_dump($id,$user, $vehicule , $date_debut, $date_fin , $lieu );



         $reservation = new Reservation();
         if ($reservation->update($id, $user, $vehicule , $date_debut, $date_fin , $lieu )) {
            echo "this is wooooorkinggg";
            header('Location: ../View/index.php');     


        }
       
           ob_end_flush();


 


}