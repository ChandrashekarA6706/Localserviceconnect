<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Retrieve username from form
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $city = $_POST['city'];
    $service = $_POST['service'];
    $contact = $_POST['contact'];

    $conn = new mysqli("localhost", "root", "Chandu5@@", "localserviceconnect");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Updated query to include username
    $stmt = $conn->prepare("INSERT INTO serviceprovider (username, email, password, city, service, contact) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $email, $password, $city, $service, $contact);

    if ($stmt->execute()) {
        echo "Signup successful! <a href='providerlogin.html'>Login now</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>