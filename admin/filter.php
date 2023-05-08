<!DOCTYPE html>
<html>
<head>
    <title>Admin - Booked Flight</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* Add some spacing around the page */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Style the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Style the form */
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2E8B57;
        }

        /* Style the buttons */
        .btn-group {
            margin-bottom: 20px;
        }

        .btn-group button {
            color: #4CAF50;
    padding: 8px 16px;
    border: 2px solid #4CAF50;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px;
        }

        .btn-group button:hover {
            color: #2E8B57;
    border-color: #2E8B57;
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
    <h1>Booked Flight Details</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <!-- <form method="post"> -->
        <!-- <label for="start_date">Start Date:</label>
        <input type="text" id="start_date" name="start_date"> -->
        <label for="airline_name">Airline Name:</label>
        <input type="text" id="airline_name" name="airline_name">

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
            <th>Username</th>
            <th>Flight Number</th>
            <th>Departure City</th>
            <th>Arrival City</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Price</th>
            <th>Seat</th>
        </tr>
        <div class="button-container">
        <button onclick="location.href='admin_actions.php'">Admin Actions</button>
    <button onclick="location.href='../view_flights.php'">View flights</button>
    <button onclick="location.href='add_flight.php'">Add a new flight</button>
    <button onclick="location.href='remove_flight.php'">Remove a flight</button>
    <button onclick="location.href='filter.php'">Filter view</button>
    <button onclick="location.href='logout.php'">Logout</button> 
    </div>
        <br>
        <?php
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $airline_name = $_POST['airline_name'];
            // $start_date = $_POST['start_date'];
            $start_time = $_POST['start_time'];
            // $end_date = $_POST['end_date'];
            $end_time = $_POST['end_time'];
            
            if(empty($start_time) && empty($end_time)) {
                // Retrieve all flights from the database
                $sql = "SELECT * FROM bookings";
            } else {
                $sql = "SELECT * FROM bookings WHERE airline_name='$airline_name' AND departure_time >= '$start_time' AND arrival_time <='$end_time'";

            }
        

            $result = $conn->query($sql);
            // $_SESSION['username'] = $username;

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["airline_name"] . "</td>";
                    echo "<td>" . $row["city_source"] . "</td>";
                    echo "<td>" . $row["city_destination"] . "</td>";
                    echo "<td>" . $row["departure_time"] . "</td>";
                    echo "<td>" . $row["arrival_time"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["seat"] . "</td>";
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


