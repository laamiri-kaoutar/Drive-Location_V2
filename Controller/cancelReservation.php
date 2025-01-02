<?php
 require_once '../Model/Reservation.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    var_dump($id);

    $reservation = new Reservation();
   
    if ($reservation->deleteById($id)) {
        // var_dump($categorie->create($name));
        echo "this is wooooorkinggg";
        var_dump($reservation->getElementById($id));

        header('Location: ../View/index.php');     
    }
  


}
