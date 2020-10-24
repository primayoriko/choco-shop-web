<?php
    $search_result = [];
    if (isset($_GET['search'])){
        ['connect_db' => $connect_db ] = require 'utils/db_connect.php';
        require_once(__DIR__ . '/../config/image_saving.config.php');
        $asset_dir = '../' . CHOCO_IMG_DIR . '/';
        $db = $connect_db();
        $nama = htmlspecialchars(trim($_GET['search']));
        $sql = "SELECT * FROM chocolates WHERE name LIKE '%$nama%'";
        $search_result = $db->query($sql)->fetchAll();
        $sql = "SELECT * FROM transactions";
        $transactions = $db->query($sql)->fetchAll();
    }

    include('components/choco_card_long.php');
    include('utils/utility.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="../public/css/search_result.css" type="text/css">
    <link rel="stylesheet" href="../public/css/components/choco_card_long.css" type="text/css">
</head>
<body>
    <main>
        <?php include('components/header.php') ?>
        <?php foreach ($search_result as $chocolate) {
            $chocolate['image'] = $asset_dir . $chocolate['id'] . $chocolate['extension'];
            $chocolate['sold'] = getSold($chocolate['id'], $transactions);
            choco_card_long($chocolate);
        } ?>
    </main>
</body>
</html>