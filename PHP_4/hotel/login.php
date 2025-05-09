<?php
    include_once "login_utils.php";

    //Form submit
    $loginError = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (login($_POST['username'], $_POST['password'])) {
            header("Location: hotel.php");
            exit;
        } else
            $loginError = true;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card shadow" style="width: 22rem;">
    <div class="card-body">
        <h4 class="card-title mb-4 text-center">Login</h4>

        <?php if ($loginError): ?>
            <div class="alert alert-danger">Invalid username or password.</div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Enter username" autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

</body>
</html>