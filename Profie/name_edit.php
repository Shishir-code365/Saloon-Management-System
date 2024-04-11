<?php
session_start();
include "../connection.php"; 

$id = $_SESSION['user_id'];

if(isset($_POST['nameinput_value']))
{
  $data = $_POST['nameinput_value'];
  $sql = "UPDATE user SET Name = ? WHERE id = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("si", $data, $id); 
  $stmt->execute();
  
  if($stmt->affected_rows > 0)
  {
    echo 1; 
  }
  else
  {
    echo 0; 
  }
}
else
{
  echo "Error: No data received"; 
}
?>
