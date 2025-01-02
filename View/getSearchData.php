<?php
require_once '../Model/Vehicule.php';

if (isset($_GET['key'])) {
    $key = $_GET['key']; // Ensure it's an integer
    $vehicule = new Vehicule();

    $car = $vehicule->search($key);
    

    if ($car) {
        echo json_encode($car); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found $category"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
