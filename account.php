<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user data
$email = $_GET['email'];
$sql = "SELECT first_name, last_name FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstName, $lastName);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account - Travel Your Way</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($firstName); ?>!</h1>
    </header>
    <main>
        <div class="account-container">
            <nav class="account-nav">
                <ul>
                    <li><a href="#your-trips">Your Trips</a></li>
                    <li><a href="#future-trips">Future Trips</a></li>
                    <li><a href="#completed-trips">Completed Trips</a></li>
                </ul>
            </nav>
            <div class="account-content">
                <div id="your-trips" class="tab-content">
                    <h2>Your Trips</h2>
                    <p>List of your trips will appear here.</p>
                </div>
                <div id="future-trips" class="tab-content hidden">
                    <h2>Your Future Trips</h2>
                    <p>List of your future trips will appear here.</p>
                </div>
                <div id="completed-trips" class="tab-content hidden">
                    <h2>Completed Trips</h2>
                    <p>List of your completed trips will appear here.</p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Travel Your Way. All rights reserved.</p>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function showTab(tabId) {
                const tabs = document.querySelectorAll('.tab-content');
                tabs.forEach(tab => tab.classList.add('hidden'));

                const activeTab = document.getElementById(tabId);
                if (activeTab) {
                    activeTab.classList.remove('hidden');
                }
            }

            const links = document.querySelectorAll('.account-nav a');
            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const tabId = this.getAttribute('href').substring(1);
                    showTab(tabId);
                });
            });
        });
    </script>
</body>
</html>



