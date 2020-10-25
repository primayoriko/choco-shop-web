<?php

['validate_token' => $validate_token] = require 'utils/authentication.php';
['make_token' => $make_token] = require 'utils/authentication.php';


// if (!isset($_COOKIE['sessionID'])) {
//     header("location: login.php");
//     exit;
// }

if (!isset($_COOKIE['sessionID'])) {
    header("location: login.php");
    exit;
}

$session;
$transactions = [];

try {
    $session = $validate_token($_COOKIE['sessionID']);
    if (!$session['is_valid']) {
        header("location: login.php");
        exit;
    } else if ($session['is_superuser']) {
        header("location: dashboard.php");
        exit;
    }


    ['connect_db' => $connect_db] = require 'utils/db_connect.php';
    $sql = "SELECT c.name, t.chocolate_id, t.amount, t.totalprice, t.time, t.address FROM transactions as t, chocolates as c WHERE t.username = :username AND c.id = t.chocolate_id ORDER BY time DESC";
    $db = $connect_db();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $session['username']);
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_CLASS);
} catch (Exception $error) {
    $error_message = $error->getMessage();
}

?>

<!DOCTYPE html>
<html>
<<<<<<< HEAD
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
=======

<head>
    <title>Register</title>
    <link rel="stylesheet" href="../public/css/history.css" type="text/css">
</head>

<body>
    <main>
        <?php include('components/header.php') ?>
        <div class="container">
            <div class="page-title text-title">
                Transaction History
            </div>
<<<<<<< HEAD
        </div>
        <?php
        if (count($transactions) === 0) {
            echo '<div> Nothing to show </div>';
        } else {

            echo '<table class="text-content"> ';
            echo "<tr>
>>>>>>> a60f45c37ad68eadaae449b0be314fb2f1620ae7
                            <th>
                                Chocolate Name:
=======
            <div class="table-container">
                <?php
                if (count($transactions) === 0) {
                    echo '<div> Nothing to show </div>';
                } else {

                    echo '<table class="text-subtitle"> ';
                    echo "<thead>
                    <tr>
                            <th >
                                Chocolate Name
>>>>>>> 4b857b42dc279c54707e8cbd731e2c06c9875d49
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Total Price
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Time
                            </th>
                            <th>
                                Address
                            </th>
                        </tr>
                        </thead>
                        <tbody>";
                    foreach ($transactions as $transaction) {
                        $rtime = date_create($transaction->time);
                        $fdate = date_format($rtime, "d F y");
                        $ftime = date_format($rtime, "H:i:s");
                        $fprice = number_format($transaction->totalprice, 2, ",", ".");
                        echo "<tr >
                                <td>
                                    <a class='choco-title' href='detail_chocolate.php?id=$transaction->chocolate_id'>
                                        $transaction->name
                                    </a>
                                </td>
                                <td>
                                    $transaction->amount
                                </td>
                                <td>
                                    Rp $fprice
                                </td>
                                <td>
                                   $fdate
                                </td>
                                <td>
                                    $ftime
                                </td>
                                <td>
                                    $transaction->address
                                </td>
                            </tr>";
                    }

                    echo '</tbody></table> ';
                }
                ?></div>
        </div>

    </main>
    <script>

    </script>
</body>

</html>