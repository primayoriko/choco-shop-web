<?php

// Connection query change as your own needs
require_once('db_keys.config.php');


// Using mysqli
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn->connect_error){
    die("conn failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE users ( 
            username VARCHAR(50) PRIMARY KEY,
            email VARCHAR(100) UNIQUE NOT NULL,
            password_hash VARCHAR(100) NOT NULL,
            is_superuser BOOLEAN NOT NULL
        )";

if ($conn->query($sql) === TRUE){
    echo "users table successfully created\n";
} else {
    echo "ERROR create table users\n";
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
            -- id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            chocolate_id INT(6) UNSIGNED NOT NULL,
            amount INT(10) UNSIGNED NOT NULL,
            totalprice INT(18) UNSIGNED NOT NULL,
            description TEXT,
            address TEXT NOT NULL,
            time DATETIME NOT NULL,
            PRIMARY KEY (username, chocolate_id, time),
            FOREIGN KEY (chocolate_id) REFERENCES chocolates(id),
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