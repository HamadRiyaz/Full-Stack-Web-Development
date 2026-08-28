<?php
include "db.php";
if(!isset($_SESSION['student'])){
    die("Access Denied");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: student_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="student_dashboard.css">
    <style>
        .center-box{
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dashboard-box{
            background: #f5f5f5;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        .dashboard-box button{
            display: block;
            width: 200px;
            padding: 12px;
            margin: 10px auto;
            border: none;
            border-radius: 8px;
            background: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .dashboard-box button:hover{
            background: #43a047;
        }
    </style>
</head>
<body>

<header>
    <div style="background-color: rebeccapurple; color: white; height: 60px; text-align: center;"><h2>Student Dashboard</h2></div>
</header>

<div class="center-box">
    <div class="dashboard-box">

        <button onclick="window.location.href='view_attendance.php'">
            View Attendance
        </button>

     <form action="Main_dashboard.html" method="GET">
    <button type="submit">Back to Dashboard</button>
</form>


    </div>
</div>

</body>
</html>
