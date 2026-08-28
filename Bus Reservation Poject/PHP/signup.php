<?php
include "db.php";

if (isset($_POST['signup'])) {
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pass  = mysqli_real_escape_string($conn, $_POST['password']);

    $check = mysqli_query($conn, "SELECT * FROM passenger WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already exists');</script>";
    } else {
        $query = "INSERT INTO passenger (name, email, phone, password)
          VALUES ('$name','$email','$phone','$pass')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Signup successful'); window.location='Passenger_login.php';</script>";
        } else {
            echo "<script>alert('Signup failed');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="sign_style.css">

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

       <a href="Passenger_login.php"></br> <button class="login"><b>Log In</b></button></a>

        <button  class="S1">Sign Up</button><br>
<form method="POST">
    <label class="F1">First Name</label><br>
    <input class="F2" type="text" name="name" placeholder="Enter full name" required><br>

    <label class="F1">Email</label><br>
    <input class="F2" type="email" name="email" placeholder="Enter email" required><br>

    <label class="F1">Phone Number</label><br>
    <input class="F2" type="text" name="phone" placeholder="Enter phone number" required><br>

    <label class="F1">Create Password</label><br>
    <input class="F2" type="password" name="password" placeholder="Create password" required><br>

    <button class="btn" type="submit" name="signup">Sign Up</button>
</form>

        <pre id="p2">I have already account?
<a href="Adminlogin.html"><b style="cursor:pointer">Login</b></a></pre>
    </div>

</div>

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