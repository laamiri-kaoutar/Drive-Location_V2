<?php
 require_once '../Model/Theme.php';

if (isset($_GET['idtheme'])) {
    $id = intval($_GET['idtheme']); // Ensure it's an integer
    $theme = new Theme();
    $data = $theme->getElementById($id);

    if ($data) {
        echo json_encode($data[0]); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
