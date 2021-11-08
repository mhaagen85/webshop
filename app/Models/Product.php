<?php

namespace Models;

use Core\DbConnection;

class Product extends AbstractModel
{
    CONST TABLE = 'Products';
    CONST ID = 'product_id';

    public string $name;
    public int $price;
    public string $description;
    public int $stock;

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function create($postData)
    {
        $this->validateData($postData);
        $properties = $this->getClassProperties();

        return $this->dbConnection->query("
                    INSERT INTO `".self::TABLE."` (
                      $properties) 
                      VALUES (
                      '".$this->name."', '".$this->price."', '".$this->description."', '".$this->stock."')
                      ");
    }

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function update($postData)
    {
        $id = $postData['product_id'];
        $this->validateData($postData);

        return $this->dbConnection->query("
                UPDATE `".self::TABLE."` SET 
                name = '".$this->name."', 
                price = '".$this->price."',
                description = '".$this->description."',
                stock = '".$this->stock."'
                WHERE product_id = '".id."'
                ");
    }

}