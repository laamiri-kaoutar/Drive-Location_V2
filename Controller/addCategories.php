<?php
 require_once '../Model/categorie.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


         $names=$_POST["name"];
        //  var_dump($names);
         $categorie = new Categorie();

        foreach ($names as $name) {
           echo " <tr><td><br><br></td></tr>";
           echo " $name";
           
           var_dump($categorie->create($name));

           
        }
        header("Location:../View/dashboard.php");
  


}