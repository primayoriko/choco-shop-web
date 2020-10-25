<?php

['validate_token' => $validate_token] = require 'utils/authentication.php';
['make_token' => $make_token] = require 'utils/authentication.php';
['connect_db' => $connect_db] = require 'utils/db_connect.php';

function is_allowed_ext($file)
{
    $ext_type = array('gif', 'jpg', 'jpe', 'jpeg', 'png');
}

function is_allowed_size($file)
{
}

function is_not_empty($file)
{
}

if (!isset($_COOKIE['sessionID'])) {
    header("location: login.php");
    exit;
}

$session = $validate_token($_COOKIE['sessionID']);
if (!$session['is_valid']) {
    header("location: login.php");
    exit;
} else if (!$session['is_superuser']) {
    header("location: dashboard.php");
    exit;
}

require_once(__DIR__ . '/../config/image_saving.config.php');

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];
    $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES['image']['tmp_name']);

    // ADD FILE CHECKING HERE IF NEEDED

    try {
        $sql = "INSERT INTO chocolates(name, price, description, amount, image_extension)
                        VALUES (:name, :price, :description, :amount, :image_extension)";

        $pdo = $connect_db();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":image_extension", $image_extension);

        $stmt->execute();
        $id = $pdo->lastInsertId();
        // $new_filepath = __DIR__ . "/../" . CHOCO_IMG_DIR . $id . $image_extension;
        $new_filepath =  '../' . CHOCO_IMG_DIR .  $id . '.' . $image_extension;
        move_uploaded_file($_FILES["image"]["tmp_name"], $new_filepath);

        // header("location: login.php");
        // exit;

    } catch (Exception $error) {
        $error_message = $error->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="../public/css/index.css" type="text/css">
    <link rel="stylesheet" href="../public/css/new_chocolate.css" type="text/css">
</head>

<body>
    <?php include('components/header.php') ?>
    <div class="spacer"></div>
    <div class="errorMessage">
        <?php echo $error_message ?>
    </div>
    <main>
        <form id="newChocolate" action="new_chocolate.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>
                        Name:
                    </th>
                    <td>
                        <input id="nameField" name="name">
                    </td>
                </tr>

                <tr>
                    <th>
                        Price:
                    </th>
                    <td>
                        <input id="priceField" name="price">
                    </td>
                </tr>

                <tr>
                    <th>
                        Description:
                    </th>
                    <td>
                        <textarea rows="4" cols="50" form="newChocolate" id="descriptionField" name="description"></textarea>
                    </td>
                </tr>

                <tr>
                    <th>
                        Image:
                    </th>
                    <td>
                        <input type="file" id="imageField" name="image">
                    </td>
                </tr>

                <tr>
                    <th>
                        Amount:
                    </th>
                    <td>
                        <input id="amountField" name="amount">
                    </td>
                </tr>

                <tr>
                    <th>

                    </th>
                    <td>
                        <button type="submit" form="newChocolate">
                            Add Chocolate
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </main>
    <div class="spacer"></div>
    <script>

    </script>
</body>

</html>