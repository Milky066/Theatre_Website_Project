<?php
include "Backend/checkLogin.php";
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
    <div id="movie-card-container" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center;">
      <!-- To be populated by script -->
      <?php
      include 'Backend/indexOperations.php';
      FillShowCards();
      ?>
    </div>
  </main>
  <!-- <theatre-footer background-color = "black"></theatre-footer> -->

  <footer>
    <div class="footer-container">
      <div class="footer-left-panel">
        <p>&copy; JhaMil Theatre</p>
      </div>
      <div class="footer-right-panel">
        <div><a href="#">Privacy Policy</a></div>
        <div><a href="#">Terms of Service</a></div>
        <div><a href="#">Contact Us</a></div>
      </div>
    </div>
  </footer>


</body>


</html>