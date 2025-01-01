<?php
ob_start();
 require_once '../Model/Vehicule.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {

         $image = $_FILES['vehiculeImage']['name'];
         $tempname = $_FILES['vehiculeImage']['tmp_name'];
         // i have to change the path here to be exactly where we want to add the image
         $folder = '../View/img/'.$image; 
         move_uploaded_file($tempname , $folder);

        
        //  var_dump($image);
         


         $id=$_POST["id_vehicule"];
         $marque=$_POST["vehiculeMarque"];
         $modele = $_POST["vehiculeModele"]; 
         $prix_par_jour=$_POST["vehiculePrix"] ; 
         $disponibilite = $_POST["vehiculeDisponibilite"] ; 
         $id_categorie = $_POST["vehiculeCategory"]; 
         $description = $_POST["vehiculeDescription"];

         var_dump($id ,$marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image );

         $vehicule = new Vehicule();
         if ($vehicule->update($id , $marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description ,  $image)) {
            header('Location: ../View/dashboard.php');     
            echo "hjqsyucgyZVCV";
            echo "3333333333333333333333333333333333333333";

        }
       
           ob_end_flush();


 


}