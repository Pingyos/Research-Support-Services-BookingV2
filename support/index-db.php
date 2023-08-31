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

    // เรียกใช้งาน SweetAlert ตามผลลัพธ์การอัปเดต
    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    
    if ($result) {
        echo '<script>
            swal({
              title: "Edit Data Success",
              text: "success",
              type: "success",
              timer: 1500,
              showConfirmButton: false
            }, function(){
              window.location = "calendar.php";
            });
          </script>';
    } else {
        echo '<script>
            swal({
              title: "Edit data fail",
              text: "fail",
              type: "fail",
              timer: 1500,
              showConfirmButton: false
            }, function(){
              window.location.href = "calendar.php";
            });
          </script>';
    }
}
