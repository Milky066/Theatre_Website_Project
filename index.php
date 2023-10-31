<?php
include "Backend/checkLogin.php";
include 'Backend/displayShow.php';
include "Backend/connectDB.php";

$conn = connectDB();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="Styles/global.css" rel="stylesheet" />
  <link href="Styles/movieCard.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <title>Home</title>
</head>

<body>
  <header>
    <nav class="header-navbar">
      <div class="navbar-left-panel">
        <a href="index.php">JhaMil Theatre</a>
      </div>
      <div class="navbar-right-panel">
        <div><a href="index.php">Home</a></div>
        <?php
        if (isset($user_id)) {
          echo "<div><a href='account.php'>Account</a></div>";
          echo "<div><a href='Backend/handleLogout.php'>Logout</a></div>";
        } else {
          echo "<div><a href='login.php'>Login</a></div>";
          echo "<div><a href='register.php'>Register</a></div>";
        }

        ?>
      </div>
    </nav>
    <div class="separator"></div>
  </header>



  <main>
    <div class="search-container">
      <label for="genre">Search</label>
      <input name="search" id="search" type="text" placeholder="search for movie" oninput="refreshMovieList(this)"></input>
      <label for="genre">Genre</label>
      <select name="genre" id="genre" onchange="refreshMovieList(this)">
        <option value="none">none</option>
        <option value="action">action</option>
        <option value="adventure">adventure</option>
        <option value="drama">drama</option>
        <option value="fantasy">fantasy</option>
        <option value="romance">romance</option>
        <option value="comedy">comedy</option>
        <option value="fiction">fiction</option>
        <option value="sci-fi">sci-fi</option>
      </select>
    </div>
    <div id="movie-card-container" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center;">
      <!-- To be populated by script -->
      <?php
      FillShowCards($conn);
      ?>
    </div>
  </main>
  <!-- <theatre-footer background-color = "black"></theatre-footer> -->

  <footer>
    <div class="footer-container">
      <div class="footer-left-panel">
        <p>&copy;JhaMil Theatre</p>
      </div>
      <div class="footer-right-panel">
        Best shows at Jhamil
      </div>
    </div>
  </footer>
  <script>
    const showCards = Array.from(document.getElementsByClassName("movie-card"));
    console.log(showCards);

    const refreshMovieList = (element) => {
      if (element.id === "search") {
        const searchPrompt = new RegExp(element.value, "i");
        showCards.forEach((card) => {
          const cardTitle = card.getAttribute("title");
          if (searchPrompt.test(cardTitle)) {
            card.style = "display: block;";
          } else {
            card.style = "display: none;";
          }
        })
      } else if (element.id === "genre") {
        const genrePrompt = new RegExp(element.value, "i");
        showCards.forEach((card) => {
          const genre = card.getAttribute("genre");
          if (element.value != "none") {
            if (genrePrompt.test(genre)) {
              card.style = "display: block;";
            } else {
              card.style = "display: none;";
            }
          } else {
            card.style = "display: block;";
          }
        })
      }
    }
  </script>

</body>


</html>