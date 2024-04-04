<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
$_SESSION['error_message'] = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $loginUsername = $_POST['username'];
  $loginPassword = $_POST['password'];

  include "../connection.php";

  $sqlUser = "SELECT * FROM user WHERE username = ?";
  $stmtUser = $con->prepare($sqlUser);

  if (!$stmtUser) {
    die("Prepare failed: " . $con->error);
  }

  $stmtUser->bind_param("s", $loginUsername);
  $stmtUser->execute();
  $resultUser = $stmtUser->get_result();

  $sqlAdmin = "SELECT * FROM admin WHERE admin_username = ?";
  $stmtAdmin = $con->prepare($sqlAdmin);

  if (!$stmtAdmin) {
    die("Prepare failed: " . $con->error);
  }

  $stmtAdmin->bind_param("s", $loginUsername);
  $stmtAdmin->execute();
  $resultAdmin = $stmtAdmin->get_result();

  if ($resultUser->num_rows == 1) {
    $row = $resultUser->fetch_assoc();
    $hashedPassword = $row['password'];

    if (md5($loginPassword) == $hashedPassword) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['username'];
      $_SESSION['name'] = $row['Name'];
      $_SESSION['email']= $row['email'];
      
        header("Location: ../Dashboard/user_dash.php");
      exit;
      
    } else {
      $_SESSION['error_message'] = "Invalid username or password";
    }
  } elseif ($resultAdmin->num_rows == 1) {
    $row = $resultAdmin->fetch_assoc();
    $hashedPassword = $row['admin_password'];

    if ($loginPassword == $hashedPassword) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['admin_username'];

      header("Location: ../Dashboard/admin_dash.php");
      exit();
    } else {
      $_SESSION['error_message'] = "Invalid username or password";
    }
  } else {
    $_SESSION['error_message'] = "Invalid username or password";
  }

  // Close the prepared statements and database connection
  $stmtUser->close();
  $stmtAdmin->close();
  $con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link rel="preload" as="image" href="../Images/barber.jpg">
    
</head>
<body>
    
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
          <!-- <button class="Btn">
            <div class="sign"><svg viewBox="0 0 512 512"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg></div>
            <div class="text">Login</div>
          </button>  -->
                   
          <a href="../Signup/signup.php"><button class="Btn Btn2">
            <div class="sign"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg></div>
            <div class="text">Sign Up</div>
          </button></a>
       </div>
      </div>
      <form class="flip-card__form" method="POST"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="container">
        <div class="card">
            <a class="login">Log In</a> 

            <div class="inputBox">
                <input type="text" class="username" name="username" required="required">
                <span>Username</span>
            </div>
            <div class="enteruser">Please Enter Username!</div>

            <div class="inputBox">
                <input type="password" class="password" name="password" required="required">
                <span>Password</span>
            </div>
            <div class="enterpass">Please Enter Password!</div>
            <div class="error_message"> <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" &&   isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
            echo $_SESSION['error_message'];
           unset($_SESSION['error_message']);
        }
        ?>
            
            </div>
            <button type="submit" class="enter">Enter</button>
            <span class="create">Don't have an acount? <a href="../Signup/signup.php" style="text-decoration:none;">Create one</a></span>
          </div>
        </div>
      </form>
    </div>

<script src="login.js"></script>
</body>
</html>
