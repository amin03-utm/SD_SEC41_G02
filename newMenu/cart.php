<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
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

        .delete-button {
            background-color: #ff0000;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Your Shopping Cart</h1>

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

        if (isset($_POST["delete_item"])) {
            // Handle item deletion
            $item_id = $_POST["item_id"];
            $deleteQuery = "DELETE FROM cart_items WHERE user_email = '$user_email' AND id = $item_id";
            $conn->query($deleteQuery);
        }

        // Fetch cart items from the database
        $sql = "SELECT * FROM cart_items WHERE user_email = '$user_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Item Name</th><th>Item Price</th><th>Actions</th></tr>";
            $totalPrice = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["item_name"] . "</td>";
                echo "<td>" . $row["item_price"] . "</td>";
                echo "<td><form action='cart.php' method='post'><input type='hidden' name='item_id' value='" . $row['id'] . "'><input type='submit' name='delete_item' value='Delete' class='delete-button'></form></td>";
                echo "</tr>";
                $totalPrice += $row["item_price"];
            }
            echo "</table>";

            // Format the total price with two decimal places
            $formattedTotalPrice = number_format($totalPrice, 2);
            echo "<p>Total Price: $formattedTotalPrice</p>";
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

    <a href="menuCustomer.php">Back to Menu</a>
</body>
</html>
