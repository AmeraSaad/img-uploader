<?php
require './db/migration.php'; 

$email = 'user@example.com';
$first = 'Amira';
$last = 'Abdelaziz';
$password = password_hash('amera123', PASSWORD_DEFAULT); 

$sql = "INSERT INTO users (email, first, last, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $first, $last, $password);

if ($stmt->execute()) {
  echo "New user inserted!";
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>