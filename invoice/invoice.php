<?php
session_start();
include "../connection.php";
$userid = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
    exit();
}

$getinfo = "SELECT * FROM user WHERE id = '$userid'";
$query  = mysqli_query($con, $getinfo);
if($query) {
    $user_row = mysqli_fetch_array($query);
}

// Retrieve upcoming appointments for the user
$upcomingAppointmentsQuery = "SELECT * FROM appointment WHERE name = '" . $user_row['username'] . "' AND appointment_date > CURDATE()";
$upcomingAppointmentsResult = mysqli_query($con, $upcomingAppointmentsQuery);

// Retrieve past appointments for the user
$pastAppointmentsQuery = "SELECT * FROM appointment WHERE name = '" . $user_row['username'] . "' AND appointment_date <= CURDATE()";
$pastAppointmentsResult = mysqli_query($con, $pastAppointmentsQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Dashboard</title>
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="invoice.css">
</head>
<body>
<header class="header">
    <div class="header-icons">
        <div class="account">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
            </svg>
            <h4><?php echo $user_row['username']; ?></h4>
        </div>
    </div>
</header>
<div class="container">
    <nav>
        <div class="side_navbar">
            <span>Main Menu</span>
            <a href="../Dashboard/user_dash.php">Dashboard</a>
            <a href="../Appointment/book_appointment.php">Book Appointment</a>
            <a href="../Profile/profile.php">Profile</a>
            <a href="../Service/service.php">Services</a>
            <a href="#" class="active">Invoice</a>
            <a href="#">Feedback</a>
            <a href="../logout.php" class="logout">Logout
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" fill="rgb(100, 100, 100)"/>
                </svg>
            </a>
        </div>
    </nav>

    <div class="invoice">
        <h2>Upcoming Appointments</h2>
        <?php
        if(mysqli_num_rows($upcomingAppointmentsResult) > 0) {
            while($appointment = mysqli_fetch_assoc($upcomingAppointmentsResult)) {
                echo "<p><strong>Appointment ID:</strong> " . $appointment['id'] . "</p>";
                echo "<p><strong>Name:</strong> " . $appointment['name'] . "</p>";
                // Display other details as needed
            }
        } else {
            echo "<p>No upcoming appointments found.</p>";
        }
        ?>
        <hr>
        <h2>Past Appointments</h2>
        <?php
        if(mysqli_num_rows($pastAppointmentsResult) > 0) {
            while($appointment = mysqli_fetch_assoc($pastAppointmentsResult)) {
                echo "<p><strong>Appointment ID:</strong> " . $appointment['id'] . "</p>";
                echo "<p><strong>Name:</strong> " . $appointment['name'] . "</p>";
                // Display other details as needed
            }
        } else {
            echo "<p>No past appointments found.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
