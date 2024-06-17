<?php
session_start();
include "../connection.php";
if(!isset($_SESSION['user_id']))
{
    header("Location : ../index.php");
}


$sql = "SELECT * FROM appointment WHERE appointment_date = CURDATE() ORDER BY appointment_time ASC";
$res = mysqli_query($con,$sql);


?>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title> 
  <link rel="stylesheet" href="admin_appointment.css" />
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

        <a href="../Dashboard/admin_dash.php"  id="dash"><i class="fas fa-home icon"></i>&nbsp;Dashboard</a>
       <a href="../Admin_service/admin_service.php"> <i class="fas fa-scissors icon"></i>&nbsp;Services</a>
        <a href="../Admin_customer/customer.php"><i class="fas fa-users icon"></i>&nbsp;Customers</a>
        <a href="#" class="active"><i class="fas fa-calendar-check icon"></i>&nbsp;Appointments</a>
        
        <button class="logout">Logout <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill= "rgb(100, 100, 100)"/></svg></button>
    </div> 
    </nav>
   
    <div class="main-body">
    <h2 style="margin-bottom: 10px">Today's appointments:</h2>
            <section class="appointment-list">
            
                <table class="table1">
                    <thead>
                    <th>S.N.</th>
                    <th>Client UserName</th>
                    <th>Client Phone Number</th>
                    <th>Gender</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Service</th>
                    </thead>
                        
                    <tbody>
                        <?php if($res){
                            if(mysqli_num_rows($res)>0)
                            {
                                
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
                                    <td class='uname'>$name</td>
                                    <td class='phone'>$phone</td>
                                    <td class='gender'>$gender</td>
                                    <td class='date'>$date</td>
                                    <td class='time'>$time</td>
                                    <td class='service'>$service</td>
                                    </tr>";
                                }
                            }
                            else{
                                echo "<tr><td colspan='7' style='text-align: center;pointer-events: none'>No Appointments for today till now!!!🥲</td></tr>";
                            }
                        }?> 
                        
                        
                        
                    </tbody>
                    
                </table>
            </section>
            <h2 style="margin-bottom: 10px; margin-top:20px;">Upcoming Appointments:</h2>
            <div class="appointment-list2">
        <table>
                    <thead>
                    <th>S.N.</th>
                    <th>Client UserName</th>
                    <th>Client Phone Number</th>
                    <th>Gender</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Service</th>
                    
                    </thead>
                        
                    <tbody>
                        <?php
                        $sql2 = "SELECT * 
                        FROM appointment 
                        WHERE appointment_date BETWEEN CURDATE()+1 AND DATE_ADD(CURDATE(), INTERVAL 3 DAY) 
                        ORDER BY appointment_date ASC, appointment_time ASC";
                        
                        $res2 = mysqli_query($con,$sql2);
                        
                        
                        if($res2){
                            if(mysqli_num_rows($res2)>0)
                            {
                                
                                $i=1;
                                while ($row = mysqli_fetch_assoc($res2))
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
                            }
                            else{
                                echo "<tr><td colspan='7' style='text-align: center;pointer-events: none'>No Upcoming Appointments To Show🥲</td></tr>";
                            }
                        }?> 
                        
                        
                        
                    </tbody>
                    
                </table>
        </div>
        <form id="filterForm">
        <label for="dateFilter">Filter by Date:</label>
        <input type="date" id="dateFilter" name="dateFilter">
        <button type="submit" id="filterButton">Filter Appointments <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"fill="white"/></svg></button>
    </form>
    
    <div id="appointmentsTable">

    </div>
        
    </div>
    </div>

    
  
  <script src="../Appointment/ajax.js"></script>
    <script src="admin_appointment.js"></script>
    
</body>
</html>
</span>




                        
                        