<?php
include 'connectDB.php';

function FillShowCards(): void
{
  $conn = connectDB();
  $query_result = $conn->query("SELECT shows.id, shows.time, shows.price, movies.title, movies.description, movies.rating, movies.image, movies.genre FROM shows JOIN movies ON movies.id = shows.movie_id;");
  $seat_query_result = $conn->query("SELECT bookings.show_id FROM bookings");
  $keys = ['show_id', 'time', 'price', 'title', 'description', 'rating', 'image', 'genre', 'seat_booked'];
  $show_array = array();
  $booked_array = $seat_query_result->fetch_all(MYSQLI_ASSOC);

  while ($row = $query_result->fetch_row()) {
    $current_row = array();
    for ($i = 0; $i < count($keys); $i++) {
      if ($i != (count($keys) - 1)) {
        $current_row[$keys[$i]] = $row[$i];
      } else {
        $seat_booked = 0;
        for ($j = 0; $j < count($booked_array); $j++) {
          if ($current_row['show_id'] == $booked_array[$j]['show_id']) {
            $seat_booked++;
          }
        }
        // Add seat_booked key at the end of the original array
        $current_row[$keys[$i]] = $seat_booked;
      }
    }
    $show_array[] = $current_row;
  }
  // var_dump($show_array);
  $query_result->free_result();
  $seat_query_result->free_result();
  $conn->close();


  $seat_cap = 50;
  foreach ($show_array as $row) {

    $date_time = new DateTime($row['time']);
    $date = $date_time->format('D Y-m-d');
    $time = $date_time->format('H:i:s');
    // var_dump($row['genre']);
    $seat_available = $seat_cap - $row['seat_booked'];
    echo "
      <script>
      function onClick(show_id){
        window.location.href='playPage.php?show_id=' + show_id;
      }
      </script>";
    echo "
      <div class='movie-card' onclick='onClick($row[show_id])' genre='$row[genre]' title='$row[title]'>
      <!-- Picture -->
      <div style='margin: auto'>
      <img src='$row[image]' alt='$row[show_id]' width='auto' height='auto' style='max-width:200px; max-height:200px;'/>
      </div>
      <div class='movie-description'>
          <div class='movie-title'>
              <b>$row[title]</b>
          </div>
          <div>
              Price: <span>$row[price]</span>
          </div>
          <div>
              Available Seat: <span>$seat_available</span>
          </div>
          <div>
              Date: <span><b>$date</b></span>
          </div>
          <div>
              Showtime: <span><b>$time</b></span>
          </div>
      </div>
      </div>
      
      ";
  }
}
