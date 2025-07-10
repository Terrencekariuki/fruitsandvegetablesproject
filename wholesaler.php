<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Wholesaler Inventory</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .status-msg {
      font-size: 0.9em;
      margin-left: 10px;
      color: limegreen;
      transition: opacity 0.5s ease;
    }
    input[type=number] {
      width: 60px;
    }
  </style>
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <img src="images/mango.jpeg" alt="Mango Logo" height="50">
      <span>FruVeg Website</span>
    </div>
    <a href="dashboard.html" class="btn">Home</a>
  </header>

  <main class="container">
    <h1>Wholesaler Inventory</h1>
    <p>Here you can view and update available product quantities.</p>

    <h2>Available Products</h2>

    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "fruitsandvegetables");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch products (make sure to include ID for updates)
    $result = $conn->query("SELECT id, product_id, product_name, product_quantity FROM products");

    if ($result->num_rows > 0) {
      echo "<table>
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['product_id']) . "</td>
                <td>" . htmlspecialchars($row['product_name']) . "</td>
                <td>
                  <input type='number' value='" . $row['product_quantity'] . "' min='0'
                         onchange='updateQuantity(" . $row['id'] . ", this)' />
                  <span class='status-msg' id='status-" . $row['id'] . "'></span>
                </td>
              </tr>";
      }
      echo "</tbody></table>";
    } else {
      echo "<p>No products found.</p>";
    }

    $conn->close();
    ?>
  </main>

  <script>
  function updateQuantity(id, inputElement) {
    const newQuantity = inputElement.value;
    const statusSpan = document.getElementById("status-" + id);

    fetch("update_quantity.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: "id=" + encodeURIComponent(id) + "&new_quantity=" + encodeURIComponent(newQuantity)
    })
    .then(response => response.text())
    .then(data => {
      if (data.trim() === "success") {
        statusSpan.textContent = "✔ Updated";
        statusSpan.style.color = "limegreen";
        setTimeout(() => {
          statusSpan.textContent = "";
        }, 2000);
      } else {
        statusSpan.textContent = "✖ Error";
        statusSpan.style.color = "red";
      }
    })
    .catch(err => {
      statusSpan.textContent = "✖ AJAX Error";
      statusSpan.style.color = "red";
    });
  }
  </script>
</body>
</html>
