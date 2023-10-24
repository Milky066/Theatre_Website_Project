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
                    <form action="confirmPage.php" method="post">
                    
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
                        <table class="seat-container" id = "seat-container">
                            <script>
                            document.addEventListener("DOMContentLoaded", function () {
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

    <script>
    function updateExternalInput(inputId, value) {
        // Update the value of the corresponding hidden input field
        document.getElementById(inputId).value = value;
    }

    function submitFormWithExternalInputs() {
        // Manually submit the form
        document.getElementById('myForm').submit();
    }

    function generateSeats(rowNum = 5, rowCap = 10){
        const seatContainer = document.getElementById("seat-container");
        
        for(let row = 0; row < rowNum; row++){
            const rowContainer = document.createElement("tr");
            const rowHeader = document.createElement("td");
            const asciiOffset = 65;
            rowHeader.textContent = String.fromCharCode(row + asciiOffset);
            rowContainer.setAttribute("class", "row-container");
            rowContainer.setAttribute("id", `row-${row}`);
            rowContainer.appendChild(rowHeader);
            for(let seatNum = 0; seatNum < rowCap; seatNum++){
                const cell = document.createElement("td");
                const seat = document.createElement("input");
                seat.setAttribute("type", "checkbox");
                seat.setAttribute("id", `checkbox-row${row}-seat${seatNum}`);
                seat.setAttribute("name", `checkbox-row${row}-seat${seatNum}`)
                seat.setAttribute("class", "seat-checkbox");

                const label = document.createElement("label");
                label.setAttribute("for", seat.id);
                const span = document.createElement("span");

                label.appendChild(span);
                // rowContainer.appendChild(seat);
                // rowContainer.appendChild(label);
                cell.appendChild(seat)
                cell.appendChild(label)
                rowContainer.appendChild(cell);
            }
            seatContainer.appendChild(rowContainer);
        }
        const seatNumRow = document.createElement("tr");
        const cornerCell = document.createElement("td");
        seatNumRow.appendChild(cornerCell);
        for(let seatNum = 0; seatNum < rowCap; seatNum++){
            const cell = document.createElement("td");
            cell.textContent = seatNum;
            cell.style = "text-align: center;";
            seatNumRow.appendChild(cell);
        }
        seatContainer.appendChild(seatNumRow);
    }

    function rowToLetter(row){
        const alphabets = ['A']

    }
    </script>
</body>
    <?php
        $conn->close();
    ?>
</html>