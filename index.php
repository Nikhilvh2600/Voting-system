<?php
// Start session
session_start();

// Clear session variables
unset($_SESSION['ADMIN_ID']);
unset($_SESSION['ADMIN_NAME']);
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 1s ease;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.4);
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            border-radius: 8px;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        label {
            font-weight: 500;
        }

        .btn-login {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: bold;
            transition: 0.3s;
            width: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            box-shadow: 0 0 15px rgba(255, 75, 75, 0.6);
            transform: scale(1.03);
        }

        .alert {
            font-size: 14px;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <?php
    if (isset($_SESSION['ERROR_MSG_ARR']) && is_array($_SESSION['ERROR_MSG_ARR']) && count($_SESSION['ERROR_MSG_ARR']) > 0) {
        foreach ($_SESSION['ERROR_MSG_ARR'] as $msg) {
            echo "<div class='alert alert-danger'>$msg</div>";
        }
        unset($_SESSION['ERROR_MSG_ARR']);
    }
    ?>
    <h3>Administrator Login</h3>
    <form method="post" action="process/login.php" role="form">
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" autocomplete="off" required>
        </div>
        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" autocomplete="off" required>
        </div>
        <div class="mb-2">
            <input type="submit" name="submit" value="Login" class="btn btn-login">
        </div>
    </form>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> Voting System | All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
