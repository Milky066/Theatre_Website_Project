<?php
include "Backend/checkLogin.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="Styles/global.css" rel="stylesheet" />
    <link href="Styles/register.css" rel="stylesheet" />
</head>

<body>
    <header>
        <nav class="header-navbar">
            <div class="navbar-left-panel">
                <a href="index.php">JhaMil Theatre</a>
            </div>
            <div class="navbar-right-panel">
                <div><a href="index.php">Home</a></div>
                <div><a href="login.php">Login</a></div>
                <?php
                if (isset($user_id)) {
                    echo "<div><a href='Backend/handleLogout.php'>Logout</a></div>";
                } else {
                    echo "<div><a href='register.php'>Register</a></div>";
                }

                ?>
            </div>
        </nav>
    </header>
    <main>
        <div class="register-container">
            <div class="register-title">Register</div>
            <form class="register-form" method="post" action="Backend/handleregister.php">
                <table>
                    <tr>
                        <th>
                            <label>Email</label>
                        </th>
                        <td>
                            <input type="email" id="email" name="email" placeholder="Your email" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label>Username</label>
                        </th>
                        <td>
                            <input type="text" id="username" name="username" placeholder="Your email" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label>Password</label>
                        </th>
                        <td>
                            <input type="password" id="password" name="password" placeholder="Enter password" required onchange="checkPassword()" />
                        </td>
                    </tr>
                    <!-- TODO: Add JS logic for confirm password -->
                    <!-- TODO: Add email confirmation once a booking has been made -->
                    <tr>
                        <th>
                            <label>Confirm Password</label>
                        </th>
                        <td>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Enter password" required onchange="checkPassword()" />
                        </td>
                    </tr>
                    <tr>
                        <!-- TODO: Add a button for toggling password visibility -->
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" value="Register">
                    <?php
                    if (isset($_GET['isWrongPassword'])) {
                        echo "<div style='visibility:visible; color: rgb(235, 0, 0);'>Incorret Email and/or Password</div>";
                    } else {
                        echo "<div style='visibility:hidden; color: rgb(235, 0, 0);'>Incorret Email and/or Password</div>";
                    }
                    ?>
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    const passwordInput = document.querySelector("#password");
    const confirmPasswordInput = document.querySelector("#confirm-password");

    function checkPassword() {
        if (passwordInput.value === confirmPasswordInput) {
            return true;
        } else {
            return false;
        }
    }

    function togglePasswordVisibility() {

    }
</script>

</html>