<?php
    ['connect_db' => $connect_db ] = require 'db_connect.php';


    $is_valid_token = function($token){
        try{
            $pdo = $connect_db();
            $sql = "SELECT * FROM SESSION WHERE hash_id = :hash_id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':hash_id', $token);

            $stmt->execute();
            if($stmt->rowCount() === 1){

            } else {

            }
        } catch (Exception $error){
            // $error_message = $error->getMessage();
        }


    };

    $make_token = function($username, $password){
        require(__DIR__ . "/db_connect.php");
        $curr_date = date("Y-m-d H:i:s");
        
        $sql = "SELECT * FROM users WHERE username = :username";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);

        try{
            $stmt->execute();
            
        } catch (PDOException $db_error){

        }
        
    };

    return compact('is_valid_token', 'make_token');
?>