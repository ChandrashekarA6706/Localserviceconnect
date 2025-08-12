<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Local Service Connect</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #e3f2fd;
            font-family: 'Poppins', sans-serif;
        }
        #title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            flex-wrap: wrap;
            background-image: url(https://img.freepik.com/free-photo/vintage-grunge-blue-concrete-texture-studio-wall-background-with-vignette_1258-28374.jpg);
        }
        #title-img {
            height: 80px;
            width: 80px;
            border-radius: 50%;
            border: 1px solid white;
        }
        #search-bar {
            display: flex;
            flex-grow: 1;
            max-width: 400px;
            margin: 10px;
        }
        #search-bar input {
            border-radius: 25px;
            padding: 10px;
            flex-grow: 1;
            border: none;
        }
        #search-bar button {
            border-radius: 50%;
            background: white;
            border: none;
            padding: 8px 12px;
            margin-left: 5px;
        }
        #search-bar button i {
            color: #007aff;
        }
        .navbar {
            border-radius: 5px;
            margin-top: 5px;
            position: relative;
        }
        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }
        .service {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            text-align: center;
        }
        .service:hover {
            transform: scale(1.1);
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2);
        }
        .service img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .service:hover img {
            transform: scale(1.05);
        }
        footer {
            background: #1c1c1c;
            color: white;
            text-align: center;
            padding: 15px;
            width: 100%;
            margin-top: 20px;
            border-radius: 10px;
        }
        #footer a {
            text-decoration: none;
            color: dimgray;
        }
        #footer a:hover {
            color: blue;
            text-decoration: none;
        }
        h3 a {
            text-decoration: none;
        }
        @media (max-width: 768px) {
            #title {
                flex-direction: column;
                text-align: center;
            }
            #search-bar {
                width: 100%;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-3">
        <div id="title" class="shadow">
            <div><img src="images/logo.jpg" alt="Logo" id="title-img" /></div>
            <h1>LOCAL SERVICE CONNECT</h1>
            <div id="search-bar">
                <input type="text" class="form-control" placeholder="Search for any services..." />
                <button type="button"><i class="fa fa-search"></i></button>
            </div>
        </div>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark rounded mt-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="#title">Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="demo.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#footer">about us</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['username'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="userlogout.php">
                                    Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="demo.html#login-section">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="service-grid" id="services">
            <div class="service">
                <a href="electrician.html"><img src="images/Electrician.jpg" alt="electrician" /></a>
                <h3><a href="electrician.html">ELECTRICIAN</a></h3>
            </div>
            <div class="service">
                <a href="plumber.html"><img src="images/plumder.jpg" alt="plumber" /></a>
                <h3><a href="plumber.html">PLUMBER</a></h3>
            </div>
            <div class="service">
                <a href="gardening.html"><img src="images/gardening.jpg" alt="gardening" /></a>
                <h3><a href="gardening.html" style="text-decoration: none;">GARDENING</a></h3>
            </div>
            <div class="service">
                <a href="housecleaning.html"><img src="images/cleaning.jpg" alt="cleaning" /></a>
                <h3><a href="housecleaning.html" style="text-decoration: none;">HOUSECLEANING</a></h3>
            </div>
            <div class="service">
                <a href="painting.html"><img src="images/Painter.jpg" alt="painting" /></a>
                <h3><a href="painting.html" style="text-decoration: none;">PAINTING</a></h3>
            </div>
            <div class="service">
                <a href="carpentry.html"><img src="images/carpenter-works-with-tree.jpg" alt="carpentry" /></a>
                <h3><a href="carpentry.html">CARPENTRY</a></h3>
            </div>
            <div class="service">
                <a href="construction.html"><img src="images/construction.jpg" alt="construction" /></a>
                <h3><a href="construction.html">CONSTRUCTION</a></h3>
            </div>
            <div class="service">
                <a href="interiordesign.html"><img src="images/interiordesigning.jpg" alt="interior designing" /></a>
                <h3><a href="interiordesign.html">INTERIOR DESIGNING</a></h3>
            </div>
        </div>

        <footer id="footer" class="mt-4 p-3 bg-dark text-white rounded">
            <p>Copyright &copy; 2025 Local service connect. All rights reserved.</p>
            <p>📧
                <a href="mailto:bhargavareddyguda8848@gmail.com" class="text-white">
                    bhargavareddyguda8848@gmail.com
                </a>
            </p>
            <p>📞
                <a href="tel:+919676056192" class="text-white">+919676056192</a>
            </p>
        </footer>
    </div>
</body>
</html>
