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
         



         $marque=$_POST["vehiculeMarque"];
         $modele = $_POST["vehiculeModele"]; 
         $prix_par_jour=$_POST["vehiculePrix"] ; 
         $disponibilite = $_POST["vehiculeDisponibilite"] ; 
         $id_categorie = $_POST["vehiculeCategory"]; 
         $description = $_POST["vehiculeDescription"];

        //  var_dump($marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image );

         $vehicule = new Vehicule();
        //  $vehicule->create($marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image );
         if ($vehicule->create($marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image )) {
            header('Location: ../View/dashboard.php');     

        }
       
           ob_end_flush();


 


}