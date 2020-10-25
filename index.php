<?php
['validate_token' => $validate_token] = require 'src/utils/authentication.php';
['make_token' => $make_token] = require 'src/utils/authentication.php';
['connect_db' => $connect_db] = require 'src/utils/db_connect.php';
if (!isset($_COOKIE['sessionID'])) {
    header("location: src/login.php");
    exit;
}

$session = $validate_token($_COOKIE['sessionID']);
if (!$session['is_valid']) {
    header("location: src/login.php");
    exit;
} else if (!$session['is_superuser']) {
    header("location: src/dashboard.php");
    exit;
}
