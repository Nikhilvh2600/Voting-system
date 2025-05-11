<?php
require("process/auth.php");
require("../config/db.php");
require("classes/Voters.php");

$voter = new Voters();
$rtnReadVoters = $voter->READ_VOTERS();

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $course = trim($_POST['course']);
    $year = trim($_POST['year']);
    $stud_id = trim($_POST['stud_id']);

    $voter->INSERT_VOTER($name, $course, $year, $stud_id);

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire('Success!', 'Voter added successfully.', 'success');
        });
    </script>";
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator - Add Voters</title>
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
                <li class="nav-item"><a class="nav-link" href="add_org.php">Add Organization</a></li>
                <li class="nav-item"><a class="nav-link" href="add_pos.php">Add Position</a></li>
                <li class="nav-item"><a class="nav-link" href="add_nominees.php">Add Nominees</a></li>
                <li class="nav-item"><a class="nav-link active" href="add_voters.php">Add Voters</a></li>
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
        <!-- Add Voter Form -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h4 class="text-center mb-3">Add Voter</h4>
                <hr class="bg-light">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input required type="text" name="name" class="form-control" placeholder="Last, First MI.">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select required name="course" class="form-select">
                            <option value="">-- Select Course --</option>
                            <option value="BCA">BCA</option>
                            <option value="BBA">BBA</option>
                            <option value="EEE">EEE</option>
                            <option value="BSC">BSC</option>
                            <option value="BCOM">BCOM</option>
                            <option value="CSE">CSE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <select required name="year" class="form-select">
                            <option value="">-- Select Year --</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Student ID</label>
                        <input required type="text" name="stud_id" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-custom w-100">Submit</button>
                </form>
            </div>
        </div>

        <!-- Voter List -->
        <div class="col-md-8">
            <div class="card p-4">
                <h4 class="text-center mb-3">List of Voters</h4>
                <hr class="bg-light">
                <input type="text" id="search" class="form-control mb-3" placeholder="Search Voters...">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Name</th>
                                <th>Course/Year</th>
                                <th>Student ID</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="voterTable" class="text-center">
                            <?php if ($rtnReadVoters) { while ($rowVoter = $rtnReadVoters->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $rowVoter['name']; ?></td>
                                <td><?php echo $rowVoter['course'] . " - " . $rowVoter['year']; ?></td>
                                <td><?php echo $rowVoter['stud_id']; ?></td>
                                <td><a href="edit_voter.php?id=<?php echo $rowVoter['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
                                <td><button class="btn btn-sm btn-danger deleteBtn" data-id="<?php echo $rowVoter['id']; ?>"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Sharnbasava University Voting System. All rights reserved.</p>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Search filter
    $(document).ready(function(){
        $('#search').on('keyup', function(){
            var value = $(this).val().toLowerCase();
            $('#voterTable tr').filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Delete confirmation
        $('.deleteBtn').click(function(){
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "delete_voter.php?id=" + id;
                }
            });
        });
    });
</script>

</body>
</html>
