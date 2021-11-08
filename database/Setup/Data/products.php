<?php

use Core\DbConnection;

$mysqli = DbConnection::getConn();

$productsNames = ['fiets','driewieler','skelter','vouwfiets','step','racefiets','skateboard'];
$price = rand(1,250);
$description = generateDescription();
$stock = rand(1,250);

function generateDescription() {
    $length = 10;
    return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
}

for($x = 0; $x <= 2; $x++) {
    $productNameGenerated = array_rand($productsNames, 1);
    $name = $productsNames[$productNameGenerated];

    $mysqli->query("INSERT INTO Products (name, price, description, stock) VALUES ('".$name."', '".$price."', '".$description."', '".$stock."')");
}
