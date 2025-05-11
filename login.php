<?php
// Include database connection
require("../config/db.php");

// Include class StudentLogin
require("../classes/StudentLogin.php");

session_start();

if (isset($_POST['submit'])) {
    $stud_id = trim($_POST['stud_id']);

    if (!empty($stud_id)) {
        $loginStud = new StudentLogin($stud_id);
        $rtnLogin = $loginStud->StudLogin(); // Handles session + redirect
    } else {
        $_SESSION['ERROR_MSG_ARRAY'] = ["Student ID is required."];
        header("Location: ../index.php");
        exit();
    }
} else {
    // Optional UI fallback
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Invalid Access</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <style>
            body {
                background: #111;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                font-family: 'Segoe UI', sans-serif;
            }
            .card {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(8px);
                border-radius: 12px;
                padding: 30px;
                box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
            }
            .btn-home {
                background-color: #0dcaf0;
                color: black;
                font-weight: bold;
                border: none;
            }
            .btn-home:hover {
                background-color: #0bbecf;
            }
        </style>
    </head>
    <body>
        <div class="card text-center">
            <h3 class="mb-3">⚠️ Invalid Access</h3>
            <p>This page cannot be accessed directly.</p>
            <a href="../index.php" class="btn btn-home mt-3">Go to Login</a>
        </div>
    </body>
    </html>
    <?php
}
$db->close();
