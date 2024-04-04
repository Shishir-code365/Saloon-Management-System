<?php
include "../connection.php";

if (isset($_POST['selectDate'])) {
    $selectedDate = date("Y-m-d", strtotime($_POST['selectDate']));

    $query = "SELECT appointment_time FROM appointment WHERE appointment_date = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $bookedTimes = array();
    while ($row = $result->fetch_assoc()) {
        $bookedTimes[] = $row['appointment_time'];
    }
    
    echo json_encode($bookedTimes);
}
?>
