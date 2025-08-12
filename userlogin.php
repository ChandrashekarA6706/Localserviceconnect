<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "Chandu5@@"; 
$database = "localserviceconnect"; // Fixed typo from your code

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$pass = $_POST['password'];


$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Verify the hashed password
    if (password_verify($pass, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];             
        $_SESSION['username'] = $row['username'];       
        header("Location: index.php");
        exit();
    }
}


echo "<script>alert('Invalid email or password'); window.location.href='userlogin.html';</script>";

$conn->close();
?>
