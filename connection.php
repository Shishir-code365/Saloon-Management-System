<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sms";

// Create a connection
$con = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
// Set character set to utf8 (optional)
$con->set_charset("utf8");

?>