<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("location: login.php");
    exit;
}

$page_title = null;
$price_block = null;
$address_block = null;
$btn_main = null;

if (isset($_SESSION['isSuperuser'])) {
    if ($_SESSION["isSuperuser"]) {
        $page_title = 'Add Stock';
        $btn_main = '<button class="btn-primary" id="btn-add">Add</button>';
    } else {
        $page_title = 'Buy Chocolate';
        $btn_main = '<button class="btn-primary" id="btn-buy">Buy</button>';
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Willy Wangky Chocolate Factory</title>
    <link rel="stylesheet" href="../public/css/index.css" type="text/css">
    <link rel="stylesheet" href="../public/css/buy_add_chocolate.css" type="text/css">
</head>

<body>
    <?php include('components/header.php') ?>
    <main>
        <div class="container">
            <div class="page-title text-title">
                <?php echo ($page_title); ?>
            </div>
            <div class="choco-container">
                <div class="choco-image">
                    Image
                </div>
                <div class="choco-right">

                    <div class="choco-props">
                        <div class="choco-title text-subtitle" id="choco-title">Choco Name 1</div>
                        <div>Amount sold: <span id="choco-sold"> 6 </span></div>
                        <div>Price: <span id="choco-price"> Rp. 3.000,00 </span></div>
                        <div>Amount Remaining: <span id="choco-stock"> 15 </span></div>
                        <div>Description</div>
                        <div id="choco-desc"> Lorem ipsum sampe mampus</div>

                    </div>
                    <div class="amount-modifier">
                        <div>
                            <div>Amount to add:</div>
                            <div>Di sini tombol add / amount</div>
                        </div>
                        <?php echo ($price_block) ?>
                    </div>
                </div>
            </div>
            <?php echo ($address_block) ?>
            <div class="btn-group">
                <button class="btn-secondary"> Cancel </button>
                <?php echo ($btn_main) ?>
            </div>
        </div>

        <script>

        </script>
    </main>
</body>

</html>