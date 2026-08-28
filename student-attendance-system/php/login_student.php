<?php
include "db.php";

if(isset($_POST['login'])){
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE user_id='$user_id' AND role='student'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if($password == $row['password']){
            $_SESSION['student'] = $row['user_id'];
            header("Location: student_dashboard.php");
            exit();
        } else {
            $error = "Wrong Password";
        }
    } else {
        $error = "Student Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="login_dashboard.css">
</head>
<body>
<div class="login-container">
    <div class="login-title">Student Login</div>

    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="user_id" placeholder="User ID or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
