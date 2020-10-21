<?php

require_once __DIR__ . "/db_connect.php";

if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET["username"])){
        $username = trim($_GET["username"]);
        if(!empty($username)){
            $sql = "SELECT * FROM users WHERE username = :username";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(":username", $username);

            if($stm->execute()){
                if($stm->rowCount() === 1){
                    $return = array(
                        'message' => "Username already taken!"
                    );
                    http_response_code(200);
                } else {
                    $return = array(
                        'message' => "Available"
                    );
                    http_response_code(200);
                }
            } 
            else {
                $return = array(
                    'message' => "Internal server error"
                );
                http_response_code(500);
            }
        } 
        else {
            $return = array(
                'message' => "Bad request, username cannot be empty!"
            );
            http_response_code(400);
        }
    } 
    else if (isset($_GET["email"])){
        $email = trim($_GET["email"]);
        if(!empty($email)){
            $sql = "SELECT * FROM users WHERE email = :email";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(":email", $email);

            if($stm->execute()){
                if($stm->rowCount() === 1){
                    $return = array(
                        'message' => "Email already taken!"
                    );
                    http_response_code(200);
                } else {
                    $return = array(
                        'message' => "Available"
                    );
                    http_response_code(200);
                }
            } 
            else {
                $return = array(
                    'message' => "Internal server error"
                );
                http_response_code(500);
            }
        } 
        else {
            $return = array(
                'message' => "Bad request, email cannot be empty!"
            );
            http_response_code(400);
        }
    } else {
        $return = array(
            'message' => "Bad request, email/username query parameter needed!"
        );
        http_response_code(400);
    }
    echo json_encode($return);
}

?>