<?php

namespace Models;

use Core\DbConnection;

class ProductList
{
    public function getProductList()
    {
        $db = new DbConnection();
        return $db->conn->query("SELECT * FROM Products")->fetch_assoc();
    }
}