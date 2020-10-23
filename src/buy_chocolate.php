<?php
// session_start();
// if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
//     header("location: login.php");
//     exit;
// }


// if (!isset($_SESSION['isSuperuser']) || !$_SESSION['isSuperuser']) {
//     header("location: dashboard.php")
// }


?>


<!DOCTYPE html>
<html>

<head>
    <title>Willy Wangky Chocolate Factory</title>
    <link rel="stylesheet" href="../public/css/index.css" type="text/css">
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
                <div class="choco-image">
                    Image
                </div>
                <div class="choco-right">

                <div class="choco-props text-content">
                        <div class="choco-title text-title" id="choco-title">Choco Name 1</div>
                        <div>Amount sold: <span id="choco-sold"> 6 </span></div>
                        <div>Price: <span id="choco-price"> Rp. 3.000,00 </span></div>
                        <div>Amount Remaining: <span id="choco-stock"> 15 </span></div>
                        <div>Description:</div>
                        <div class="choco-desc" id="choco-desc"> Lorem ipsum sampe mampus</div>

                    </div>
                    <div class="amount-modifier text-content">
                        <div>
                            <div>Amount to add:</div>
                            <div>Di sini tombol add / amount</div>
                        </div>
                        <div>
                            <div>Total Price</div>
                            <div>Rp 420.000,00</div>
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