<?php
include "userUtils.php";
include "connectDB.php";
include "showUtils.php";

session_start();
$conn = connectDB();

// user_id = -1 for non-user purchase
$user_id = -1;
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}

$seat_arr = [];
$email = isset($_POST['email']) ? $_POST['email'] : null;
$show_id = isset($_POST['show_id']) ? $_POST['show_id'] : null;
foreach ($_POST as $key => $val) {
    if ($val == "on") {
        $seat_arr[] = $key;
    }
}

// -1 for non-user
if ($user_id == -1) {
    foreach ($seat_arr as $seat) {
        $query = "INSERT INTO bookings (show_id, user_id, non_user_email, seat_selected)
                    VALUES ('$show_id', '$user_id','$email', '$seat');";
        $query_result = $conn->query($query);
    }
} else {
    foreach ($seat_arr as $seat) {
        $query = "INSERT INTO bookings (show_id, user_id, seat_selected)
                    VALUES ('$show_id', '$user_id', '$seat');";
        $query_result = $conn->query($query);
    }
}

$movie_name = getShowNameByShowId($conn, $show_id);
$show_time = getShowTimeByShowId($conn, $show_id);
$to_mail = 'danayel@localhost';
$seat_string = implode(",", $seat_arr);

$mail_header = 'From: jhamiltheatre@localhost' . "\r\n" .
    'Reply-To: jhamiltheatre@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$mail_subject = "Booking Confirmation!";
$mail_message = "Thank you for purchasing the tickets." . "\n" .
    "Movie: $movie_name" . "\n" .
    "Showtime: $show_time" . "\n" .
    "Your seats: $seat_string";

mail($email, $mail_subject, $mail_message, $mail_header, '-jhamiltheatre@localhost');
echo ("<script>alert('Mailed to $email');window.location.href='../index.php'</script>");
$conn->close();
