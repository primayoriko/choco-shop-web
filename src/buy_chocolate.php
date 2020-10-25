<?php
    ['validate_token' => $validate_token ] = require 'utils/authentication.php';
    ['make_token' => $make_token ] = require 'utils/authentication.php';
    ['connect_db' => $connect_db ] = require 'utils/db_connect.php';

    if($_SERVER["REQUEST_METHOD"] !== "GET" ||
        !isset($_GET['id']) || !is_numeric($_GET['id'])){
        header('location: dashboard.php');
        exit;
    }

    if(!isset($_COOKIE['sessionID'])){
        header("location: login.php");
        exit;
    }

    $session;

    try{
        $session = $validate_token($_COOKIE['sessionID']);
        if(!$session['is_valid']) {
            header("location: login.php");
            exit;
        }

        else if(!$session['is_superuser']){
            header("location: dashboard.php");
            exit;
        }

        
        $sql = "SELECT * FROM chocolates WHERE id = :id";
        $pdo = $connect_db();

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);

        $stmt->execute();

        if($stmt->rowCount() === 1){    
            $chocolate = $stmt->fetch(PDO::FETCH_OBJ);

            
        } else {
            // ERROR NOT FOUND
        }
    } 
    catch (Exception $error) {
        $error_message = $error->getMessage();
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
    <main>
    <?php include('components/header.php') ?>
        <div class="container">
            <div class="page-title text-title">
                Buy Chocolate
            </div>
            <div class="choco-container">
                <div class="choco-image">
                    djasndasdnas<!-- Image ADD IMAGE HERE PLS -->
                </div>
                <div class="choco-right">

                <div class="choco-props text-content">
                        <div style="display: hidden" id="choco-id"> <?php echo $chocolate->id ?> </div>
                        <div class="choco-title text-title" id="choco-title"><?php echo $chocolate->name ?></div>
                        <div>Amount sold: <span id="choco-sold"> 6 </span></div>
                        <div>Price: <span id="choco-price"> Rp. <a><?php echo $chocolate->price ?><a>,00 </span></div>
                        <div>Amount Remaining: <span id="choco-stock"> <?php echo $chocolate->amount ?> </span></div>
                        <div>Description:</div>
                        <div class="choco-desc" id="choco-desc"> <?php echo $chocolate->description ?></div>

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
                function add(){
                    var amount = document.getElementsById("buy-amount"); 
                    var amountMax = document.getElementsById("buyAmount"); 
                }

                function minus(){

                }

                function updateAmount(){

                }

                updateAmount();
            </script>
    </main>
</body>

</html>