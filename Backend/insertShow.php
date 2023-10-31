<?php
include "connectDB.php";
// var_dump($_POST);
// movie-id, date, price
$movie_id = isset($_POST["movie-id"]) ? $_POST["movie-id"] : null;
$time = isset($_POST["date"]) ? $_POST["date"] : null;
$price = isset($_POST["price"]) ? $_POST["price"] : null;

$conn = connectDB();
$query = "INSERT INTO shows (shows.movie_id, shows.time, shows.price)
                    VALUES ('$movie_id','$time', '$price');";
$query_result = $conn->query($query);

$conn->close();
echo "<script>alert('Inserted new show!'); window.location.href='../account.php';</script>";
