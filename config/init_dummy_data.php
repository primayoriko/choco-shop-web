<?php

require_once('db_keys.config.php');

// Using mysqli
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn->connect_error){
    die("conn failed: " . $conn->connect_error);
}


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
        "INSERT INTO `users` VALUES ('admin', 'a@g.com', '" . password_hash('123', PASSWORD_BCRYPT) . "', 1);",
        "INSERT INTO `users` VALUES ('spongebob', 'spongebob@gmail.com', '" . password_hash('kuning', PASSWORD_BCRYPT) ."', 0);",
        "INSERT INTO `users` VALUES ('patrick', 'patrick@gmail.com', '" . password_hash('merahjambu', PASSWORD_BCRYPT) ."', 0);",
        "INSERT INTO `transactions` VALUES ('spongebob', 1, 3, 36000, 'Bikini Bottom yang rumahnya bentuk nanas', '2020-07-23');",
        "INSERT INTO `transactions` VALUES ('spongebob', 5, 1, 22000, 'Bikini Bottom yang rumahnya bentuk nanas', '2020-05-17');",
        "INSERT INTO `transactions` VALUES ('spongebob', 3, 2, 20000, 'Bikini Bottom yang rumahnya bentuk nanas', '2020-02-21');",
        "INSERT INTO `transactions` VALUES ('spongebob', 8, 5, 200000, 'Bikini Bottom yang rumahnya bentuk nanas', '2020-08-16');",
        "INSERT INTO `transactions` VALUES ('spongebob', 11, 3, 9000, 'Bikini Bottom yang rumahnya bentuk nanas', '2020-06-18');",
        "INSERT INTO `transactions` VALUES ('spongebob', 2, 2, 30000, 'Bikini Bottom yang rumahnya bentuk nanas', '2020-10-29');",
        "INSERT INTO `transactions` VALUES ('patrick', 11, 9, 27000, 'Batu', '2020-12-23');",
        "INSERT INTO `transactions` VALUES ('patrick', 3, 12, 120000, 'Batu', '2020-05-25');",
        "INSERT INTO `transactions` VALUES ('patrick', 4, 15, 270000, 'Batu', '2020-07-21');",
        "INSERT INTO `transactions` VALUES ('patrick', 12, 30, 30000, 'Batu', '2020-08-22');",
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