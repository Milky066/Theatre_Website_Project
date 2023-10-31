<?php

include "connectDB.php";
$conn = connectDB();

$email = isset($_POST["email"]) ? $_POST["email"] : null;
$query = "SELECT users.username, users.password FROM users WHERE users.email = '$email'";
$query_result = $conn->query($query);
$result = $query_result->fetch_assoc();
if ($result != null) {
    echo $result["password"];
} else {
    echo ("<script>alert('The email does not exist');window.location.href='../forgetPassword.php?noEmailFound=true'</script>");
    die();
}

$mail_header = 'From: jhamiltheatre@localhost' . "\r\n" .
    'Reply-To: jhamiltheatre@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$mail_subject = "Password Recovery";
$mail_message = "Password Recovery" . "\n" .
    "Username: $result[username]" . "\n" .
    "Password: $result[password]";

mail($email, $mail_subject, $mail_message, $mail_header, '-jhamiltheatre@localhost');
echo ("<script>alert('Recovered password sent to $email');window.location.href='../index.php'</script>");
$conn->close();
