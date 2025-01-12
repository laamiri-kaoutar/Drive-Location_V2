<?php
 require_once '../Model/tag.php';

if (isset($_GET['tagId'])) {
    $id = intval($_GET['tagId']); // Ensure it's an integer
    $tag = new Tag();
    $data = $tag->getElementById($id);

    if ($data) {
        echo json_encode($data[0]); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
