<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$idNumber = $_POST['idNumber'];
$password = $_POST['password'];
// Database connection
$conn = new mysqli('localhost', 'root', '', 'sign_up');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO sign_up (firstName, lastName, email, phoneNumber, idNumber, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phoneNumber, $idNumber, $password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>