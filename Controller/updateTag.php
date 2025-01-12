<?php
 require_once '../Model/tag.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {



        $id=$_POST["id_tag"];
         $title=$_POST["tag_title"];
         $color=$_POST["tag_color"];

         var_dump($title);
         var_dump($color);
         var_dump($id);



         $tag = new Tag();
           
         if ($tag->update($id ,$title,$color)) {
            header("Location:../View/dashboard.php");
        }

  


}