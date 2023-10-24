<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script type="module" src="Components/navigation.js"></script>
  <!-- <script type="module" src="Components/movieCard.js"></script> -->
  <title>Home</title>
</head>
<body>
  <!-- Include the navbar component -->
  <h1>JhaMil Theatre</h1>
  <theatre-header background-color = "black"></theatre-header>
  <div id="movie-card-container" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center;">
    <!-- To be populated by script -->
    <?php
      include 'Utils/indexOperations.php';
      FillShowCards();
    ?>
  </div>
  
  <theatre-footer background-color = "black"></theatre-footer>

  
</body>
<script>

  // fetch('./Backend/getBookings.php')
  // .then(response => {return response.json();})
  // .then(data => {
  //   const movieCardContainer = document.getElementById('movie-card-container');
  //   const size = 200;
  //   const theatreCapacity = 230;
  //   console.log(data);
  //   data.forEach(show => {
  //     const movieCard = document.createElement('movie-card');

  //     movieCard.setAttribute('src', show.image);
  //     movieCard.setAttribute('alt', show.title);
  //     movieCard.setAttribute('size', size);
  //     movieCard.setAttribute('showtime', show.time)
  //     movieCard.setAttribute('price', show.price);
  //     movieCard.setAttribute('seat', theatreCapacity - show.seat_booked);
  //     movieCardContainer.appendChild(movieCard);
  //   });
  // })
  // .catch(error => console.error('Error fetching show data:', error));


</script>


</html>
