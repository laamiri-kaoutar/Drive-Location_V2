<?php
require_once '../Model/Vehicule.php';

if (isset($_GET['carId'])) {
    $id = intval($_GET['carId']);
    var_dump($id);

    $vehicule = new Vehicule();
    if ($vehicule->deleteById($id)) {
       header('Location: ../View/dashboard.php');     
       echo "hjqsyucgyZVCV";
       echo "3333333333333333333333333333333333333333";

   }
  


}