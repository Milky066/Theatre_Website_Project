<?php

function getPriceByShowId($conn, $id): float{
    $query = "SELECT shows.price FROM shows WHERE shows.id = $id";
    $query_result = $conn->query($query);
    $show_id = $query_result->fetch_row()[0];
    $query_result->free_result();
    return $show_id;
}
