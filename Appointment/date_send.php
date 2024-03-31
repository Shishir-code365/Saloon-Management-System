<?php
include "../connection.php";

if(isset($_POST['selectDate'])) {
    $selectedDate = date("Y-m-d", strtotime($_POST['appointmentDate']));

    $query = "SELECT appointment_time FROM appointments WHERE appointment_date = ?";

    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$selectedDate]);
    $bookedTimes = $stmt->fetchAll(PDO::FETCH_COLUMN);
    

    if (count($bookedTimes) > 0) {
        echo json_encode($bookedTimes); // Return booked times if there are any
    } else {
        // No booked times on this date, echo nothing
    }
}
?>
