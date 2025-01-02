<?php
 require_once '../Model/Avis.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure it's an integer
    $avis = new Avis();
    $opinion = $avis->getElementById($id);

    if ($opinion) {
        echo json_encode($opinion[0]); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
