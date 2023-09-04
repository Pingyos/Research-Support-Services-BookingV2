<?php
require_once 'connect.php';

if (isset($_POST['date']) && isset($_POST['timeslot'])) {
    $date = $_POST['date'];
    $timeslot = $_POST['timeslot'];

    // ตรวจสอบและกำหนดค่าว่างให้กับข้อมูลที่ไม่ระบุ
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $meeting = isset($_POST['meeting']) ? $_POST['meeting'] : '';
    $manutitle = isset($_POST['manutitle']) ? $_POST['manutitle'] : '';
    $booking_id = isset($_POST['booking_id']) ? $_POST['booking_id'] : '';

    $query = "INSERT INTO booking_t1 (date, timeslot, title, name, email, tel, meeting, manutitle, booking_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param('sssssssss', $date, $timeslot, $title, $name, $email, $tel, $meeting, $manutitle, $booking_id);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        echo 'error: ' . $mysqli->error;
    }
} else {
    echo 'error';
}

$mysqli->close();
