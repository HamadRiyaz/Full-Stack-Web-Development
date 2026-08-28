<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$add_msg = "";
$delete_msg = "";


$routeQuery = "SELECT route_id, source, destination 
               FROM Route 
               WHERE admin_id = '$admin_id'";
$routeResult = $conn->query($routeQuery);


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $bus_number = $_POST['bus_number'];
    $total_seats = $_POST['total_seats'];
    $route_id = $_POST['route_id'];

    // Duplicate check
    $checkQuery = "SELECT * FROM Bus WHERE bus_number = '$bus_number'";
    $checkResult = $conn->query($checkQuery);

    if($checkResult->num_rows > 0){

        $add_msg = "Bus Number Already Exists!";

    } else {

        $sql = "INSERT INTO Bus (bus_number, total_seats, admin_id, route_id)
                VALUES ('$bus_number', '$total_seats', '$admin_id', '$route_id')";

        if($conn->query($sql)){

            $new_bus_id = $conn->insert_id;

            // Auto Generate Seats
            for($i = 1; $i <= $total_seats; $i++){

                $seat_no = "S".$i;

                $seatInsert = "INSERT INTO Seat (bus_id, seat_no, seat_type, is_booked)
                               VALUES ('$new_bus_id', '$seat_no', 'Normal', 0)";

                $conn->query($seatInsert);
            }

            $add_msg = "Bus Added Successfully with Seats!";

        } else {
            $add_msg = "Error: " . $conn->error;
        }
    }
}


if(isset($_GET['delete_id'])){

    $delete_id = $_GET['delete_id'];

    // Delete seats first (important)
    $conn->query("DELETE FROM Seat WHERE bus_id = '$delete_id'");

    $deleteQuery = "DELETE FROM Bus 
                    WHERE bus_id = '$delete_id' 
                    AND admin_id = '$admin_id'";

    if($conn->query($deleteQuery)){
        $delete_msg = "Bus Deleted Successfully!";
    } else {
        $delete_msg = "Delete Error: " . $conn->error;
    }
}


$busesQuery = "SELECT bus_id, bus_number, total_seats 
               FROM Bus 
               WHERE admin_id = '$admin_id'";
$buses = $conn->query($busesQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Buses</title>
    <link rel="stylesheet" href="managebus_style.css">
</head>

<body>

<div class="topbar">
    <h2>Manage Buses</h2>
</div>

<div class="container">

    <!-- Add Bus Form -->
    <div class="bus-form card">
        <h3>Add New Bus</h3>
        
        <form method="POST">
            <input type="text" name="bus_number" placeholder="Bus Number" required><br>
            <input type="number" name="total_seats" placeholder="Total Seats" required><br>

            <select name="route_id" required>
                <option value="">Select Route</option>
                <?php
                if($routeResult && $routeResult->num_rows > 0){
                    while($route = $routeResult->fetch_assoc()){
                        echo "<option value='{$route['route_id']}'>
                                {$route['source']} → {$route['destination']}
                              </option>";
                    }
                } else {
                    echo "<option>No Routes Available</option>";
                }
                ?>
            </select><br>

            <button type="submit" style="margin-top:30px;">Add Bus</button>
        </form>

        <?php if($add_msg) echo "<div style='margin-top:10px;font-weight:bold;'>$add_msg</div>"; ?>
    </div>

    <!-- Bus Table -->
    <div class="bus-table card">
        <h3>Your Buses</h3>
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Bus Number</th>
                <th>Total Seats</th>
                <th>Action</th>
            </tr>

            <?php
            if($buses && $buses->num_rows > 0){
                while($row = $buses->fetch_assoc()){
            ?>
                <tr>
                    <td><?= $row['bus_id'] ?></td>
                    <td><?= $row['bus_number'] ?></td>
                    <td><?= $row['total_seats'] ?></td>
                    <td>
                        <a href="?delete_id=<?= $row['bus_id'] ?>" 
                           onclick="return confirm('Are you sure?')">
                            <button type="button" class="delete">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>No buses found</td></tr>";
            }
            ?>
        </table>

        <?php if($delete_msg) echo "<div style='margin-top:10px;font-weight:bold;'>$delete_msg</div>"; ?>
    </div>

</div>

</body>
</html>