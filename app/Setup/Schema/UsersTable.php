<?php

use Core\DbConnection;

$mysqli = New DbConnection();

if ($mysqli->conn->query("CREATE TABLE IF NOT EXISTS Users(user_id int NOT NULL AUTO_INCREMENT, username varchar(255) UNIQUE, active int, password varchar(255), PRIMARY KEY ( user_id ));")) {
    // echo "Table Users created successfully.<br />";
} elseif ($mysqli->conn->errno) {
    echo "Could not create table: %s<br />", $mysqli->conn->error;
}

$mysqli->conn->close();



