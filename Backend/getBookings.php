<?php
$dbname = 'theatre_database';

$username = 'root';
$password = '';
$servername = '127.0.0.1';
$port = '3306';

$conn = new mysqli($servername.':'.$port, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->query("USE $dbname");
$query_result = $conn->query("SELECT shows.id, shows.time, shows.price, movies.title, movies.description, movies.rating, movies.image FROM shows JOIN movies ON movies.id = shows.movie_id;");
$seat_query_result = $conn->query("SELECT bookings.show_id FROM bookings");
$keys = ['show_id','time', 'price', 'title', 'description', 'rating', 'image', 'seat_booked'];
$show_array = array();
$booked_array = $seat_query_result->fetch_all(MYSQLI_ASSOC);

while($row = $query_result -> fetch_row()){
  $current_row = array();
  for($i = 0; $i < count($keys); $i++){
    if($i != (count($keys)-1))
    {
      $current_row[$keys[$i]] = $row[$i];
    } else {
      $seat_booked = 0;
      for($j = 0; $j < count($booked_array); $j++){
        if($current_row['show_id'] == $booked_array[$j]['show_id']){
          $seat_booked++;
        }
      }
      $current_row[$keys[$i]] = $seat_booked;
    }
    
  }
  $show_array[] = $current_row;
}

// print($show_array);
$query_result -> free_result();
$seat_query_result -> free_result();
$show_json = json_encode($show_array);

$conn->close();
header('Content-Type: application/json');
echo $show_json;
?>