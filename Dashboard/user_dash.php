<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./user_dash.css">
    <link rel="preload" as="image" href="../Images/barber.jpg">
</head>
<body>
    <div class="navbar">
          <div class="logo">
            <img id="img-logo" src="../Images/logo5.jpg" alt="">
          </div>
          <div class="items">
          <ul>
            <li><a href="user_dash.php">home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="../Appointment/book_appointment.php">Book Appointment</a></li>
            <li><a href="#">Review</a></li>
          </ul>
        </div>
          <div class="log-sign">
          <button class="Btn">
            <div class="sign"><svg viewBox="0 0 512 512"><path fill="#ff0000" d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg></div>
            <div class="text"><a href="../logout/logout.php">Logout</a></div>
          </button> 

       </div>
      </div>
      <div class="hero-section">
        <div class="container">
          <div class="row">
            <div class="main_cont">
              <h1 class="hero-title">MEN'S SALON MANAGEMENT SYSTEM <i class="fa fa-scissors"></i></h1>
              <p class="hero-text"><strong>YOUR TYPES , YOUR STYLE , YOUR COLOR  .</strong> </p>
                    <p class="hero-text2"><strong>ANY TIME ANYWHERE "24X7" OPEN</strong> </p>
              <a href="../Appointment/book_appointment.php" class="btn btn-default">Make an Appointment <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" fill="white"/></svg></a>
            </div>
          </div>
        </div>
      </div>
     </div>


</body>
</html>