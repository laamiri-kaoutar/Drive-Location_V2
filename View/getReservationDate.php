<?php
 require_once '../Model/Reservation.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure it's an integer
    $reservation = new Reservation();
    $booking = $reservation->getElementById($id);

    if ($booking) {
        echo json_encode($booking[0]); // Send the car data as JSON
    } else {
        echo json_encode(["error" => "Car not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
