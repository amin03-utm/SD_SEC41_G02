<!DOCTYPE html>
<html>
<head>
    <title>Menu View</title>
    <style>
        /* Add your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-delete {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Order Dashboard (Admin)</h1>

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

        // Retrieve the user's email from the URL parameter
        $user_email = $_GET["user_email"];

        // Fetch menu items for the selected user from the database
        $sql = "SELECT * FROM cart_items WHERE user_email = '$user_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Item Name</th><th>Item Price</th><th>Action</th></tr>";
            $totalPrice = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["item_name"] . "</td>";
                echo "<td>" . $row["item_price"] . "</td>";
                echo '<td>
                        <form action="deleteMenuItem.php" method="POST">
                            <input type="hidden" name="item_id" value="' . $row["item_id"] . '">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                      </td>';
                echo "</tr>";
                $totalPrice += $row["item_price"];
            }
            echo "</table>";

            // Format the total price with two decimal places
            $formattedTotalPrice = number_format($totalPrice, 2);
            echo "<p>Total Price: $formattedTotalPrice</p>";
        } else {
            echo "<p>This user's cart is empty.</p>";
        }

        // Close the database connection
        $conn->close();
    } else {
        // Handle unauthenticated access (e.g., redirect to a login page)
        echo "Please log in to view this menu.";
    }
    ?>

    <a href="../admin/indexAdmin.php">Back to Admin Dashboard</a>
</body>
</html>
