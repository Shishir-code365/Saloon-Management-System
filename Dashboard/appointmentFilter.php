<?php
session_start();
$userid = $_SESSION['user_id'];
include "../connection.php";

$dateFilter = $_POST['dateFilter'] ?? '';

$sql = "SELECT * FROM appointment WHERE user_id = $userid";

if (!empty($dateFilter)) {
    $sql .= " AND appointment_date = '$dateFilter'";
}


$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Service</th>
                <th>Payment Status</th>
                
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $statusColor = $row['status'] === 'unpaid' ? 'red' : ($row['status'] === 'paid' ? 'green' : 'inherit');
        echo "<tr>
                <td>{$row['appointment_date']}</td>
                <td>{$row['appointment_time']}</td>
                <td>{$row['service']}</td>
                <td style='color: $statusColor'>{$row['status']}</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center'>No appointments found on this date!</p>";
}

$con->close();
?>
