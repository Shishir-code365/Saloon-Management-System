<?php
session_start();
include "../connection.php";
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['mobileNumber'];
  $gender = $_POST['gender'];
  $appointmentDate = date("Y-m-d", strtotime($_POST['appointmentDate']));
  $appointmentTime = date("H:i:s", strtotime($_POST['appointmentTime']));

  $service = $_POST['service'];
  $check_sql = "Select * from appointment where appointment_date= '$appointmentDate' and ((appointment_time = '$appointmentTime') or (appointment_time >= '$appointmentTime' and appointment_time < ADDTIME('$appointmentTime','00:30:00 ')))";
  $result = mysqli_query($con,$check_sql);
  if(mysqli_num_rows($result)>0)
  {
    echo "*Another appointment already booked on the same date and same time!";
  }
  else{
    $sql = "insert into appointment (name,email,phone,gender,appointment_date,appointment_time,service) values('$name','$email','$phone','$gender','$appointmentDate','$appointmentTime','$service')";
  
  $exec = mysqli_query($con,$sql);
 
  if($exec)
  
  {
    
    echo '<script>
            alert("Booked Successfully");
                window.location.href = "../Dashboard/user_dash.php";
          </script>';
    exit();
  }
  else{
   echo "Error: " . mysqli_error($con);
  }
  }
  
  
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="book_appointment.css">
</head>
<body>
  <div class="small_img">
  <img src="" alt="">
  </div>  
<form id="appointmentForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  <?php
  $userid = $_SESSION['user_id'];
  $user_sql = "SELECT username, email, phone from user where id = '$userid'";
  $user_result = mysqli_query($con,$user_sql);
  if($user_result)
  {
    $user_row = mysqli_fetch_array($user_result);
  }
   
  ?>
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" value="<?php echo $user_row['username'];?>" required><br>
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" value="<?php echo $user_row['email'];?>" required><br>
  <label for="mobileNumber">Mobile Number:</label><br>
  <input type="tel" id="mobileNumber" name="mobileNumber" value="<?php echo $user_row['phone'];?>" required><br>
  <label for="gender">Gender:</label><br>
  <input type="radio" id="male" name="gender" value="male" required>Male
  <input type="radio" id="female" name="gender" value="female" required>Female
  <input type="radio" id="transgender" name="gender" value="transgender" required>Transgender
  <br>
  <label for="appointmentDate">Appointment Date:</label><br>
  <input type="date" id="appointmentDate" name="appointmentDate" required><br>
  <label for="appointmentTime">Appointment Time:</label><br>
  <input type="time" id="appointmentTime" name="appointmentTime" required><br>
  <label for="service">Service:</label><br>
  <input type="text" id="service" name="service" required><br>
  <input type="submit" value="Submit">
  
</form>
<script src="book_appointment.js"></script>
</body>
</html>
