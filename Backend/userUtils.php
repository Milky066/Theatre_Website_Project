<?php

function getUsername($conn, $user_id): string
{
    $query = "SELECT users.username FROM users WHERE users.id = $user_id;";
    $query_result = $conn->query($query);
    $username = $query_result->fetch_row()[0];
    $query_result->free_result();
    return $username;
}


function getBookingsByUser($conn, $user_id): array
{
    $query = "SELECT bookings.id, movies.title, shows.time, bookings.seat_selected 
    FROM bookings 
    JOIN shows ON bookings.show_id = shows.id 
    JOIN movies ON shows.movie_id = movies.id WHERE bookings.user_id = $user_id
    ORDER BY shows.time;";
    $query_result = $conn->query($query);
    $bookings = $query_result->fetch_all(MYSQLI_ASSOC);
    $query_result->free_result();
    return $bookings;
}

function getUserEmail($conn, $user_id): string
{
    $query = "SELECT users.email FROM users WHERE users.id = $user_id";
    $query_result = $conn->query($query);
    $user_email = $query_result->fetch_row()[0];
    $query_result->free_result();
    return $user_email;
}

function getUserIdByEmail($conn, $user_email): string
{
    $query = "SELECT users.id FROM users WHERE users.email = $user_email";
    $query_result = $conn->query($query);
    $user_id = $query_result->fetch_row()[0];
    $query_result->free_result();
    return $user_id;
}
