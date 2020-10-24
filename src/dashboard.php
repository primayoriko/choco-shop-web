<?php
// session_start();
// if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
//     header("location: login.php");
//     exit;
// }


$menu_list = [];
['connect_db' => $connect_db] = require 'utils/db_connect.php';
require_once(__DIR__ . '/../config/image_saving.config.php');
$asset_dir = '../' . CHOCO_IMG_DIR . '/';
$db = $connect_db();
$sql = "SELECT * FROM chocolates ORDER BY sold";
$menu_list = $db->query($sql)->fetchAll();
$sql = "SELECT * FROM transactions";
$transactions = $db->query($sql)->fetchAll();

function getSold($id, $transactions)
{
    $countSold = 0;
    foreach ($transactions as $transaction) {
        if ($transaction['chocolate_id'] === $id) {
            $countSold += $transaction['amount'];
        }
    }
    return $countSold;
}

include('components/choco_card.php');

// $chocolate['image'] = $asset_dir . $chocolate['id'] . $chocolate['extension'];
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
                <div class="top-content" id="buttonView"></div>
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
            var btnView = document.getElementById("buttonView");
            btnView.innerHTML = "View All Chocolate";
            btnView.addEventListener('click', function() {
                if (btnView.innerHTML === "View All Chocolate") {
                    btnView.innerHTML = "View Less Chocolate";
                } else {
                    btnView.innerHTML = "View All Chocolate";
                }
            })
        </script>
    </main>
</body>

</html>