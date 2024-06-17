<?php
include "../connection.php";

if(isset($_POST['appointmentDate'])&&isset($_POST['appointmentTime'])&&isset($_POST['service'])){
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $service = $_POST['service'];

    $sql = "DELETE FROM appointment 
    WHERE appointment_date = ? 
    AND appointment_time = ? 
    AND service = ? 
    AND TIMEDIFF(CONCAT(appointment_date, ' ', appointment_time), NOW()) >= '01:00:00'";
    

    $stmt  = $con->prepare($sql);
    $stmt->bind_param("sss",$appointmentDate,$appointmentTime,$service);
    $stmt->execute();


    if($stmt->affected_rows>0)
    {
        echo "success";
    }
    else{
        echo "failure";
    }
}
?>