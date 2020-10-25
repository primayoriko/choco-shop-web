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
                <!-- $ Sementara  -->
                <h3 class="top-content">Hello, user </h3>
                <div class="top-content" id="buttonView"></div>
            </div>
            <div class="menu-container" id="menu">
            </div>
        </div>

        <script>
            var btnView = document.getElementById("buttonView");
            var menu = document.getElementById('menu');
            btnView.addEventListener('click', toggleView);
            toggleView();

            function toggleView() {
                var xhr = new XMLHttpRequest();
                if (btnView.innerHTML === "View All Chocolate") {
                    xhr.open('GET', 'components/render_cards.php?function=all', true);
                    xhr.onload = function() {
                        if (this.status == 200) {
                            btnView.innerHTML = "View Less Chocolate"
                            menu.innerHTML = this.responseText;
                        }
                    }
                    xhr.send();

                } else {
                    xhr.open('GET', 'components/render_cards.php?function=ten', true);
                    xhr.onload = function() {
                        if (this.status == 200) {
                            btnView.innerHTML = "View All Chocolate"
                            menu.innerHTML = this.responseText;
                        }
                    }
                    xhr.send();
                }
            }
        </script>
    </main>
</body>

</html>