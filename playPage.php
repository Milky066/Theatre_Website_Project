<?php
        include 'Backend/connectDB.php';
        include 'Backend/displayShow.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>play</title>
    <link href="Styles/global.css" rel="stylesheet" />
    <link href="Styles/playPage.css" rel="stylesheet" />
</head>
<body>
    <h1>JhaMil Theatre</h1>
    <header>
        <nav class="header-navbar">
            <ul>
            <li><a href="http://localhost/Theatre_Website_Project/">Home</a></li>
            <!-- Put loging and register on the right end!!!!!! -->
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
            </ul>
        </nav>
    </header>
    <?php
        $conn = connectDB();
        $show_id = $_GET['show_id'];
    ?>
    <main>
        <div class="movie-container">
            <div class="movie-container-left">
                <div>
                    <?php
                        displayImage($conn, $show_id);
                    ?>
                </div>
                <div>
                    <?php 
                        displayRating($conn, $show_id);
                    ?>
                </div>
                <div>
                    <?php 
                        displayDate($conn, $show_id);
                    ?>
                </div>
                <div>
                    <!-- Do post over here -->
                    <input type="button" value="Book"/>
                </div>
            </div>
            <div class="movie-container-right">
                <div>
                    Title
                </div>
                <div>
                    <?php
                        displayDescription($conn, $show_id);
                    ?>
                </div>
                <div>
                    <!-- Seat selection componet -->
                    <div stly>
                        Screen
                    </div>
                </div>
            </div>
        </div>
        <!-- <?php
            $show_id = $_GET['show_id'];
            echo "Show ID: ".$show_id;
        ?> -->
    </main>

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
    <?php
        $conn->close();
    ?>
</html>