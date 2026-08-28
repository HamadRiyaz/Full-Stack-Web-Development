<?php
include "db.php";
if(!isset($_SESSION['teacher'])){
    die("Access Denied");
}
$students = [];
$q = mysqli_query($conn, "SELECT * FROM users WHERE role='student'");
while($r = mysqli_fetch_assoc($q)){
    $date = date("Y-m-d");
    $att_q = mysqli_query($conn, "SELECT status FROM attendance WHERE student_id='".$r['user_id']."' AND date='$date'");
    if(mysqli_num_rows($att_q) > 0){
        $att_row = mysqli_fetch_assoc($att_q);
        $r['attendance'] = $att_row['status']; 
    } else {
        $r['attendance'] = ''; 
    }
    $students[] = $r;
}
if(isset($_POST['update'])){
    foreach($students as $s){
        $att_key = "att_".$s['id'];
        if(isset($_POST[$att_key])){
            $status = $_POST[$att_key];
            $date = date("Y-m-d");
            $sid = $s['user_id'];

            $check = mysqli_query($conn,"SELECT * FROM attendance WHERE student_id='$sid' AND date='$date'");
            if(mysqli_num_rows($check) > 0){
                mysqli_query($conn,"UPDATE attendance SET status='$status', subject='Software Engineering' WHERE student_id='$sid' AND date='$date'");
            } else {
                mysqli_query($conn,"INSERT INTO attendance (student_id, date, status, subject) VALUES ('$sid','$date','$status','Software Engineering')");
            }
        }
    }
    $msg = "Attendance updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Attendance</title>
    <link rel="stylesheet" href="attendance_update.css">
</head>
<body>

<h2>Update Attendance</h2>

<?php if(isset($msg)) echo "<p style='color:green'>$msg</p>"; ?>

<form method="POST">
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Attendance</th>
</tr>

<?php foreach($students as $student){ ?>
<tr>
    <td><?php echo $student['id']; ?></td>
    <td><?php echo $student['user_id']; ?></td>
    <td>
        <select name="att_<?php echo $student['id']; ?>">
            <option value="Present" <?php if($student['attendance']=='Present') echo 'selected'; ?>>Present</option>
            <option value="Absent" <?php if($student['attendance']=='Absent') echo 'selected'; ?>>Absent</option>
        </select>
    </td>
</tr>
<?php } ?>

</table>
<br>
<button type="submit" name="update">Save Attendance</button>
</form>

</body>
</html>
