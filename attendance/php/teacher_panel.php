<?php
include "db.php";
if(!isset($_SESSION['teacher'])){
    die("Access Denied");
}

// Add Student
if(isset($_POST['add'])){
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // check if student already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$user_id'");
    if(mysqli_num_rows($check) == 0){
        mysqli_query($conn, "INSERT INTO users (user_id, password, role) VALUES ('$user_id','$password','student')");
        $msg = "Student added successfully!";
    } else {
        $msg = "Student already exists!";
    }
}

// Delete Student
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id' AND role='student'");
    mysqli_query($conn, "DELETE FROM attendance WHERE student_id=(SELECT user_id FROM users WHERE id='$id')");
    header("Location: teacher_panel.php");
    exit();
}

// Fetch all students
$students = [];
$q = mysqli_query($conn, "SELECT * FROM users WHERE role='student'");
while($r = mysqli_fetch_assoc($q)){
    $students[] = $r;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <link rel="stylesheet" href="teacher_panel.css">
</head>
<body>

<h2>Manage Students</h2>

<?php if(isset($msg)) echo "<p style='color:green'>$msg</p>"; ?>

<h3>Add New Student</h3>
<form method="POST">
    <input type="text" name="user_id" placeholder="Student ID or Email" required>
    <input type="text" name="password" placeholder="Password" required>
    <button type="submit" name="add">Add Student</button>
</form>

<h3>Existing Students</h3>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>User ID / Email</th>
    <th>Actions</th>
</tr>

<?php foreach($students as $student){ ?>
<tr>
    <td><?php echo $student['id']; ?></td>
    <td><?php echo $student['user_id']; ?></td>
    <td>
        <a href="teacher_panel.php?delete=<?php echo $student['id']; ?>" 
           onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

<br>
<button onclick="window.location.href='teacher_dashboard.php'">Back to Dashboard</button>
</body>
</html>
