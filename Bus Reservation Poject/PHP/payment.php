<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Invalid access");
}

$bus_id = (int)$_POST['bus_id'];
$route_id = (int)$_POST['route_id'];
$seat_id = (int)$_POST['seat_id'];
$passenger_id = (int)$_POST['passenger_id'];
$amount = (float)$_POST['amount'];
?>


<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <style>
        .box{
            width:400px;
            margin:100px auto;
            padding:20px;
            border:1px solid #ccc;
            border-radius:8px;
        }
        input,button{
            width:100%;
            padding:10px;
            margin:8px 0;
        }
        button{
            background:#00bfff;
            color:white;
            border:none;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Payment</h2>
    <p><b>Total Amount:</b> <?php echo $amount; ?> Rs</p>

    <form action="payment_process.php" method="POST">

        <!-- Hidden booking data -->
        <input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>">
        <input type="hidden" name="route_id" value="<?php echo $route_id; ?>">
        <input type="hidden" name="seat_id" value="<?php echo $seat_id; ?>">
        <input type="hidden" name="passenger_id" value="<?php echo $passenger_id; ?>">
        <input type="hidden" name="amount" value="<?php echo $amount; ?>">

        <input type="text" name="card_name" placeholder="Card Holder Name" required>
        <input type="text" name="card_number" placeholder="Card Number" required>
        <input type="text" name="payment_method" value="Card" readonly>

        <button type="submit">Pay Now</button>
    </form>
</div>

</body>
</html>
