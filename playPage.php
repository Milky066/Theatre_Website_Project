<?php
include "Backend/checkLogin.php";
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
                    <form id="hidden-form" action="confirmPage.php" method="post">
                        <!-- Populate by hidden input elements by the JS below -->
                        <!-- <input type="checkbox" name="check111"/> -->
                        <!-- <input type="submit" value="Proceed"/> -->
                    </form>
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
                    <div>
                        <div class="screen-container">Screen</div>
                        <table class="seat-container" id="seat-container">
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    generateSeats();
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <?php
                $show_id = $_GET['show_id'];
                echo "Show ID: " . $show_id;
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

    <script>
        function updateExternalInput(inputId, value) {
            // Update the value of the corresponding hidden input field
            document.getElementById(inputId).value = value;
        }

        function submitFormWithExternalInputs() {
            // Manually submit the form
            document.getElementById('myForm').submit();
        }

        function generateSeats(rowNum = 5, rowCap = 10, hiddenFormId = "hidden-form", seatContainerId = "seat-container") {
            const seatContainer = document.getElementById(seatContainerId);
            const hiddenForm = document.getElementById(hiddenFormId);
            for (let row = 0; row < rowNum; row++) {
                const rowContainer = document.createElement("tr");
                const rowHeader = document.createElement("td");
                const asciiOffset = 65;
                rowHeader.textContent = String.fromCharCode(row + asciiOffset);
                rowContainer.setAttribute("class", "row-container");
                rowContainer.setAttribute("id", `row-${row}`);
                rowContainer.appendChild(rowHeader);
                for (let seatNum = 0; seatNum < rowCap; seatNum++) {
                    const cell = document.createElement("td");
                    const seat = document.createElement("input");
                    seat.setAttribute("type", "checkbox");
                    seat.setAttribute("id", `external-checkbox-${String.fromCharCode(row + asciiOffset)}${seatNum}`);
                    seat.setAttribute("name", `external-checkbox-${String.fromCharCode(row + asciiOffset)}${seatNum}`)
                    seat.setAttribute("class", "seat-checkbox");
                    seat.setAttribute("onchange", 'updateInternalInput(this)');
                    const label = document.createElement("label");
                    label.setAttribute("for", seat.id);
                    const span = document.createElement("span");

                    label.appendChild(span);
                    cell.appendChild(seat)
                    cell.appendChild(label)
                    rowContainer.appendChild(cell);

                    const hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("id", `hidden-checkbox-${String.fromCharCode(row + asciiOffset)}${seatNum}`);
                    hiddenInput.setAttribute("name", `hidden-checkbox-${String.fromCharCode(row + asciiOffset)}${seatNum}`)
                    hiddenInput.style = "display: none;";
                    hiddenForm.appendChild(hiddenInput);
                }
                seatContainer.appendChild(rowContainer);
            }
            const seatNumRow = document.createElement("tr");
            const cornerCell = document.createElement("td");
            seatNumRow.appendChild(cornerCell);
            for (let seatNum = 0; seatNum < rowCap; seatNum++) {
                const cell = document.createElement("td");
                cell.textContent = seatNum;
                cell.style = "text-align: center;";
                seatNumRow.appendChild(cell);
            }
            seatContainer.appendChild(seatNumRow);
            const submitButton = document.createElement("input");
            submitButton.setAttribute("type", "submit");
            submitButton.setAttribute("value", "Proceed");
            hiddenForm.appendChild(submitButton);
        }

        function updateInternalInput(element) {
            const internalId = /-[A-Z][0-9]/;
            const id = "hidden-checkbox" + internalId.exec(element.id)[0];

            const hiddenInputElement = document.getElementById(id);
            hiddenInputElement.checked = element.checked;
            hiddenInputElement.checked ? hiddenInputElement.value = "on" : hiddenInputElement.value = "off";

            // console.log(hiddenInputElement.checked);
        }

        function rowToLetter(row) {
            const alphabets = ['A']

        }
    </script>
</body>
<?php
$conn->close();
?>

</html>