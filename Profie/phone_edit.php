<?php
session_start();
include "../connection.php"; 

$id = $_SESSION['user_id'];

if(isset($_POST['phoneinput_value']))
{
  $data = $_POST['phoneinput_value'];
  $checksql = "Select phone from user where phone = ?";
  $stmt2 = $con->prepare($checksql);
  $stmt2->bind_param("i",$data);
  $stmt2->execute();
  $result = $stmt2->get_result();
  if($result->num_rows>0)
  {
    echo 0;

  }

else{
    $sql = "UPDATE user SET phone = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $data, $id); 
    $stmt->execute();
    if($stmt->affected_rows > 0)
    {
      echo 1; 
      $sql2 = "UPDATE appointment SET phone = ? where user_id = ?";
      $stmt2 = $con->prepare($sql2);
      $stmt2->bind_param("ii", $data, $id); 
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
