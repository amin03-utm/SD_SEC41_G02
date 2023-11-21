<!DOCTYPE html>
<html>
<head>
    <title>Menu View (Admin)</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom styles here (if needed) */
        .delete-button {
            background-color: #ff0000;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        /* Add a gradient background */
        body {
            background: pink;
        }

        /* Style for the card container */
        .card-container {
            margin-top: 20px;
            padding: 20px;
        }

        /* Style for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
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

        .btn-delete:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container card-container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Order Dashboard (Admin)</h1>

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

                    if (isset($_POST["delete_item"])) {
                        // Handle item deletion
                        $item_id = $_POST["item_id"];
                        $deleteQuery = "DELETE FROM cart_items WHERE user_email = '$user_email' AND id = $item_id";
                        $conn->query($deleteQuery);
                    }

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
                                    <form action="menuViewAdmin.php?user_email=' . $user_email . '" method="post">
                                        <input type="hidden" name="item_id" value="' . $row["id"] . '">
                                        <button type="submit" name="delete_item" class="btn-delete">Delete</button>
                                    </form>
                                </td>';
                            echo "</tr>";
                            $totalPrice += $row["item_price"];
                        }
                        echo "</table>";

                        // Format the total price with two decimal places
                        $formattedTotalPrice = number_format($totalPrice, 2);
                        echo "<p>Total Price: $formattedTotalPrice</p>";
                        echo '<a href="../admin/indexAdmin.php" class="btn btn-primary">Back to Admin Dashboard</a>';


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
            </div>
        </div>
    </div>

    
</body>
</html>
