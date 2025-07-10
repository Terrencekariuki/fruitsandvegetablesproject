<?php
// update_quantity.php
$conn = new mysqli("localhost", "root", "", "fruitsandvegetables");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if required POST data exists
if (isset($_POST['id']) && isset($_POST['new_quantity'])) {
    $id = $_POST['id'];
    $new_quantity = $_POST['new_quantity'];

    $stmt = $conn->prepare("UPDATE products SET product_quantity = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_quantity, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "missing";
}
?>
