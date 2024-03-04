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
    <!-- <h5>Welcome user</h5>
    <form action="../logout/logout.php" method="POST">
        <button name="logout">Logout</button>
    </form> -->

    <div class="navbar">
          <div class="logo">
            <img id="img-logo" src="../Images/logo5.jpg" alt="">
          </div>
          <div class="items">
          <ul>
            <li><a href="../index.php">home</a></li>
            <li><a href="#">archives</a></li>
            <li><a href="#">tags</a></li>
            <li><a href="#">categories</a></li>
            <li><a href="#">about</a></li>
          </ul>
        </div>
          <div class="log-sign">
          <button class="Btn">
            <div class="sign"><svg viewBox="0 0 512 512"><path fill="#ff0000" d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg></div>
            <div class="text"><a href="../logout/logout.php">Logout</a></div>
          </button> 
                   
          
       </div>
      </div>
     </div>

<script src="login.js"></script>

</body>
</html>