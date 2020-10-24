<?php

function choco_card($choc)
{
    extract($choc);
    $fprice = number_format($price, 2, ",", ".");
    echo ('
    <div class="choco-card" id="choc-' . $id . '">
        <div class="card-image-box">
            <img class="card-image" alt="' . $name . '" src="' . $image . '">
            <div class="hover">
                <a class="hover-text text-subtitle" href="#">Buy now! 
                </a>
            </div> 
        </div>
        <div class="card-desc">
            <a class="card-title text-title">' . $name . '</a>
            <div class="card-amount text-content">Amount sold: ' . $amount . ' </div>
            <div class="card-price text-content">Price: ' . $fprice . ' </div>
        </div>
    </div>');
}
