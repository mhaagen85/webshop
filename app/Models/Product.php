<?php

namespace Models;

use Core\DbConnection;

class Product extends AbstractModel
{
    const TABLE = 'Products';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function delete()
    {
        return $this->conn->query("DELETE FROM $this->table WHERE product_id = '".$_GET['id']."'");
    }

    public function create($postData)
    {
        $name = $postData['name'];
        $price = $postData['price'];
        $description = $postData['description'];
        $stock = $postData['stock'];

        return $this->conn->query("INSERT INTO Products (
                      name, price, description, stock) VALUES ('".$name."', '".$price."', '".$description."', '".$stock."')");
    }

    public function update($postData)
    {
        $id = $postData['product_id'];
        $name = $postData['name'];
        $price = $postData['price'];
        $description = $postData['description'];
        $stock = $postData['stock'];

        return $this->conn->query("UPDATE Products SET 
                name = '".$name."', 
                price = '".$price."',
                description = '".$description."',
                stock = '".$stock."'
                WHERE product_id = '".$id."'
                ");
    }

    public function getById($id)
    {
        return $this->conn->query("SELECT * FROM $this->table WHERE product_id = '".$_GET['id']."'")->fetch_assoc();
    }
}