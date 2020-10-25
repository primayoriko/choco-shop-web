<?php
    ['connect_db' => $connect_db ] = require 'db_connect.php';

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        if(isset($_GET['id'])){
            $pdo = $connect_db();
            $sql = "SELECT * FROM chocolates WHERE id = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['id']);

            $stmt->execute();

            if($stmt->rowCount() === 1){
                $chocolate = $stmt->fetch(PDO::FETCH_OBJ);
                $return = array(
                    'message' => 'ok',
                    'id' => $_GET['id'],
                    'amount' => $chocolate->amount
                );
                http_response_code(200);
            }
            else{
                $return = array(
                    'message' => "Not Found"
                );
                http_response_code(404);
            }
        }
        else {
            $return = array(
                'message' => "Bad request, id cannot be empty!"
            );
            http_response_code(400);
        }
    } 
    else {
        $return = array(
            'message' => "Method not allowed!"
        );
        http_response_code(405);
    }

    echo json_encode($return);
?>