<?php
['validate_token' => $validate_token] = require 'utils/authentication.php';
['make_token' => $make_token] = require 'utils/authentication.php';
['connect_db' => $connect_db] = require 'utils/db_connect.php';

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

if($_SERVER["REQUEST_METHOD"] === "POST"){
    date_default_timezone_set('Asia/Jakarta');
    $chocolate_id = $_POST['id'];

    $db = $connect_db();
    $sql = "SELECT * FROM chocolates WHERE id=$chocolate_id";
    $chocolate = $db->query($sql)->fetch();
    
    $address = $_POST['address'];
    $username = $session['username'];
    $amount = $_POST['quantity'];
    $totalprice = $amount * $chocolate['price'];
    $time = date("Y-m-d H:i:s");

    $sql = "INSERT transactions VALUES (:username, :chocolate_id, :amount, :totalprice, :address, :time)";
    $pdo = $connect_db();
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':chocolate_id', $chocolate_id);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':totalprice', $totalprice);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':time', $time);

    $stmt->execute();

    header("location: transaction_history.php");
    exit;
}

include('utils/utility.php');

if (isset($_GET['id'])) {
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
                        <div>Price: Rp <span id="choco-price"><?php echo $fprice ?></span></div>
                        <div>Amount Remaining: <span id="choco-stock"> <?php echo $amount ?></span></div>
                        <div>Description:</div>
                        <div class="choco-desc" id="choco-desc"><?php echo $description ?></div>

                    </div>
                    <div style="display: none" id='ori-price'>
                        <?php echo $price ?></div>
                    <!-- price_block -->
                </div>
            </div>
            <form class="form-bawah" id="buyChocolate" action="buy_chocolate.php" method="POST">
                <?php
                    if ($amount === 0) {
                        echo "<div> Items is currently sold out.. </div>";
                    } else {
                        echo '
                    <div>
                        <div class="text-title">Amount to buy:</div>
                        <div class="mod text-subtitle">
                            <button type="button" id="minus"> - </button>
                            <input class="mod-number text-subtitle" type="number" id="quantity" name="quantity" min="1" max="' . $amount . '">
                            <button type="button" id="plus"> + </button>
                        </div>
                    </div>
                    ';
                    }
                ?>
                <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                <div class="address-block text-subtitle">
                    <label> Address: </label>
                    <textarea class="address-input" name="address" id="address" cols="40" rows="3" placeholder="insert your address"></textarea>
                </div>
                <div class="btn-group ">
                    <a href="/src/detail_chocolate.php?id=<?php echo $id ?>"><button class="btn-secondary text-subtitle" type="button"> Cancel </button></a>
                    <button class="btn-primary text-subtitle" id="btn-buy" type="submit">Buy</button>
                </div>
            </form>
        </div>
        </div>

        <script>
            // console.log(total);
            // var quantity = document.getElementById('quantity').innerHTML;
            // var price = document.getElementById('ori-price').innerHTML;
            // document.getElementById('total-price').innerHTML = quantity * price;
            // console.log(total);
            // console.log(quantity);
            document.getElementById('plus').addEventListener('click', function() {
                document.getElementById('quantity').stepUp();
                // document.getElementById('total-price').innerHTML = total + quantity * price;
            })
            document.getElementById('minus').addEventListener('click', function() {
                document.getElementById('quantity').stepDown();
                // document.getElementById('total-price').innerHTML = total - quantity * price;
            })
        </script>
    </main>
</body>

</html>