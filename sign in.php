<?php
$idNumber = $_POST['idNumber'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Connect to database
$conn = new mysqli('localhost', 'root', '', 'sign_up');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to check if credentials match
$sql = "SELECT * FROM sign_up WHERE idNumber=? AND email=? AND password=? AND role=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $idNumber, $email, $password, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Success
    echo "<script>alert('Login successful! Redirecting...'); window.location.href='order.html';</script>";
} else {
    echo "<script>alert('Invalid credentials. Please try again.'); window.location.href='signin.html';</script>";
}

$stmt->close();
$conn->close();
?>
