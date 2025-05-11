<?php

// Include authentication
require("process/auth.php");

// Include database connection
require("../config/db.php");

// Include required classes
require("classes/Organization.php");
require("classes/Position.php");
require("classes/Nominees.php");

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Voting System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Poppins', sans-serif;
            animation: fadeInPage 1s ease;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.9) !important;
            padding: 15px;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
            color: white;
        }
        .form-control, .form-select {
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }
        .btn-custom {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0px 4px 12px rgba(255, 75, 75, 0.3);
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
        }
        .table {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead {
            background-color: rgba(0, 0, 0, 0.6);
        }
        .footer {
            background: rgba(0, 0, 0, 0.9);
            text-align: center;
            padding: 15px;
            position: fixed;
            width: 100%;
            bottom: 0;
            font-size: 14px;
        }
        @keyframes fadeInPage {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function getPos(val) {
            $.ajax({
                type: "POST",
                url: "get_pos.php",
                data: {org: val},
                success: function(data) {
                    $("#pos-list").html(data);
                }
            });
        }
    </script>
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
                <li class="nav-item"><a class="nav-link active" href="add_nominees.php">Add Nominees</a></li>
                <li class="nav-item"><a class="nav-link" href="add_voters.php">Add Voters</a></li>
                <li class="nav-item"><a class="nav-link" href="vote_result.php">Vote Result</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
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
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h4 class="text-center">Add Nominee</h4>
                <hr>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <?php
                    if(isset($_POST['submit'])) {
                        $org = trim($_POST['organization']);
                        $pos = trim($_POST['position']);
                        $name = trim($_POST['name']);
                        $course = trim($_POST['course']);
                        $year = trim($_POST['year']);
                        $stud_id = trim($_POST['stud_id']);

                        $insertNominee = new Nominees();
                        $rtnInsertNom = $insertNominee->INSERT_NOMINEE($org, $pos, $name, $course, $year, $stud_id);
                        echo "<script>Swal.fire('Success', 'Nominee added successfully!', 'success');</script>";
                    }

                    $readOrg = new Organization();
                    $rtnReadOrg = $readOrg->READ_ORG();
                    ?>
                    <div class="mb-3">
                        <label class="form-label">Organization</label>
                        <select required name="organization" class="form-select" onchange="getPos(this.value);">
                            <option value="">Select Organization</option>
                            <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                                <option value="<?php echo $rowOrg['org']; ?>"><?php echo $rowOrg['org']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <select required name="position" class="form-select" id="pos-list">
                            <option value="">Select Position</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input required type="text" name="name" class="form-control" placeholder="Last, First MI">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select required name="course" class="form-select">
                            <option value="">Select Course</option>
                            <option value="BCA">BCA</option>
                            <option value="BBA">BBA</option>
                            <option value="CSE">CSE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <select required name="year" class="form-select">
                            <option value="">Select Year</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Student ID</label>
                        <input required type="text" name="stud_id" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-custom w-100">Add Nominee</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <h4 class="text-center">List of Nominees</h4>
                <hr>
                <div class="table-responsive">
                    <?php
                    $readNominees = new Nominees();
                    $rtnReadNominees = $readNominees->READ_NOMINEE();
                    if($rtnReadNominees) {
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Organization</th>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Course/Year</th>
                                <th>Student ID</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($rowNom = $rtnReadNominees->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $rowNom['org']; ?></td>
                                <td><?php echo $rowNom['pos']; ?></td>
                                <td><?php echo $rowNom['name']; ?></td>
                                <td><?php echo $rowNom['course'] . " - " . $rowNom['year']; ?></td>
                                <td><?php echo $rowNom['stud_id']; ?></td>
                                <td><a href="edit_nominee.php?id=<?php echo $rowNom['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a></td>
                                <td><a href="delete_nominee.php?id=<?php echo $rowNom['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Sharnbasava University Voting System. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
