<?php
['validate_token' => $validate_token] = require 'utils/authentication.php';
['make_token' => $make_token] = require 'utils/authentication.php';

if (!isset($_COOKIE['sessionID'])) {
    header("location: login.php");
    exit;
}

$session = $validate_token($_COOKIE['sessionID']);
if (!$session['is_valid']) {
    header("location: login.php");
    exit;
}

define('PAGINATION', 3);
$search_result = [];
$nama = '';
$page = 0;
$totalpage = 0;

if (isset($_GET['search'])) {
    $page = 1;
    if (isset($_GET['page'])) {
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        if (false === $page) {
            $page = 1;
        }
    }
    ['connect_db' => $connect_db] = require 'utils/db_connect.php';
    require_once(__DIR__ . '/../config/image_saving.config.php');
    $asset_dir = '../' . CHOCO_IMG_DIR . '/';
    $db = $connect_db();
    $nama = htmlspecialchars(trim($_GET['search']));
    $sql = "SELECT * FROM chocolates WHERE name LIKE '%$nama%' LIMIT " . PAGINATION;
    if ($page > 1) {
        $sql .= ' OFFSET ' . (($page - 1) * PAGINATION);
    }
    $search_result = $db->query($sql)->fetchAll();
    $num_row = (int) $db->query("SELECT COUNT(*) as total FROM chocolates WHERE name LIKE '%$nama%'")->fetch()['total'];
    $totalpage = ceil($num_row / PAGINATION);
    $sql = "SELECT * FROM transactions";
    $transactions = $db->query($sql)->fetchAll();
}

include('components/choco_card_long.php');
include('components/pagination.php');
include('utils/utility.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="../public/css/search_result.css" type="text/css">
    <link rel="stylesheet" href="../public/css/components/choco_card_long.css" type="text/css">
</head>

<body>
    <main>
        <?php include('components/header.php') ?>
        <div class="container">
            <?php
            if (count($search_result) <= 0) {
                echo "<div class='text-subtitle not-found'> Coklat tidak ditemukan :( </div>";
            }
            foreach ($search_result as $chocolate) {
                $chocolate['image'] = $asset_dir . $chocolate['id'] . $chocolate['image_extension'];
                $chocolate['sold'] = getSold($chocolate['id'], $transactions);
                choco_card_long($chocolate);
            } ?>
            <div class="pagination-container">
                <?php echo paginate($page, $totalpage, 1,  '/src/search_result.php?search=' . $nama) ?>
            </div>
        </div>
    </main>
</body>

</html>