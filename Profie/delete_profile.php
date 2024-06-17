<?php
session_start();
include "../connection.php"; 

if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];

$con->begin_transaction();

try {

    $sql_appointments = "DELETE FROM appointment WHERE user_id = ?";
    $stmt_appointments = $con->prepare($sql_appointments);
    $stmt_appointments->bind_param("i", $user_id);
    $stmt_appointments->execute();

    $sql_user = "DELETE FROM user WHERE id = ?";
    $stmt_user = $con->prepare($sql_user);
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();

    $con->commit();

    echo "success"; 
} catch (Exception $e) {

    $con->rollback();
    echo "error: " . $e->getMessage(); 
}
?>
