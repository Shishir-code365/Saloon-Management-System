<?php
session_start();
include "../connection.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit; 
}

if (isset($_POST['uname']) && isset($_POST['phone']) && isset($_POST['date']) && isset($_POST['time'])&& isset($_POST['service'])&& isset($_POST['gender'])) {
    $uname = $_POST['uname'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];
    $gender = $_POST['gender'];
    
    $sql = "INSERT INTO appointment_done (uname, date, time, phone,service,gender) VALUES (?, ?, ?, ?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssiss", $uname, $date, $time, $phone,$service,$gender); 
    $stmt->execute();

    if ($stmt->error) {
        echo "SQL Error: " . $stmt->error;
    } else {
        if ($stmt->affected_rows > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
} else {
    echo "Error"; 
}
?>