<!DOCTYPE html>
<html>

<head>
    <title>Admin Add Flight</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            width: 100%;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    // Replace these variables with your own database credentials
    $host = 'localhost:3307';
    $username = 'root';
    $password = '';
    $dbname = 'flight_booking';

    // $_SESSION['username']
    if (isset($_SESSION['admin'])) {
        // User is logged in, show the page content
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form data
            $airline_name = $_POST['airline_name'];
            $city_source = $_POST['city_source'];
            $city_destination = $_POST['city_destination'];
            $departure_time = $_POST['departure_time'];
            $arrival_time = $_POST['arrival_time'];
            $price = $_POST['price'];

            // TODO: Validate the form data

            // Insert the new flight record into the database
            $conn = new mysqli($host, $username, $password, $dbname);
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }
            $sql = "SELECT * FROM flights WHERE airline_name='$airline_name' AND city_source='$city_source' AND city_destination='$city_destination' AND departure_time='$departure_time'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<p class='error'>Error: Flight already exists in the database</p>";
            } else {

            $sql = "INSERT INTO flights (airline_name, city_source, city_destination, departure_time, arrival_time, price) VALUES ('$airline_name', '$city_source', '$city_destination', '$departure_time', '$arrival_time', $price)";
            if ($conn->query($sql) === TRUE) {
                echo "<p class='success'>New flight added successfully</p>";
            } else {
                echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

            $conn->close();
        }
        ?>

        <h1>Add Flight</h1>
        <button onclick="location.href='admin_actions.php'">Admin Actions</button>
    <button onclick="location.href='view_flights.php'">View flights</button>
    <button onclick="location.href='add_flight.php'">Add a new flight</button>
    <button onclick="location.href='remove_flight.php'">Remove a flight</button>
    <button onclick="location.href='filter.php'">Filter view</button>
    <button onclick="location.href='logout.php'">Logout</button>
        <br></br>
        <form method="POST">
            <label for="airline_name">Flight Number:</label>
            <input type="text" name="airline_name" required><br>

            <label for="city_source">Departure City:</label>
            <input type="text" name="city_source" required><br>

            <label for="city_destination">Arrival City:</label>
            <input type="text" name="city_destination" required><br>

            <label for="departure_time">Departure Time:</label>
            <input type="text" name="departure_time" required><br>

            <label for="arrival_time">Arrival Time:</label>
            <input type="text" name="arrival_time" required><br>

            <!-- <label for="departure_time">Departure Time:</label>
            <input type="datetime-local" name="departure_time" required><br>

            <label for="arrival_time">Arrival Time:</label>
            <input type="datetime-local" name="arrival_time" required><br> -->

            <label for="price">Price:</label>
            <input type="number" name="price" required><br>

            <input type="submit" value="Add Flight">
        </form>
    <?php
    } else {
        // User is not logged in, redirect to login page
        header("Location: ../view_flights.php");
        exit();
    }
    ?>
</body>

</html>
