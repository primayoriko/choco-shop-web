<?php

    ['validate_token' => $validate_token ] = require 'utils/authentication.php';
    ['make_token' => $make_token ] = require 'utils/authentication.php';
    ['connect_db' => $connect_db ] = require 'utils/db_connect.php';

    require_once __DIR__ . '/../config/pagination.config.php';

    if(!isset($_COOKIE['sessionID'])){
        header("location: login.php");
        exit;
    }

    $error_message = "";
    $session;

    try{
        $session = $validate_token($_COOKIE['sessionID']);
        if(!$session['is_valid']) {
            header("location: login.php");
            exit;
        }

        // Need checking superuser??
        else if($session['is_superuser']){
            echo 'asdsadsa';
            header("location: dashboard.php");
            exit;
        }

        $sql = "SELECT t.chocolate_id, c.name, t.amount, t.totalprice, t.time, t.address 
                FROM TRANSACTIONS as t LEFT JOIN CHOCOLATES as c 
                ON t.chocolate_id = c.id where t.username = :username";
        $pdo = $connect_db();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $session['username']);

        $stmt->execute();

        $transactions = $stmt->fetchAll(PDO::FETCH_CLASS);

    } 
    catch (Exception $error) {
        $error_message = $error->getMessage();
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
            Transaction History
        </header>
        <div class="spacer"></div>
        <main>
            <?php 
                if(count($transactions) === 0){
                    echo '<div> Nothing to show </div>';
                }
                else{
                    echo '<table> ';
                    echo "<tr>
                            <th>
                                Chocolate Name:
                            </th>
                            <th>
                                Amount:
                            </th>
                            <th>
                                Total Price:
                            </th>
                            <th>
                                Date:
                            </th>
                            <th>
                                Time:
                            </th>
                            <th>
                                Address:
                            </th>
                        </tr>";
                    foreach ($transactions as $transaction){
                        $datetime = explode(" ",$transaction->time);
                        echo "<tr>
                                <th>
                                    <a href='detail_chocolate.php?id=$transaction->chocolate_id'>
                                        $transaction->name
                                    </a>
                                </th>
                                <th>
                                    $transaction->amount
                                </th>
                                <th>
                                    $transaction->totalprice
                                </th>
                                <th>
                                    $datetime[0]
                                </th>
                                <th>
                                    $datetime[1]
                                </th>
                                <th>
                                    $transaction->address
                                </th>
                            </tr>";
                    }

                    echo '</table> ';
                }
            ?>
        </main>
        <div class="spacer"></div>
        <script>
            
        </script>    
    </body>
</html>

