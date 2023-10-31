<?php
include "connectDB.php";
$conn = connectDB();

$booking_id = isset($_POST['booking-id']) ? $_POST['booking-id'] : null;
$user_id = isset($_POST['user-id']) ? $_POST['user-id'] : null;

$query = "DELETE FROM bookings WHERE bookings.id = $booking_id AND bookings.user_id = $user_id";
$conn->query($query);
echo "<script>window.location.href='../account.php';</script>";
$conn->close();
