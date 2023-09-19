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
  && isset($_POST['booking_id'])
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

  // Prepare the statement for booking_t1 table
  $stmt_t2 = $mysqli->prepare("INSERT INTO booking_t1 (date, booking_id, timeslot, title, name, email, tel, meeting, manutitle)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

  if ($stmt_t2 === false) {
    die("Prepare failed: " . $mysqli->error);
  }

  $result = $stmt_t2->bind_param('sssssssss', $date, $booking_id, $timeslot, $title, $name, $email, $tel, $meeting, $manutitle);

  if ($result === false) {
    die("Bind failed: " . $stmt_t2->error);
  }

  if ($stmt_t2->execute()) {
    $booking_id = $stmt_t2->insert_id;

    // Prepare the statement for booking table
    $stmt_all = $mysqli->prepare("INSERT INTO booking (booking_id, date, timeslot, title, name, email, tel, meeting, manutitle)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt_all === false) {
      die("Prepare failed: " . $mysqli->error);
    }

    $result_all = $stmt_all->bind_param('ssssssssss', $booking_id, $date, $timeslot, $title, $name, $email, $tel, $meeting, $manutitle);

    if ($result_all === false) {
      die("Bind failed: " . $stmt_all->error);
    }

    // Execute statement for booking
    if ($stmt_all->execute()) {
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
    $stmt_all->close(); // Close the statement
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
  $stmt_t2->close(); // Close the statement
  
  $mysqli->close();
}
