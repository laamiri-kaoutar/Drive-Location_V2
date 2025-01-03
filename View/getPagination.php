<?php
require_once '../Controller/pagination.php';

if (isset($_GET['page'])) {
    $page =  intval($_GET['page']) ; 
    $pagination = new pagination();
   
    $car = $pagination->getVehicule($page);
    if ($car) {
        echo json_encode($car); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found $page"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
