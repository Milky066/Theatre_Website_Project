<?php
include "Backend/userUtils.php";
include "Backend/connectDB.php";

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
                <table class="booking-table">
                    <tr>
                        <th class="th-name">Name</th>
                        <th>Seat</th>
                        <th>Showtime</th>
                    </tr>

                    <?php
                    foreach ($bookings as $key => $values) {
                        echo "<tr>";
                        echo "<td>$values[title]</td>";
                        echo "<td>$values[seat_selected]</td>";
                        echo "<td>$values[time]</td>";
                        echo "</tr>";
                    }

                    ?>
                </table>

            </div>
        </div>
    </main>
</body>
<script>

</script>

</html>

<?php
$conn->close();
?>