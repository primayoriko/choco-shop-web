<?php
['validate_token' => $validate_token] = require 'utils/authentication.php';
['make_token' => $make_token] = require 'utils/authentication.php';

if (!isset($_COOKIE['sessionID'])) {
    header("location: login.php");
    exit;
}

$session = $validate_token($_COOKIE['sessionID']);
if (!$session['is_valid']) {
    header("location: login.php");
    exit;
}
if ($session['is_superuser']) {
    $mode = ['link' => '/src/add_chocolate.php?id=', 'name' => 'Add Stock'];
} else {
    $mode = ['link' => '/src/buy_chocolate.php?id=', 'name' => 'Buy Now'];
}

include('utils/utility.php');

if (isset($_GET['id'])) {
    ['connect_db' => $connect_db] = require 'utils/db_connect.php';
    require_once(__DIR__ . '/../config/image_saving.config.php');
    $asset_dir = '../' . CHOCO_IMG_DIR . '/';
    $db = $connect_db();
    $id = htmlspecialchars(trim($_GET['id']));
    $sql = "SELECT * FROM chocolates WHERE id=$id";
    $chocolate = $db->query($sql)->fetch();
    $sql = "SELECT * FROM transactions WHERE chocolate_id=$id";
    $transactions = $db->query($sql)->fetchAll();

    $chocolate['image'] = $asset_dir . $chocolate['id'] . $chocolate['image_extension'];
    $chocolate['sold'] = getSold($chocolate['id'], $transactions);
    $fprice = number_format($chocolate['price'], 2, ",", ".");
    extract($chocolate);
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Willy Wangky Chocolate Factory</title>
    <link rel="stylesheet" href="../public/css/buy_add_chocolate.css" type="text/css">
</head>

<body>
    <main>
        <?php include('components/header.php') ?>
        <div class="container">
            <div class="page-title text-title">
                Buy Chocolate
            </div>
            <div class="choco-container">
                <div class="image-box">
                    <img class="image" alt="<?php echo $name ?>" src="<?php echo $image ?>">
                </div>
                <div class="choco-right">

                    <div class="choco-props text-content">
                        <div class="choco-title text-title" id="choco-title"><?php echo $name ?></div>
                        <div>Amount sold: <span id="choco-sold"><?php echo $sold ?></span></div>
                        <div>Price: <span id="choco-price"><?php echo "Rp " . $fprice ?></span></div>
                        <div>Amount Remaining: <span id="choco-stock"> <?php echo $amount ?></span></div>
                        <div>Description:</div>
                        <div class="choco-desc" id="choco-desc"><?php echo $description ?></div>

                    </div>
                    <div class="amount-modifier text-content">
                        <div>
                            <div>Amount to add:</div>
                            <div>Di sini tombol add / amount</div>
                            <div onclick='minus()'> - </div>
                            <div id="buy-amount"> 0 </div>
                            <div onclick='plus()'> + </div>
                        </div>
                        <div>
                            <div>Total Price</div>
                            <div>Rp <a id="total-price">0<a>,00</div>
                        </div>
                        <!-- price_block -->
                    </div>
                </div>
            </div>
            <div class="address-block">
                <div> Address: </div>
                <div class="address-input"> Textbox </div>
            </div>
            <div class="btn-group ">
                <button class="btn-secondary text-subtitle"> Cancel </button>
                <button class="btn-primary text-subtitle" id="btn-buy">Buy</button>
            </div>
        </div>

        <script>

        </script>
    </main>
</body>

</html>