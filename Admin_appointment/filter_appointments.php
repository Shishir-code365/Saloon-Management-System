<?php
include "../connection.php";
$dateFilter = $_POST['dateFilter'] ?? '';


$sql = "SELECT * FROM appointment WHERE 1=1";

if (!empty($dateFilter)) {
    $sql .= " AND appointment_date = '$dateFilter'";
}


$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Client Username</th>
                <th>Client Phone Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Service</th>
                <th>Status</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $statusColor = $row['status'] === 'unpaid' ? 'red' : ($row['status'] === 'paid' ? 'green' : 'inherit');
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['phone']}</td>
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
