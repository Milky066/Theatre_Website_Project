<?php

function getPriceByShowId($conn, $id): float
{
    $query = "SELECT shows.price FROM shows WHERE shows.id = $id";
    $query_result = $conn->query($query);
    $show_id = $query_result->fetch_row()[0];
    $query_result->free_result();
    return $show_id;
}

function getShowNameByShowId($conn, $id): string
{
    $query = "SELECT movies.title FROM movies JOIN shows ON movies.id = shows.movie_id WHERE shows.id = $id";
    $query_result = $conn->query($query);
    $movie_name = $query_result->fetch_row()[0];
    $query_result->free_result();
    return $movie_name;
}

function getShowTimeByShowId($conn, $id): string
{
    $query = "SELECT shows.time FROM shows WHERE shows.id = $id";
    $query_result = $conn->query($query);
    $show_time = $query_result->fetch_row()[0];
    $query_result->free_result();
    return $show_time;
}
