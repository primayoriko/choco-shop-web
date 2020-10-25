<?php
// $ Fetch menu list 
include '../utils/utility.php';
$menu_list = [];
['connect_db' => $connect_db] = require '../utils/db_connect.php';
require_once(__DIR__ . '/../../config/image_saving.config.php');
$asset_dir = '../../' . CHOCO_IMG_DIR . '/';
$db = $connect_db();
$sql = "SELECT * FROM chocolates";
$menu_list = $db->query($sql)->fetchAll();
$sql = "SELECT * FROM transactions";
$transactions = $db->query($sql)->fetchAll();

// $ Insert sold amount and image to array
for ($i = 0; $i <  count($menu_list); $i++) {
    $menu_list[$i]['sold'] = getSold($menu_list[$i]['id'], $transactions);
    $menu_list[$i]['image'] = $asset_dir . $menu_list[$i]['id'] . $menu_list[$i]['image_extension'];
}

// $ Sort array on amount of sold chocolate
usort($menu_list, function ($a, $b) {
    return $b['sold'] - $a['sold'];
});

// $ Render Chocolate Cards based on view

include('choco_card.php');

function renderAllMenu($menu)
{
    for ($i = 0; $i < count($menu); $i++) {
        choco_card($menu[$i]);
    }
}

function render10Menu($menu)
{
    for ($i = 0; $i < 10; $i++) {
        choco_card($menu[$i]);
    }
}

// $ Get functions
if (isset($_GET['function'])) {
    if ($_GET['function'] == 'ten') {
        render10Menu($menu_list);
    } elseif ($_GET['function'] == 'all') {
        renderAllMenu($menu_list);
    }
}
