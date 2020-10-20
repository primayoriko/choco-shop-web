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
        <link rel="stylesheet" href="../public/css/register.css" type="text/css">
    </head>
    <body>
        <div class="spacer"></div>
        <header>
            Willy Wangky Choco Factory
        </header>
        <div class="spacer"></div>
        <main>

        </main>
        <div class="spacer"></div>
        <script>
            
        </script>    
    </body>
</html>