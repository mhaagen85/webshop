<?php

use Core\Database;

class m0003_seed_products_table
{

    public function up()
    {
        $db = Database::getConnection();
        $productsNames = ['fiets','driewieler','skelter','vouwfiets','step','racefiets','skateboard'];
        $price = rand(1,250);
        $description = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1, 10);
        $stock = rand(1,250);

        for($x = 0; $x <= 10; $x++) {
            $productNameGenerated = array_rand($productsNames, 1);
            $name = $productsNames[$productNameGenerated];
            $db->query("INSERT INTO Products (name, price, description, stock) VALUES ('".$name."', '".$price."', '".$description."', '".$stock."')");
        }

    }

    public function down()
    {
        $db = Database::getConnection();
        $Sql = "TRUNCATE TABLE products;";
        $db->query($Sql);
    }
}
