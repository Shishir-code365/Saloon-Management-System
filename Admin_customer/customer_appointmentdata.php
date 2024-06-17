<?php

include "../connection.php";
if (isset($_POST['email_customer'])) {
    $email_customer = $_POST['email_customer'];
    $sql = "select * from appointment where email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s',$email_customer);
    $stmt->execute();

    $result = $stmt->get_result();
    $appointments = [];
    if($result->num_rows>0){
       
        while($row = $result->fetch_assoc()){
            $appointments[] = [
                "appointmentDate" => $row['appointment_date'],
                "appointmentTime" => $row['appointment_time'],
                "service" => $row['service'],
                "status" => $row['status']
            ];
        }
        echo json_encode($appointments);
    }
    else{
        echo json_encode(["error" => "No records found for email: " . htmlspecialchars($email_customer)]);
    }
}
else{
    echo "Email not set!";
}

?>