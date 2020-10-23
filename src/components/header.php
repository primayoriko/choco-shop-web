<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../public/css/header.css" type="text/css">
</head>

<body>
    <header class="text-title">
        <div class="header-comp">
            <div class="header-menu" id="homeButton">
                Home
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
            Search Bar
        </div>
        <div class="header-comp header-menu" id="logoutButton">
            Logout
        </div>
    </header>
    <script>

    </script>

</body>

</html>