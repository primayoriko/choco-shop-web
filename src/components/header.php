<?php
    $keyword = '';
    if (isset($_GET['search'])){
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
        function send()
        {document.searchbar.submit()}
    </script>
    <header class="text-title">
        <div class="header-comp">
            <div class="header-menu" id="homeButton">
                <a href="/src/dashboard.php">Home</a>
            </div>
            <?php
            if (isset($_SESSION['isSuperuser'])) {
                if ($_SESSION["isSuperuser"]) {
                    echo '<div class="header-menu"> Add New Chocolate </div>';
                } else {
                    echo '<div class="header-menu"> History </div>';
                }
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