<?php
include "connectDB.php";

$conn = connectDB();
$email = isset($_POST["email"]) ? $_POST["email"] : null;
$username = isset($_POST["username"]) ? $_POST["username"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;
$confirm_password = isset($_POST["confirm-password"]) ? $_POST["confirm-password"] : null;
if (
    $email != null && $username != null
    && $password != null && $confirm_password != null
) {
    if ($password != $confirm_password) {
        returnError("Password not matched");
    }
    $email_query = "SELECT users.id FROM users WHERE users.email = '$email'";
    $query_result = $conn->query($email_query);
    $data = $query_result->fetch_all(MYSQLI_NUM);
    $query_result->free_result();
    $insert_query = "INSERT INTO users (users.username, users.password, users.email) 
    VALUES ('$username','$password','$email');";
    $insert_result = $conn->query($insert_query);
    if ($data) {
        returnError("Email is used");
    } else {
        returnSuccess("Registerd");
    }
} else {
    returnError("Fields missing");
}



function returnError($message)
{
    $safe_message = str_replace(" ", "_", $message);
    echo "<script>alert('$message');window.location.href='../register.php?error=$safe_message'</script>";
    die();
}

function returnSuccess($message)
{
    // $safe_message = str_replace("_", " ", $message);
    echo "<script>alert('$message');window.location.href='../login.php'</script>";
    die();
}


// Redirect to index afterwards

$conn->close();
