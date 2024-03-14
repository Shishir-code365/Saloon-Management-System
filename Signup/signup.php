<?php
session_start(); // Start the session
$_SESSION['error_message'] = "";
include "../connection.php";

if (isset($_POST['register'])) {
    $username = $_POST['username2'];
    $password = $_POST['password2'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $hashedPassword = md5($password);

    $checkUserSql = "SELECT * FROM user WHERE email = ? OR phone = ?";
    $checkUserStmt = $con->prepare($checkUserSql);
    $checkUserStmt->bind_param("si", $email, $phone);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "User with the same phone number or email already exists.";
        
    } else {
        $sql = "insert into user (username, password, email, phone) values (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi", $username, $hashedPassword, $email, $phone);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['success_message']="Signed Up Successfully!";
            header("Location: ../Dashboard/user_dash.php"); 
            exit();
        } else {
            $_SESSION['error_message'] = "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkUserStmt->close();
    $con->close();

    // Redirect back to the signup page
    // header("Location: signup.php");
    // exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preload" as="image" href="../Images/barber.jpg">
    <link rel="stylesheet" href="signup.css">
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
            <a href="../Login/login.php"><button class="Btn">
              <div class="sign"><svg viewBox="0 0 512 512"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg></div>
              <div class="text">Login</div>
            </button> </a>
                   
         <!-- <button class="Btn Btn2">
          <div class="sign"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg></div>
          <div class="text">Sign Up</div>
        </button> -->
       </div>
      </div>
      

        <!-- Signup -->

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post" onsubmit="return validate_register()">
        <div class="container2">
        <div class="card2">
          <a class="singup">Sign Up</a>

          <div class="inputBox2">
              <input type="text" class="username2" name="username2" required="required">
              <span>Username</span>
          </div>

          <span class="enteruser2">*Please Enter Username!</span>
          <span class = "validuser2">*Invalid Username!</span>
          <div class="inputBox2">
              <input type="password" class="password2" name="password2" required="required">
              <span>Password</span>
          </div>
          <span class="enterpass2">*Please Enter Password!</span>

          <div class="inputBox2">
            <input type="password" class="repassword2" name="repassword2" required="required">
            <span>Re-Password</span>
        </div>
        <span class="enterrepass2">*Please Enter Re-Password</span>
        <span class="repassmatch">*Passwords Dont Match!</span>
        <div class="inputBox2">

       <input type="text" class="email" name="email" required="required">
       <span>E-mail</span>
      </div>
      <span class="enteremail">*Please Enter E-mail!</span>
      <span class="validemail">*Invalid E-mail!</span>
      <div class="inputBox2">
        <input type="text" class="phone" name="phone" required="required">
        <span>Phone Number</span>
    </div>
    <span class="enterphone">*Please Enter Phone Number!</span>
    <span class="numberformat">*Phone number invalid! Must start from 9 and digit should be less than 10</span>
    <div class="error_message">
   <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['error_message']) ) {
            echo $_SESSION['error_message'];
            // Clear the error message to avoid displaying it again on refresh
            unset($_SESSION['error_message']);
        }?>
    </div>
     <button type="submit" class="enter2" name="register">Enter</button>
    </div>
    </div>
    </form>

<script src="signup.js"></script>
</body>
</html>