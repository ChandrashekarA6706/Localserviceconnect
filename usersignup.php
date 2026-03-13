<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
    $city = $_POST['city'];
    $contact = $_POST['contact'];

    $conn = new mysqli("localhost", "root", "chandu5@@", "localserviceconnect");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (email, password, city, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $password, $city, $contact);

    if ($stmt->execute()) {
        echo "Signup successful! <a href='userlogin.html'>Login now</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
