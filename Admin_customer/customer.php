<?php

session_start();
 
include "../connection.php";
if(!isset($_SESSION['user_id']))
{
    header("Location : ../index.php");
}
$sql = "Select * from user";
$query = mysqli_query($con,$sql);
if($query)
{
    $row = mysqli_fetch_assoc($query);
}

?>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title> 
  <link rel="stylesheet" href="customer.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
<div class="full-screen">

<div class="add-service">
<span class="exit">x</span>
<div class="profile-logo2">
    <div class="svg">
      <img src="../Images/user.jpg" alt="">
      <h4></h4>
      <p></p>
      </div>
  </div>
  <div class="info-content">
  <span class="content-header"><h2>Customer Info</h2></span> 
    <div class="setting-content">
    <table class="tableData">
          <tr>
            <th>Name:</th>
            <td class="name"></td>
          </tr>
          <tr>
            <th>Email:</th>
            <td class="email"></td>
          </tr>
          <tr>
            <th>Phone:</th>
            <td class="phone"></td>
          </tr>
          <tr>
            <th>Username:</th>
            <td class="username"></td>
          </tr>
    </table>
    </div>
    <div class="row">
            <h2>Customer Booked Appointments</h2></div>
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
          <tbody id="appointmentBody"></tbody>
         </table>
         </div>
  </div>
</div>

</div>  
  <header class="header">
    <!-- <div class="logo">
     <img src="../Images/4992262.jpg" alt="">

    </div> -->

    <div class="header-icons">
      <div class="account">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
        <h4>Admin</h4>
      </div>
    </div>
  </header>

  <div class="container">
 
    <nav>
      <div class="side_navbar">
        <span>Admin Dashboard</span>

        <a href="../Dashboard/admin_dash.php"  id="dash"><i class="fas fa-home icon"></i>&nbsp;Dashboard</a>
       <a href="../Admin_service/admin_service.php"> <i class="fas fa-scissors icon"></i>&nbsp;Services</a>
        <a href="#" class="active"><i class="fas fa-users icon"></i>&nbsp;Customers</a>
        <a href="../Admin_appointment/admin_appointment.php"><i class="fas fa-calendar-check icon"></i>&nbsp;Appointments</a>
        
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>
    </div> 
    </nav>
    
    <div class="main-body">
   <div class="header1">
     <h2>Customers</h2>
     <input type="text" id="searchInput" onkeyup="searchCustomers()" placeholder="Search with customer username">

</div>
  <div class="users">


    <?php
    echo '<div class="grid-container">';
    
    while($row = mysqli_fetch_assoc($query))
    {
        
        echo'<div class="card">';
       
        echo'<div class="profile-logo"><img src="../Images/user.jpg"></img></div>';
        
        echo'<div class="detail">';
        echo '<p class="customer-username">Username: ' .$row['username'] . '</p>';
        
        echo'<p class="customer-email">Email: ' .$row['email']. '</p>';
        // echo'<p>Phone: ' .$row['phone']. '</p>';
        // echo'<p>Username: ' .$row['username'].'</p>';
        echo'</div>';
        echo'<div class="seemore"><button class="see-button">See More</button></div>';
        echo'<div class="delbtn"><button class="delete-button"><i class="fas fa-trash-alt icon" style="color: white"></i>&nbsp;Delete Account</button></div>';
        echo'</div>';
        
    }
    echo '</div>';
    ?>

    </div>
    </div>


  </div>
 
  <script src="../Appointment/ajax.js"></script>
    <script src="customer.js"></script>

</body>
</html>
</span>