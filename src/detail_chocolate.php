<?php
    include('utils/utility.php');

    if (isset($_GET['id'])){
        ['connect_db' => $connect_db ] = require 'utils/db_connect.php';
        require_once(__DIR__ . '/../config/image_saving.config.php');
        $asset_dir = '../' . CHOCO_IMG_DIR . '/';
        $db = $connect_db();
        $id = htmlspecialchars(trim($_GET['id']));
        $sql = "SELECT * FROM chocolates WHERE id=$id";
        $chocolate = $db->query($sql)->fetch();
        $sql = "SELECT * FROM transactions WHERE chocolate_id=$id";
        $transactions = $db->query($sql)->fetchAll();

        $chocolate['image'] = $asset_dir . $chocolate['id'] . $chocolate['extension'];
        $chocolate['sold'] = getSold($chocolate['id'], $transactions);
        $fprice = number_format($chocolate['price'], 2, ",", ".");
        extract($chocolate);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate Detail</title>
    <link rel="stylesheet" href="../public/css/detail_chocolate.css" type="text/css">
</head>
<body>
    <main>
        <?php include('components/header.php') ?>
        <div class="container">
            <div class="text-title"><?php echo $name ?></div>
            <div class="chocolate-container">
                <div class="image-box">
                    <img class="image" alt="<?php echo $name ?>" src="<?php echo $image ?>">
                </div>
                <div class="desc">
                    <div class="text-subtitle">Amount sold: <?php echo $sold ?></div>
                    <div class="text-subtitle">Price: <?php echo $price ?></div>
                    <div class="text-subtitle">Amount remaining: <?php echo $amount ?></div>
                    <div class="text-subtitle">Description</div>
                    <p class="text-content"><?php echo $description ?></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>