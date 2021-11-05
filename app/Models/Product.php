<?php

namespace Models;

use Core\DbConnection;

class Product extends AbstractModel
{
    CONST TABLE = 'Products';
    CONST ID = 'product_id';
    protected $properties = ['name', 'price', 'description', 'stock'];

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function create($postData)
    {
        $name = $postData['name'];
        $price = $postData['price'];
        $description = $postData['description'];
        $stock = $postData['stock'];

        $properties = implode(',', $this->properties);

        return $this->dbConnection->query("
                    INSERT INTO `".self::TABLE."` (
                      $properties) 
                      VALUES (
                      '".$name."', '".$price."', '".$description."', '".$stock."')
                      ");
    }

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function update($postData)
    {
        $id = $postData['product_id'];
        $name = $postData['name'];
        $price = $postData['price'];
        $description = $postData['description'];
        $stock = $postData['stock'];

        return $this->dbConnection->query("
                UPDATE `".self::TABLE."` SET 
                name = '".$name."', 
                price = '".$price."',
                description = '".$description."',
                stock = '".$stock."'
                WHERE product_id = '".$id."'
                ");
    }

}