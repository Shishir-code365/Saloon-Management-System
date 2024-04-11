<?php
session_start();
include "../connection.php"; 

$id = $_SESSION['user_id'];

if(isset($_POST['emailinput_value']))
{
  
  $data = $_POST['emailinput_value'];
  $checksql = "Select email from user where email = ?";
  $stmt2 = $con->prepare($checksql);
  $stmt2->bind_param("s",$data);
  $stmt2->execute();

  $result = $stmt2->get_result();
  if($result->num_rows>0)
  {
    echo 0;

  }

else{
    $sql = "UPDATE user SET email = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $data, $id); 
    $stmt->execute();
    if($stmt->affected_rows > 0)
    {
      echo 1; 
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
