<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .pay-button {
            background-color: #008CBA;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        body {
            background: pink; /* Set the website background to pink */
        }

        .card-container {
            background: #fff; /* Set the card background to white */
            padding: 20px;
            border-radius: 10px; /* Add rounded corners to the card */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow to the card */
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card card-container">
            <div class="card-body">
                <h1 class="card-title">Checkout</h1>

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

                    $user_email = $_SESSION["user_email"];

                    // Fetch cart items from the database
                    $sql = "SELECT * FROM cart_items WHERE user_email = '$user_email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='table'>";
                        echo "<thead><tr><th>Item Name</th><th>Item Price</th></tr></thead>";
                        $totalPrice = 0;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["item_name"] . "</td>";
                            echo "<td>" . $row["item_price"] . "</td>";
                            echo "</tr>";
                            $totalPrice += $row["item_price"];
                        }
                        echo "</table>";

                        // Format the total price with two decimal places
                        $formattedTotalPrice = number_format($totalPrice, 2);
                        echo "<p>Total Price: $formattedTotalPrice</p>";

                        // Add a "Pay" button with a link
                        echo "<a href='https://buy.stripe.com/test_9AQ9AAbL79hu3qocMM' target='_blank'><button class='btn btn-primary pay-button'>Pay</button></a>";
                    } else {
                        echo "<p>Your cart is empty.</p>";
                    }

                    // Close the database connection
                    $conn->close();
                } else {
                    // Handle unauthenticated access (e.g., redirect to a login page)
                    echo "Please log in to view your shopping cart.";
                }
                ?>
                <br>
                <br>
                <a href="menuCustomer.php" class="btn btn-secondary">Back to Cart</a>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
