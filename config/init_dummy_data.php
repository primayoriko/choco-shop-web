<?php

require_once('db_keys.config.php');

// Using mysqli
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn->connect_error){
    die("conn failed: " . $conn->connect_error);
}

$hash = password_hash('123', PASSWORD_BCRYPT);

$dummies = [
        "INSERT INTO `chocolates` VALUES (1,'Dairy Milk',5,12000,'ntap','.jpg');",
        "INSERT INTO `chocolates` VALUES (2,'Silver Queen',2,15000,'enak bingits','.jpg');",
        "INSERT INTO `chocolates` VALUES (3,'Kinder Joy',10,10000,'enak pisan euy','.jpg');",
        "INSERT INTO `chocolates` VALUES (4,'Toblerone',32,18000,'rasanya anjim banget','.jpg');",
        "INSERT INTO `chocolates` VALUES (5,'Kitkat Green',1,22000,'booming banget dulu sampe PO ke jepun','.jpg');",
        "INSERT INTO `chocolates` VALUES (6,'Kitkat White',7,19000,'putih bersih merona','.jpg');",
        "INSERT INTO `chocolates` VALUES (7,'Kitkat Dark',9,21000,'hitam pekat kayak tubes','.jpg');",
        "INSERT INTO `chocolates` VALUES (8,'Kitkat Hello Kitty',0,25000,'gue bahkan belom pernah nyoba. Emang ada yak?','.jpg');",
        "INSERT INTO `chocolates` VALUES (9,'Dove',11,8000,'Di Borma murah wgwg','.jpg');",
        "INSERT INTO `chocolates` VALUES (10,'Alpine',12,9000,'Ini agak mahal dikit dari dove tapi mayan lah','.jpg');",
        "INSERT INTO `chocolates` VALUES (11,'Aice',2,3000,'MURAH BANGET ENAK LAGI tapi rasa keringat dan darah','.jpg');",
        "INSERT INTO `chocolates` VALUES (12,'Chocolatos',5,1000,'Udah kayak tahu bulat harganya','.jpg');",
        "INSERT INTO `chocolates` VALUES (12,'Chocolatos',5,1000,'Udah kayak tahu bulat harganya','.jpg');",
        "INSERT INTO `users` VALUES ('admin', 'a@g.com', '$hash', 1);",
];
foreach ($dummies as $sql) {
    if ($conn->query($sql)){
        echo $sql . '<span style="color: green; font-weight: bold;"> EXECUTED PROPERLY</span>';
    } else {
        echo $sql . '<span style="color: red; font-weight: bold;"> NOT EXECUTED / ALREADY EXIST</span>';
    }
    echo '<br /><br />';
}
?>