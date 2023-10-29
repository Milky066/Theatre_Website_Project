<?php
include "connectDB.php";

$conn = connectDB();

echo "<div>Inserted a booking</div>";

// Redirect to index afterwards

$conn->close();
