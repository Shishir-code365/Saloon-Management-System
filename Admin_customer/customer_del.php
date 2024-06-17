<?php
session_start();
include "../connection.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit; // Make sure to stop further execution
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $sql_appointments = "DELETE FROM appointment WHERE email = ?";
    $stmt_appointments = $con->prepare($sql_appointments);
    $stmt_appointments->bind_param("s", $email);
    $stmt_appointments->execute();
   
    $sql = "DELETE FROM user WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Check for errors after executing the prepared statement
    if ($stmt->error) {
        echo "SQL Error: " . $stmt->error;
    } else {
        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "No records deleted".$email; // This could happen if the email doesn't exist in the database
        }
    }
} else {
    echo "Error: Email not provided"; 
}
?>