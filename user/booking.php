<style>
    body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  background-color: #f5f5f5;
  padding: 20px;
}

h1, h2, h3, h4, h5, h6 {
  font-family: inherit;
  font-weight: bold;
  line-height: 1.2;
  margin-top: 0;
  margin-bottom: 0.5rem;
}

h1 {
  font-size: 2.5rem;
}

h2 {
  font-size: 2rem;
}

h3 {
  font-size: 1.75rem;
}

h4 {
  font-size: 1.5rem;
}

h5 {
  font-size: 1.25rem;
}

h6 {
  font-size: 1rem;
}

p {
  margin-top: 0;
  margin-bottom: 1rem;
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

// Get flight ID and username from form data
$id = $_POST['flight_id'];
$seat = isset($_POST['seat']) ? $_POST['seat'] : 0;

// Get flight details from flights table
$sql = "SELECT airline_name, city_source, city_destination, departure_time, arrival_time, price, seat FROM flights WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Get booking details
    $username = $_SESSION['username'];

    // Fetch flight details
    $row = $result->fetch_assoc();
    $airline_name = $row["airline_name"];
    $city_source = $row["city_source"];
    $city_destination = $row["city_destination"];
    $departure_time = $row["departure_time"];
    $arrival_time = $row["arrival_time"];
    $price = $row["price"];
    $available_seats = $row["seat"];

    // Check if a booking with the same airline and username already exists
    $sql = "SELECT * FROM bookings WHERE airline_name = '$airline_name' AND username = '$username' AND city_source='$city_source' AND city_destination='$city_destination' AND departure_time='$departure_time' AND arrival_time='$arrival_time'";
    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) {
        // A booking for the same user and airline combination already exists
        echo "You have already booked a flight with this airline";
        echo "<br>";

        // Update booked seat count
        $sql = "SELECT username, flight_id, seat FROM bookings WHERE flight_id = '$id' AND username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $seat_number = $row["seat"];

            $booked_seats = $seat_number + $seat;
            $sql = "UPDATE bookings SET seat = $booked_seats WHERE flight_id = '$id' AND username='$username'";
            if (mysqli_query($conn, $sql)) {
                echo "Booking seat count updated successfully";
                echo "<br>";
            } else {
                echo "Error updating booking seat count: " . mysqli_error($conn);
                echo "<br>";
            }
        } else {
            echo "No booking found for user $username and flight $id";
            echo "<br>";
        }

        // Update available seat count
        $updated_seats = $available_seats - $seat;
        $sql = "UPDATE flights SET seat = $updated_seats WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            echo "Flight seat count updated successfully";
            echo "<br>";
        } else {
            echo "Error updating flight seat count: " . mysqli_error($conn);
            echo "<br>";
        }
    }else {        
        if ($seat <= 0 || $seat > $available_seats) {
            echo "Invalid number of seats selected";  
            echo "<br>";   
        } else {
            // Insert booking into database
            $sql = "INSERT INTO bookings (airline_name, username, city_source, city_destination, departure_time, arrival_time, price, seat, flight_id) 
                    VALUES ('$airline_name', '$username', '$city_source', '$city_destination', '$departure_time', '$arrival_time', '$price', '$seat', '$id')";
             if ($conn->query($sql) === TRUE) {
                echo "Booking created successfully";
                echo "<br>";

                // Update available seat count
                $updated_seats = $available_seats - $seat;
                $sql = "UPDATE flights SET seat = $updated_seats WHERE id = '$id'";
                if (mysqli_query($conn, $sql)) {
                    echo "Flight seat count updated successfully";
                    echo "<br>";
                } else {
                    echo "Error updating flight seat count: " . mysqli_error($conn);
                    echo "<br>";
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<br>";
            }
        }        
    }
} else {
    echo "No flight found with ID: $id";
    echo "<br>";
}
?>
<br>
<br>
<button onclick="location.href='../view_flights.php'">Home</button>
<button onclick="location.href='filter.php'">View All Flights</button>
<button onclick="location.href='mybooking.php'">My Booking</button>
<button onclick="location.href='logout.php'">Logout</button>
<br>
<br>

<?php
$conn->close();
?>
