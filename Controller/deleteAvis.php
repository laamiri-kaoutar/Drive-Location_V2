<?php
 require_once '../Model/Avis.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    var_dump($id);

    $avis = new Avis();
   
    if ($avis->deleteById($id)) {
        echo "this is wooooorkinggg";
        // header('Location: ../View/index.php');
        
    }
  


}
