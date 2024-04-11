<?php
session_start();
include "../connection.php";
if(!isset($_SESSION['user_id']))
{
    header("Location : ../index.php");
}
$currentDate = date("Y-m-d");
$sql = "SELECT * FROM appointment WHERE appointment_date = '$currentDate' ORDER BY appointment_time ASC";
$res = mysqli_query($con,$sql);


?>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard</title>
  <link rel="stylesheet" href="admin_dash.css" />
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
        <span>Admin Dashboard</span>

       <a href="#" class="active" id="dash">Dashboard</a>
       <a href="#">Services</a>
        <a href="#">Customers</a>
        <a href="#">Appointments</a>
        
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>

      </div>
    </nav>

        <div class="content1">
            <header>
                <h2>Dashboard   </h2>
            </header>
            <section class="overview">
                <div class="card1">
                    <h3>Total Appointments</h3>
                    
                        <?php
                        $count_sql = "Select count(*)as total from appointment";
                        $exec = mysqli_query($con,$count_sql);
                        
                        if($exec)
                        {
                            $row = mysqli_fetch_assoc($exec);
                            $total = $row["total"];
                            echo "<p>$total</p>";
                        }
                        ?>
                   
                </div>
                <div class="card2">
                    <h3>Today's Appointments</h3>
                    <?php
                    $today_sql = "Select count(*) as today from appointment where appointment_date = curdate()";
                    $res1 = mysqli_query($con,$today_sql);
                    if($res1)
                    {
                        $row1 = mysqli_fetch_assoc($res1);
                        $today = $row1["today"];
                        echo "<p>$today</p>";
                    }
                    ?>
                </div>

                <div class="card3">
                    <h3>Total Customers</h3>
                    <?php
                    $today_sql = "Select count(*) as today from user";
                    $res1 = mysqli_query($con,$today_sql);
                    if($res1)
                    {
                        $row1 = mysqli_fetch_assoc($res1);
                        $today = $row1["today"];
                        echo "<p>$today</p>";
                    }
                    ?>
                </div>
            </section>
            <h2 style="margin-bottom: 10px">Today's appointments:</h2>
            <section class="appointment-list">
                
                <table>
                    <thead>
                    <th>S.N.</th>
                    <th>Client Name</th>
                    <th>Client Phone Number</th>
                    <th>Gender</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Service</th>
                    </thead>
                        
                    <tbody>
                        <?php if($res){
                            $i=1;
                            while ($row = mysqli_fetch_assoc($res))
                            {
                                $name = $row["name"];
                                $phone = $row["phone"];
                                $gender = $row["gender"];
                                $date = $row["appointment_date"];
                                $time = $row["appointment_time"];
                                $service = $row["service"];
                                
                           echo "<tr>
                             <td>".$i++."</td>
                             <td>$name</td>
                             <td>$phone</td>
                             <td>$gender</td>
                             <td>$date</td>
                             <td>$time</td>
                             <td>$service</td>
                         </tr>";
                            }
                        }?> 
                        
                        
                        
                    </tbody>
                    
                </table>
            </section>
            
        </div>
    </div>
    <script src="admin_dash.js"></script>
</body>
</html>
</span>