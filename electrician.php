<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "Chandu5@@";
$database = "localserviceconnect";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['provider_id'], $_POST['city'])) {
    $user_id = $_SESSION['user_id'];
    $provider_id = intval($_POST['provider_id']);
    $city = $conn->real_escape_string($_POST['city']);
    $service_type = 'electrician';

    $sql_insert = "INSERT INTO requests (user_id, provider_id, service_type, city, status) VALUES (?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("iiss", $user_id, $provider_id, $service_type, $city);

    if ($stmt->execute()) {
        $message = "Service booked successfully!";
    } else {
        $message = "Failed to book service: " . $stmt->error;
    }
    $stmt->close();
}

$city = isset($_GET['city']) ? $conn->real_escape_string($_GET['city']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Electrician Services in <?php echo htmlspecialchars(ucfirst($city)); ?></title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
</head>
<body>
<div class="container mt-4">
    <h2>Electrician Services in <?php echo htmlspecialchars(ucfirst($city)); ?></h2>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if ($city): ?>
        <?php
        $sql = "SELECT id, username, contact, city 
                FROM serviceprovider 
                WHERE city = ? AND service = 'Electrician'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $city);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="list-group">';
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5><?php echo htmlspecialchars($row['username']); ?></h5>
                        <p>Contact: <?php echo htmlspecialchars($row['contact']); ?></p>
                        <p>City: <?php echo htmlspecialchars(ucfirst($row['city'])); ?></p>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="provider_id" value="<?php echo $row['id']; ?>" />
                        <input type="hidden" name="city" value="<?php echo htmlspecialchars($city); ?>" />
                        <button type="submit" class="btn btn-primary">Book Service</button>
                    </form>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo "<p>No electrician service providers found in " . htmlspecialchars(ucfirst($city)) . ".</p>";
        }
        $stmt->close();
        ?>
    <?php else: ?>
        <p>Please select a city from the <a href="electrician.html">search page</a>.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php $conn->close(); ?>
