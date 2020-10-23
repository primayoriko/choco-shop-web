<?php

$connect_db = function(){
    require_once(__DIR__.'/../../config/db_keys.config.php');
    // require_once('../../config/db_keys.config.php');

    try {
        $pdo = new PDO("mysql:host=" . DB_SERVER .
                        ";dbname=" . DB_NAME , 
                        DB_USERNAME, DB_PASSWORD);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    } catch (PDOException $e){
        // die("ERROR: can't connect to database" . $e->getMessage());
        throw $e;
    }
};

return compact('connect_db');

?>