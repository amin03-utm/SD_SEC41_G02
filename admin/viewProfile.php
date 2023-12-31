<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gulamomo Bakery Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))></style>
</head>
<body>
<section class="vh-100 bg-image"
  style="background-image: url('https://images.hdqwalls.com/download/chocolate-dessert-pastry-cake-5k-yw-2560x1440.jpg');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6" >
          <div class="card" style="border-radius: 15px;">
          <div class="card-body p-5" style="background-color: pink; border-radius: 15px;">
              <h2 class="text-uppercase text-center mb-5 ">User Profile</h2>
              <div class="bulit_icon"  ><img src="images/user_icon.jpg"></div>


</body>

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
    echo "<p style='color: black;'>Email: $userEmail</p>"; // Change "Username" to "email"

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
   
    echo "<p style='color: black;'>Username: $userName</p>";
    echo "<p style='color: black;'>Password: $userPass</p>";
    echo "<p style='color: black;'>User Type: $userType</p>";
    

    // Display other profile information here
    echo "</div></body></html>";

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "User is not logged in. Please log in to view your profile.";
}
?>

