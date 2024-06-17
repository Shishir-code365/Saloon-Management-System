<?php
session_start();
include "../connection.php"; 

$id = $_SESSION['user_id'];

if(isset($_POST['passwordinput_value']))
{
  $data = $_POST['passwordinput_value'];
  $hashedPassword = md5($data);
  $sql = "UPDATE user SET original_password = ?, password = ? WHERE id = ?";
  $stmt = $con->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("ssi", $data, $hashedPassword, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 1;
        
    } else {

        echo 0;
    }
    $stmt->close();
}}   else {

    echo "Error preparing statement: " . $con->error;
}
?>
