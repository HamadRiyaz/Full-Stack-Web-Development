<?php
include 'db.php';

if(isset($_POST['booking_id'])){
    $booking_id = (int)$_POST['booking_id'];

    // 1️⃣ Get seat id for the booking
    $seatQuery = $conn->query("SELECT seat_id FROM Booking WHERE booking_id=$booking_id");
    if($seatQuery && $seatQuery->num_rows > 0){
        $seat = $seatQuery->fetch_assoc();
        $seat_id = $seat['seat_id'];

        // 2️⃣ Delete payment first
        $conn->query("DELETE FROM Payment WHERE booking_id=$booking_id");

        // 3️⃣ Delete booking
        $conn->query("DELETE FROM Booking WHERE booking_id=$booking_id");

        // 4️⃣ Make seat available again
        $conn->query("UPDATE Seat SET is_booked=0 WHERE seat_id=$seat_id");

        // Redirect back to reservations page
        header("Location: Resevations.php");
        exit;
    } else {
        echo "Invalid booking ID";
    }
} else {
    echo "No booking ID provided";
}
?>
