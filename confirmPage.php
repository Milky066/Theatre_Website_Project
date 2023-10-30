<?php
include "Backend/checkLogin.php";
include 'Backend/displayShow.php';
include 'Backend/connectDB.php';
include "Backend/userUtils.php";
include "Backend/showUtils.php";

$conn = connectDB();
$booked_seats = $_POST["booked_seats"];
$show_page = $_POST["show_page"];
$show_id = $_POST["show_id"];
$price = getPriceByShowId($conn, $show_id);

$username = null;
$email = null;
// var_dump($booked_seats);
if ($booked_seats <= 0) {
    echo "<script>alert('Seat not selected!'); history.go(-1);</script>";
    exit;
}
if ($user_id != null) {
    $username = getUsername($conn, $user_id);
    $email = getUserEmail($conn, $user_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>play</title>
    <link href="Styles/global.css" rel="stylesheet" />
    <link href="Styles/confirmPage.css" rel="stylesheet" />
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
        <div class="container-left">
            <div>User Details</div>
            <form class="booking-submit-form" method="post" action="Backend/insertBooking.php">
                <div>
                    <!-- Autofilled if logged in -->
                    <?php echo "<input type='email' placeholder='email' name='email' value='$email' required></input>" ?>
                    <?php echo "<input type='hidden' name='show_id' value='$show_id'/>" ?>
                </div>
                <?php
                if (isset($user_id)) {
                    echo "<div>Username: $username</div>";
                }
                ?>
                <div class="seat-containers">
                    <?php
                    $row_count = 5;
                    $seat_per_row = 10;
                    $selected_seats = [];
                    for ($row = 0; $row < $row_count; $row++) {
                        $rowChar = chr($row + 65);
                        for ($seat = 0; $seat < $seat_per_row; $seat++) {
                            $seat_id = chr(65 + $row) . $seat;
                            $checkbox_name = "hidden-checkbox-" . $seat_id;
                            if (isset($_POST[$checkbox_name]) && ($_POST[$checkbox_name] == "on")) {
                                $selected_seats[] = $seat_id;
                            }
                        }
                    }
                    foreach ($selected_seats as $seat) {
                        echo "<input type='hidden' name='$seat' value='on'></input>";
                    }
                    ?>
                </div>
                <div>
                    <input type="submit" value="Book" />
                </div>
            </form>
            <button onclick="cancel()">Cancel</button>
            <script>
                function cancel() {
                    window.location.href = "http://localhost/theatre_Website_Project";
                }
            </script>
        </div>
        <!-- Seat selection component -->
        <div class="container-right">
            <div class="seat-container">
                <div style="text-align:center; font-size: xx-large;">Booked Seats</div>
                <div class="screen-container">Screen</div>
                <table>
                    <?php
                    $conn = connectDB();
                    $row_count = 5;
                    $seat_per_row = 10;
                    $checked_seat = [];
                    $seat_size = 32;
                    $show_id = isset($_POST["show_id"]) ? $_POST["show_id"] : null;
                    $booked_seats = getBookedSeatArray($conn, $show_id);

                    echo "<tbody>";
                    for ($row = 0; $row < $row_count; $row++) {
                        $rowChar = chr($row + 65);
                        echo "<tr>";
                        echo "<td>$rowChar</td>";
                        for ($seat = 0; $seat < $seat_per_row; $seat++) {
                            $seat_id = chr(65 + $row) . $seat;
                            $checkbox_name = "hidden-checkbox-" . $seat_id;
                            if (isset($_POST[$checkbox_name]) && ($_POST[$checkbox_name] == "on")) {
                                $checked_seat[] = $seat_id;
                                echo "<td style='width: $seat_size" . "px; height: $seat_size" . "px; background-color: #F99417;'></td>";
                            } else if (in_array($seat_id, $booked_seats)) {
                                echo "<td style='width: $seat_size" . "px; height: $seat_size" . "px; background-color: #434343;'></td>";
                            } else {
                                echo "<td style='width: $seat_size" . "px; height: $seat_size" . "px; background-color: #4D4C7D;'></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "<tr><td></td>";
                    for ($seat = 0; $seat < $seat_per_row; $seat++) {
                        echo "<td>$seat</td>";
                    }
                    echo "</tr>";
                    echo "</tbody>";
                    $conn->close();
                    ?>
                </table>
            </div>
            <table class="total-table">
                <tr>
                    <th class="detail-column">Seats</th>
                    <th>Prices</th>
                </tr>
                <?php
                foreach ($checked_seat as $seat) {
                    echo "
                    <tr>
                        <td>$seat</td>
                        <td class='price-detail'>$price</td>
                    </tr>";
                }
                ?>
                <tr>
                    <td class="total-column">Total</td>
                    <td class="price-detail-total">
                        <?php
                        $total = $price * count($checked_seat);
                        echo $total;
                        ?>
                    </td>
                </tr>
            </table>

        </div>

    </main>

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