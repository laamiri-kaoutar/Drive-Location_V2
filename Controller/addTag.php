<?php
 require_once '../Model/tag.php';
 if($_SERVER['REQUEST_METHOD'] == "POST" ) {


         $titles=$_POST["tag_title"];
         $colors=$_POST["tag_color"];

         var_dump($titles);
         var_dump($colors);


         $tag = new Tag();

        foreach ($titles as $i =>$title) {
            $titre=trim(htmlspecialchars($title));
           echo " <tr><td><br><br></td></tr>";
           echo " $n";
           echo " <tr><td><br><br></td></tr>";

           echo "$colors[$i]";
           $color =trim(htmlspecialchars($colors[$i]));
           
           var_dump($tag->create($titre,$color));

           
        }
        header("Location:../View/dashboard.php");
  


}