<?php
include "db.php";

$from = $_GET['from'] ?? '';
$to   = $_GET['to'] ?? '';

$result = null;

if (!empty($from) && !empty($to)) {
    $from_safe = mysqli_real_escape_string($conn, $from);
    $to_safe   = mysqli_real_escape_string($conn, $to);

    $query = "SELECT * FROM route WHERE source='$from_safe' AND destination='$to_safe'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Safeline Travel — Routes</title>
    <link rel="stylesheet" href="routes_style.css">
</head>
<body>

<header class="navbar">
    <div class="nav-left">
        <img src="logo.png" alt="logo" class="logo">
        <div class="brand">Safeline Travel</div>
    </div>
    <nav class="nav-links">
        <a href="Main_Dashboard.html">Home</a>
        <a href="routes.php">Routes</a>
        <a href="About.html">Services</a>
         <a href="Resevations.php">Reservation</a>
    </nav>
    <a class="signup-btn" href="signup.php">Sign Up</a>
</header>

<section class="hero">
    <img src="hero.jpg" alt="hero image">
    <div class="overlay">
        <h1>Available Routes</h1>
        <p>Find your perfect journey to any destination</p>
    </div>
</section>

<form method="GET" class="search-panel">
    <div class="field select-wrap">
        <label>From</label>
        <div style="display:flex;align-items:center;gap:8px">
            <img src="logo.png" class="icon" alt="from">
            <select name="from" id="fromSelect">
                <option value="Lahore">Lahore, PK</option>
                <option value="Gujranwala">Gujranwala, PK</option>
                <option value="Sialkot">Sialkot, PK</option>
                <option value="Daska">Daska, PK</option>
                <option value="Islamabad">Islamabad, PK</option>
                <option value="Multan">Multan, PK</option>
                <option value="Faisalabad">Faisalabad, PK</option>
                <option value="Karachi">Karachi, PK</option>
            </select>
        </div>
    </div>

    <div class="divider" aria-hidden></div>

    <div class="field select-wrap">
        <label>To</label>
        <div style="display:flex;align-items:center;gap:8px">
            <img src="logo.png" class="icon" alt="to">
            <select name="to" id="toSelect">
                <option value="Islamabad">Islamabad, PK</option>
                <option value="Lahore">Lahore, PK</option>
                <option value="Faisalabad">Faisalabad, PK</option>
                <option value="Multan">Multan, PK</option>
                <option value="Sialkot">Sialkot, PK</option>
                <option value="Karachi">Karachi, PK</option>
            </select>
        </div>
    </div>

    <div class="divider" aria-hidden></div>

    <div class="field select-wrap">
        <label>Date</label>
        <div style="display:flex;align-items:center;gap:8px">
            <img src="logo.png" class="icon" alt="date">
            <input type="date" name="date" id="tripDate">
        </div>
    </div>

    <button class="search-btn" type="submit">&#128269</button>
</form>

<main class="results-wrapper">
<?php if(!empty($from) && !empty($to)): ?>
    <div class="results-title">Available Routes</div>
    <div class="cards" id="cardsContainer">
        <?php
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                // Split travel_time into departure & arrival
                $departure = '';
                $arrival = '';
                if(!empty($row['travel_time'])){
                    $times = explode('-', $row['travel_time']);
                    $departure = $times[0] ?? '';
                    $arrival = $times[1] ?? '';
                }
                ?>
                <article class="card">
                    <div class="left">
                        <span class="tag">STANDARD</span>
                        <div class="time"><?= htmlspecialchars($departure) ?></div>
                        <div class="place"><?= htmlspecialchars($row['source']) ?></div>
                    </div>
                    <div class="center">
                        <div class="dotline"></div>
                        <img src="logo.png" class="bus-icon">
                        <div class="dotline"></div>
                    </div>
                    <div class="right">
                        <div class="time"><?= htmlspecialchars($arrival) ?></div>
                        <div class="place"><?= htmlspecialchars($row['destination']) ?></div>
                        <div class="price">Rs <?= htmlspecialchars($row['price']) ?></div>
                        <a href="booknow.php?route_id=<?= $row['route_id'] ?>">
                            <button class="view">Book now</button>
                        </a>
                    </div>
                </article>
        <?php
            }
        } else {
            echo "<p style='padding:20px'>No routes found for this selection.</p>";
        }
        ?>
    </div>
<?php endif; ?>
</main>

<footer style="max-width:var(--container-width);margin:40px auto 80px;padding:0 12px;color:var(--muted)"></footer>

</body>
</html>
