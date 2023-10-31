<?php
include "Backend/userUtils.php";
include "Backend/connectDB.php";
include "Backend/insertUtils.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Not logged in!');window.location.href='index.php'</script>";
    exit();
}

$user_id = $_SESSION["user_id"];
$conn = connectDB();
$username = getUsername($conn, $user_id);
$user_email = getUserEmail($conn, $user_id);
$bookings = getBookingsByUser($conn, $user_id);
// user_id == 1 for administrator
$isAdmin = $user_id == 1 ? true : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?></title>
    <link href="Styles/global.css" rel="stylesheet" />
    <link href="Styles/account.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
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
        <div class="your-account">Your account</div>
        <div class="account-container">
            <div class="account-container-left">
                <div class="username">Username</div>
                <div class="username-field"><?php echo $username; ?></div>
                <div class="email">Email</div>
                <div class="email-field"><?php echo $user_email ?></div>
            </div>
            <div class="account-container-right">
                <div class="booking">Bookings</div>
                <div class="booking-separator"></div>
                <div class="booking-table-container">
                    <table class="booking-table">
                        <tr>
                            <th class="th-name">Name</th>
                            <th>Seat</th>
                            <th colspan="2">Showtime</th>
                        </tr>

                        <?php
                        foreach ($bookings as $key => $values) {
                            echo "<tr>";
                            echo "<td>$values[title]</td>";
                            echo "<td>$values[seat_selected]</td>";
                            echo "<td>$values[time]</td>";
                            echo "
                                <td style='background-color:#a73f11;'>
                                <form action='Backend/deleteBooking.php' method='post'>
                                <input type='hidden' name='booking-id' value='$values[id]'/>
                                <input type='hidden' name='user-id' value='$user_id'/>
                                <input 
                                type='submit' 
                                value='Delete' 
                                style='background-color: transparent;
                                cursor: pointer;
                                color: #f5dada;
                                border-width: 0px;
                                font-size: larger;'
                                onclick='return confirmDeleteBooking(`$values[title]`)'>
                                </input>
                                </form>
                                </td>";
                            echo "</tr>";
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="separator-account"></div>
        <div class="insert-container">
            <div class="insert-show-container">
                <div class='insert-title'>Create New Show</div>
                <form action="Backend/insertShow.php" method="post">
                    <div>
                        <label for="movie-id">Show: </label>
                        <select name="movie-id" id="movie-id">
                            <!-- Populate with names here -->
                            <?php
                            displayShowOptions($conn);
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="date">Date: </label>
                        <input type="datetime-local" id="date" name="date" />
                    </div>
                    <div>
                        <label for="price">Price: </label>
                        <input type="text" id="price" name="price" />
                    </div>
                    <div>
                        <input class="submit-button" type="submit" value="submit" />
                    </div>

                </form>
            </div>
            <div class="insert-movie-container">
                <div class='insert-title'>Insert Movie</div>
                <!--title, description, image, rating, genre, runtime -->
                <form class="insert-movie-form" action="Backend/insertMovie.php" method="post">
                    <div>
                        <label for="title">Movie name:</label>
                        <input type="text" id="title" name="title" />
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <label for="description" style="margin-right: 10px;">Description:</label>
                        <textarea id="description" name="description" rows="4" cols="50"></textarea>
                    </div>
                    <div>
                        <label for="rating">Rating: </label>
                        <select name="rating" id="rating">
                            <!-- Populate with names here -->
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div>
                        <label for="genre">Genre:</label>
                        <input type="text" id="genre" name="genre" />
                    </div>
                    <div>
                        <label for="runtime">Runtime:</label>
                        <input type="text" id="runtime" name="runtime" />
                    </div>
                    <div>
                        <label class="image-upload-button" for="image">Select image:</label>
                        <input type="file" id="image" name="image" accept="image/*" onchange="convertImageToBase64(this)" />
                    </div>
                    <input type="hidden" id="image-base64" name="image-base64" />
                    <input class="submit-button" type="submit">
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    function confirmDeleteBooking(booking) {
        if (confirm(`Do you want to delete ${booking}?`)) {
            return true;
        } else {
            return false;
        }
    }

    function convertImageToBase64(element) {
        const image = element.files[0];
        const imageBase64 = document.getElementById("image-base64");
        if (image) {
            const fileReader = new FileReader();
            fileReader.onload = function(event) {
                // Base64 string updated to hidden element
                imageBase64.value = event.target.result;
            };
            fileReader.readAsDataURL(image);
        } else {
            imageBase64.value = "";
            console.log("No image uploaded");
        }
    }
</script>

</html>

<?php
$conn->close();
?>