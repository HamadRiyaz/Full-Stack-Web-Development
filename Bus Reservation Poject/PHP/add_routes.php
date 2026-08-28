<?php
session_start();
include "db.php";

$msg = "";

$admin_id = $_SESSION['admin_id'];

// Form submission
if (isset($_POST['add_route'])) {
    $source = mysqli_real_escape_string($conn, $_POST['source']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $travel_time = mysqli_real_escape_string($conn, $_POST['travel_time']);
    $price = $_POST['price'];
    $admin_id = $_SESSION['admin_id']; // Admin ID, session ya default

    if ($source && $destination && $price) {
        $query = "INSERT INTO Route (source, destination, travel_time, price, admin_id)
                  VALUES ('$source', '$destination', '$travel_time', '$price', '$admin_id')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $msg = "<span class='success'>Route added successfully!</span>";
        } else {
            $msg = "<span class='error'>Error: " . mysqli_error($conn) . "</span>";
        }
    } else {
        $msg = "<span class='error'>Please fill all required fields.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Route — Safeline Travel</title>
<style>
body { font-family: Arial,sans-serif; background:#f4f6f8; margin:0; }
.container { max-width:600px; margin:50px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.1); }
h1 { text-align:center; color:#333; margin-bottom:25px; }
form { display:flex; flex-direction:column; gap:15px; }
label { font-weight:bold; color:#555; }
input, select { padding:10px; border:1px solid #ccc; border-radius:5px; font-size:16px; width:100%; }
button { padding:12px; background:#007bff; color:#fff; border:none; border-radius:5px; font-size:16px; cursor:pointer; transition:0.3s; }
button:hover { background:#0056b3; }
.message { text-align:center; margin-bottom:15px; font-weight:bold; }
.success { color:green; }
.error { color:red; }
</style>
</head>
<body>

<div class="container">
    <h1>Add New Route</h1>
    <?php if($msg) echo "<div class='message'>$msg</div>"; ?>
    <form method="POST">
        <label>From</label>
        <input type="text" name="source" placeholder="Source City">

        <label>To</label>
        <input type="text" name="destination" placeholder="Destination City">

        <label>Travel Time</label>
        <input type="text" name="travel_time" placeholder="e.g., 5h 30m">

        <label>Price (Rs)</label>
        <input type="number" name="price" placeholder="Fare in Rs" step="0.01">

        <button type="submit" name="add_route">Add Route</button>
    </form>
</div>

</body>
</html>
