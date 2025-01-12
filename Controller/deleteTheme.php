<?php
 require_once '../Model/theme.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    var_dump($id);

    $theme = new Theme();
   
    if ($theme->deleteById($id)) {
        echo "this is wooooorkinggg";
        header('Location: ../View/index.php');
        
    }
  


}
