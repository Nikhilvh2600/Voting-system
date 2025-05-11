<?php
// Include authentication
require("process/auth.php");

// Include database connection
require("config/db.php");

// Include class Voting
require("classes/Voting.php");

$readOrganization = new Voting();
$rtnReadOrg = $readOrganization->READ_ORG();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System - Select Organization</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Orbitron', sans-serif;
            background: url('assets/images/background.jpg') no-repeat center center/cover;
            min-height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.9);
        }

        .container-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 100px;
            padding-bottom: 40px;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
        }

        .card h3 {
            color: #00f7ff;
        }

        .form-label {
            color: #f8f9fa;
            text-align: left;
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            background-color: transparent;
            border: 1px solid #00f7ff;
            color: #fff;
        }

        .form-control option {
            color: black;
        }

        .form-control:focus {
            background-color: transparent;
            color: #fff;
            border-color: #0dcaf0;
            box-shadow: 0 0 10px #0dcaf0;
        }

        .btn-custom {
            background: linear-gradient(45deg, #0dcaf0, #00f7ff);
            border: none;
            color: #000;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 0 10px #0dcaf0;
        }

        .btn-custom:hover {
            background: linear-gradient(45deg, #00f7ff, #0dcaf0);
            box-shadow: 0 0 20px #00f7ff;
            transform: scale(1.03);
        }

        footer {
            background-color: rgba(0, 0, 0, 0.9);
        }

        .dropdown-menu {
            background-color: #222;
        }

        .dropdown-item {
            color: #fff;
        }

        .dropdown-item:hover {
            background-color: #444;
        }

        .glow-text {
            text-shadow: 0 0 5px #0dcaf0, 0 0 10px #0dcaf0;
        }
    </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="stud_page.php"><i class="bi bi-house"></i> Voting System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="stud_page.php"><i class="bi bi-house"></i> Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?php echo $_SESSION['NAME']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="process/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Section -->
<div class="container-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <h3 class="mb-3 glow-text">Select Organization</h3>
                    <h5 class="mb-4">Welcome, <?php echo $_SESSION['NAME']; ?>!</h5>
                    <hr class="text-light">
                    <?php if($rtnReadOrg) { ?>
                    <form action="voting_page.php" method="GET">
                        <div class="mb-3 text-start">
                            <label for="organization" class="form-label">Organization</label>
                            <select required class="form-control" name="organization">
                                <option value="">***** Select Organization *****</option>
                                <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                                <option value="<?php echo $rowOrg['org']; ?>"><?php echo $rowOrg['org']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-custom w-100 mt-3">Submit</button>
                    </form>
                    <?php $rtnReadOrg->free(); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center text-light py-3 mt-auto">
    <div class="container">
        <p>&copy; 2025 Voting System | All Rights Reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
