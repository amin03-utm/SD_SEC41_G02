<?php
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
    $email = $_SESSION["user_email"]; // Assuming you have a user's email stored in the session
    
    $username = $_POST["Username"];
    $newPassword = $_POST["new_password"];

    // Update the user's profile in the database
    // Replace 'your_table_name' with your actual table name
    $sql = "UPDATE user SET Username = ?, password = ? WHERE email = ?";
        
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $newPassword, $email);
        
    if ($stmt->execute()) {
        $_SESSION["update_success"] = "Profile updated successfully.";
        header("Location: editProfile.html"); // Redirect back to the edit profile page
        exit();
    } else {
        $_SESSION["update_error"] = "Error updating profile: " . $stmt->error;
        header("Location: editProfile.html"); // Redirect back to the edit profile page
        exit();
    }
}

// Close the database connection
$conn->close();
?>
