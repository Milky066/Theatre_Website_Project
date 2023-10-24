<?php
      include '../Backend/utils/connectDB.php';
      $conn = connectDB();
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
      
      $query_result -> free_result();
      $seat_query_result -> free_result();
      $conn->close();
      foreach($show_array as $row){
          $show_id = $row['show_id'];
          $image = $row['image'];
          $rating = $row['rating'];
          $time = $row['time'];
          $price = $row['price'];
          $title = $row['title'];
          $description = $row['description'];
          $seat_booked = $row['seat_booked'];
          echo "<div style='width: 200px; height: 300px; background-color: gray; margin: 15px; text-align: center; padding-top: 1rem; padding-bottom: 1rem;'>
          <!-- Picture -->
          <div style='margin: auto'>
          <img src='$image' alt='$show_id' width='auto' height='auto' style='max-width:200px; max-height:200px;'/>
          </div>
          <div style='padding: 1rem;'>
              <div>
                  <b>$show_id</b>
              </div>
              <div>
                  Price: $price
              </div>
              <div>
                  Available Seat: $seat_booked
              </div>
              <div>
                  Date: <b>$time</b>
              </div>
              <div>
                  Showtime: <b>$time</b>
              </div>
          </div>
          </div>"
          
          ;
      }
    ?>