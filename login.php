<?php
session_start();

// Simulated user data (replace with database query)
$users = [
    'user1' => ['password' => 'password1', 'fullname' => 'User One'],
    'user2' => ['password' => 'password2', 'fullname' => 'User Two']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Check if user exists and password is correct
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $users[$username]['fullname'];

        // Redirect to the account page
        header('Location: account.php');
        exit;
    } else {
        // Invalid credentials
        echo '<script>alert("Invalid username or password."); window.location.href = "login.html";</script>';
        exit;
    }
} else {
    // Redirect to login page if accessed directly
    header('Location: login.html');
    exit;
}
?>
