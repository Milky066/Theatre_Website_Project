<?php
include "connectDB.php";

$conn = connectDB();
// var_dump($_POST);
// title, description, image, rating, genre, runtime, image-base64
$image_base64 = isset($_POST["image-base64"]) ? $_POST["image-base64"] : null;
$title = isset($_POST["title"]) ? $_POST["title"] : null;
$description = isset($_POST["description"]) ? $_POST["description"] : null;
$rating = isset($_POST["rating"]) ? $_POST["rating"] : null;
$genre = isset($_POST["genre"]) ? $_POST["genre"] : null;
$runtime = isset($_POST["runtime"]) ? $_POST["runtime"] : null;

$query = "INSERT INTO movies 
(movies.title, 
movies.description, 
movies.rating, 
movies.image, 
movies.genre, 
movies.runtime) 
VALUES 
('$title',
'$description',
$rating,
'$image_base64',
'$genre',
$runtime
);";
$conn->query($query);

$conn->close();

echo "<script>alert('Inserted $title'); window.location.href='../account.php';</script>";
