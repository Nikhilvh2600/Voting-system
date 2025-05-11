<?php

// Include authentication
require("process/auth.php");

// Include database connection
require("../config/db.php");

// Include class Organization
require("classes/Organization.php");

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator - Add Organization</title>
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
            padding: 12px 30px;
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
                <li class="nav-item"><a class="nav-link active" href="add_org.php">Add Organization</a></li>
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
<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Add Organization Form -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h4 class="text-center mb-3">Add Organization</h4>
                <hr class="bg-light">
                <?php
                if (isset($_POST['submit'])) {
                    $organization = trim($_POST['organization']);
                    $insertOrg = new Organization();
                    $rtnInsertOrg = $insertOrg->INSERT_ORG($organization);
                    echo "<script>Swal.fire('Success!', 'Organization Added!', 'success');</script>";
                }
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="mb-3">
                        <label for="organization" class="form-label">Organization Name</label>
                        <input required type="text" name="organization" class="form-control" placeholder="Enter organization name">
                    </div>
                    <button type="submit" name="submit" class="btn btn-custom w-100">Submit</button>
                </form>
            </div>
        </div>

        <!-- List of Organizations -->
        <div class="col-md-8">
            <div class="card p-4">
                <h4 class="text-center mb-3">List of Organizations</h4>
                <hr class="bg-light">
                <div class="table-responsive">
                    <?php
                    $readOrg = new Organization();
                    $rtnReadOrg = $readOrg->READ_ORG();
                    if ($rtnReadOrg) {
                    ?>
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Organization</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php while ($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $rowOrg['org']; ?></td>
                                <td>
                                    <a href="edit_org.php?id=<?php echo $rowOrg['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="delete_org.php?id=<?php echo $rowOrg['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php $rtnReadOrg->free(); ?>
                    <?php } else { echo "<p class='text-center'>No organizations found.</p>"; } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    &copy; <?php echo date('Y'); ?> Sharnbasava University Voting System. All rights reserved.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
<?php
// Close database connection
$db->close();
?>
