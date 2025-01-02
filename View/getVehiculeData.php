<?php
require_once '../Model/Vehicule.php';

if (isset($_GET['category'])) {
    $category = $_GET['category']; // Ensure it's an integer
    $vehicule = new Vehicule();
    if ($category === "All") {
        $car = $vehicule->readAll();
        
    }else {
        $car = $vehicule->getElementByCategory($category);
    }

    if ($car) {
        echo json_encode($car); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found $category"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
