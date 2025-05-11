<?php

// Include authentication
require("process/auth.php");

// Include database connection
require("../config/db.php");

// Include class Organization
require("classes/Organization.php");

// Include class Position
require("classes/Position.php");

// Include class Nominees
require("classes/Nominees.php");

// Fetch organizations for dropdown
$orgObj = new Organization();
$rtnReadOrg = $orgObj->READ_ORG();

// Initialize organization selection
$org = $_GET['organization'] ?? null;

if ($org) {
    $nomObj = new Nominees();
    $rtnReadNomOrgPos = $nomObj->READ_NOMINEES_BY_ORG($org);
    $rtnCountVotes = $nomObj->COUNT_VOTES($org);
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            animation: fadeInPage 1s ease;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.9) !important;
            padding: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }

        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            color: white;
            border: none;
        }

        .form-control, .form-select {
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-custom {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(255, 75, 75, 0.3);
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            box-shadow: 0 0 20px rgba(255, 75, 75, 0.5);
            transform: scale(1.05);
        }

        .table {
            color: white;
        }

        .table-dark th {
            background-color: #1e1e2f;
        }

        .footer {
            background: rgba(0, 0, 0, 0.9);
            text-align: center;
            padding: 15px;
            position: fixed;
            width: 100%;
            bottom: 0;
            font-size: 14px;
            color: white;
        }

        @keyframes fadeInPage {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>

<!-- Navigation -->
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
                <li class="nav-item"><a class="nav-link active" href="vote_result.php">Vote Result</a></li>
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

<!-- Page Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Organization Selector -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h4 class="text-center">Select Organization</h4>
                <hr class="bg-light">
                <form method="GET" action="">
                    <div class="mb-3">
                        <label for="organization" class="form-label">Organization</label>
                        <select name="organization" class="form-control" required>
                            <option value="">-- Select Organization --</option>
                            <?php while ($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                                <option value="<?php echo $rowOrg['org']; ?>" <?php if ($org === $rowOrg['org']) echo 'selected'; ?>>
                                    <?php echo $rowOrg['org']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-custom w-100">Submit</button>
                </form>
            </div>
        </div>

        <!-- Results Table -->
        <div class="col-md-8">
            <div class="card p-4">
                <h4 class="text-center">Voting Results</h4>
                <hr class="bg-light">
                <?php if ($org) { ?>
                <div class="d-flex justify-content-between align-items-center">
                    <h5><?php echo htmlspecialchars($org); ?> Result</h5>
                    <a href="./print_result.php?organization=<?php echo urlencode($org); ?>" target="_blank" class="btn btn-success btn-sm">Print Result</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            if ($rtnReadNomOrgPos && $rtnReadNomOrgPos->num_rows > 0) {
                                while ($row = $rtnReadNomOrgPos->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['votes']}</td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No results found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                    <div class="alert alert-warning">Please select an organization to view results.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    &copy; <?php echo date('Y'); ?> Sharnbasava University Voting System. All rights reserved.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
