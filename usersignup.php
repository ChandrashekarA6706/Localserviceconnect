<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];  // new line to capture username
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
    $city = $_POST['city'];
    $contact = $_POST['contact'];

   
    $conn = new mysqli("localhost", "root", "Chandu5@@", "localserviceconnect");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, city, contact) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $password, $city, $contact);

    if ($stmt->execute()) {
        echo "Signup successful! <a href='userlogin.html'>Login now</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
