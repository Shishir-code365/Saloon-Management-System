<?php
session_start();
include "../connection.php";
if(!isset($_SESSION['user_id']))
{
    header("Location : ../index.php");
}
if(isset($_POST['addbtn'])){

  if(isset($_POST['service-name'])&&isset($_POST['service-price'])&&isset($_POST['service-description']))
  {
  $service_name = $_POST['service-name'];
  $service_price= $_POST['service-price'];
  $service_description = $_POST['service-description'];
  
  $sql = "INSERT INTO services (service_name, service_price, service_description)VALUES (?,?,?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("sis", $service_name,$service_price, $service_description); 
  $stmt->execute();
  
  if($stmt->affected_rows>0)
  {
    echo "<script>
    alert('Services successfully added!!');
    window.location.href = 'admin_service.php';
    </script>";
    
  }
  else{
    $_SESSION['error_message'] = "Failed to add service. Please try again.";
            header("Location: admin_service.php");
            exit();
  }
}
  else{
    echo "<script>
  alert('Please insert all value');</script>";
  }
}
?>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title> 
  <link rel="stylesheet" href="admin_service.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
<div class="full-screen">
  <div class="add-service">
    <span class="exit">x</span>
    <form method="post" id="service-form">
      <h2 style="text-align:center;">Add Service</h2><br>
      <div class="sname">
      <label>Service Name</label><br>
      <input type="text" name="service-name" required>
      </div>
      <div class="sprice">
      <label for="">Service Price(Rs.)</label><br>
      <input type="number" name="service-price" id="price" required>
      </div>
      <div class="sdescription">
      <label for="">Service Description</label><br>
      <input type="text" name="service-description" required>
      </div>
      <div class="add-btn">
        <button type="submit" class="add" name="addbtn">Add</button>
      </div>
    </form> 
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

       <a href="../Dashboard/admin_dash.php"><i class="fas fa-home icon"></i>&nbsp;Dashboard</a>
       <a href="#" class="active"><i class="fas fa-scissors icon"></i>&nbsp;Services</a>
        <a href="../Admin_customer/customer.php"><i class="fas fa-users icon"></i>&nbsp;Customers</a>
        <a href="../Admin_appointment/admin_appointment.php"><i class="fas fa-calendar-check icon"></i>&nbsp;Appointments</a>
        
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>

      </div>
    </nav>
    
    <div class="service-category">
    <div class="btn">
  <button type="button" class="button">
  <span class="button__text">Add Service</span>
  <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
</button>
  </div>
  
  <?php 
$sql = "SELECT * FROM services";
$res = mysqli_query($con, $sql);
if($res && mysqli_num_rows($res) > 0) {
  $i = 1;
  while ($row = mysqli_fetch_assoc($res)) {
   
    $service_id = $row["id"];
    $servicename = $row["service_name"];
    $serviceprice = $row["service_price"];
    $servicedescription = $row["service_description"];

    echo "<div class='service-item'>
      <div class='service-details'>
        <div class='service-number'>$i. $servicename (Rs. $serviceprice)</div></br>
        <div class='service-description'>$servicedescription</div>
        <div class='service-buttons'>
          <button class='delete-btn' data-id='$service_id'><i class='fas fa-trash-alt icon' style='color: white'></i>&nbsp;Delete</button>
        </div>
      </div>
    </div>";
    $i++;
    
  }
} 

?>

 
    </div>  
  </div>   
  <script src="../Appointment/ajax.js"></script>
    <script src="admin_service.js"></script>

</body>
</html>
</span>