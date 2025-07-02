<?php
// Debug: see if form is submitting
// print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = trim($_POST['customerName']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $itemQuantity = trim($_POST['itemQuantity']);
    $wholesaler = trim($_POST['wholesaler']);
    $payment = trim($_POST['payment']);

    // Validate inputs
    if ($customerName && $phoneNumber && $itemQuantity && $wholesaler && $payment) {
        $conn = new mysqli("localhost", "root", "", "fruitsandvegetables");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO orders (customerName, phoneNumber, itemQuantity, wholesaler, paymentMethod) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssss", $customerName, $phoneNumber, $itemQuantity, $wholesaler, $payment);

        if ($stmt->execute()) {
            echo "<h2>Order Received Successfully!</h2>";
            echo "<p><strong>Name:</strong> $customerName</p>";
            echo "<p><strong>Phone:</strong> $phoneNumber</p>";
            echo "<p><strong>Item & Quantity:</strong> $itemQuantity</p>";
            echo "<p><strong>Wholesaler:</strong> $wholesaler</p>";
            echo "<p><strong>Payment:</strong> $payment</p>";
            echo '<a href="order.html">Back to Order Page</a>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
