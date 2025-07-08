<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Wholesaler Inventory</title>
  <link rel="stylesheet" href="style.css" />
</head>
 <header class="navbar">
    <div class="logo">
      <img src="images\mango.jpeg" alt="Mango Logo">
      <span>FruVeg website</span>
<div>
  <h1>Wholesaler Inventory</h1>
  <p> Here you can view all available products.</p>
   <a href="dashboard.html" class="btn">Home</a>
 
</div>
<body>
  <div class="container">
    <h1>Available Products</h1>

    <table>
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Quantity</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "fruitsandvegetables");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch products
        $result = $conn->query("SELECT product_id, product_name, product_quantity FROM products");

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['product_id']) . "</td>
                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                    <td>" . htmlspecialchars($row['product_quantity']) . "</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='3'>No products found.</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
