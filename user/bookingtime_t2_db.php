<?php
if (
  isset($_POST['date']) &&
  isset($_POST['timeslot']) &&
  isset($_POST['title']) &&
  isset($_POST['name']) &&
  isset($_POST['email']) &&
  isset($_POST['tel']) &&
  isset($_POST['meeting']) &&
  isset($_POST['manutitle']) &&
  isset($_POST['booking_id'])
) {
  require_once 'connect.php';

  $date = $_POST['date'];
  $timeslot = $_POST['timeslot'];
  $title = $_POST['title'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $tel = $_POST['tel'];
  $meeting = $_POST['meeting'];
  $manutitle = $_POST['manutitle'];
  $booking_id = $_POST['booking_id'];

  $stmt1 = $mysqli->prepare("INSERT INTO booking_t2 (date, timeslot, title, name, email, tel, meeting, manutitle, booking_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt1->bind_param("sssssssss", $date, $timeslot, $title, $name, $email, $tel, $meeting, $manutitle, $booking_id);

  $result1 = $stmt1->execute();

  $stmt2 = $mysqli->prepare("INSERT INTO booking (date, timeslot, title, name, email, tel, meeting, manutitle, booking_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt2->bind_param("sssssssss", $date, $timeslot, $title, $name, $email, $tel, $meeting, $manutitle, $booking_id);

  $result2 = $stmt2->execute();

  if ($result1 && $result2) {
    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    echo '<script>
        swal({
          title: "Booking Success",
          text: "University add success",
          type: "success",
          timer: 1500,
          showConfirmButton: false
        }, function(){
          window.location = "viewdata.php";
        });
      </script>';
  } else {
    echo '<script>
        swal({
          title: "Add Data Fail",
          text: "Failed to add data",
          type: "error",
          timer: 1500,
          showConfirmButton: false
        }, function(){
          window.location.href = "viewdata.php";
        });
      </script>';
  }

  // Close the database connections
  $stmt1->close();
  $stmt2->close();
  $mysqli->close();
}
