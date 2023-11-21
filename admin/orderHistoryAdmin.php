<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f9e6e6; /* Light pink background */
        }

        .card-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-title {
            color: #ff0066; /* Dark pink for the card title */
            margin-bottom: 20px;
        }

        .user-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            overflow-x: auto; /* Add horizontal scrollbar if needed */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ff99cc; /* Light pink for table headers */
        }

        .user-table tbody tr:nth-child(even) {
            background-color: #fce4e4; /* Alternating row color */
        }


        .btn-secondary {
            background-color: #ff99cc; /* Light pink for the "Back to Homepage" button */
            color: #fff;
            border: none;
            margin-top: 20px;
        }


    </style>
</head>

<body>
    <div class="container">
        <div class="card card-container">
            <div class="card-body">
                <h1 class="card-title">Order History</h1>

                <?php
                session_start();

                // Check if the user is authenticated (replace with your authentication logic)
                if (isset($_SESSION["user_email"])) {
                    // Replace with your database connection code
                    $servername = "localhost";
                    $username = "sd41";
                    $password = "sd41project";
                    $dbname = "db_sd_41_02";

                    // Create a database connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check the connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch all unique user emails
                    $uniqueUserEmailsQuery = "SELECT DISTINCT user_email FROM cart_items";
                    $uniqueUserEmailsResult = $conn->query($uniqueUserEmailsQuery);

                    if ($uniqueUserEmailsResult->num_rows > 0) {
                        // Loop through each unique user email
                        while ($userRow = $uniqueUserEmailsResult->fetch_assoc()) {
                            $currentUserEmail = $userRow["user_email"];

                            // Fetch order history for the specific user from the database
                            $sql = "SELECT * FROM cart_items WHERE user_email = '$currentUserEmail'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<h2>User Email: $currentUserEmail</h2>";
                                echo "<table class='table user-table'>";
                                echo "<thead><tr><th>Item ID</th><th>Item Name</th><th>Item Price</th><th>Created At</th></tr></thead>";
                                echo "<tbody>"; // Added tbody for better styling

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["item_id"] . "</td>";
                                    echo "<td>" . $row["item_name"] . "</td>";
                                    echo "<td>" . $row["item_price"] . "</td>";
                                    echo "<td>" . $row["created_at"] . "</td>";
                                    echo "</tr>";
                                }

                                echo "</tbody>"; // Close tbody
                                echo "</table>";
                                echo "<br><br><br><br><br>";
                            } else {
                                echo "<p>No orders found for user email: $currentUserEmail</p>";
                            }
                        }
                    } else {
                        echo "<p>No user emails found in the order history.</p>";
                    }

                    // Close the database connection
                    $conn->close();
                } else {
                    // Handle unauthenticated access (e.g., redirect to a login page)
                    echo "Please log in to view your order history.";
                }
                ?>

                <a href="indexAdmin.php" class="btn btn-secondary">Back to Homepage</a>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>