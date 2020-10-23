<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("location: login.php");
    exit;
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Willy Wangky Chocolate Factory</title>
    <link rel="stylesheet" href="../public/css/index.css" type="text/css">
    <link rel="stylesheet" href="../public/css/dashboard.css" type="text/css">
</head>

<body>
    <main>
        <?php include('components/header.php') ?>
        <div class="container">
            <div class="top-container text-title">
                <?php
                echo ('<h2 class="top-content">Hello, ' . $_SESSION["username"] . '</h2>')
                ?>
                <div class="top-content" id="buttonViewAll">View all chocolates</div>
            </div>
        </div>

        <script>

        </script>
    </main>
</body>

</html>