<?php

function connectDB(){
    $dbname = 'theatre_database';

    $username = 'root';
    $password = '';
    $servername = '127.0.0.1';
    $port = '3306';

    $conn = new mysqli($servername.':'.$port, $username, $password, $dbname);

    if ($conn->connect_error) {
        $errorResponse = array(
            'status' => 'failed',
            'message' => 'Connection failed: ' . $conn->connect_error
        );
        $jsonError = json_encode($errorResponse);
        header('Content-Type: application/json');
        die($jsonError);
    }
    $conn->query("USE theatre_database");
    return $conn;
}

?>