<?php
// session_start();
// if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
//     header("location: login.php");
//     exit;
// }
include('components/choco_card.php');

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/dashboard.css" type="text/css">
    <link rel="stylesheet" href="../public/css/components/choco_card.css" type="text/css">
    <title>Willy Wangky Chocolate Factory</title>
    <!-- <link rel="stylesheet" href="../public/css/index.css" type="text/css"> -->
</head>

<body>
    <main>
        <?php include('components/header.php') ?>
        <div class="container">
            <div class="top-container text-title">
                <!-- <?php
                        echo ('<h3 class="top-content">Hello, ' . $_SESSION["username"] . '</h3>')
                        ?> -->
                <!-- Sementara  -->
                <h3 class="top-content">Hello, user </h3>
                <div class="top-content" id="buttonViewAll">View all chocolates</div>
            </div>
            <div class="menu-container">
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/1.jpg', '']); ?>
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/2.jpg', '']); ?>
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/3.jpg', '']); ?>
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/3.jpg', '']); ?>
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/3.jpg', '']); ?>
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/3.jpg', '']); ?>
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/3.jpg', '']); ?>
                <?php choco_card(['name' => 'Coklat asem', 'id' => 1, 'amount' => 10, 'price' => 1000, 'image' => '../resources/chocolate_img/3.jpg', '']); ?>
            </div>
        </div>

        <script>

        </script>
    </main>
</body>

</html>