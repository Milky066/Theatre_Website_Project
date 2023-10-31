<?php
include "Backend/checkLogin.php";
include 'Backend/connectDB.php';
include 'Backend/displayShow.php';

$conn = connectDB();
$show_id = $_GET['show_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        displayTitle($conn, $show_id);
        ?>
    </title>
    <link href="Styles/global.css" rel="stylesheet" />
    <link href="Styles/playPage.css" rel="stylesheet" />
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
        <div class="movie-container">
            <div class="movie-container-left">
                <div class="movie-title-left">
                    <?php
                    displayTitle($conn, $show_id);
                    ?>
                </div>
                <div class="image">
                    <?php
                    displayImage($conn, $show_id);
                    ?>
                </div>
                <div class="rating">
                    Rating:
                    <?php
                    displayRating($conn, $show_id);
                    ?>
                </div>
                <div class="showtime">
                    Showtime: <b>
                        <?php
                        displayDate($conn, $show_id);
                        ?></b>
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
                <table>
                    <tr>
                        <th>Title</th>
                        <td class="movie-title-right">
                            <?php
                            displayTitle($conn, $show_id);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Synopsis</th>
                        <td class="movie-description">
                            <?php
                            displayDescription($conn, $show_id);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <!-- Seat selection componet -->

                            <div class="screen-container">Screen</div>
                            <table class="seat-container" id="seat-container">
                                <script>
                                    const seatString = "<?php getBookedSeatString($conn, $show_id); ?>";
                                    const seatArr = seatString.split(",");
                                    document.addEventListener("DOMContentLoaded", function() {

                                        generateSeats(seats = seatArr);
                                        resetCheckboxes();

                                    });
                                </script>
                            </table>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-left-panel">
                <p>&copy;JhaMil Theatre</p>
            </div>
            <div class="footer-right-panel">
                Best shows at Jhamil
            </div>
        </div>
    </footer>

    <script>
        let bookedSeats = 0;

        function updateExternalInput(inputId, value) {
            // Update the value of the corresponding hidden input field
            document.getElementById(inputId).value = value;
        }

        function resetCheckboxes() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }

        function generateSeats(seats = [], rowNum = 5, rowCap = 10, hiddenFormId = "hidden-form", seatContainerId = "seat-container") {
            const seatContainer = document.getElementById(seatContainerId);
            const hiddenForm = document.getElementById(hiddenFormId);
            console.log("Booked seats: " + seats);
            for (let row = 0; row < rowNum; row++) {
                const rowContainer = document.createElement("tr");
                const rowHeader = document.createElement("td");
                const asciiOffset = 65;

                // Row names
                rowHeader.textContent = String.fromCharCode(row + asciiOffset);
                rowContainer.setAttribute("class", "row-container");
                rowContainer.setAttribute("id", `row-${row}`);
                rowContainer.appendChild(rowHeader);
                for (let seatNum = 0; seatNum < rowCap; seatNum++) {
                    const cell = document.createElement("td");

                    const rowId = String.fromCharCode(row + asciiOffset) + seatNum;
                    if (seats.includes(rowId)) {
                        // console.log(rowId)
                        const filledSeat = document.createElement("div")
                        filledSeat.setAttribute("class", "seat-checkbox-booked");
                        cell.appendChild(filledSeat);
                    } else {
                        const seat = document.createElement("input");
                        seat.setAttribute("type", "checkbox");
                        seat.setAttribute("id", `external-checkbox-${rowId}`);
                        seat.setAttribute("name", `external-checkbox-${rowId}`)
                        seat.setAttribute("class", "seat-checkbox");
                        seat.setAttribute("onchange", 'updateInternalInput(this)');
                        const label = document.createElement("label");
                        label.setAttribute("for", seat.id);
                        const span = document.createElement("span");
                        label.appendChild(span);
                        cell.appendChild(seat);
                        cell.appendChild(label);

                        const hiddenInput = document.createElement("input");
                        hiddenInput.setAttribute("id", `hidden-checkbox-${rowId}`);
                        hiddenInput.setAttribute("name", `hidden-checkbox-${rowId}`)
                        hiddenInput.style = "display: none;";
                        hiddenForm.appendChild(hiddenInput);
                    }
                    rowContainer.appendChild(cell);
                }
                seatContainer.appendChild(rowContainer);
            }
            const seatNumRow = document.createElement("tr");
            const cornerCell = document.createElement("td");
            seatNumRow.appendChild(cornerCell);

            // Row numbers
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
            submitButton.setAttribute("class", "submit-button");
            const showIdPost = document.createElement("input");
            showIdPost.setAttribute("type", "hidden");
            showIdPost.setAttribute("value", <?php echo $show_id; ?>);
            showIdPost.setAttribute("name", "show_id");

            const bookedAmount = document.createElement("input");
            bookedAmount.setAttribute("type", "hidden");
            bookedAmount.setAttribute("value", bookedSeats);
            bookedAmount.setAttribute("id", "booked_seats");
            bookedAmount.setAttribute("name", "booked_seats");

            const showPage = document.createElement("input");
            showPage.setAttribute("type", "hidden");
            showPage.setAttribute("value", window.location.href);
            showPage.setAttribute("id", "show_page");
            showPage.setAttribute("name", "show_page");

            hiddenForm.appendChild(showPage);
            hiddenForm.appendChild(bookedAmount);
            hiddenForm.appendChild(showIdPost);
            hiddenForm.appendChild(submitButton);
        }

        function updateInternalInput(element) {
            // If cell is not previously booked, generate checkbox, else div
            const internalId = /-[A-Z][0-9]/;
            const id = "hidden-checkbox" + internalId.exec(element.id)[0];


            const hiddenInputElement = document.getElementById(id);
            const bookedSeat = document.getElementById("booked_seats");
            hiddenInputElement.checked = element.checked;
            if (hiddenInputElement.checked) {
                hiddenInputElement.value = "on";
                bookedSeats++;
            } else {
                hiddenInputElement.value = "off";
                bookedSeats--;
            }
            // hiddenInputElement.checked ? hiddenInputElement.value = "on" : hiddenInputElement.value = "off";
            console.log("Booked seat: " + bookedSeats);
            bookedSeat.value = bookedSeats;
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