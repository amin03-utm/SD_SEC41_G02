<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Start the session (if it hasn't been started already)
session_start();

// Check if the user is logged in (authenticated)
if (isset($_SESSION['user_email'])) {
    // The session variable 'user_email' exists, so it's safe to use
    $userEmail = $_SESSION['user_email'];

    // Connect to the database (replace with your database credentials)
    $servername = "localhost";
    $username = "sd41";
    $password = "sd41project";
    $dbname = "db_sd_41_02";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the user's profile based on their authenticated email
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display the user's profile
    echo "<html><head><link rel='stylesheet' type='text/css' href='css/style.css'></head><body>";
    echo "<div class='container'>";
    echo "<h1>User Profile</h1>";
    echo "<p>Email: $userEmail</p>"; // Change "Username" to "email"

    // Retrieve additional user information from the database
    $userName = "";
    $userType = "";
    $userPass = "";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userName = $row["Username"]; // Assuming 'Username' is the column name
        $userType = $row["userType"]; // Assuming 'userType' is the column name
        $userPass = $row["password"]; // Assuming 'userType' is the column name

    }

    echo "<p>Username: $userName</p>";
    echo "<p>Password: $userPass</p>";
    echo "<p>User Type: $userType</p>";


    // Display other profile information here
    echo "</div></body></html>";

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "User is not logged in. Please log in to view your profile.";
}
?>
