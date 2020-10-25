<?php
['validate_token' => $validate_token] = require 'utils/authentication.php';
['make_token' => $make_token] = require 'utils/authentication.php';
['connect_db' => $connect_db] = require 'utils/db_connect.php';

$error_message = "";

$session = array();
if (isset($_COOKIE["sessionID"])) {
    try {
        $session = $validate_token($_COOKIE["sessionID"]);
        if ($session['is_valid']) {
            header("location: dashboard.php");
            exit;
        }
        $error_message = $session['message'];
    } catch (Exception $error) {
        $error_message = $error->getMessage();
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    try {
        $token = $make_token($email, $password);
        if ($token['is_success']) {
            // echo $token['session_id'];
            setcookie('sessionID', $token['session_id'], [
                'expires' => time() + 3600 * 5,
                'path' => '/',
                'domain' => 'localhost',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None',
            ]);
            header("location: dashboard.php");
            exit;
        } else {
            $error_message = $token['message'];
        }
    } catch (Exception $error) {
        $error_message = $error->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../public/css/logreg.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <main>
        <div class="container">
            <div class="text-title large-title">
                Willy Wangky Choco Factory
            </div>
            <form id="login" action="login.php" method="POST">
                <div class="text-content label">Email</div>
                <input class="text-input<?php $error_message=='' ? '' : ' border-error'?>" id="emailField" name="email" type="email">
                <div class="text-content label">Password</div>
                <input class="text-input<?php $error_message=='' ? '' : ' border-error'?>" id="passwordField" name="password" type="password">
                <div class="text-content error"><?php echo $error_message ?></div>
                <a href="/src/register.php"><button class="btn-secondary" type="button">Sign up</button></a>
                <button class="btn-primary btn-submit" type="submit" form="login">Login</button>
            </form>
        </div>
    </main>
</body>
</html>