<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
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
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ff99cc; /* Light pink for table headers */
        }

        .btn-secondary {
            background-color: #ff99cc; /* Light pink for the "Back to Homepage" button */
            color: #fff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #ff0066; /* Dark pink on hover for the "Back to Homepage" button */
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
                    $servername = "auth-db622.hstgr.io";
                    $username = "u882131357_gulamomo";
                    $password = "*Gulamomo123";
                    $dbname = "u882131357_db_sd_41_02";

                    // Create a database connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check the connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $user_email = $_SESSION["user_email"];

                    // Fetch order history from the database
                    $sql = "SELECT * FROM cart_items WHERE user_email = '$user_email'";
                    $result = $conn->query($sql);
                    echo "<p>User Email: $user_email</p>"; // Display the user's username
                    if ($result->num_rows > 0) {
                        echo "<table class='table'>";
                        echo "<thead><tr><th>Item ID</th><th>Item Name</th><th>Item Price</th><th>Created At</th></tr></thead>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["item_id"] . "</td>";
                            echo "<td>" . $row["item_name"] . "</td>";
                            echo "<td>" . $row["item_price"] . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";

                    } else {
                        echo "<p>No orders found in your order history.</p>";
                    }

                    // Close the database connection
                    $conn->close();
                } else {
                    // Handle unauthenticated access (e.g., redirect to a login page)
                    echo "Please log in to view your order history.";
                }
                ?>

                <br>
                <br>
                <a href="indexCustomer.html" class="btn btn-secondary">Back to Homepage</a>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
