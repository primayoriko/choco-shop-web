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
            <a class="header-menu" id="homeButton" href="/src/dashboard.php">
                Home
            </a>
            <?php

            if ($session['is_superuser']) {
                echo '<a class="header-menu" href="/src/new_chocolate.php">
                    Add New Chocolate
                </a>';
            } else if (!$session['is_superuser']) {
                echo '<a class="header-menu" href="/src/transaction_history.php">
                    History
                </a>';
            }
            ?>
        </div>
        <div class="header-comp header-search">
            <form name="searchbar" action="/src/search_result.php" method="get">
                <input class="search-bar" type="text" name="search" placeholder="Search" value="<?php echo $keyword ?>" onUnfocus="send()">
            </form>
        </div>
        <a class="header-comp header-menu" id="logoutButton" href="/src/utils/logout.php">
            Logout
        </a>
    </header>

</body>

</html>