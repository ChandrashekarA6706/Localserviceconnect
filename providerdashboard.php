<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['provider_id'])) {
    header("Location: providerlogin.html");
    exit();
}

$provider_id = $_SESSION['provider_id'];

// Fetch provider's name and service
$servername = "localhost";
$username = "root";
$password = "Chandu5@@";
$database = "localserviceconnect";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, service FROM serviceprovider WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$provider_username = $row['username'];
$provider_service = $row['service'];

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Provider Dashboard</title>
  <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <script src="Library/bootstrap.bundle.min.js"></script>
  <style>
    #title {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 15px;
        color: white;
        border-radius: 10px;
        background-image: url('https://img.freepik.com/free-photo/vintage-grunge-blue-concrete-texture-studio-wall-background-with-vignette_1258-28374.jpg');
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
        border-radius: 10px;
        margin-top: 40px;
    }

    .sidebar {
        height: 100vh;
        background-color: #f8f9fa;
        padding: 20px;
        border-right: 1px solid #ddd;
    }

    .sidebar a {
        display: block;
        padding: 10px;
        margin: 10px 0;
        color: #333;
        text-decoration: none;
    }

    .sidebar a:hover {
        background-color: #007bff;
        color: white;
        border-radius: 5px;
    }

    .content {
        padding: 20px;
    }

    .profile-card {
        display: flex;
        align-items: center;
        background: #f1f1f1;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .profile-card img {
        height: 100px;
        width: 100px;
        border-radius: 50%;
        margin-right: 20px;
    }

    .profile-info h4 {
        margin-bottom: 5px;
    }

    @media (max-width: 768px) {
        #title {
            flex-direction: column;
            text-align: center;
        }
        .profile-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .profile-card img {
            margin-bottom: 10px;
        }
    }
  </style>
</head>
<body>
  <div class="container-fluid mt-3">
    
    <div id="title">
      <img src="images/logo.jpg" alt="Logo" id="title-img" />
      <h1>LOCAL SERVICE CONNECT</h1>
    </div>

    <div class="row mt-4">
      
      <div class="col-md-3 sidebar">
        <hr />
        <a href="providerdashboard.php">🏠 Dashboard</a>
        <a href="servicerequests.php">📬 Requests</a>
        <a href="providerlogout.php">🚪 Logout</a>
      </div>

      
      <div class="col-md-9 content">
        
        <div class="profile-card mb-4">
          
          <div class="profile-info">
            <h4>👤 <?= htmlspecialchars($provider_username) ?></h4>
            <p>🛠️ Service: <?= htmlspecialchars($provider_service) ?></p>
          </div>
        </div>

        
        <h2>📋 Dashboard Overview</h2>
        <p>This is your main dashboard. Use the navigation on the left to check requests, update your profile, and manage services.</p>
      </div>
    </div>

    
    <footer id="footer">
      <p>Copyrights © 2025 Local Service Connect. All rights reserved.</p>
      <p>📞 <a href="tel:+919676056192">+91 9676056192</a></p>
    </footer>
  </div>
</body>
</html>
