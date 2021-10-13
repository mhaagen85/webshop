<?php

use Core\DbConnection;

$mysqli = New DbConnection();

if ($mysqli->conn->query("CREATE TABLE IF NOT EXISTS Products(product_id int NOT NULL AUTO_INCREMENT, name varchar(255), price int, description text, stock int, PRIMARY KEY ( product_id ));")) {
   //  echo "Table Products created successfully.<br />";
 } elseif ($this->conn->mysql->errno) {
   echo "Could not create table: %s<br />", $mysqli->conn->error;
}

$mysqli->conn->close();

