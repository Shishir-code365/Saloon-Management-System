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
  $check_sql = "SELECT * FROM appointment WHERE (appointment_date = '$appointmentDate' AND appointment_time = '$appointmentTime')";

  $result = mysqli_query($con,$check_sql);
  if(mysqli_num_rows($result)>0)
  {
    echo '<script>
            alert("*Another appointment already booked on the same date and same time!");</script>';
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
<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard</title>
  <link rel="stylesheet" href="book_appointment.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
  <header class="header">
    <!-- <div class="logo">
     <img src="../Images/4992262.jpg" alt="">

    </div> -->

    <div class="header-icons">
      <div class="account">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
        <h4><?php
        $username = $_SESSION['user_name'];
        echo "".$username;
        ?></h4>
      </div>
    </div>
  </header>
  <div class="container">
    <nav>
      <div class="side_navbar">
        <span>Main Menu</span>
        <a href="../Dashboard/user_dash.php">Dashboard</a>
       <a href="#" class= "active">Book Appointment</a>
        <a href="../Profie/profile.php">Profile</a>
        <a href="#">Services</a>
        <a href="#">Invoice</a>
        <a href="#">Feedback</a>
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>
      </div>
    </nav>
    <div class="apart">
    <div class="start_appoint"><h2>Appointment Form</h2></div>
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
  <label for="appointmentTime">Available Times:</label><br>
  <div id="timeButtons"></div>
  <input type="text" id="appointmentTime" name="appointmentTime" required readonly></div>
  
  <div class="service">
  <label for="service">Service:</label><br>
  <input type="text" id="service" name="service" required></div>
  <div class="submit">
  <input type="submit" value="Submit" class="btn btn-default"></div>
</form>
</div>
</div>
</div>
<script src="book_appointment.js"></script>
<script src="ajax.js"></script>
</body>
</html>
</span>