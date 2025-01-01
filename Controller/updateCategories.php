<?php
 require_once '../Model/categorie.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


         $name=$_POST["name"];
         $id =$_POST["id_category"];

         $categorie = new Categorie();

         if ($categorie->update($id ,$name)) {
            // var_dump($categorie->create($name));
            header("Location:../View/dashboard.php");
        }
   
       

       
  


}