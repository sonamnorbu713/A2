<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "profile";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user input to prevent SQL injection
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Placeholder for secure password verification using password_verify()
// Implement logic to fetch the user record by username and compare the
// entered password (hashed) with the stored hashed password.
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    // Placeholder for secure password verification
    // Replace this with actual logic using password_verify()
    if ($password == $user['password']) {
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        $_SESSION['username'] = $user['username']; // Store username in session
        header('Location: dashboard.php'); // Redirect to dashboard
    } else {
        $_SESSION['message'] = 'Invalid username or password'; // Set error message
        header('Location: login.php'); // Redirect back to login with error
    }
} else {
    $_SESSION['message'] = 'Invalid username or password'; // Set error message
    header('Location: login.php'); // Redirect back to login with error
}

// Close the database connection (optional)
$conn->close();
?>
