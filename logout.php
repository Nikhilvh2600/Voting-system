<?php
// Start session
session_start();

// Destroy all session data
session_destroy();

// Try redirecting
header("Location: ../index.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logging Out...</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #111;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.15);
            backdrop-filter: blur(8px);
        }
        .loader {
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top: 4px solid #0dcaf0;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="card text-center">
        <h3>Logging you out...</h3>
        <div class="loader"></div>
        <p>Redirecting to login page.</p>
        <noscript><a href="../index.php" class="btn btn-info mt-3">Click here if not redirected</a></noscript>
    </div>
</body>
</html>
