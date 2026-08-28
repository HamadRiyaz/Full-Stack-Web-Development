<?php

$conn = mysqli_connect("localhost", "root", "", "attendance_db");
if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
session_start();
?>
