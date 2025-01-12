<?php
 require_once '../Model/theme.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


    trim(htmlspecialchars($_POST["theme_name"]));

         $theme_name= trim(htmlspecialchars($_POST["theme_name"]));
         $description= trim(htmlspecialchars($_POST["description"]));

         var_dump($theme_name);
         var_dump($description);

         $theme = new Theme();

         if ($theme->create($theme_name , $description)) {
            header("Location:../View/dashboard.php");
        }

}