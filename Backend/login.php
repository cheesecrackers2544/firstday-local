<?php
//login.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $host = '127.0.0.1'; // or your host
    $dbUsername = 'root'; // or your db username
    $dbPassword = ''; // or your db password
    $dbName = 'firstdaydb'; // your database name

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Password is not escaped because it will be hashed

    // Query to get the user's hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password against the hashed password
        if (password_verify($password, $user['password'])) {
            // Login success
            $_SESSION['username'] = $username;
            header("Location: welcome.php"); // redirect to welcome page or dashboard
            exit;
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>
