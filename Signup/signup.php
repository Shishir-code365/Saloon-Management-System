<?php
session_start(); // Start the session
$_SESSION['error_message'] = "";
include "../connection.php";


if (isset($_POST['register'])) {
    $username = $_POST['username2'];
    $password = $_POST['password2'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $name = $_POST['name2'];
    
    $hashedPassword = md5($password);

    $checkUserSql = "SELECT * FROM user WHERE email = ? OR phone = ? OR username = ?";
    $stmt = $con->prepare($checkUserSql);
    $stmt->bind_param("sis", $email, $phone, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $_SESSION['error_message']="Same username,phone or email already exists";
        echo "<script>alert('Same username, phone, or email already exists!!')</script>";
       
        
    } else {

        $sql = "INSERT INTO user (username, password, email, phone, Name,original_password) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssiss", $username, $hashedPassword, $email, $phone, $name,$password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
          $sqlUser = "SELECT * FROM user WHERE username = ?";
          $stmtUser = $con->prepare($sqlUser);
        
          if (!$stmtUser) {
            die("Prepare failed: " . $con->error);
          }
        
          $stmtUser->bind_param("s", $username);
          $stmtUser->execute();
          $resultUser = $stmtUser->get_result();

          if ($resultUser->num_rows == 1) {
            $row = $resultUser->fetch_assoc();

              $_SESSION['user_id'] = $row['id'];
              $_SESSION['user_name'] = $row['username'];
              $_SESSION['name'] = $row['Name'];
              $_SESSION['email']= $row['email'];
              $_SESSION['password']=$row['original_password'];
              $_SESSION['redirect'] = true;

                header("Location: ../Dashboard/user_dash.php");
              exit();
          }
        }
        else{
          $_SESSION['error_message'] = "Error inserting data: " . $stmt->error;
        }
    }
    $stmt->close();
    $con->close();
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
          <img id="img-logo" src="../Images/logo.jpg" alt="">
          </div>
          <div class="items">
          <ul>
          <li><a href="../index.php">home</a></li>
            <li><a href="../index.php#about">About us</a></li>
            <li><a href="../index.php#services">Our Services</a></li>
            <li><a href="../index.php#gallery">Gallery</a></li>
            <li><a href="../index.php#footer">Contact US</a></li>
          </ul>
        </div>
          <div class="log-sign">
            <a href="../Login/login.php"><button class="Btn">
              <div class="sign"><svg viewBox="0 0 512 512"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg></div>
              <div class="text">Login</div>
            </button> </a>
       </div>
      </div>
      

        <!-- Signup -->

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post" onsubmit="return validate_register()" class="form">
        <div class="container2">
          <div class="para">
            <p>
              <h2>SIGN UP</h2> with us to access exclusive benefits and enjoy a streamlined booking experience. Register now to schedule appointments effortlessly, manage your preferences!</p>
          </div>
        <div class="card2">
            <a class="signup">Sign Up</a>

            <div class="inputBox2">
                <input type="text" name = "name2" required="required" class="name">
                <span class="user2">Name</span>
            </div>
            <span class="nameError"></span>

            <div class="inputBox2">
                <input type="text" name="username2" required="required" class="username">
                <span class="user2">Username</span>
            </div>
            

            <div class="inputBox2">
                <input type="password" name="password2" required="required" class="password">
                <span>Password</span>
            </div>

            <div class="inputBox2">
                <input type="password" name="repassword2" required="required" class="repassword">
                <span>Re-Password</span>
            </div>
            <span class="passError"></span>

            <div class="inputBox2">
                <input type="text" name="email" required="required" class="email">
                <span>E-mail</span>
            </div>
            <span class="emailError"></span>

            <div class="inputBox2">
                <input type="text" name="phone" required="required" class="phone">
                <span>Phone Number</span>
            </div>
            <span class="phoneError"></span>

            <button class="enter"name="register" type="submit">Register</button>

        </div>
    </div>
    </form>
<script src="signup.js"></script>
</body>
</html>