<?php
$conn = mysqli_connect("localhost", "root", "", "Bus_Reservation");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
