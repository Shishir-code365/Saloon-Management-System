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
<div class="navbar">
          <div class="logo">
            <img id="img-logo" src="../Images/logo5.jpg" alt="">
          </div>
          <div class="items">
          <ul>
            <li><a href="../Dashboard/user_dash.php">home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="../Appointment/book_appointment.php">Book Appointment</a></li>
            <li><a href="#">Review</a></li>
          </ul>
        </div>
        <div class="log-sign">
          <button class="Btn">
            <div class="sign"><svg viewBox="0 0 512 512"><path fill="#ff0000" d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg></div>
            <div class="text"><a href="../logout/logout.php">Logout</a></div>
          </button> 
         
       </div>
      </div>
      <div class="hero-section">
        <div class="container">
              <h1 class="hero-title">Book Appointment</h1><br>
              <h3 class="hero-title">Streamline Your Schedule: Book Appointments with Ease!</h3>
        </div>
      </div>
    <span class="start_appoint"><h1>Appointment Form</h1></span>
<div class="appointment_form">
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
  <div class="name">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" value="<?php echo $user_row['username'];?>" required></div>
  <div class="email">
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" value="<?php echo $user_row['email'];?>" required></div>
  <div class="phone">
  <label for="mobileNumber">Mobile Number:</label><br>
  <input type="tel" id="mobileNumber" name="mobileNumber" value="<?php echo $user_row['phone'];?>" required></div>
  <label for="gender">Gender:</label><br>
  <div class="gender">
  <div class="male">
  <input type="radio" id="male" name="gender" value="male" required>Male</div>
  <div class="female">
  <input type="radio" id="female" name="gender" value="female" required>Female</div>
  <div class="trans">
  <input type="radio" id="transgender" name="gender" value="transgender" class="trans" required>Transgender</div></div>
  
  <div class="date">
  <label for="appointmentDate">Appointment Date:</label><br>
  <input type="date" id="appointmentDate" name="appointmentDate" required></div>
  <div class="time">
  <label for="appointmentTime">Appointment Time:</label><br>
  <input type="time" id="appointmentTime" name="appointmentTime" required></div>
  <div class="service">
  <label for="service">Service:</label><br>
  <input type="text" id="service" name="service" required></div>
  <div class="submit">
  <input type="submit" value="Submit" class="btn btn-default"></div>
  </div>
</form>
<script src="book_appointment.js"></script>
</body>
</html>
