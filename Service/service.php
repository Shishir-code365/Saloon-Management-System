<?php 
session_start();
include "../connection.php";
// $name = $_SESSION["name"];
// $email = $_SESSION["email"];
$userid = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
}
$getinfo = "SELECT * from user where id = '$userid'";
$query  = mysqli_query($con,$getinfo);
if($query)
{
  $user_row = mysqli_fetch_array($query);
}

?>
<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard</title>
  <link rel="stylesheet" href="service.css" />
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
        echo $user_row['username'];
        ?></h4>
      </div>
    </div>
  </header>
  <div class="container">
    <nav>
      <div class="side_navbar">
        <span>Main Menu</span>

       <a href="../Dashboard/user_dash.php"><i class="fas fa-home icon"></i>&nbsp;Dashboard</a>
       <a href="../Appointment/book_appointment.php"><i class="fas fa-calendar-alt icon"></i>&nbsp;Book Appointment</a>
        <a href="../Profie/profile.php"><i class="fas fa-user icon"></i>&nbsp;Profile</a>
        <a href="#"class="active"><i class="fas fa-scissors icon"></i>&nbsp;Services</a>
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>

      </div>
    </nav>
   
<div class="service-category">
  <h2>Services</h2>
  <?php 
  $sql = "SELECT * FROM services";
  $res = mysqli_query($con, $sql);
  if($res && mysqli_num_rows($res) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
      $servicename = $row["service_name"];
      $serviceprice = $row["service_price"];
      $servicedescription = $row["service_description"];

      echo "<div class='service-item'>
        <div class='service-details'>
          <div class='service-number'style='color: #333333'>$i. $servicename (Rs. $serviceprice)</div></br>
          <div class='service-description'style='color: #777777'>$servicedescription</div>
          <button class='book-now' onclick=\"redirectToBookAppointment('$servicename')\"><i class='fas fa-calendar icon' style='color: white'></i>&nbsp;Book Now</button>
        </div>
      </div>";

      $i++; 
    }
  } 
  ?>
</div>




    </div>
    
    </div>

  </div>
</body>
<script src="service.js"></script>
</html>
 </span>