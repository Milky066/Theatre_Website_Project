<?php
function displayShowOptions($conn): void
{
    // movie_id, time, price
    $query = "SELECT movies.title, movies.id FROM movies;";
    $query_result = $conn->query($query);
    // $movies = $query_result->fetch_all(MYSQLI_ASSOC);
    while ($row = $query_result->fetch_assoc()) {
        echo "<option value='$row[id]'>$row[title]</option>";
    }
    $query_result->free_result();
}
