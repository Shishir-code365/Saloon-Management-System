<?php 
session_start();
include "../connection.php";
$username = $_SESSION["user_name"];
if(!isset($_SESSION['user_id'])){

    header("Location: ../index.php");
}

if(isset($_SESSION['redirect'])&&($_SESSION['redirect'])==true){

  echo"<script>alert('Signed Up Successfully')</script>";
  unset($_SESSION['redirect']);
}

?>

<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard</title>
  <link rel="stylesheet" href="user_dash.css" />
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

       <a href="#" class="active" id="dash">Dashboard</a>
       <a href="../Appointment/book_appointment.php" id="book">Book Appointment</a>
        <a href="../Profie/profile.php">Profile</a>
        <a href="#">Services</a>
        <a href="#">Invoice</a>
        <a href="#">Feedback</a>
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>

      </div>
    </nav>

    <div class="main-body">
      
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1 style="text-transform: capitalize">Welcome <?php
        echo "".$_SESSION["user_name"];
         ?></h1>
        <span>Transform Your Look, Book Your Appointment Now!</span>
        <button class="book">Book Appointment</button>
      </div>
      <div class="row">
            <h4>Your Past Appointments</h4>
 
          </div>
        <div class="list1">
         
          <table>
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Service</th>
                
              </tr>
            </thead>
            <tbody>
            <?php 
                $sql = "Select appointment_date, appointment_time, service from appointment where name = '$username' order by appointment_date, appointment_time";
                $res = mysqli_query($con,$sql);
                if($res)
                {
                  if (mysqli_num_rows($res) > 0) {
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($res))
                  {
                    $appointmentDate = $row["appointment_date"];
                    $appointmentTime = $row["appointment_time"];
                    $service = $row["service"];

                    echo "<tr>
                    <td>".$i++."</td>
                    <td>$appointmentDate</td>
                    <td>$appointmentTime</td>
                    <td>$service</td>
                  </tr>";
                  }
                  
                }
                else {
                  echo "<tr><td colspan='3' style='text-align: center;'>No Appointments made till now!!!🥲</td></tr>";
              }
                
                }
               
                
                ?>
              

            </tbody>
          </table>
        </div>
    </div>
   
    <!-- <div class="profile" ><h1>Profile</h1></div>
    <div class="service" ><h1>Servicces</h1></div>
    <div class="invoice" ><h1>Invoice</h1></div>
    <div class="feedback"><h1>Feedback</h1>></div> -->
  </div>

</body>
<script src="user_dash.js"></script>
</html>
 </span>