<?php
    ['connect_db' => $connect_db ] = require 'db_connect.php';

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $pdo = $connect_db();
            $sql = "SELECT * FROM chocolates WHERE id = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['id']);

            $stmt->execute();

            if($stmt->rowCount() === 1){
                $chocolate = $stmt->fetch(PDO::FETCH_OBJ);

                $sql = "SELECT SUM(amount) as sold FROM transactions 
                        where chocolate_id = :id GROUP BY chocolate_id";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $_GET['id']);

                $stmt->execute();

                if($stmt->rowCount() === 1){
                    $data = $stmt->fetch(PDO::FETCH_OBJ);
                    $sold = $data->sold;
                }
                else{
                    $sold = 0;
                }

                $return = array(
                    'message' => 'ok',
                    'id' => $_GET['id'],
                    'amount' => $chocolate->amount,
                    'sold' => $sold
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
                'message' => "Bad request!"
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