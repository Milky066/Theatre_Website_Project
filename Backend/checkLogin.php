<?php
session_start();
$user_id = null;
if (isset($_SESSION["user_id"])) {
    // $user_id = $_SESSION["user_id"][0];
    $user_id = $_SESSION["user_id"];
    echo "<script>console.log('User ID: '+$user_id)</script>";
}
