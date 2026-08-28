<?php
session_start();
include 'db.php';

if(!isset($_SESSION['passenger_id'])){
    header("Location: passenger_login.php");
    exit();
}

$passenger_id = $_SESSION['passenger_id'];
$msg = "";
$msg_type = "";

// Fetch current passenger data
$query = "SELECT * FROM passenger WHERE passenger_id = '$passenger_id'";
$result = $conn->query($query);

if(!$result){
    die("Query Error: " . $conn->error);
}

$passenger = $result->fetch_assoc();

// Update logic
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if(empty($password)){
        $updateQuery = "UPDATE passenger 
                        SET name='$name', email='$email', phone='$phone'
                        WHERE passenger_id='$passenger_id'";
    } else {
        $updateQuery = "UPDATE passenger 
                        SET name='$name', email='$email', phone='$phone', password='$password'
                        WHERE passenger_id='$passenger_id'";
    }

    if($conn->query($updateQuery)){
        $msg = "Profile Updated Successfully!";
        $msg_type = "success";

        // Refresh updated data
        $result = $conn->query("SELECT * FROM passenger WHERE passenger_id = '$passenger_id'");
        $passenger = $result->fetch_assoc();
    } else {
        $msg = "Error: " . $conn->error;
        $msg_type = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="profile_update.css">
</head>

<body>

<div class="topbar">
    <h2>Safeline Travels</h2>
</div>

<div class="profile-box">

    <h3>Edit Your Profile</h3>

    <?php if($msg): ?>
        <div class="message <?php echo $msg_type; ?>">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="name" 
               value="<?php echo htmlspecialchars($passenger['name']); ?>" required>

        <label>Email Address</label>
        <input type="email" name="email" 
               value="<?php echo htmlspecialchars($passenger['email']); ?>" required>

        <label>Phone Number</label>
        <input type="text" name="phone" 
               value="<?php echo htmlspecialchars($passenger['phone']); ?>" required>

        <label>Password (Leave blank if no change)</label>
        <input type="password" name="password" placeholder="Enter new password">

        <button type="submit">Update Profile</button>

    </form>

</div>

</body>
</html>