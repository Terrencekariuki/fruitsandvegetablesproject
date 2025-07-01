<?php
print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $idNumber = trim($_POST['idNumber'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    if ($firstName && $lastName && $phoneNumber && $email && $idNumber && $password && $role) {
        $conn = new mysqli("localhost", "root", "", "fruitsandvegetables");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add role to DB insert
        $stmt = $conn->prepare("INSERT INTO sign_up (firstName, lastName, phoneNumber, email, idNumber, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssssss", $firstName, $lastName, $phoneNumber, $email, $idNumber, $hashedPassword, $role);

        if ($stmt->execute()) {
            // Redirect based on role
            if ($role === "Wholesaler") {
                header("Location: wholesaler.html");
            } elseif ($role === "Customer") {
                header("Location: order.html");
            } else {
                echo "Invalid role selected.";
            }
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill in all required fields.";
    }
} else {
    echo "Invalid request.";
}
?>
