<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pay-button {
            background-color: #008CBA;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Checkout</h1>

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
            echo "<table>";
            echo "<tr><th>Item Name</th><th>Item Price</th></tr>";
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
            echo "<a href='https://buy.stripe.com/test_3cs8yP6XHeQm1na4gn'><button class='pay-button'>Pay</button></a>";
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
    <a href="menuCustomer.php">Back to Cart</a>
</body>
</html>
