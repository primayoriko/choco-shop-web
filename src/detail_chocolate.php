<?php
    if (isset($_GET['id'])){
        ['connect_db' => $connect_db ] = require 'utils/db_connect.php';
        require_once(__DIR__ . '/../config/image_saving.config.php');
        $asset_dir = '../' . CHOCO_IMG_DIR . '/';
        $db = $connect_db();
        $id = htmlspecialchars(trim($_GET['id']));
        $sql = "SELECT * FROM chocolates WHERE id=''";
        $search_result = $db->query($sql)->fetchAll();
        $sql = "SELECT * FROM transactions";
        $transactions = $db->query($sql)->fetchAll();
    }
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chocolate Detail</title>
</head>
<body>
    
</body>
</html>