<?php
include "../connection.php";

if(isset($_POST['serviceId'])){
    $serviceId = $_POST['serviceId'];

    $sql = "DELETE FROM services 
    WHERE id= ?";
    

    $stmt  = $con->prepare($sql);
    $stmt->bind_param("i",$serviceId);
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