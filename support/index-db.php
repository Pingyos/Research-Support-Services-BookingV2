<?php
// ตรวจสอบว่ามีการเรียกใช้งานผ่านการ POST หรือไม่
if (
  isset($_POST['id'])
  && isset($_POST['service'])
  && isset($_POST['note'])
  && isset($_POST['status_user'])
  && isset($_POST['dateCreate'])
) {
  require_once 'connect.php'; // เรียกใช้ไฟล์ connect.php

  $id = $_POST['id'];
  $service = $_POST['service'];
  $note = $_POST['note'];
  $status_user = $_POST['status_user'];
  $dateCreate = $_POST['dateCreate'];

  // ทำการเตรียมคำสั่ง SQL UPDATE
  $stmt = $mysqli->prepare("UPDATE booking SET service=?, note=?, status_user=?, dateCreate=? WHERE id=?");
  $stmt->bind_param('ssssi', $service, $note, $status_user, $dateCreate, $id);

  // ส่งคำสั่ง SQL ไป execute
  $result = $stmt->execute();

  // ปิดคำสั่ง SQL
  $stmt->close();

  // ปิดการเชื่อมต่อกับฐานข้อมูล
  $mysqli->close();

  // ตรวจสอบผลลัพธ์การอัปเดตและแจ้งเตือน Line Notify
  if ($result) {
    $sToken = ["MJ8OSZyno8b7v2LqVexPMP4KuWhs5z93fS84Zhltc89"]; // เปลี่ยนเป็น Line Notify Token ของคุณ
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

    // แสดงแจ้งเตือน SweetAlert หลังจากการอัปเดตเสร็จสิ้น
    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    echo '<script>
        swal({
          title: "Update Booking Success",
          text: "Success",
          type: "success",
          timer: 1500,
          showConfirmButton: false
        }, function(){
          window.location = "calendar.php";
        });
      </script>';
  } else {
    // แสดงแจ้งเตือน SweetAlert หากการอัปเดตล้มเหลว
    echo '<script>
        swal({
          title: "Update Booking Fail",
          text: "Fail",
          type: "error",
          timer: 1500,
          showConfirmButton: false
        }, function(){
          window.location.href = "calendar.php";
        });
      </script>';
  }
}
