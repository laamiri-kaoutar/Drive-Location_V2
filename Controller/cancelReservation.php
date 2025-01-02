<?php
 require_once '../Model/categorie.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    var_dump($id);

    $categorie = new Categorie();
   
    if ($categorie->deleteById($id)) {
        // var_dump($categorie->create($name));
        header("Location:../View/dashboard.php");
    }
  


}
