<?php

use Core\Database;

class m0001_create_users_table
{

    public function up()
    {
        $db = Database::getConnection();
        $Sql = "CREATE TABLE users(
                user_id int NOT NULL AUTO_INCREMENT, 
                username varchar(255) UNIQUE, 
                active int, 
                password varchar(255), PRIMARY KEY ( user_id ));";
        $db->query($Sql);
    }

    public function down()
    {
        $db = Database::getConnection();
        $Sql = "DROP TABLE users;";
        $db->query($Sql);
    }
}