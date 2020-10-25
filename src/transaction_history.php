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
            <div class="table-container">
                <?php
                if (count($transactions) === 0) {
                    echo '<div class="text-subtitle "> Anda belum melakukan transaksi :( </div>';
                } else {

                    echo '<table class="text-subtitle"> ';
                    echo "<thead>
                    <tr>
                            <th >
                                Chocolate Name
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