<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost";
$username = "sd41";
$password = "sd41project";
$dbname = "db_sd_41_02";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION["user_email"];
    $update = false; // Flag to check if any updates were made
    
    // Check if "Username" is provided and different from the current value
    if (isset($_POST["Username"]) && $_POST["Username"] !== "") {
        $newUsername = $_POST["Username"];
        
        // Update the "Username" field in the database
        $stmt = $conn->prepare("UPDATE user SET Username = ? WHERE email = ?");
        $stmt->bind_param("ss", $newUsername, $email);
        
        if ($stmt->execute()) {
            $update = true; // Username updated
        } else {
            $_SESSION["update_error"] = "Error updating Username: " . $stmt->error;
        }
    }

    // Check if "new_password" is provided and different from the current value
    if (isset($_POST["new_password"]) && $_POST["new_password"] !== "") {
        $newPassword = $_POST["new_password"];
        
        // Update the "password" field in the database
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        
        if ($stmt->execute()) {
            $update = true; // Password updated
        } else {
            $_SESSION["update_error"] = "Error updating password: " . $stmt->error;
        }
    }
    
    if ($update) {
        $_SESSION["update_success"] = "Profile updated successfully.";
    } else if (!isset($_SESSION["update_error"])) {
        $_SESSION["update_error"] = "No data provided for update.";
    }

    header("Location: editProfile.html"); // Redirect to editProfile.html
    exit();
}
?>
