<?php
session_start();
include "../connection.php";
if(!isset($_SESSION['user_id']))
{
    header("Location : ../index.php");
}
$currentDate = date("Y-m-d");
$sql = "SELECT * FROM appointment WHERE appointment_date = curdate() ORDER BY appointment_time ASC";
$res = mysqli_query($con,$sql);


?>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
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
        <h4>Admin</h4>
      </div>
    </div>
  </header>
  <div class="container">
    <nav>
      <div class="side_navbar">
        <span>Admin Dashboard</span>

       <a href="#" class="active" id="dash"><i class="fas fa-home icon"></i>&nbsp;Dashboard</a>
       <a href="../Admin_service/admin_service.php"> <i class="fas fa-scissors icon"></i>&nbsp;Services</a>
        <a href="../Admin_customer/customer.php"><i class="fas fa-users icon"></i>&nbsp;Customers</a>
        <a href="../Admin_appointment/admin_appointment.php"><i class="fas fa-calendar-check icon"></i>&nbsp;Appointments</a>
        
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>

      </div>
    </nav>

        <div class="content1">
            <header>
                <h2>Dashboard   </h2>
            </header>
            <section class="overview">
                <div class="card1">
                    <h3><i class="fas fa-calendar-check card-icon" style="color:#5d3fd3"></i>&nbsp;Appointments This Month</h3>
                    
                        <?php
                        $count_sql = "SELECT COUNT(*) AS total 
                        FROM appointment 
                        WHERE MONTH(appointment_date) = MONTH(CURRENT_DATE()) 
                        AND YEAR(appointment_date) = YEAR(CURRENT_DATE());
                        ";
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
                    <h3><i class="fas fa-calendar-day card-icon"style="color:#5d3fd3"></i>&nbsp;Today's Appointments</h3>
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
                    <h3><i class="fas fa-users card-icon" style="color: #5d3fd3;"></i>&nbsp;Total Customers</h3>
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
                
                <table class="list-table">
                    <thead>
                    <th>S.N.</th>
                    <th>Client UserName</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Appointment Time</th>
                    <th>Service</th>
                    <th>Payment Status</th>
                    </thead>
                        
                    <tbody>
                        <?php if($res){
                            if(mysqli_num_rows($res)>0)
                            {
                                
                                $i=1;
                                while ($row = mysqli_fetch_assoc($res))
                                {
                                    $statusColor = $row['status'] === 'unpaid' ? 'red' : ($row['status'] === 'paid' ? 'green' : 'inherit');
                                    $name = $row["name"];
                                    $phone = $row["phone"];
                                    $gender = $row["gender"];
                                    $date = $row["appointment_date"];
                                    $time = $row["appointment_time"];
                                    $service = $row["service"];
                                    $status = $row['status'];
                                    
                                    echo "<tr>
                                    <td>".$i++."</td>
                                    <td class='uname'>$name</td>
                                    <td class='phone'>$phone</td>
                                    <td>$gender</td>

                                    <td class='time'>$time</td>
                                    <td class='service'>$service</td>
                                    <td class='status' style='color: $statusColor; text-transform: uppercase'>{$row['status']}</td>
                                    <td><button class ='view-button'><i class='fas fa-file-invoice icon'style='color: white'></i>&nbsp;View Invoice</button></td>
                                    <td><button class='change-btn'>Change status</button></td>
                                    <td class='date'>$date</td>
                                    </tr>";
                                }
                            }
                            else{
                                echo "<tr><td colspan='7' style='text-align: center;pointer-events:none'>No Appointments for today till now!!!🥲</td></tr>";
                            }
                        }?> 
                        
                        
                        
                    </tbody>
                    
                </table>
            </section>
            
        </div>
    </div>
    <script src = "../Appointment/ajax.js"></script>
    <script src="admin_dash.js"></script>

</body>
</html>
</span>
