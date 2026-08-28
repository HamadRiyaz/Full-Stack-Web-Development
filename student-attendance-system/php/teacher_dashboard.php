<?php
include "db.php";

if(!isset($_SESSION['teacher'])){
    die("Access Denied");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: faculty_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="faculty_dashboard.css">
</head>
<body>

<header>
    <div style="background-color: rebeccapurple; color: white; height: 60px; text-align: center;"><h2>Teacher Dashboard</h2></div>
</header>

<div style="
    width: 320px;
    margin: 80px auto;
    background: white;
    padding: 30px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
">

    <button 
        style="background:#4CAF50; color:white; padding:12px 20px; border:none; border-radius:6px; width:100%;"
        onclick="window.location.href='attendance_update.php'">
        Mark / Update Attendance
    </button>

    <br><br>

    <button 
        style="background:#2196F3; color:white; padding:12px 20px; border:none; border-radius:6px; width:100%;"
        onclick="window.location.href='teacher_panel.php'">
        Manage Students
    </button>

    <br><br>

   
    </form>

     <form action="Main_dashboard.html" method="GET">
    <button type="submit" style="background:#f44336; color:white; padding:12px 20px; border:none; border-radius:6px; width:100%;">Back to Dashboard</button>
</form>

</div>

</body>
</html>
