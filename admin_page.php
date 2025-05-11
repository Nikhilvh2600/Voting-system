<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #0f2027, #203a43, #2c5364);
    color: white;
    min-height: 100vh;
    overflow-x: hidden;
    animation: fadeInPage 1s ease;
}

.navbar {
    background: rgba(0, 0, 0, 0.95) !important;
    padding: 15px;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
}

.navbar-brand {
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 22px;
}

.navbar-nav .nav-link {
    color: #ddd;
    font-weight: 500;
    transition: 0.3s;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link:focus {
    color: #17a2b8;
    transform: scale(1.05);
}

.jumbotron {
    position: relative;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50px;
    padding: 60px 40px;
    text-align: center;
    margin-top: 80px;
    box-shadow: 0 0 25px rgba(0, 255, 255, 0.2);
    animation: boxGlow 6s linear infinite;
    transition: all 0.4s ease;
    border: 3px solid transparent; /* Keep for slight outline */
}


.jumbotron h1,
.jumbotron h2 {
    font-weight: 600;
    animation: slideUp 1.2s ease;
    letter-spacing: 1px;
    text-shadow: 2px 2px 10px rgba(0, 255, 255, 0.2);
}

.btn-custom {
    background: linear-gradient(135deg, #17a2b8, #00c9ff);
    color: white;
    border-radius: 50px; /* <-- Updated */
    padding: 12px 35px;
    font-weight: bold;
    transition: 0.3s ease-in-out;
    font-size: 20px;
    border: none;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
}


.btn-custom:hover {
    background: linear-gradient(135deg, #00c9ff, #17a2b8);
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(0, 255, 255, 0.6);
}

.footer {
    background: rgba(0, 0, 0, 0.95);
    text-align: center;
    padding: 15px;
    position: fixed;
    width: 100%;
    bottom: 0;
    font-size: 14px;
    color: #aaa;
    letter-spacing: 0.5px;
}

@keyframes fadeInPage {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    0% { transform: translateY(40px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

@keyframes boxGlow {
    0% {
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
    }
    50% {
        box-shadow: 0 0 35px rgba(255, 75, 75, 0.5);
    }
    100% {
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
    }
}

.image-container{
            position: relative;
            left: -15%;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="admin_page.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="add_org.php">Add Organization</a></li>
                <li class="nav-item"><a class="nav-link" href="add_pos.php">Add Position</a></li>
                <li class="nav-item"><a class="nav-link" href="add_nominees.php">Add Nominees</a></li>
                <li class="nav-item"><a class="nav-link" href="add_voters.php">Add Voters</a></li>
                <li class="nav-item"><a class="nav-link" href="vote_result.php">Vote Result</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Profile
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="process/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
        <div class="image-container">
                <img src="data:image/jpeg;base64,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" alt="img" width="1180" height="170">
            </div>
            <div class="jumbotron">
                <h1>✨ SHARNBASAVA UNIVERSITY</h1>
                <h2>VOTING SYSTEM</h2>
                <br>
                <button class="btn btn-custom">+</button>
            </div>
            </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2025 Sharnbasava University Voting System. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>