<!DOCTYPE html>
<html>
<head>
    <title>User Sign Up</title>
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
    <h1>User Sign Up</h1>
    <form action="signup.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>
        <input type="submit" value="Sign Up">
    </form>

    <?php
    // Display error messages if any
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <?php
    session_start();

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
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];



        // Validate form data
        if ($password !== $confirm_password) {
            echo "Passwords do not match";
            $error ="Passwords do not match";
        } else {
            // Check if username is already taken
            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                echo  "Username is already taken";
                $error = "Username is already taken";
                header("Location: login.php");
            } else {
                // Insert new user into database
                $query = "INSERT INTO users (name,username, password, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssss",$name, $username, $password, $email, $phone, $address);
                $stmt->execute();
                $stmt->close();

                // Redirect to login page
                header("Location: login.php");
                exit();
            }
        }

        $stmt->close();
    }

    $conn->close();
   
