<?php

namespace Models;

use Core\DbConnection;

class ProductList
{
    public function getProductList()
    {

        $db = DbConnection::getConn();
        return $db->query("SELECT name, price,stock FROM Products")->fetch_all(MYSQLI_ASSOC);
    }
}