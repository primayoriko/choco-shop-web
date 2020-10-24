<?php

function choco_card_long($choc)
{
    extract($choc);
    $fprice = number_format($price, 2, ",", ".");
    echo ('
    <div class="choco-card" id="choc-' . $id . '">
        <div class="card-image-box">
            <a href="/src/detail_chocolate.php?id=' . $id .'"><img class="card-image" alt="' . $name . '" src="' . $image . '"></a>
        </div>
        <div class="card-desc">
            <a href="/src/detail_chocolate.php?id=' . $id .'"><div class="card-title text-title">' . $name . '</div></a>
            <div class="text-subtitle">Amount sold: ' . $sold . '</div>
            <div class="text-subtitle">Price: ' . $fprice .'</div>
            <div class="text-subtitle">Amount remaining: ' . $amount .'</div>
            <div class="text-subtitle">Description</div>
            <p class="text-content">' . $description .'</p>
        </div>
    </div>');
}
