<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="Styles/global.css" rel="stylesheet"/>
  <title>Home</title>
</head>
<body>
  <!-- Include the navbar component -->
  <h1>JhaMil Theatre</h1>
  <header>
    <nav class="header-navbar">
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
    </nav>
  </header>
  

  <div id="movie-card-container" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center;">
    <!-- To be populated by script -->
    <?php
      include 'Backend/indexOperations.php';
      FillShowCards();
    ?>
  </div>
  
  <!-- <theatre-footer background-color = "black"></theatre-footer> -->

  <footer>
          <div class="footer-container">
              <div>
                  <p>&copy; JhaMil Theatre</p>
              </div>
              <div>
                  <ul>
                      <li><a href="#">Privacy Policy</a></li>
                      <li><a href="#">Terms of Service</a></li>
                      <li><a href="#">Contact Us</a></li>
                  </ul>
              </div>
          </div>
    </footer>

  
</body>


</html>
