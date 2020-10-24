<?php

function choco_card_long($choc)
{
    extract($choc);
    $fprice = number_format($price, 2, ",", ".");
    echo ('
    <div class="choco-card" id="choc-' . $id . '">
        <div class="card-image-box">
            <img class="card-image" alt="' . $name . '" src="' . $image . '">
        </div>
        <div class="card-desc">
            <div class="card-title text-title">' . $name . '</div>
            <div class="text-subtitle">Amount sold: ' . $sold . '</div>
            <div class="text-subtitle">Price: ' . $fprice .'</div>
            <div class="text-subtitle">Amount remaining: ' . $amount .'</div>
            <div class="text-subtitle">Description</div>
            <p class="text-content">' . $description .'</p>
        </div>
    </div>');
}
