<?php
require_once '../Model/categorie.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure it's an integer
    $categorie = new Categorie();
    $category = $categorie->getElementById($id);

    if ($category) {
        echo json_encode($category[0]); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "category not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}