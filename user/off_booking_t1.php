<?php
require_once 'connect.php';
if (isset($_POST['date']) && isset($_POST['timeslot'])) {
    $date = $_POST['date'];
    $timeslot = $_POST['timeslot'];

    $query = "INSERT INTO booking_t1 (date, timeslot) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ss', $date, $timeslot);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
        $stmt->close();
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}


$mysqli->close();
