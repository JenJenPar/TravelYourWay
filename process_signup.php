<?php
session_start(); // Start the session

// Database connection details
$servername = "localhost";
$username = "username"; // Update with your database username
$password = "password"; // Update with your database password
$dbname = "database"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['signupEmail'];
$password = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT);

// Insert the data into the database
$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

if ($stmt->execute()) {
    // Set session variables
    $_SESSION['email'] = $email;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;

    // Successful signup, redirect to the account page
    header("Location: account.php");
    exit();
} else {
    // Handle errors here
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>




