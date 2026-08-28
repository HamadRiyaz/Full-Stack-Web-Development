<?php
include "db.php";
if(!isset($_SESSION['teacher'])){
    die("Access Denied");
}
if(isset($_POST['save_attendance'])){
    $attendance = $_POST['attendance']; 
    $date = date("Y-m-d");

    foreach($attendance as $student_id => $status){
        
        $check = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id='$student_id' AND date='$date'");
        if(mysqli_num_rows($check) > 0){
            
            mysqli_query($conn, "UPDATE attendance SET status='$status' WHERE student_id='$student_id' AND date='$date'");
        } else {
            
            mysqli_query($conn, "INSERT INTO attendance (student_id, date, status) VALUES ('$student_id','$date','$status')");
        }
    }

    echo "<p style='color:green'>Attendance saved successfully!</p>";
    echo "<a href='teacher_dashboard.php'>Back to Dashboard</a>";
}
?>
