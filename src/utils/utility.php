<?php
    function getSold($id, $transactions) {
        $countSold = 0;
        foreach ($transactions as $transaction) {
            if ($transaction['chocolate_id'] === $id) {
                $countSold += $transaction['amount'];
            }
        }
        return $countSold;
    }
?>