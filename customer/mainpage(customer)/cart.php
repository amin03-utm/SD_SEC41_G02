<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to bottom right, #faa5a5, #FAFCFF);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .Cart-Container {
      width: 70%;
      height: 85%;
      background-color: #ffffff;
      border-radius: 20px;
      box-shadow: 0px 25px 40px #1687d933;
      padding: 20px;
      position: relative;
    }
    .quantity-input {
      width: 60px;
      height: 40px;
    }
    .shop-logo {
      position: absolute;
      top: 20px;
      left: 20px;
      width: 300px;
      height: 60px;
    }
    .center-buttons {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <img src="images/logo.png" alt="Shop Logo" class="shop-logo">
  <div class="Cart-Container p-4">
    <h1 class="mb-4">Your Cart</h1>
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th>Product</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Replace with your database connection code
          $dbHost = 'localhost';
          $dbName = 'db_sd_41_02';
          $dbUser = 'sd41';
          $dbPass = 'sd41project';

          try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch food items from the database
            $stmt = $pdo->query('SELECT * FROM menu_items');
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo '<tr>';
              echo '<td>' . $row['name'] . '</td>';
              echo '<td>$' . number_format($row['price'], 2) . '</td>';
              echo '<td><input type="number" class="quantity-input form-control" value="1" min="1"></td>';
              echo '<td>$' . number_format($row['price'], 2) . '</td>';
              echo '</tr>';
            }
          } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
          }
        ?>
      </tbody>
    </table>
    <div class="center-buttons">
      <a href="../newMenu/menu.php">Continue Shopping</a>
      <a> Or </a>
      <button class="btn btn-primary checkout-button">Checkout</button>
    </div>
  </div>
  <script>
    const quantityInputs = document.querySelectorAll(".quantity-input");
    quantityInputs.forEach((input) => {
      input.addEventListener("change", updateTotal);
    });

    function updateTotal() {
      const row = this.parentNode.parentNode;
      const priceCell = row.querySelector("td:nth-child(2)");
      const totalCell = row.querySelector("td:nth-child(4)");
      const quantity = this.value;
      const price = parseFloat(priceCell.textContent.replace("$", ""));
      totalCell.textContent = "$" + (quantity * price).toFixed(2);
    }
  </script>
</body>
</html>
