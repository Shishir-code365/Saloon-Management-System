<?php 
session_start();
include "../connection.php";
$userid = $_SESSION['user_id'];
$username = $_SESSION["user_name"];
$name = $_SESSION['name'];
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

       <a href="#" class="active" id="dash"><i class="fas fa-home icon"></i>&nbsp;Dashboard</a>
       <a href="../Appointment/book_appointment.php" id="book"><i class="fas fa-calendar-alt icon"></i>&nbsp;Book Appointment</a>
        <a href="../Profie/profile.php"><i class="fas fa-user icon"></i>&nbsp;Profile</a>
        <a href="../Service/service.php"><i class="fas fa-scissors icon"></i>&nbsp;Services</a>
        
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>

      </div>
    </nav>

    <div class="main-body">
      
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1 style="text-transform: capitalize">Welcome <?php
        echo "".$_SESSION["name"];
         ?></h1>
        <span>Transform Your Look, Book Your Appointment Now!</span>
        <button class="book"><i class="fas fa-calendar-alt icon"></i>&nbsp;Book Appointment</button>
      </div>
      
        <div class="row">
            <h4>Your Booked Appointments</h4>
 
          </div>
        <div class="list2">
         
         <table>
           <thead>
             <tr>
               <th>S.N.</th>
               <th>Appointment Date</th>
               <th>Appointment Time</th>
               <th>Service</th>
               <th>Status</th>
               
             </tr>
           </thead>
           <tbody>
           <?php 
              $sql2="SELECT appointment_date, appointment_time, service,status
              FROM appointment 
              WHERE user_id = '$userid' 
              AND appointment_date >= CURDATE()
              ORDER BY appointment_date ASC, appointment_time ASC";
              
               $res2 = mysqli_query($con,$sql2);
               if($res2)
               {
                 if (mysqli_num_rows($res2) > 0) {
                 $i = 1;
                 while ($row = mysqli_fetch_assoc($res2))
                 {
                   $appointmentDate = $row["appointment_date"];
                   $appointmentTime = $row["appointment_time"];
                   $service = $row["service"];
                    $status = $row["status"];
                    $statusClass = ($status == 'unpaid') ? 'unpaid' : (($status == 'paid') ? 'paid' : '');

                   echo "<tr>
                   <td>".$i++."</td>
                   <td class='appointmentDate'>$appointmentDate</td>
                   <td class='appointmentTime'>$appointmentTime</td>
                   <td class='service'>$service</td>
                   <td class='status $statusClass'>$status</td>
                   <td><button class ='view-button'><i class='fas fa-file-invoice icon'style='color: white'></i>&nbsp;View Invoice</button></td>
                   <td><button class ='delete-button'><i class='fas fa-trash-alt icon'id='del'></i>&nbsp;Delete Appointment</button></td>
                 </tr>";
                 }
                 
               }
               else {
                 echo "<tr><td colspan='5' style='text-align: center;'>No Appointments made till now!!!🥲</td></tr>";
             }
               
               }
              
               
               ?>
             <!-- <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><path d='M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z'/></svg> -->

           </tbody>
         </table>
       </div>

       <h2 style="margin-top: 20px">Find Your Appointments</h2>
       <form id="filterForm">
           <label for="dateFilter">Filter by Date:</label>
           <input type="date" id="dateFilter" name="dateFilter">
           <button type="submit" id="filterButton">Filter Appointments&nbsp;<i class="fas fa-filter icon"></i></button>
       </form>
       <div id="appointmentsTable">

</div>
    </div>
  </div>

</body>
<script src = "../Appointment/ajax.js"></script>
<script src="user_dash.js"></script>
</html>
 </span>
             