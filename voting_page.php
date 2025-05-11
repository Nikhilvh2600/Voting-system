<?php
//Include authentication
require("process/auth.php");

//Include database connection
require("config/db.php");

//Include class Voting
require("classes/Voting.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style_voter.css">
    <style>
        body {
            background: url('assets/images/voting-bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .voting-con {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
        .btn-info {
            background: linear-gradient(45deg, #007bff, #6610f2);
            border: none;
        }
        .btn-info:hover {
            background: linear-gradient(45deg, #6610f2, #007bff);
        }
    </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="stud_page.php"><span class="glyphicon glyphicon-home"></span> Voting System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="stud_page.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span> Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="process/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Header -->

<?php
if(isset($_GET['organization'])) {
    $org = $_GET['organization'];
}
$readPos = new Voting();
$rtnReadPos = $readPos->READ_POSITION($org);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <?php if($rtnReadPos) { ?>
        <div class="col-md-6">
            <div class="voting-con">
                <h4 class="text-center">Voting for <?php echo $org; ?></h4><hr />
                <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
                    <p class="font-weight-bold">Position: <?php echo $rowPos['pos']; ?></p>
                    <?php
                    $readNominee = new Voting();
                    $rtnReadNominee = $readNominee->READ_NOMINEES($org, $rowPos['pos']);
                    ?>
                    <?php if($rtnReadNominee) { ?>
                        <div class="form-group">
                            <select name="nominee" class="form-control" required>
                                <option value="">-- Select Nominee --</option>
                                <?php while($rowNominee = $rtnReadNominee->fetch_assoc()) { ?>
                                <option value="<?php echo $rowNominee['id']; ?>"><?php echo $rowNominee['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="org" value="<?php echo $org; ?>">
                    <input type="hidden" name="pos" value="<?php echo $rowPos['pos']; ?>">
                    <input type="hidden" name="voter_id" value="<?php echo $_SESSION['ID']; ?>">
                    <?php
                    $validateVote = new Voting();
                    $rtnValVote = $validateVote->VALIDATE_VOTE($org, $rowPos['pos'], $_SESSION['ID']);
                    ?>
                    <button type="submit" name="vote" class="btn btn-info btn-block" <?php if($rtnValVote->num_rows > 0) { echo "disabled"; } ?>>Vote</button>
                </form>
                <hr />
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 fixed-bottom">
    &copy; 2025 Online Voting System. All Rights Reserved.
</footer>
<!-- End Footer -->

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
