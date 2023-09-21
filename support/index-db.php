<?php
if (
    isset($_POST['id'])
    && isset($_POST['service'])
    && isset($_POST['note'])
    && isset($_POST['status_user'])
    && isset($_POST['dateCreate'])
) {
    require_once 'connect.php';
    $id = $_POST['id'];
    $service = $_POST['service'];
    $note = $_POST['note'];
    $status_user = $_POST['status_user'];
    $dateCreate = $_POST['dateCreate'];
    $stmt = $mysqli->prepare("UPDATE booking SET service=?, note=?, status_user=?, dateCreate=? WHERE id=?");
    $stmt->bind_param('ssssi', $service, $note, $status_user, $dateCreate, $id);
    $result = $stmt->execute();

    $stmt = $mysqli->prepare("SELECT * FROM booking WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    if ($result) {
        $sToken = [""];
        $sMessage .= "";
        $sMessage .= "Booking Id: " . $row['booking_id'] . "\n";
        $sMessage .= "Date: " . $row['date'] . "\n";
        $sMessage .= "Time: " . $row['timeslot'] . "\n";
        $sMessage .= "Service Type: " . $row['title'] . "\n";
        $sMessage .= "\n";
        $sMessage .= "Booked by: " . $row['name'] . "\n";
        $sMessage .= "E-mail: " . $row['email'] . "\n";
        $sMessage .= "Tel: " . $row['tel'] . "\n";
        $sMessage .= "\n";
        $sMessage .= $row['meeting'] . ":" . $row['service'] . "\n";
        $sMessage .= "Note: " . $row['note'] . "\n";
        $sMessage .= "Update: " . $row['dateCreate'] . "\n";
        $sMessage .= "\n";
        $sMessage .= "login : " . "https://app.nurse.cmu.ac.th/booking" . "\n";


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

        // Call the notify_message function for each Line token
        foreach ($sToken as $Token) {
            notify_message($sMessage, $Token);
        }
    }

    $mysqli->close();

    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($result) {
        echo '<script>
            swal({
              title: "Update Booking Success",
              text: "success",
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
              title: "Update Booking Fail",
              text: "fail",
              type: "fail",
              timer: 1500,
              showConfirmButton: false
            }, function(){
              window.location.href = "index.php";
            });
          </script>';
    }
}
