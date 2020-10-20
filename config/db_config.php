<?php

// Creds for DB
require_once('db_keys.php');

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER .
                    ";dbname=" . DB_NAME , 
                    DB_USERNAME, DB_PASSWORD);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, 
                        PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die("ERROR: can't connect to database" . $e->getMessage());
}

?>