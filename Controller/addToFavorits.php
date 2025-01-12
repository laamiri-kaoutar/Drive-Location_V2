<?php

session_start();
require_once '../Model/favorit.php';

$user_id=$_SESSION["user"]["id"];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {



    $article_id = intval($_GET['id']); 
      

         $favorit = new Favorit();

         if ($favorit->create($article_id , $user_id)) {

            echo "wwwwwwoooooorrrrrrrrkkkkkiiiiiiiiiinnnngg";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }

}