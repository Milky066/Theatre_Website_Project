<?php
include 'connectDB.php';

$conn = connectDB();
// if email + password aren't found on the database = login fail
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$redirectURL = "index.php";

if($email != null && $password != null){
    $query_result = $conn->query("SELECT users.id FROM users WHERE users.email = '$email' AND users.password = '$password';");
    $id = $query_result->fetch_row()[0];
    if($id != null){
        // User found
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

?>
