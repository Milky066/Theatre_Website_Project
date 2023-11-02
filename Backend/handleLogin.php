<?php
include 'connectDB.php';

$conn = connectDB();
// if email + password aren't found on the database = login fail
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$redirectURL = "index.php";

if ($email != null && $password != null) {
    $query_result = $conn->query("SELECT users.id FROM users WHERE users.email = '$email' AND users.password = '$password';");
    $id = $query_result->fetch_row()[0];
    if ($id != null) {
        // User found
        if (isset($_POST["remember-me"])) {
            // setting cookie for remembering the user for next login
            // Set cookie for just 1 day, availble just for login.php
            setcookie("login_email", $email, time() + (86400), "/"); // 86400s = 1 day
            setcookie("login_password", $password, time() + (86400), "/");
        } else {
            // Set cookies to expire an hour ago to delete the cookies
            setcookie("login_email", "", time() - (3600), "/");
            setcookie("login_password", "", time() - (3600), "/");
        }
        header("Location: ../$redirectURL");
        session_start();
        $_SESSION["user_id"] = $id;
        die();
    } else {
        // User does not exist
        header("Location: ../login.php?isWrongPassword=true");
        die();
    }
} else {
    header("Location: ../login.php?isWrongPassword=true");
    die();
}
