<?php
session_start();

// Redirect to login if provider is not logged in
if (!isset($_SESSION['provider_id'])) {
    header("Location: providerlogin.html");
    exit();
}

$provider_id = $_SESSION['provider_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "Chandu5@@"; 
$database = "localserviceconnect";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch service requests
$sql = "SELECT r.service_type, r.city, r.request_time, r.status, 
               u.username AS user_name, u.contact AS user_contact
        FROM requests r
        JOIN users u ON r.user_id = u.id
        WHERE r.provider_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Service Requests</title>
  <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="Library/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    #title {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 15px;
        color: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        background-image: url(https://img.freepik.com/free-photo/vintage-grunge-blue-concrete-texture-studio-wall-background-with-vignette_1258-28374.jpg?t=st=1742910997~exp=1742914597~hmac=eeb38009b85f7b8f272170c862adb3d01c8b3d6f6ccb0aafe950c5089c493672&w=1380);
        animation: slideIn 1s ease-in-out;
    }

    #title-img {
        height: 80px;
        width: 80px;
        border-radius: 50%;
        border: 1px solid white;
        margin-right: 15px;
    }

    #title h1 {
        flex-grow: 1; 
        text-align: center;
    }

    footer {
        background: #1c1c1c;
        color: white;
        text-align: center;
        padding: 15px;
        width: 100%;
        margin-top: 40px;
        border-radius: 10px;
    }

    #footer a {
        text-decoration: none;
        color: dimgray;
    }

    #footer a:hover {
        color: blue;
    }

    .card {
        margin: 20px auto;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .card-header {
        font-weight: bold;
        background-color: #007bff;
        color: white;
    }

    @media (max-width: 768px) {
        #title {
            flex-direction: column;
            text-align: center;
        }
    }
  </style>
</head>
<body>
  <div class="container-fluid mt-3">
    <div id="title" class="shadow">
      <div><img src="images/logo.jpg" alt="" id="title-img"></div>
      <h1>LOCAL SERVICE CONNECT</h1>
    </div>

    <div class="container mt-4">
      <h2 class="text-center">📬 Your Service Requests</h2>

      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="card">
            <div class="card-header">
              Service: <?= htmlspecialchars($row['service_type']) ?> | <?= htmlspecialchars($row['status']) ?>
            </div>
            <div class="card-body">
              <p><strong>User Name:</strong> <?= htmlspecialchars($row['user_name']) ?></p>
              <p><strong>Contact:</strong> <?= htmlspecialchars($row['user_contact']) ?></p>
              <p><strong>City:</strong> <?= htmlspecialchars($row['city']) ?></p>
              <p><strong>Requested At:</strong> <?= htmlspecialchars($row['request_time']) ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center mt-4">No service requests available.</p>
      <?php endif; ?>
    </div>

    <footer id="footer">
      <p>Copyrights © 2025 Local Service Connect. All rights reserved.</p>
      <p>📞<a href="tel:+919676056192">+91 9676056192</a></p>
    </footer>
  </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
