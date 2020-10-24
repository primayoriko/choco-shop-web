<?php
    ['destroy_token' => $destroy_token ] = require __DIR__ . '/authentication.php';

    if(isset($_COOKIE['sessionID'])){
        $destroy_token($_COOKIE['sessionID']);
        setcookie('sessionID', '', time() - 3600);
    }

    header("location: ../login.php");
    exit;
?>