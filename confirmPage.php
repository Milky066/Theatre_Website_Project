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

    <main>
        
        <div>
            <!-- Seat selection componet -->
            <div class = "right">
                <div style="text-align:center;">Booked seats</div>
                <div class="screen-container" style="width: 20%; margin-left: auto; margin-right: auto;">Screen</div>
                <table style = "text-align: center; display: flex; justify-content: center;">
                <?php
                    $row_count = 5;
                    $seat_per_row = 10;
                    $checked_seat = [];
                    echo "<tbody>";
                    for ($row = 0; $row < $row_count; $row++) {
                        $rowChar = chr($row + 65);
                        echo "<tr>";
                        echo "<td>$rowChar</td>";
                        for ($seat = 0; $seat < $seat_per_row; $seat++) {
                            
                            $seat_id = chr(65 + $row) . $seat;
                            $checkbox_name = "hidden-checkbox-" . $seat_id;
                            if(isset($_POST[$checkbox_name]) && ($_POST[$checkbox_name] == "on")){
                                $checked_seat[] = $seat_id;
                                echo "<td style='width: 16px; height: 16px; background-color: red;'></td>";
                            } else {
                                echo "<td style='width: 16px; height: 16px; background-color: gray;'></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "<tr><td></td>";
                    for ($seat = 0; $seat < $seat_per_row; $seat++){
                        echo "<td>$seat</td>";
                    }   
                    echo "</tr>";
                    echo "</tbody>";
                    ?>
                </table>
            </div>
        </div>
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
        function generateSeatsReadOnly(rowNum = 5, rowCap = 10, seatContainerId = "seat-container"){
        const seatContainer = document.getElementById(seatContainerId);
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
                const seat = document.createElement("div");
                
                
                seat.setAttribute("id", `external-checkbox-${String.fromCharCode(row + asciiOffset)}${seatNum}`);
                seat.style = "width: 16px; height: 16px; background-color: gray;";
                // if(seat is in POST){
                //     seat.style = "width: 16px; height: 16px; background-color: red;";
                // } else {
                    
                // }
                

                // seat.setAttribute("type", "checkbox");
                // seat.setAttribute("name", `external-checkbox-${String.fromCharCode(row + asciiOffset)}${seatNum}`)
                // seat.setAttribute("class", "seat-checkbox");
                // seat.disabled = true;
                // const label = document.createElement("label");
                // label.setAttribute("for", seat.id);
                // const span = document.createElement("span");

                // label.appendChild(span);
                cell.appendChild(seat)
                // cell.appendChild(label)
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
    </script>
</body>
</html>