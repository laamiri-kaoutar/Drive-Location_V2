<?php
 require_once '../Model/theme.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


         $theme_name=$_POST["theme_name"];
         $id=$_POST["theme_id"];
         $description=$_POST["description"];

         var_dump($theme_name);
         var_dump($id);

         var_dump($description);

         $theme = new Theme();

         if ($theme->update( $id, $theme_name , $description)) {
            header("Location:../View/dashboard.php");
        }

}