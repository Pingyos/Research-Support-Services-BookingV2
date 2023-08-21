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

    // SQL insert
    $stmt = $conn->prepare("INSERT INTO booking_t1 (date, timeslot, title, name, tel, meeting, manutitle)
    VALUES (:date, :timeslot, :title, :name, :tel, :meeting, :manutitle)");

    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':timeslot', $timeslot, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindParam(':meeting', $meeting, PDO::PARAM_STR);
    $stmt->bindParam(':manutitle', $manutitle, PDO::PARAM_STR);

    $result = $stmt->execute();
    $stmt = $conn->prepare("SELECT id FROM booking_t1 WHERE date = :date");
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $result['id'];
    if ($result) {
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
            window.location = "Date-University-View.php?university_id=' . $id . '";
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
          window.location.href = "Date-University-View.php";
        });
      </script>';
    }
    $conn = null;
}
