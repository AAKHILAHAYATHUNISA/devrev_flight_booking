<?php
session_start();

if (isset($_SESSION['admin'])) {
    // User is logged in, show the page content
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Actions</title>
    <style>
            body {
                font-family: Arial, sans-serif;
            }
            h1 {
                font-size: 36px;
                margin-bottom: 20px;
            }
            h2 {
                font-size: 24px;
                margin-bottom: 10px;
            }
            p {
                font-size: 16px;
                margin-bottom: 10px;
            }
            button {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 10px;
                cursor: pointer;
                border-radius: 5px;
            }
            button:hover {
                background-color: #3e8e41;
            }
    </style>
</head>
<body>
    <h1>Hello!</h1>
    <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
    <button onclick="location.href='logout.php'">Logout</button>


    <h2>Flight Details</h2>
    <button onclick="location.href='../view_flights.php'">View flights</button>
    <button onclick="location.href='add_flight.php'">Add a new flight</button>
    <button onclick="location.href='remove_flight.php'">Remove a flight</button>
    <button onclick="location.href='filter.php'">Filter view</button>
    <button onclick="location.href='logout.php'">Logout</button>

</body>
</html>
<?php
} else {
    // User is not logged in, redirect to login page
    header("Location: ../view_flights.php");
    exit();
}
?>


