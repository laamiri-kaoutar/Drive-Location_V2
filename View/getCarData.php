<?php
require_once '../Model/Vehicule.php';

if (isset($_GET['carId'])) {
    $carId = intval($_GET['carId']); // Ensure it's an integer
    $vehicule = new Vehicule();
    $car = $vehicule->getElementById($carId);

    if ($car) {
        echo json_encode($car[0]); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
