<?php
include 'db.php'; // Database connection

// Fetch all bookings with related info
$query = "
SELECT 
    b.booking_id,
    b.booking_date,
    b.status AS booking_status,
    p.name AS passenger_name,
    bus.bus_number AS bus_name,
    s.seat_no
FROM Booking b
JOIN Passenger p ON p.passenger_id = b.passenger_id
JOIN Bus bus ON bus.bus_id = b.bus_id
JOIN Seat s ON s.seat_id = b.seat_id
ORDER BY b.booking_date DESC
";

$result = $conn->query($query);
if(!$result){
    die("Query Error: ".$conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link rel="stylesheet" href="managebus_style.css">
</head>
<body>

<div class="topbar">
    <h2>Bookings</h2>
</div>

<div class="container">

    <div class="card">
        <h3>All Bookings</h3>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Passenger</th>
                <th>Bus</th>
                <th>Date</th>
                <th>Seat</th>
                <th>Status</th>
            </tr>

            <?php if($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>BK-<?php echo str_pad($row['booking_id'],3,"0",STR_PAD_LEFT); ?></td>
                        <td><?php echo htmlspecialchars($row['passenger_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['bus_name']); ?></td>
                        <td><?php echo date('d M Y', strtotime($row['booking_date'])); ?></td>
                        <td><?php echo htmlspecialchars($row['seat_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No bookings found</td>
                </tr>
            <?php endif; ?>

        </table>
    </div>

</div>

</body>
</html>
