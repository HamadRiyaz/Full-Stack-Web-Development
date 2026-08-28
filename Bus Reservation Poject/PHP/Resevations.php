<?php
session_start();
include 'db.php';

if(!isset($_SESSION['passenger_id'])){
    header("Location: Passenger_login.php");
    exit();
}

$passenger_id = $_SESSION['passenger_id'];

$query = "
SELECT 
    b.booking_id,
    b.booking_date,
    b.status,
    r.source,
    r.destination,
    s.seat_no
FROM Booking b
JOIN Route r ON r.route_id = b.route_id
JOIN Seat s ON s.seat_id = b.seat_id
WHERE b.passenger_id = $passenger_id
ORDER BY b.booking_date DESC
";

$result = $conn->query($query);
if(!$result) die("Query Error: ".$conn->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Reservations</title>
    <style>
        body{ margin:0; font-family: Arial, Helvetica, sans-serif; background:#f2f5f9;}
        .navbar{ background:#1f5fbf; color:#fff; padding:15px 30px; display:flex; justify-content:space-between; align-items:center;}
        .navbar h2{ margin:0; font-size:20px;}
        .navbar ul{ list-style:none; margin:0; padding:0; display:flex; gap:20px;}
        .navbar ul li{ cursor:pointer;}
        .container{ width:90%; margin:30px auto; background:#fff; padding:25px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1);}
        .container h3{ margin-bottom:20px; color:#333;}
        table{ width:100%; border-collapse:collapse;}
        table th, table td{ padding:12px; text-align:center; border-bottom:1px solid #ddd;}
        table th{ background:#f1f4f8; font-weight:bold;}
        .btn{ padding:6px 12px; border:none; border-radius:4px; color:#fff; cursor:pointer; font-size:13px;}
        .btn-cancel{ background:#d9534f;}
    </style>
</head>
<body>

<div class="navbar">
    <h2>🚌 Bus Reservation System</h2>
    <ul>
        <a href="Main_Dashboard.html" style="color:white;"><li>Home</li></a>
        <a href="Booknow.php"  style="color:white;"><li>Book Ticket</li></a>
        <li><b>My Reservations</b></li>
    </ul>
</div>

<div class="container">
    <h3>My Booked Tickets</h3>

    <table>
        <tr>
            <th>Booking ID</th>
            <th>Passenger Name</th>
            <th>Route</th>
            <th>Travel Date</th>
            <th>Seat No.</th>
            <th>Action</th>
        </tr>

        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo htmlspecialchars($_SESSION['passenger_name'] ?? 'Passenger'); ?></td>
                    <td><?php echo $row['source'].' → '.$row['destination']; ?></td>
                    <td><?php echo date('d-M-Y', strtotime($row['booking_date'])); ?></td>
                    <td><?php echo htmlspecialchars($row['seat_no']); ?></td>
                    <td>
                        <form method="POST" action="cancel_booking.php" style="display:inline;">
                            <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                            <button type="submit" class="btn btn-cancel">Cancel Ticket</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No bookings found</td>
            </tr>
        <?php endif; ?>

    </table>
</div>

</body>
</html>
