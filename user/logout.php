<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // User is not logged in, redirect to login page
    header("Location: ../view_flights.php");
    exit();
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Logout</title>
</head>
<body>
    <h1>You have been logged out.</h1>
    <p><a href="../view_flights.php">Home</a></p>
</body>
</html>
