<?php
session_start();


$host = "localhost";
$dbname = "localserviceconnect";
$username = "root";
$password = "Chandu5@@";


$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

$sql = "SELECT * FROM serviceprovider WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        $_SESSION['provider_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: providerdashboard.php");
        exit();
    } else {
        echo "<script>alert('❌ Invalid password.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('❌ Email not registered.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
