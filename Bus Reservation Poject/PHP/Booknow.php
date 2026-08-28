<?php
session_start();
include 'db.php';

if(!isset($_SESSION['passenger_id'])){
    header("Location: Passenger_login.php");
    exit();
}

$passenger_id = $_SESSION['passenger_id'];
$selected_bus = isset($_GET['bus_id']) ? (int)$_GET['bus_id'] : 0;

$busQuery = "
SELECT b.bus_id, b.bus_number,
       r.source, r.destination
FROM Bus b
JOIN Route r ON r.route_id = b.route_id
";

$busResult = $conn->query($busQuery);


$route = null;
$route_id = 0;
$seatPrice = 0;

if($selected_bus){

    // Fetch route + price
 $routeQuery = "
SELECT r.*
FROM Route r
JOIN Bus b ON b.route_id = r.route_id
WHERE b.bus_id = $selected_bus
LIMIT 1
";
    $routeResult = $conn->query($routeQuery);
    if($routeResult && $routeResult->num_rows > 0){
        $route = $routeResult->fetch_assoc();
        $route_id = $route['route_id'];
        $seatPrice = $route['price'];
    }

    // Fetch seats
    $seatQuery = "SELECT * FROM Seat WHERE bus_id = $selected_bus";
    $seatResult = $conn->query($seatQuery);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ticket Booking</title>
    <link rel="stylesheet" href="bookingstyle.css">
    <style>
        .seat { cursor:pointer; }
        .seat.selected { background-color:#00bfff; color:white; }
    </style>
</head>
<body>

<header class="navbar">
    <div class="logo"><img src="logo.png"></div>
    <div>
        <nav>
            <a href="Main_Dashboard.html">Home</a>
            <a href="routes.php">Routes</a>
            <a href="about.html">Services</a>
            <a href="Resevations.php">Reservation</a>
        </nav>
    </div>
    <a href="about.html"><button class="signin">About us</button></a>
</header>

<!-- Search Form -->
<form method="GET" action="">
<section class="search">
    <div class="box" style="display: flex; justify-content: center; align-items: center; margin: 30px 0;">
        <div class="box">
            <label style="color:white;">Bus</label>
            <select name="bus_id" onchange="this.form.submit()">
                <option value="">Select Bus</option>
                <?php
                if($busResult->num_rows > 0){
                    while($bus = $busResult->fetch_assoc()){
                        $selected = ($selected_bus == $bus['bus_id']) ? "selected" : "";
                        echo "<option value='".$bus['bus_id']."' $selected>
                                ".$bus['bus_number']." (".$bus['source']." → ".$bus['destination'].")
                              </option>";
                    }
                } else {
                    echo "<option>No buses found</option>";
                }
                ?>
            </select>
        </div>
    </div>
</section>
</form>

<?php if(isset($route) && $route): ?>
<section class="route">
    <div>
        <h3 class="t">Safeline Travels</h3>
        <p class="t">Business Class</p>

        <div class="route-card">
            <div class="route-row">
                <div class="time-box">
                    <h3>8:00 AM</h3>
                    <p>&#x1F4CD; <?php echo $route['source']; ?></p>
                </div>

                <div class="route-line">
                    <span class="line"></span>
                    <span class="bus">&#128652;</span>
                    <span class="line"></span>
                </div>

                <div class="time-box">
                    <h3>12:00 PM</h3>
                    <p>&#x1F4CD; <?php echo $route['destination']; ?></p>
                </div>
            </div>

            <div class="price">
                <h3><?php echo $route['price']; ?> Rs</h3>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<h2 class="title">Select Your Seats</h2>

<div class="legend">
    <span><div class="box available"></div> Available</span>
    <span><div class="box booked"></div> Booked</span>
    <span><div class="box selected"></div> Selected</span>
</div>

<div class="bus-container">
    <div class="seats">
        <?php
        if(isset($seatResult) && $seatResult->num_rows > 0){
            while($seat = $seatResult->fetch_assoc()){
                $class = $seat['is_booked'] ? 'seat booked' : 'seat available';
                $seatNo = $seat['seat_no'] . ($seat['seat_type']=='VIP'?' (VIP)':'');
                echo "<div class='$class seat-item' data-seat-id='{$seat['seat_id']}'>$seatNo</div>";
            }
        } elseif($selected_bus) {
            echo "<p style='padding:20px;'>No seats found for this bus</p>";
        }
        ?>
    </div>
</div>

<form action="payment.php" method="POST" id="paymentForm" style="text-align:center; margin:20px;">
    <input type="hidden" name="bus_id" value="<?php echo $selected_bus; ?>">
    <input type="hidden" name="route_id" value="<?php echo $route_id; ?>">
   <input type="hidden" name="passenger_id" value="<?php echo $passenger_id; ?>">
    <input type="hidden" name="seat_id" id="seat_id">
    <input type="hidden" name="amount" id="amount">

    <button type="submit" class="confirm-btn" id="payBtn">
        Select Seat First
    </button>
</form>

<footer>
    <div class="container">
        <div class="section">
            <h3>Safeline</h3>
            <p>Connecting cities and people with comfort, safety, and reliability.</p>
        </div>

        <div class="section">
            <h3>Quick Links</h3>
            <a href="#">About Us</a>
            <a href="#">Careers</a>
            <a href="#">Blog</a>
            <a href="#">Terms of Service</a>
        </div>

        <div class="section">
            <h3>Contact Us</h3>
            <p>&#128222; +1 (555) 123-4567</p>
            <p>&#9993; support@safeline.com</p>
            <p>&#x1F4CD; 123 Transport PAK, LAHORE</p>
        </div>

        <div class="section">
            <h3>Follow Us</h3>
            <div class="social">
                <span>&#x1F15F;</span>
                <span>&#x1F4F8;</span>
                <span>&#x2716;</span>
                <span>&#x1F156;</span>
            </div>
        </div>
    </div>
    <p class="last">© 2025 Safeline Travel. All rights reserved.</p>
</footer>

<script>
const seatPrice = <?php echo $seatPrice ?? 0; ?>;
const seats = document.querySelectorAll('.seat.available');
const seatInput = document.getElementById('seat_id');
const amountInput = document.getElementById('amount');
const payBtn = document.getElementById('payBtn');

let selectedSeats = [];

seats.forEach(seat => {
    seat.addEventListener('click', () => {

        const seatId = seat.dataset.seatId;

        if(seat.classList.contains('selected')){
            seat.classList.remove('selected');
            selectedSeats = selectedSeats.filter(id => id !== seatId);
        } else {
            seat.classList.add('selected');
            selectedSeats.push(seatId);
        }

        seatInput.value = selectedSeats.join(",");
        amountInput.value = selectedSeats.length * seatPrice;

        if(selectedSeats.length > 0){
            payBtn.textContent = "Pay " + (selectedSeats.length * seatPrice) + " Rs";
        } else {
            payBtn.textContent = "Select Seat First";
        }
    });
});
</script>

</body>
</html>
