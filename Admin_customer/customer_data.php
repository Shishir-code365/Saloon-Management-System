<?php

if (isset($_POST['email_customer'])) {
    include ("../connection.php");
    $email_customer = $_POST['email_customer'];

    $sql = "SELECT username, email, phone, Name FROM user WHERE email = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        echo json_encode(["error" => "SQL Error: " . $con->error]);
    } else {
        $stmt->bind_param("s", $email_customer);
        $stmt->execute();

        if ($stmt->error) {
            echo json_encode(["error" => "SQL Error: " . $stmt->error]);
        } else {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo json_encode([
                    "username" => $row['username'],
                    "email" => $row['email'],
                    "phone" => $row['phone'],
                    "name" => $row['Name']
                ]);
            } else {
                echo json_encode(["error" => "No records found for email: " . htmlspecialchars($email_customer)]);
            }
        }

        $stmt->close();
    }
    $con->close();
} else {
    echo json_encode(["error" => "Email not set"]);
}
?>
