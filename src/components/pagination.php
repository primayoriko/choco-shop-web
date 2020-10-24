<?php
    function paginate($current, $total, $around, $url) {
        $skipped = false;
        $result = '';
        for ($i = 1; $i<=$total; $i++) {
            if ($i == $current){
                $result .= '<a href="' . $url . '&page=' . $i . '"><button class="btn-primary" style="margin: 0 1rem; min-width: 0; padding: 1rem 3rem;">' . $i . '</button></a>';
            }
            elseif ($i == 1 || $i == $total) {
                $result .= '<a href="' . $url . '&page=' . $i . '"><button class="btn-secondary" style="margin: 0 1rem;">' . $i . '</button></a>';
            } elseif ($i >= $current-$around && $i <= $current+$around) {
                $result .= '<a href="' . $url . '&page=' . $i . '"><button class="btn-secondary" style="margin: 0 1rem;">' . $i . '</button></a>';
                $skipped  = false;
            } elseif (!$skipped) {
                $result .= ' <span class="text-title">...</span> ';
                $skipped = true;
            }
        }
        return $result;
    }
?>