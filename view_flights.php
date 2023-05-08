<!DOCTYPE html>
<html>
<head>
    <title>Flight Details</title>
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
    <h1>Flight Details</h1>
    <table>
        <tr>
            <th>Flight Number</th>
            <th>Departure City</th>
            <th>Arrival City</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Price</th>
            <th>Seat</th>
        </tr>
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

        // Retrieve all flights from the database
        $sql = "SELECT * FROM flights";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
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
            echo "<tr><td colspan='6'>No flights found</td></tr>";
        }       


        $conn->close();
        ?>
    </table>
    <br>
    <br>
    <?php
    session_start();
    if (isset($_SESSION['admin'])) {
        ?>
        <button onclick="location.href='admin/filter.php'">Admin</button>
        <?php
        echo "Admin Loggedin";
        exit();
    }
    
    if (isset($_SESSION['username'])) {
        ?>
        <button onclick="location.href='user/filter.php'">User</button>
        <?php
        echo "User Loggedin";
        exit();
    }
    ?>
    <button onclick="location.href='user/option.php'">User</button>
    <button onclick="location.href='admin/option.php'">Admin</button>
</body>
</html>
