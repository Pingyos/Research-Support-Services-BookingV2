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

  // ตรวจสอบว่าข้อมูลถูกบันทึกเรียบร้อยหรือไม่
  if ($result1 && $result2) {
    // สร้างข้อความที่จะส่งไปยัง Line Notify
    // MJ8OSZyno8b7v2LqVexPMP4KuWhs5z93fS84Zhltc89
    $sToken = [""]; // เปลี่ยนเป็น Line Notify Token ของคุณ
    $sMessage = "Booking\r\n";
    $sMessage .= "\n";
    $sMessage .= "Booking Id: " . $booking_id . "\n";
    $sMessage .= "Date: " . $date . "\n";
    $sMessage .= "Time: " . $timeslot . "\n";
    $sMessage .= "Service Type: " . $title . "\n";
    $sMessage .= "Meeting Option: \n";
    $sMessage .= $meeting . "\n";
    $sMessage .= "\n";
    $sMessage .= "Booked by: " . $name . "\n";
    $sMessage .= "E-mail: " . $email . "\n";
    $sMessage .= "Tel: " . $tel . "\n";

    // สร้างฟังก์ชัน notify_message ภายในส่วน PHP ของคุณ
    function notify_message($sMessage, $Token)
    {
      $chOne = curl_init();
      curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
      curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($chOne, CURLOPT_POST, 1);
      curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
      $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $Token . '',);
      curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($chOne);
      if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
      }
      curl_close($chOne);
    }

    // เรียกใช้งานฟังก์ชัน notify_message สำหรับทุก Token
    foreach ($sToken as $Token) {
      notify_message($sMessage, $Token);
    }

    // หลังจากแจ้งเตือน Line Notify เรียบร้อยแล้ว คุณสามารถแสดงข้อความสำเร็จอื่น ๆ ได้ที่นี่
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
        window.location = "index.php";
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
        window.location.href = "index.php";
      });
    </script>';
  }
  $stmt1->close();
  $stmt2->close();
  $mysqli->close();
}
