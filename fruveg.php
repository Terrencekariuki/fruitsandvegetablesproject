<?php
// Database connection settings
$host = "localhost";
$username = "root"; // change if needed
$password = "";     // change if needed
$database = "fruitsandvegetables"; // change if needed

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$product_ids = $_POST['product_id'];
$product_names = $_POST['product_name'];
$product_quantities = $_POST['product_quantity'];

// Insert each product into the database
for ($i = 0; $i < count($product_ids); $i++) {
  $id = $conn->real_escape_string($product_ids[$i]);
  $name = $conn->real_escape_string($product_names[$i]);
  $quantity = (int)$product_quantities[$i];

  $sql = "INSERT INTO products (product_id, product_name, product_quantity)
          VALUES ('$id', '$name', $quantity)";

  if (!$conn->query($sql)) {
    echo "Error: " . $conn->error;
    exit;
  }
}

$conn->close();

// Redirect to wholesaler.html
header("Location: wholesaler.php");
exit;
?>
