<?php

use Core\Database;

class m0002_create_products_table
{

    public function up()
    {
        $db = Database::getConnection();
        $Sql = "CREATE TABLE IF products(
                product_id int NOT NULL AUTO_INCREMENT, 
                name varchar(255), 
                price int, 
                description text, 
                stock int, 
                PRIMARY KEY ( product_id ));";
        $db->query($Sql);
    }

    public function down()
    {
        $db = Database::getConnection();
        $Sql = "DROP TABLE products;";
        $db->query($Sql);
    }
}
