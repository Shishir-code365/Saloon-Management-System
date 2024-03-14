<?php 
session_start();

  unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_password']);

    session_destroy();

if(!isset($_SESSION['user_id'])){ //handling error if incase session is not destroyed
    header("Location: ../index.php");
}else{
   echo "Couldn't logout";
    
}

?>