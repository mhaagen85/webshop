<?php

use Core\DbConnection;

$mysqli = DbConnection::getConn();

if ($mysqli->query("CREATE TABLE IF NOT EXISTS Products(product_id int NOT NULL AUTO_INCREMENT, name varchar(255), price int, description text, stock int, PRIMARY KEY ( product_id ));")) {
   //  echo "Table Products created successfully.<br />";
 } elseif ($mysqli->errno) {
   echo "Could not create table: %s<br />", $mysqli->error;
}

$mysqli->close();

