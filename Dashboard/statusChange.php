<?php
include "../connection.php";

if (isset($_POST['time']) && isset($_POST['phone']) && isset($_POST['date'])) {
    $phone = $_POST['phone'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    $sql = "SELECT status FROM appointment WHERE phone = ? AND appointment_time = ? AND appointment_date = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iss", $phone, $time, $date);
    $stmt->execute();
    $stmt->bind_result($status);
    $stmt->fetch();
    $stmt->close();

    if ($status === "unpaid") {

        $sql2 = "UPDATE appointment SET status = 'paid' WHERE phone = ? AND appointment_time = ? AND appointment_date = ?";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("iss", $phone, $time, $date);
        $stmt2->execute();

        if ($stmt2->affected_rows > 0) {
            echo "paid";
        } else {
            echo "failure";
        }
        $stmt2->close();
    } else if ($status === "paid") {
  
        $sql3 = "UPDATE appointment SET status = 'unpaid' WHERE phone = ? AND appointment_time = ? AND appointment_date = ?";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bind_param("iss", $phone, $time, $date);
        $stmt3->execute();

        if ($stmt3->affected_rows > 0) {
            echo "unpaid";
        } else {
            echo "failure";
        }
        $stmt3->close();
    } else {
        echo "Invalid status found in database";
    }
} else {
    echo "Cannot get data";
}
?>
