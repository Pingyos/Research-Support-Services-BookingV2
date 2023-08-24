<?php
if (
  isset($_POST['date'])
  && isset($_POST['timeslot'])
  && isset($_POST['title'])
  && isset($_POST['name'])
  && isset($_POST['email'])
  && isset($_POST['tel'])
  && isset($_POST['meeting'])
  && isset($_POST['manutitle'])
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

  // Insert data into booking_t2 table
  $stmt_t2 = $mysqli->prepare("INSERT INTO booking_t1 (date, timeslot, title, name, email, tel, meeting, manutitle)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt_t2->bind_param('ssssssss', $date, $timeslot, $title, $name, $email, $tel, $meeting, $manutitle);

  // Insert data into bookingall table
  $stmt_all = $mysqli->prepare("INSERT INTO booking (date, timeslot, title, name, email, tel, meeting, manutitle)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt_all->bind_param('ssssssss', $date, $timeslot, $title, $name, $email, $tel, $meeting, $manutitle);

  // Execute both statements
  if ($stmt_t2->execute() && $stmt_all->execute()) {
    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    echo '<script>
        swal({
          title: "Add Data Success",
          text: "University add success",
          type: "success",
          timer: 1500,
          showConfirmButton: false
        }, function(){
            window.location = "bookingtime_t1.php?date=' . $date . '&title=' . $title . '";
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
          window.location.href = "bookingtime_t1.php";
        });
      </script>';
  }
  $mysqli->close();
}
