<?php

// Connection query change as your own needs
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "wbd1";


// Using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("conn failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE users ( 
            username VARCHAR(50) PRIMARY KEY,
            email VARCHAR(100) UNIQUE NOT NULL,
            passwordhash VARCHAR(100) NOT NULL,
            superuser BOOLEAN NOT NULL
        )";

if ($conn->query($sql) === TRUE){
    echo "users table successfully created";
} else {
    echo "ERROR create table users";
}

$sql = "CREATE TABLE chocolates ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            amount INT(10) UNSIGNED NOT NULL,
            price INT(12) UNSIGNED NOT NULL,
            description TEXT,
            image LONGBLOB
        )";

if ($conn->query($sql) === TRUE){
    echo "chocolates table successfully created\n";
} else {
    echo "ERROR create table chocolates\n";
}

$sql = "CREATE TABLE transactions ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            choco_id INT(6) UNSIGNED NOT NULL,
            amount INT(10) UNSIGNED NOT NULL,
            totalprice INT(18) UNSIGNED NOT NULL,
            description TEXT,
            address TEXT NOT NULL,
            time DATETIME NOT NULL,
            FOREIGN KEY (choco_id) REFERENCES chocolates(id),
            FOREIGN KEY (username) REFERENCES users(username)
        )";

// salat satu cara buat timestamp : 
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

if ($conn->query($sql) === TRUE){
    echo "transactions table successfully created\n";
} else {
    echo "ERROR create table transactions\n";
}

$conn->close();

?>