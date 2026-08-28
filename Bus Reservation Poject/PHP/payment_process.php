<?php
include 'db.php';

$bus_id = (int)$_POST['bus_id'];
$route_id = (int)$_POST['route_id'];
$seat_id = (int)$_POST['seat_id'];
$passenger_id = (int)$_POST['passenger_id'];
$amount = (float)$_POST['amount'];

$today = date('Y-m-d');

/* 1️⃣ Booking */
$conn->query("
INSERT INTO Booking
(booking_date,status,passenger_id,bus_id,route_id,seat_id)
VALUES
('$today','Confirmed',$passenger_id,$bus_id,$route_id,$seat_id)
");

$booking_id = $conn->insert_id;

/* 2️⃣ Payment */
$conn->query("
INSERT INTO Payment
(booking_id,payment_date,amount,payment_method,payment_status)
VALUES
($booking_id,'$today',$amount,'Card','Paid')
");

/* 3️⃣ Seat lock */
$conn->query("
UPDATE Seat SET is_booked=1 WHERE seat_id=$seat_id
");
?>
<!DOCTYPE html>
<html>
<body>
<h2 style="text-align:center;margin-top:120px;color:green">
Booking Confirmed ✅<br>
Payment Successful 💳
</h2>
</body>
</html>
