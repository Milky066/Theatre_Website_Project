<?php
include "Backend/checkLogin.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="Styles/global.css" rel="stylesheet" />
    <link href="Styles/login.css" rel="stylesheet" />
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
        <div class="login-container">
            <div class="login-title">Login</div>
            <form class="login-form" method="post" action="Backend/handleLogin.php">
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
                            <label>Password</label>
                        </th>
                        <td>
                            <input type="password" id="password" name="password" placeholder="Enter password" required>
                        </td>
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" value="Log In">
                    <?php
                    if (isset($_GET['isWrongPassword'])) {
                        echo "<div style='visibility:visible; color: rgb(235, 0, 0);'>Incorret Email and/or Password</div>";
                    } else {
                        echo "<div style='visibility:hidden; color: rgb(235, 0, 0);'>Incorret Email and/or Password</div>";
                    }
                    ?>
                    <div class="forgot-password"><a href="">Forgot your password?</a></div>
                </div>
            </form>
            <p>Don't have an account? Click here to <span> <a href="register.html">sign up</a></span></p>
        </div>
    </main>
</body>
<script>

</script>

</html>