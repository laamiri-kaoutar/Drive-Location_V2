<?php
 require_once '../Model/tag.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    var_dump($id);

    $tag = new Tag();
           
    if ($tag->deleteById($id)) {
       header("Location:../View/dashboard.php");
   }



}
