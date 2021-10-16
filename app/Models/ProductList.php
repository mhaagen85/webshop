<?php

namespace Models;

use Core\DbConnection;

class ProductList
{
    public function getProductList()
    {

        $db = DbConnection::getConn();
        return $db->query("SELECT * FROM Products")->fetch_assoc();
    }
}