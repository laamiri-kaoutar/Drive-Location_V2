<?php
ob_start();
session_start();

 require_once '../Model/Article.php';
 require_once '../Model/Tagging.php';

 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


         $image = $_FILES['image']['name'];
         $tempname = $_FILES['image']['tmp_name'];
         $folder = '../View/img/'.$image; 
         move_uploaded_file($tempname , $folder);


         $article_title=$_POST["article_title"];
         $theme_id = $_POST["theme_id"]; 
         $tags=$_POST["tags"] ; 
         $content = $_POST["content"]; 
         $user_id = $_SESSION["user"]["id"];

         var_dump($user_id, $article_title , $theme_id, $image , $content);
         var_dump($tags);

         $article = new Article();
        //  $vehicule->create($marque, $modele , $prix_par_jour, $disponibilite , $id_categorie , $description , $image );
         if ($article->create($user_id, $article_title , $theme_id, $image , $content)) {
            echo "this iiss aliivvvvveeee";
            header('Location: ../View/blog.php');     

        }

         $article_id=$article->lastInsertId();
         $tagging = new Tagging();

         foreach ($tags as $tag_id) {
            $tagging->create($tag_id, $article_id );
         }
       
           ob_end_flush();



}