<?php
session_start();
if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"][0];
    echo "<script>console.log('User ID: '+$user_id)</script>";
}

?>