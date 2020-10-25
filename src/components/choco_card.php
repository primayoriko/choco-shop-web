<?php

function choco_card($choc)
{
    extract($choc);
    $hover_text = "Buy Now!";
    if ($is_superuser) {
        $hover_text = "Add Stock";
    }
    $fprice = number_format($price, 2, ",", ".");
    echo ('
    <div class="choco-card" id="choc-' . $id . '">
        <a href="/src/detail_chocolate.php?id=' . $id . '">
            <div class="card-image-box">
                <img class="card-image" alt="' . $name . '" src="' . $image . '">
                <div class="hover">
                    <a class="hover-text text-subtitle" href="/src/detail_chocolate.php?id=' . $id . '">' . $hover_text . '
                    </a>
                </div> 
            </div>
        </a>
        <div class="card-desc">
            <a class="card-title text-title" href="/src/detail_chocolate.php?id=' . $id . '">' . $name . '</a>
            <div class="card-amount text-content">Amount sold: ' . $sold . ' </div>
            <div class="card-price text-content">Price: Rp ' . $fprice . ' </div>
        </div>
    </div>');
}
