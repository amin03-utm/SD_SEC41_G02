<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost"; // Replace with your database server name
$username = "sd41"; // Replace with your database username
$password = "sd41project"; // Replace with your database password
$dbname = "db_sd_41_02"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session (if not already started)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; // Get the email entered by the user
    
    // Check if the email exists in the database
    $checkSql = "SELECT * FROM user WHERE email = ? AND userType='Staff'";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $_SESSION["update_error"] = "Email not found in the database.";
        header("Location: Customer.html"); // Redirect back to the edit customer profile page
        exit();
    }
    
    $customerName = $_POST["Username"]; // Change 'name' to 'Username'
    $password = $_POST["password"];

    // Update the user's profile in the database based on the email
    $updateSql = "UPDATE user SET Username = ?, password = ? WHERE email = ? AND userType='Staff'";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sss", $customerName, $password, $email);
    
    if ($stmt->execute()) {
        $_SESSION["update_success"] = "Profile updated successfully.";
        header("Location: Customer.html"); // Redirect back to the edit customer profile page
        exit();
    } else {
        $_SESSION["update_error"] = "Error updating profile: " . $stmt->error;
        header("Location: Customer.html"); // Redirect back to the edit customer profile page
        exit();
    }
}

// Close the database connection
$conn->close();
?>
