<?php

use Core\DbConnection;

$mysqli = DbConnection::getConn();

$mysqli->query("CREATE TABLE IF NOT EXISTS Products(
    product_id int NOT NULL AUTO_INCREMENT, 
    name varchar(255), 
    price int, 
    description text, 
    stock int, 
    PRIMARY KEY ( product_id ));"
);

// Create Products when less then 15 products exists
if ($mysqli->query("SELECT * FROM Products")->num_rows < 15) {
    require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR .'/Data/products.php';
}

$mysqli->close();

