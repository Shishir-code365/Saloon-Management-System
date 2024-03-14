<?php
session_start();
include "../connection.php";
if(!isset($_SESSION['user_id']))
{
    header("Location : ../index.php");
}
$sql = "Select * from appointment order by appointment_date, appointment_time";
$res = mysqli_query($con,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dash.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <header>
                <h1>Salon Dashboard</h1>
            </header>
            <nav>
                <ul>
                    <li><a href="#" class="nav_item" id="appointments">Appointments</a></li>
                    <li><a href="#" class="nav_item">Customers</a></li>
                    <li><a href="#" class="nav_item">Services</a></li>
                    <li><a href="#" class="nav_item">Reports</a></li>
                    <li><a href="#" class="nav_item">Settings</a></li>
                </ul>
            </nav>
            <a href = "../logout/logout.php" class="logout">Logout</a>
        </aside>
        <div class="content1">
            <header>
                <h2>Appointments</h2>
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
            </section>
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
    <script src="./admin_dash.js"></script>
</body>
</html>
