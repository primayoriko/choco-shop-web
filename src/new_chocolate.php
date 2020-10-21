<?php
    session_start();

    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]){
        header("location: login.php");
        exit;
    }

    if(!isset($_SESSION["isSuperuser"]) || !$_SESSION["isSuperuser"]){
        header("location: dashboard.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="../public/css/new_chocolate.css" type="text/css">
    </head>
    <body>
        <div class="spacer"></div>
        <header>
            Add New Chocolate
        </header>
        <div class="spacer"></div>
        <main>
            <form id="newChocolate" action="new_chocolate.php" method="POST" >
                <th>
                </th>
            </form>
        </main>
        <div class="spacer"></div>
        <script>
            
        </script>    
    </body>
</html>