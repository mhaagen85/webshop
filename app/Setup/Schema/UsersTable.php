<?php

use Core\DbConnection;

$mysqli = DbConnection::getConn();

if ($mysqli->query("CREATE TABLE IF NOT EXISTS Users(user_id int NOT NULL AUTO_INCREMENT, username varchar(255) UNIQUE, active int, password varchar(255), PRIMARY KEY ( user_id ));")) {
    // echo "Table Users created successfully.<br />";
} elseif ($mysqli->errno) {
    echo "Could not create table: %s<br />", $mysqli->error;
}

$mysqli->close();



