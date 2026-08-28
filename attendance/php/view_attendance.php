<?php
include "db.php";
if(!isset($_SESSION['student'])){
    die("Access Denied");
}

$student_id = $_SESSION['student'];
$q = mysqli_query($conn,"SELECT subject, COUNT(*) as total, SUM(status='Present') as attended FROM attendance WHERE student_id='$student_id' GROUP BY subject");
?>

<!DOCTYPE html>
<html>
<head><title>View Attendance</title></head>
<body>
<h2>My Attendance</h2>
<table border="1">
<tr><th>Subject</th><th>Total Classes</th><th>Attended</th><th>%</th><th>Status</th></tr>
<?php while($r=mysqli_fetch_assoc($q)):
    $perc = $r['total']>0 ? ($r['attended']/$r['total'])*100 : 0;
    $status = $perc>=75 ? 'Good' : 'Low';
?>
<tr>
<td><?php echo $r['subject']; ?></td>
<td><?php echo $r['total']; ?></td>
<td><?php echo $r['attended']; ?></td>
<td><?php echo number_format($perc,1); ?>%</td>
<td><?php echo $status; ?></td>
</tr>
<?php endwhile; ?>
</table>
<button onclick="window.location.href='student_dashboard.php'">Back</button>
</body>
</html>
