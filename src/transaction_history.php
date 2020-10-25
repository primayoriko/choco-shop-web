<?php
session_start();

if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("location: login.php");
    exit;
}

// Need checking superuser??
// if(!isset($_SESSION["isSuperuser"]) || !$_SESSION["isSuperuser"]){
//     header("location: dashboard.php");
//     exit;
// }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="public/css/new_chocolate.css" type="text/css">
</head>

<body>
    <div class="spacer"></div>
    <header>
        Transaction History
    </header>
    <div class="spacer"></div>
    <main>
        <table>
            <tr>
                <th>
                    Chocolate Name:
                </th>
                <th>
                    Chocolate Name:
                </th>
                <th>
                    Chocolate Name:
                </th>
                <th>
                    Chocolate Name:
                </th>
                <th>
                    Chocolate Name:
                </th>
            </tr>
            <?php

            ?>
        </table>
    </main>
    <div class="spacer"></div>
    <script>

    </script>
</body>

</html>