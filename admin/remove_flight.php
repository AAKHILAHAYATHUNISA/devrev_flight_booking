<!DOCTYPE html>
<html>
<head>
    <title>Remove Flight</title>
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
    <button onclick="location.href='admin_actions.php'">Admin Actions</button>
    <button onclick="location.href='../view_flights.php'">View flights</button>
    <button onclick="location.href='add_flight.php'">Add a new flight</button>
    <button onclick="location.href='remove_flight.php'">Remove a flight</button>
    <button onclick="location.href='filter.php'">Filter view</button>
    <button onclick="location.href='logout.php'">Logout</button>
    <br>
    <br>
    <br>
    <table>
        <?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../view_flights.php");           
    
    exit();
}

// Replace these variables with your own database credentials
$host = 'localhost:3307';
$username = 'root';
$password = '';
$dbname = 'flight_booking';

if (isset($_SESSION['admin'])) {
    // User is logged in, show the page content

    // Remove the flight record from the database
    if (isset($_GET['delete'])) {
        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $flight_id = $_GET['delete'];
        $sql = "DELETE FROM flights WHERE id=$flight_id";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>Flight removed successfully</p>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }

    // Display all flights in a table
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "SELECT * FROM flights";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Flight ID</th><th>Airline Name</th><th>Source</th><th>Destination</th><th>Departure Time</th><th>Arrival Time</th><th>Price</th><th>Seat</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["airline_name"]."</td>";
            echo "<td>".$row["city_source"]."</td>";
            echo "<td>".$row["city_destination"]."</td>";
            echo "<td>".$row["departure_time"]."</td>";
            echo "<td>".$row["arrival_time"]."</td>";
            echo "<td>".$row["price"]."</td>";
            echo "<td>".$row["seat"]."</td>";
            echo "<td><a href='?delete=".$row["id"]."'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No flights found";
    }

    $conn->close();
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

        
    </table>
</body>
</html>
