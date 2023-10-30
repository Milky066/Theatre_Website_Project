<?php
include "Backend/checkLogin.php";

$error_message = isset($_GET["error"]) ? $_GET["error"] : null;
?>
<script>
    const errorMessage = "<?php echo $error_message; ?>";
    const error = errorMessage.replace(/_/g, " ");
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="Styles/global.css" rel="stylesheet" />
    <link href="Styles/register.css" rel="stylesheet" />
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
                    <tr>
                        <th>
                            <label>Confirm Password</label>
                        </th>
                        <td>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Enter password" required onchange="checkPassword()" />
                        </td>
                    </tr>

                </table>
                <span><input type="checkbox" id="password-toggle" name="password-toggle" value="toggle visibility" onchange="togglePasswordVisibility(this)">Toggle visibility</input></span>
                <div id="error-message"></div>
                <div class="submit">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    const passwordInput = document.querySelector("#password");
    const confirmPasswordInput = document.querySelector("#confirm-password");

    document.addEventListener("DOMContentLoaded", updateError());

    function updateError() {
        const erroeContainer = document.getElementById("error-message");
        erroeContainer.textContent = error;
    }

    function checkPassword() {
        if (passwordInput.value === confirmPasswordInput) {
            return true;
        } else {
            return false;
        }
    }

    function togglePasswordVisibility(element) {

        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm-password");
        if (element.checked) {
            password.setAttribute("type", "text");
            confirmPassword.setAttribute("type", "text");
        } else {
            password.setAttribute("type", "password");
            confirmPassword.setAttribute("type", "password");
        }
    }
</script>

</html>