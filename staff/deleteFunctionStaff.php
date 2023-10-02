<?php
if (isset($_POST["delete_staff"])) {
    // Database connection parameters
    $servername = "localhost";
    $username = "sd41";
    $password = "sd41project";
    $dbname = "db_sd_41_02";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the user's email from the form
    $user_email = $_POST["user_email"];

    // SQL query to delete the record
    $deleteSql = "DELETE FROM user WHERE Email = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $user_email);

    if ($stmt->execute()) {
        // Record deleted successfully
        header("Location: indexStaff.php"); // Redirect to the desired page
        exit;
    } else {
        // Error deleting record
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Handle the case when delete_staff is not set
    echo "Invalid request";
}
?>
