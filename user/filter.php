<!DOCTYPE html>
<html>
<head>
    <title>Flight Search Details</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
        button {
            color: #4CAF50;
    padding: 8px 16px;
    border: 2px solid #4CAF50;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px;
}

button:hover {
    color: #2E8B57;
    border-color: #2E8B57;
}
    </style>
</head>
<body>
    <h1>Flight Search Details</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- <label for="start_date">Start Date:</label>
        <input type="text" id="start_date" name="start_date"> -->

        <label for="start_time">Start Time:</label>
        <input type="text" id="start_time" name="start_time">

        <!-- <label for="end_date">End Date:</label>
        <input type="text" id="end_date" name="end_date"> -->

        <label for="end_time">End Time:</label>
        <input type="text" id="end_time" name="end_time">
        <!-- <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time">

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time"> -->

        <input type="submit" value="View All Flights">
    </form>
    <br>
    <table>
        <tr>
            <th>Flight Number</th>
            <th>Departure City</th>
            <th>Arrival City</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Price</th>
            <th>Available Seat</th>
            <th>Seat Needed</th>
            <th>Action</th>
        </tr>
        <button onclick="location.href='../view_flights.php'">Home</button>
        <button onclick="location.href='mybooking.php'">My Booking</button>
        <button onclick="location.href='logout.php'">Logout</button>
        <br>
        <br>





        <?php
        session_start();

        if (!isset($_SESSION['username'])) {
            header("Location: ../view_flights.php");           
            
            exit();
        }
        // Replace these variables with your own database credentials
        $host = 'localhost:3307';
        $username = 'root';
        $password = '';
        $dbname = 'flight_booking';

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $temp;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // $start_date = $_POST['start_date'];
            $start_time = $_POST['start_time'];
            // $end_date = $_POST['end_date'];
            $end_time = $_POST['end_time'];

            // Retrieve all flights from the database           

            $sql = "SELECT * FROM flights";
            if(!empty($start_time) && !empty($end_time)) {
                // Retrieve all flights from the database
                $sql = "SELECT * FROM flights WHERE departure_time >= '$start_time' AND arrival_time <='$end_time'";
            }
            
            

            $result = $conn->query($sql);
            

            if ($result->num_rows > 0) {
                // Output data of each row
                // while($row = $result->fetch_assoc()) {
                //     echo "<tr>";
                //     echo "<td>" . $row["airline_name"] . "</td>";
                //     echo "<td>" . $row["city_source"] . "</td>";
                //     echo "<td>" . $row["city_destination"] . "</td>";
                //     echo "<td>" . $row["departure_time"] . "</td>";
                //     echo "<td>" . $row["arrival_time"] . "</td>";
                //     echo "<td>" . $row["price"] . "</td>";
                //     echo "<td>" . $row["seat"] . "</td>";



                //     // echo "<input type='number' name='seat' required><br>";
                //     echo "<td><form action='booking_1.php' method='post'>
                //             <input type='hidden' name='flight_id' value='" . $row["id"] . "'>
                //             <input type='hidden' name='username' value='" . $username . "'>
                //             <button type='submit'>Book</button>
                //         </form></td>";

                //     // echo "<td><a href='product.php'>Book</a></td>";
                //     echo "</tr>";
                // }
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["airline_name"] . "</td>";
                    echo "<td>" . $row["city_source"] . "</td>";
                    echo "<td>" . $row["city_destination"] . "</td>";
                    echo "<td>" . $row["departure_time"] . "</td>";
                    echo "<td>" . $row["arrival_time"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["seat"] . "</td>";

                    echo "<form action='booking.php' method='post'>";
                    echo "<td><input type='number' id='seat' name='seat' min='1' max='" . $row["seat"] . "' required></td>";
                    echo "<input type='hidden' name='flight_id' value='" . $row["id"] . "'>";
                    echo "<input type='hidden' name='username' value='" . $_SESSION['username'] . "'>";
                    echo "<td><input type='submit' value='Book'></td>";
                    echo "</form>";
                
                    // echo "<input type='number' name='seat' required><br>";
                    // echo "<td><form action='booking.php' method='post'>
                    //         <input type='hidden' name='flight_id' value='" . $row["id"] . "'>
                    //         <input type='hidden' name='username' value='" . $username . "'>";
                    // // if (isset($_POST["seat"])) {
                    //     echo "<input type='hidden' name='seat_count' value='" . $_POST["seat"] . "'>";
                    // // }
                    // echo "<button type='submit'>Book</button>
                    //     </form></td>";
                
                    // echo "<td><a href='product.php'>Book</a></td>";
                    echo "</tr>";

                }
                
            } else {
                echo "<tr><td colspan='7'>No flights found</td></tr>";
            }
        }


        $conn->close();
        ?>
    </table>
</body>
</html>


