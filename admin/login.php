<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
        text-align: center;
    }

    form {
        width: 300px;
        margin: 0 auto;
    }

    label, input {
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 5px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        margin-top: 10px;
        text-align: center;
    }
</style>
</head>
<body>
    <h1>Admin Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php
// Display error messages if any
if (isset($error)) {
    echo "<p class='error'>$error</p>";
}
?>

<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: admin_actions.php");
    exit();
}
if (isset($_SESSION['admin'])) {
    header("Location: admin_actions.php");
    exit();
}

// Replace these variables with your own database credentials
$host = 'localhost:3307';
$username = 'root';
$password = '';
$dbname = 'flight_booking';

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are valid
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username;
        // Username and password are valid, redirect to product page
        header("Location: admin_actions.php");
        exit();
    } else {
        // Username and password are not valid, redirect to signup page
        header("Location: login.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
</body>
</html>