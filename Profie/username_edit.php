<?php
session_start();
include "../connection.php"; 

$id = $_SESSION['user_id'];

if(isset($_POST['usernameinput_value']))
{
  $data = $_POST['usernameinput_value'];
  $checksql = "Select username from user where username = ?";
  $stmt2 = $con->prepare($checksql);
  $stmt2->bind_param("s",$data);
  $stmt2->execute();
  $result = $stmt2->get_result();
  if($result->num_rows>0)
  {
    echo 0;

  }

else{
    $sql = "UPDATE user SET username = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $data, $id); 
    $stmt->execute();
    if($stmt->affected_rows > 0)
    {
      echo 1; 
      $sql2 = "UPDATE appointment SET name = ? where user_id = ?";
      $stmt2 = $con->prepare($sql2);
      $stmt2->bind_param("si", $data, $id); 
      $stmt2->execute();
    }
    else{
        echo "NO row affected";
    }

}


}
else
{
  echo "Error: No data received"; 
}
?>
