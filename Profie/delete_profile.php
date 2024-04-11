<?php
session_start();
include "../connection.php"; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit;
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Perform deletion query
$sql = "DELETE FROM user WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "success"; // Deletion successful
} else {
    echo "error"; // Deletion failed
}
?>
