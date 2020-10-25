<?php
$keyword = '';
if (isset($_GET['search'])) {
    $keyword = htmlspecialchars(trim($_GET['search']));
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../public/css/header.css" type="text/css">
</head>

<body>
    <script>
        function send() {
            document.searchbar.submit()
        }
    </script>
    <header class="text-title">
        <div class="header-comp">
            <div class="header-menu" id="homeButton">
                <a href="/src/dashboard.php">Home</a>
            </div>
            <?php

            if ($session['is_superuser']) {
                echo '<div class="header-menu">
                        <a href="/src/new_chocolate.php">
                        Add New Chocolate
                        </a>
                 </div>';
            } else if (!$session['is_superuser']) {
                echo '<div class="header-menu">
                <a href="/src/transaction_history.php">
                History
                </a>
         </div>';
            }
            ?>
        </div>
        <div class="header-comp header-search">
            <form name="searchbar" action="/src/search_result.php" method="get">
                <input class="search-bar" type="text" name="search" placeholder="Search" value="<?php echo $keyword ?>" onUnfocus="send()">
            </form>
        </div>
        <div class="header-comp header-menu" id="logoutButton">
            <a href="/src/utils/logout.php">Logout</a>
        </div>
    </header>

</body>

</html>