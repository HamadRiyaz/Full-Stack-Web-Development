<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {

    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Direct password match query
    $query = "SELECT * FROM passenger 
              WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['passenger_id'] = $row['passenger_id'];
        $_SESSION['passenger_name'] = $row['name'];

        header("Location: Main_Dashboard.html");
        exit();

    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    
    <title>Dashboard</title>
    <link rel="stylesheet" href="passenger_login_style.css">
</head>
<body class="b1">
    <header class="navbar">
        <div class="logo"><img src="logo.png"></img> </div>
        <div>
            <nav>
               <a href="Main_Dashboard.html">Home</a>
                <a href="routes.php">Routes</a>
                <a href="about.html">Services</a>
                <a href="about.html">Contact</a>
            </nav>
        </div>
        <a href="about.html"><button class="contact">Contact Support</button></a>
    </header>

    
        <div class="b2">PREMIUM BUS SERVICE<h6 id="h6" >Book Your Bus<br/>Tickets Easily with<br/>SafeLine Travel.</h6><p class="text">Experience premium comfort, safety, and reliability on every journey. Join thousands of satisfied travelers choosing SafeLine today.</p>
            <button id="p1">&#128274;</button>
            <button id="p1">&#128205;</button>
            <button id="p1">&#127911;</button>
            <pre style="font-size: 14px;"><b> Secure payment    Realtime Tracking      24/7 Support</b></pre>
        </div>

      



     <div class="form"> <a href="signup.php"><button class="b5"><b>PASSENGER</button></a>   
      <a href="Adminlogin.php"><button class="b6">ADMIN</b></button></a>

       </br> <a href="Passenger_login.php"><button class="login"><b>Log In</b></button></a>

        <a href="signup.php"><button  class="S1">Sign Up</button><br></a>

     <form method="POST">
    <br><label class="F1">EMAIL</label><br>
    <input class="F2" name="email" type="email" placeholder="Enter your email" required><br>

    <br><label class="F1">PASSWORD</label><br>
    <input class="F2" name="password" type="password" placeholder="Enter your password" required><br>

    <br>
    <button class="btn" type="submit" name="login">Login to Account</button><br>
</form>

    
    
        </div>

        <div id="d2">

            <div>
            <h3 id="h3">Safeline</h3>
            <p id="p6">Connecting cities and</br> people with safety, comfort,</br> and reliability. Your premium journey</br>begins with SafeLine.</p>
             </div>
             

             <div id="d4" >
                    <h3 id="h4">Contact Us</h3>
                    <p style="color:white">&#128222; +1 (555) 123-4567</p>
                    <p style="color:white">&#9993; support@safeline.com</p>
                    <p style="color:white">&#x1F4CD; 123 Transport PAK, LAHORE</p>
                    <p style="color:white">&#x1F4CD; 123 Transport PAK, LAHORE</p>
                    <p class="last">© 2025 Safeline Travel. All rights reserved.</p>
                </div>

                <div>
                    <h3 style="color: white;padding: 40px 18px 10px 10px;"><b>Quick Links</b></h3>
                     <pre id="pre"><b>About Us</b></pre>
                     <pre id="pre"><b>Careers</b></pre>
                     <pre id="pre"><b>Blog</b></pre>
                     <pre id="pre"><b>Terms of Service</b></pre>
                </div>

                <div >
                     <div class="section">
                     <h3 style="margin-left:50px">Follow Us</h3>
                    <div class="social">
                    <span>&#x1F15F;</span>
                    <span>&#x1F4F8;</span>
                    <span>&#x2716;</span>
                    <span>&#x1F156;</span>
                </div>
        
                

                
              </div>
              
            
</body>
</html>